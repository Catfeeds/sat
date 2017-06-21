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
use app\modules\cn\models\Questions;

class ExerciseController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
       $model=new Questions();
        $data=$model->data();
        $str=$data['str'];
        unset($data['str']);
        $arr = Yii::$app->db->createCommand("select * from {{%questions}} order by id desc limit 6")->queryAll();
        return $this->render('index',['data'=>$data,'page'=>$str,'arr'=>$arr]);
    }

    public function actionExercise()
    {
        $id=Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=".$id)->queryOne();
        // 上下一题逻辑不太对

        $nextid = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$id."limit 1" )->queryOne();
        $upid = Yii::$app->db->createCommand("select id from {{%questions}} where id<".$id."limit 1" )->queryOne();
//        如果有短文或图片
        if($data['pid']!=false){
            $crr = Yii::$app->db->createCommand("select essay from {{%questions}} where id=".$data['pid'])->queryOne();
            $data= Yii::$app->db->createCommand("select  from {{%questions}} where pid=".$data['pid'])->queryAll();
            return $this->render('exercise',['crr'=>$crr,'data'=>$data,'nextid'=>$nextid,'upid'=>$nextid]);
        }else{
            return $this->render('exercise',['data'=>$data,'nextid'=>$nextid,'upid'=>$nextid]);
        }
    }

}