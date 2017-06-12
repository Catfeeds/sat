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
        $major=Yii::$app->request->get('m','');
        $cate=Yii::$app->request->get('c','');
        if($major!=false){
            $where="where major = '$major'";
            if($cate!=false){
                $where=$where." and cate='$cate'";
            }
        }else{
            if($cate!=false){
                $where="where cate='$cate'";
            }else{
                $where='';
            }
        }
        $data = Yii::$app->db->createCommand("select * from {{%questions}} $where")->queryAll();
//        var_dump($data);die;
        return $this->render('index',['data'=>$data]);
    }

    public function actionExercise()
    {
        $id=Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=".$id)->queryOne();
        if($data['essay'])
        return $this->render('exercise');
    }

}