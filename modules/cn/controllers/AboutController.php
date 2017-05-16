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
class AboutController extends Controller{
    public function actionAbout(){
        return $this->renderPartial('about');
    }
    public function actionSuggest(){
//        var_dump($_POST);DIE;
        $sugData['suggest']= Yii::$app->request->post('suggest');
//        $sugData['uid']= $_SESSION['uid'];
        $re = Yii::$app->db->createCommand()->insert("{{%suggest}}",$sugData)->execute();

    }
}