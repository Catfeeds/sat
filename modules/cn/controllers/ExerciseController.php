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
        $arr = Yii::$app->db->createCommand("select * from {{%topic}} order by id desc limit 6")->queryAll();
        return $this->render('index',['data'=>$data,'page'=>$str,'arr'=>$arr]);
    }

    public function actionExercise()
    {
        $id=Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select q.*,qe.* from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=".$id)->queryAll();
        // 上下一题逻辑不太对

//        var_dump($data);die;
        $nextid = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$id." and major= ".$data['major']." and section=".$data['section']." and tpId=".$data['tpId']." limit 1" )->queryOne();
        $upid = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$id." and major= ".$data['major']." and section=".$data['section']." and tpId=".$data['tpId']." limit 1" )->queryOne();

//        var_dump($data);die;
//        $nextid = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$id." and major= ".$data['major']." and section=".$data['section']." and tpId=".$data['tpId']." limit 1" )->queryOne();
//        $upid = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$id." and major= ".$data['major']." and section=".$data['section']." and tpId=".$data['tpId']." limit 1" )->queryOne();

            return $this->render('exercise',['data'=>$data,'nextid'=>$nextid,'upid'=>$nextid]);

    }

}