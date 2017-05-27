<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use yii\web\controller;

class AboutController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'cn.php';
    public $token;
    public function actionAbout()
    {
        $contact = Yii::$app->db->createCommand("select * from {{%contact}} ")->queryAll();
        $join = Yii::$app->db->createCommand("select * from {{%job_offers}} ")->queryAll();
        $session = Yii::$app->session;
        $token=md5(rand(1,999999));
        $session->set('token', $token);
        $user=$session->get('userData');
        return $this->render('about',['join'=>$join,'contact'=>$contact,'user'=>$user,'token'=>$token]);
    }

    public function actionSuggest()
    {
        $sugData['suggest'] = Yii::$app->request->post('suggest');
        $sugData['suggest']=htmlspecialchars($sugData['suggest']);
        $session = Yii::$app->session;
        $sugData['uid']=$session->get('userId');
        $count = Yii::$app->db->createCommand("select count(*) from {{%suggest}}where uid=". $sugData['uid'])->queryOne();
        $count=$count['count(*)'];
        if($count>10){
            die('<script>alert("您已经给我们提出了很多意见了，给其他人一个机会吧");history.go(-1)</script>');
        }else{
            $re = Yii::$app->db->createCommand()->insert("{{%suggest}}", $sugData)->execute();
            if($re){
                echo'<script>alert("发表成功，谢谢您宝贵的意见");window.location.href="/about.html"  </script>';
            }else{
                die('<script>alert("提交失败");history.go(-1)</script>');
            }
        }
    }
}