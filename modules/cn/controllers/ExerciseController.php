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
        $arr = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId order by q.id desc limit 6")->queryAll();
        return $this->render('index',['data'=>$data,'page'=>$str,'arr'=>$arr]);
    }

    public function actionExercise()
    {
        $id=Yii::$app->request->get('id');
//        var_dump($id);die;
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=".$id)->queryOne();
//        var_dump($data);die;
//        if($data['major']=='Math1'||$data['major']=='Math2') {
//            $major='Math';
//        }else{
            $major=$data['major'];
//        }
        $nextid = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$id." and major= '$major' and section=".$data['section']." and tpId=".$data['tpId']." order by id asc limit 1" )->queryOne();
        $upid = Yii::$app->db->createCommand("select id from {{%questions}} where id<".$id." and major='$major' and section=".$data['section']." and tpId=".$data['tpId']." order by id desc limit 1" )->queryOne();
        // 查找题目是否收藏
        $data['uid']=Yii::$app->session->get('uid',444);
        if($data['uid']){
            $arr= Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=".$data['uid'])->queryOne();
            $collection=explode(',',$arr['qid']);
            if(in_array($data['qid'],$collection)){
                $data['collection']=1;
            }else{
                $data['collection']=0;
            }
        }
        return $this->render('exercise',['data'=>$data,'nextid'=>$nextid['id'],'upid'=>$upid['id']]);

    }

}