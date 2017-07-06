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

    }

    public function actionNotice()
    {
        $this->layout = 'cn1.php';
        $tid = Yii::$app->request->get('tid');
        $major = Yii::$app->request->get('m', '');
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
        $count=$a->Gettype();
        if ($major != false) {
            if ($major == 'Math') {
                $major='major="Math1" or major="Math2"';
                $where="where tpId=" . $id . " and $major";
                $modle = 'mock_math';
                $time=80*60;
                $amount=58;
                $amount=3;
            } else {
                if($major=='Reading'){$time=62*60;$amount=52;$amount=2;}
                if($major=='Writing'){$time=35*60;$amount=44;$amount=3;}
                $where = "where tpId=" . $id . " and major='$major'";
                $modle = 'mock_read';
            }
            $section = Yii::$app->db->createCommand("select DISTINCT section from {{%questions}} $where order by section asc limit 1")->queryOne();
        } else {
            $where = "where section=1";
            $section = Yii::$app->db->createCommand("select section from {{%questions}} $where")->queryOne();
            $modle = 'mock_read';
            $time=62*60;
            $amount=52;
            $amount=2;
        }
        if (!$qid) {
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where section=".$section['section']."  and q.number='1'")->queryOne();
        } else {

            // 有qid的时候直接根据qid取
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=" . $qid )->queryOne(); // 这里是一维还是二唯数据
        }
//        var_dump($data);
        return $this->render($modle, ['data' => $data,'time'=>$time,'count'=>$count,'amount'=>$amount]);
//        $this->actionSection();
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
        $number= Yii::$app->request->get('number');
        $section= Yii::$app->request->get('section');
        $a = KeepAnswer::getCat();
         Yii::$app->session->set('uid',$uid);
         Yii::$app->session->set('tpId',$tid);
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
    public function actionSection()
    {
        $number= Yii::$app->request->get('number');
        $section= Yii::$app->request->get('section');
        $section=$section+2;
        $tid = Yii::$app->request->get('tid');
        $qid = Yii::$app->request->get('qid');
        $solution = Yii::$app->request->get('solution');// 用户提交的答案
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $solution);// 将答案保存到session里
        // 还是取下一题的qid
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where  tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        echo die(json_encode($data));
    }

}