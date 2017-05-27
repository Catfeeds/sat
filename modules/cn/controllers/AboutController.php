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
use app\modules\cn\models\classes;
use app\modules\cn\models\teachers;

class AboutController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'cn.php';
    public function actionAbout()
    {
        $contact = Yii::$app->db->createCommand("select * from {{%contact}} ")->queryAll();
        $join = Yii::$app->db->createCommand("select * from {{%job_offers}} ")->queryAll();
        $session = Yii::$app->session;
        $user=$session->get('userData');
        return $this->render('about',['join'=>$join,'contact'=>$contact,'user'=>$user]);
    }

    public function actionSuggest()
    {
//        var_dump($_POST);DIE;
        $sugData['suggest'] = Yii::$app->request->post('suggest');
        $sugData['suggest']=htmlspecialchars($sugData['suggest']);
        $session = Yii::$app->session;
        $sugData['uid']=$session->get('userId');
        $re = Yii::$app->db->createCommand()->insert("{{%suggest}}", $sugData)->execute();
        if($re){
            echo'<script>alert("发表成功，谢谢您宝贵的意见")</script>';
            header('Location:http://www.sysat.com/about.html');
        }

    }
}