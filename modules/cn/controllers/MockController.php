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
use app\modules\cn\controllers\ReportController;
use app\modules\cn\models\Report;
use app\modules\cn\models\Questions;

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
        $score=Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid order by r.score limit 10")->queryAll();
        return $this->render('index', ['data' => $data, 'og' => $og, 'princeton' => $princeton, 'kaplan' => $kaplan, 'barron' => $barron,'score'=>$score]);

    }

    public function actionNotice()
    {
        $this->layout = 'cn1.php';
        $tid = Yii::$app->request->get('tid');
        $major = Yii::$app->request->get('m', '');
        session_start();
        if(isset($_SESSION['answer'])){
            $_SESSION['answer']='';
        }
        $_SESSION['part']=$major;
        return $this->render('mock-notice', ['tid' => $tid, '$major' => $major]);


    }

    // 开始模考功能，无qid取第一道题，有qid取题目详情
    public function actionDetails()
    {
        session_start();
        $this->layout = 'cn1.php';
        $major = Yii::$app->request->get('m', '');
        $id = Yii::$app->request->get('tid');
        $qid = Yii::$app->request->get('qid', '');
        $a = KeepAnswer::getCat();
        $count = $a->Gettype();
        if ($major != false) {
            if ($major == 'Math') {
                $major = 'major="Math1" or major="Math2"';
                $where = "where tpId=" . $id . " and $major";
            } else {
                $where = "where tpId=" . $id . " and major='$major'";
            }
            $section = Yii::$app->db->createCommand("select DISTINCT section from {{%questions}} $where order by section asc limit 1")->queryOne();
        } else {
            $where = "where section=1";
            $section = Yii::$app->db->createCommand("select section from {{%questions}} $where")->queryOne();
        }
        if (!$qid) {
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where section=" . $section['section'] . "  and q.number='1'")->queryOne();
        } else {
            // 有qid的时候直接根据qid取
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=" . $qid)->queryOne(); // 这里是一维还是二唯数据
        }
        if($data['major']=='Math1'||$data['major']=='Math2'){
            $time  =80;
            $amount=58;
            $amount=2;
            $modle = 'mock_math';
        }elseif($data['major']=='Reading'){
            $time  =62;
            $amount=52;
            $amount=2;
            $modle = 'mock_read';
        }else{
            $time  =35;
            $amount=44;
            $amount=0;
            $modle = 'mock_read';
        }

        return $this->render($modle, ['data' => $data, 'time' => $time, 'count' => $count, 'amount' => $amount]);
    }

    // 下一题
    public function actionNext()
    {
        // 是只存id 和答案，还是报告所需数据都存
        $solution = Yii::$app->request->get('solution');// 用户提交的答案
        $major = Yii::$app->request->get('major');// 学科
        $tid = Yii::$app->request->get('tid');
        $qid = Yii::$app->request->get('qid');
        $uid = Yii::$app->request->get('uid');
        $utime = Yii::$app->request->get('utime');
        $number = Yii::$app->request->get('number');
        $section = Yii::$app->request->get('section');
        session_start();
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $solution,$utime);

        // 正确率等的计算，勿删
        $model=new Questions();
        $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=" . $qid)->queryOne();
        $re=$model->avg($solution,$utime,$data);

        $_SESSION['uid'] = $uid;
        $_SESSION['tid'] = $tid;
//        $re = $a->addPro($qid, $solution,$utime);
        $next['sectionNum'] = $a->Gettype();// 目前第几题
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

    public function actionSection()
    {
//        $number = Yii::$app->request->get('number');
        $section = Yii::$app->request->get('section');
        $count = Yii::$app->request->get('allPos');
        $section = $section + 1;
        $tid = Yii::$app->request->get('tpId');
        $qid = Yii::$app->request->get('qid');
        $utime = Yii::$app->request->get('utime');
        $time = Yii::$app->request->get('allTime');
        Yii::$app->session->set('time',$time);
        $solution = Yii::$app->request->get('solution');// 用户提交的答案
//        session_start();
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $solution,$utime);// 将答案保存到session里

        // 正确率等的计算，勿删
        $model=new Questions();
        $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=" . $qid)->queryOne();
        $re=$model->avg($solution,$utime,$data);

        // 统计答题总数
        if($count<8){
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number=1 and tpId=" . $tid . " and section='$section' limit 1 ")->queryOne();
//        var_dump($data);die;
            echo die(json_encode($data));
        }else{
            echo die(json_encode('rep'));
        }

    }

}