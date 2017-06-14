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
//        var_dump($data);die;
        return $this->render('index',['data'=>$data,'page'=>$str]);
    }

    public function actionExercise()
    {
        $id=Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=".$id)->queryOne();
//        如果有短文或图片
//        var_dump($data);die;
        return $this->render('exercise',['data'=>$data]);
    }

}