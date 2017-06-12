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

class ExerciseController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
        $path=Yii::$app->request->get('path','');
        $cate=Yii::$app->request->get('c','');
//        if($cate!=false){
//            $data = Yii::$app->db->createCommand("select * from {{%testpaper}} where =".$path)->queryAll();
//        }
//            $data = Yii::$app->db->createCommand("select * from {{%questions}} where major=".$path)->queryAll();
        return $this->render('index');
    }

    public function actionExercise()
    {
        $id=Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=".$id)->queryOne();
        if($data['essay'])
        return $this->render('exercise');
    }

}