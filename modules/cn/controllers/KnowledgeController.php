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

class KnowledgeController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%knowledge}} order by id desc")->queryAll();
        return $this->render('index',['data'=>$data]);
    }

    public function actionDetails()
    {

    }
}