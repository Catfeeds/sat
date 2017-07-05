<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use yii\web\Controller;
use app\libs\KeepAnswer;
use app\libs\GetScore;

class MockController extends Controller
{
    public $layout = ' ';

    public function actionIndex()
    {
        $this->layout = 'cn.php';
        $data = Yii::$app->db->createCommand("select id,name,time from {{%testpaper}}")->queryAll();
        $og = Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='OG'")->queryAll();
        $princeton = Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='princeton'")->queryAll();
        $kaplan = Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='kaplan'")->queryAll();
        $barron = Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='BARRON'")->queryAll();
//        var_dump($data);die;
        return $this->render('index', ['data' => $data, 'og' => $og, 'princeton' => $princeton, 'kaplan' => $kaplan, 'barron' => $barron]);


//        $this->actionNext();
    }

    public function actionNotice()
    {
        $this->layout = 'cn1.php';
        $tid = Yii::$app->request->get('tid');
        $major = Yii::$app->request->get('m', '');
        return $this->render('mock-notice', ['tid' => $tid, '$major' => $major]);


    }

    // 开始模考功能，只取每个模块的第一道题
    public function actionDetails()
    {
        session_start();
//        var_dump($_SESSION);
//        $this->actionReport();
//        die;
        $this->layout = 'cn1.php';
        $major = Yii::$app->request->get('m', '');
        $id = Yii::$app->request->get('tid');
//        $section = Yii::$app->request->get('s','1');// 章节数，用于提取下一个小节
//
//        $number = Yii::$app->request->get('n','1');// 题目号
        $qid = Yii::$app->request->get('qid', '');
        if ($major != false) {
            if ($major == 'Math') {
                $where = "where tpId=" . $id . " and (major='Math1' or major='Math2')";
                $modle = 'mock_math';
            } else {
                $where = "where tpId=" . $id . " and major='$major'";
                $modle = 'mock_read';
            }
        } else {
            $where = "where tpId=$id ";
            $modle = 'mock_read';
        }
        if (!$qid) {
//            $where .= " and number='1'";
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where section='1'  and q.number='1'")->queryOne();

//            $id = Yii::$app->db->createCommand("select id from {{%questions}} $where order by id asc limit 1")->queryOne();
//            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=" . $id['id'] . " order by q.id asc limit 1")->queryOne();
        } else {
//            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=" . $qid)->queryOne();
//            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number. " and section=".$section." limit 1")->queryOne(); // 这里是一维还是二唯数据
            // 有qid的时候直接根据qid取
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=" . $qid )->queryOne(); // 这里是一维还是二唯数据
        }
//        var_dump($data);
        return $this->render($modle, ['data' => $data]);
    }

    // 模考报告的生成
    // 1、判断正确略
    // 2、得出报告分数（数学，reading。writing）
    // 选题逻辑
    // 将题目的ID，答案都传过来
    // 前端点击传递id，和用户所选答案过来，
    // 下一题
    public function actionNext()
    {
        // 是只存id 和答案，还是报告所需数据都存
        $solution = Yii::$app->request->get('solution');// 用户提交的答案
//        $answer = Yii::$app->request->get('answer');// 正确答案
        $major = Yii::$app->request->get('major');// 学科
//        $crossScore = Yii::$app->request->get('crossScore');// 跨学科分类
//        $subScore=Yii::$app->request->get('subScore');// 正确答案
        $tid = Yii::$app->request->get('tid');
        $qid = Yii::$app->request->get('qid');
        $uid = Yii::$app->request->get('uid');
        $number= Yii::$app->request->get('number');
        $section= Yii::$app->request->get('section');
//        session_start();
        $a = KeepAnswer::getCat();
         Yii::$app->session->set('uid',$uid);
         Yii::$app->session->set('tpId',$tid);
//        $_SESSION['tpId'] = $tid;
//        $_SESSION['uid'] = $uid;
        $re = $a->addPro($qid, $solution);
        $next['sectionNum'] = $a->Gettype();// 目前第几题
        $next['mkNum'] = 5;// 所答第几题/总题数
//        $next=Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id>".$qid." and tpId=".$tid." and major='$major' limit 1 ")->queryOne();
        $next = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        echo die(json_encode($next));

    }

    // 做题中途离开
    public function actionLeave()
    {
        $a = KeepAnswer::getCat();
        $re = $a->Emptyitem();
        echo die(json_encode($re));
    }
    // 小节提交数据，并显示下一小节第一道题
    // 存在用户uid 和不存在 uid
//    public function actionReport()
//    {
//        // 将session 的数据存到数据库
////        session_start();
//        // 现在生成的报告
////        if(isset( $_SESSION['answer'])){
////            $uid=$report['uid'] = $_SESSION['uid'];
//        $uid = $report['uid'] = 222;
////            var_dump($uid);die;
//        $answerData = ((array)$_SESSION['answer']);
//        $answerData = $answerData['item'];// 获取用户的答题数据
//        $getscore = new GetScore();
//        $number = $getscore->Number($answerData);
//        $score = $getscore->Score($number);// 各科分数均有，按科目的分类
//        $subscore = $getscore->Subscore($number);
//
////        var_dump($number);die;
//        $crosstest = $getscore->CrossTest($number);
//        $report['tpId'] = $_SESSION['tpId'];
//        $report['readnum'] = $number['Reading'];
//        $report['mathnum'] = $number['Math'];
//        $report['writenum'] = $number['Writing'];
//        $report['matherror'] = $number['matherror'];
//        $report['readerror'] = $number['readerror'];
//        $report['writeerror'] = $number['writeerror'];
//        $report['jumpnum'] = $number['kip'];
//        $report['subScore'] = $subscore['total'];
//        $report['score'] = $score['total'];
//        $report['crossScore'] = $crosstest['total'];
//        $report['data'] = time();
////            $report['time']=$_COOKIE['time'];// 可以在cookie中直接取
//        if ($uid) {
//            // 将答案组合成字符串
//            static $temp = array();
//            foreach ($answerData as $v) {
//                $v = join(",", $v); //可以用implode将一维数组转换为用逗号连接的字符串
//                $temp[] = $v;
//            }
//            $t = "";
//            foreach ($temp as $v) {
//                $t .= $v . ";";
//            }
//            $t = substr($t, 0, -1);
//            $report['answer'] = $t;
////                var_dump($subscore);die;
//            $re = Yii::$app->db->createCommand()->insert("{{%report}}", $report)->execute();
//            if ($re) {
//                $a = KeepAnswer::getCat();
////                    $re=$a->Emptyitem();
////                    $getscore->Assignment();
//            }
//        }
//        $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Math'] . " and min<" . $score['Math'] . " and major='Math'")->queryOne();
//        $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Reading'] . " and min<" . $score['Reading'] . " and major='Reading'")->queryOne();
//        $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Writing'] . " and min<" . $score['Writing'] . " and major='Writing'")->queryOne();
////            var_dump($report);die;
////        }else{
////            // 登录之后才能查看历史报告
////            $uid=Yii::$app->session->get('uid','0');
////            $report=Yii::$app->db->createCommand("select * from {{%report}} where uid=".$uid)->queryAll();
////            foreach($report as $k=> $v){
////                static $arr=array(); static $brr=array();
////                $arr=implode(';',$report[$k]['answer']);
////                foreach($arr as $key=>$val){
////                    $brr=implode(',',$arr[$key]);
////                }
//    }
    // 将答案渲染到报告的模板

    //根据作对的题数，取建议
    // 有几套试卷的话也取不过来的

//        return $this->render('report',['report'=>$report,'suggest'=>$suggest]);
    // 没有登录的时候直接生成一次性报告

//        var_dump($t);


}