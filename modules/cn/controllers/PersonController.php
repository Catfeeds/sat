<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\libs\Format;
use yii;
use yii\web\Controller;
use app\modules\cn\models\Notes;
use app\modules\cn\models\Collection;


class PersonController extends Controller
{
    public $layout='cn.php';
    public function actionCollect(){
        $uid=Yii::$app->session->get('uid');
        $uid=444;
        $arr= Yii::$app->db->createCommand("select * from {{%collection}} where uid=".$uid)->queryOne();
        $qid=ltrim($arr['qid'],',');
        $data= Yii::$app->db->createCommand("select q.id as qid,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid)")->queryAll();
//        var_dump($data);die;

        return $this->render('person_collect',['data'=>$data]);
    }
    public function actionExercise(){
        $uid=Yii::$app->session->get('uid');
        $uid=222;
        $arr= Yii::$app->db->createCommand("select * from {{%notes}} where uid=".$uid)->queryOne();
        if ($arr['notes'] != false) {
            $brr = explode(';', $arr['notes']);
            static $crr = array();
            static $s ='';
            foreach ($brr as $k => $v) {
                if ($v !='') {
                    $key=explode(',', $v)[0];
                    $crr[$key]=explode(',', $v);
                    $s.=$key.',';
                }

            }
        }
        $qid=rtrim($s,',');
        $data= Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid)")->queryAll();
        static $n=0;
        foreach($data as $k=>$v){
            if($v['answer']==$crr[$v['qid']][1]){
                $n+=1;
            }
        }
//        var_dump($data);die;
        return $this->render('person_exercise',['data'=>$data,'crr'=>$crr,'n'=>$n]);
    }
    public function actionMock(){
        $uid=Yii::$app->session->get('uid');
        $uid=222;
        $arr= Yii::$app->db->createCommand("select r.*,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=".$uid)->queryAll();
//        var_dump($arr);die;
//        $format=new Format();
//        $format->FormatTime($arr['rtime']);
        return $this->render('person_mock',['arr'=>$arr]);
    }
    public function actionColl()
    {
        $uid=Yii::$app->session->get('uid');
        $uid=444;
        $name=Yii::$app->request->get('src');
        $major=Yii::$app->request->get('classify');
        $model=new collection();
        $data=$model->CollectionDate($name,$uid,$major);
//        $arr= Yii::$app->db->createCommand("select * from {{%collection}} where uid=".$uid)->queryOne();
//        $qid=ltrim($arr['qid'],',');
//        $data= Yii::$app->db->createCommand("select q.id as qid,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid)")->queryAll();
        echo die(json_encode($data));
    }
    public function actionExer()
    {
        $uid=Yii::$app->session->get('uid');
        $uid=222;
        $name=Yii::$app->request->get('src');
        $major=Yii::$app->request->get('classify');
        $error=Yii::$app->request->get('case');
//        var_dump($error);die;
        $notes=new Notes();
        $data=$notes->Ex($uid,$name,$major,$error);
        echo die(json_encode($data));
    }
    public function actionMo()
    {
        $uid=Yii::$app->session->get('uid');
        $uid=222;
        $src=Yii::$app->request->get('src');
        $type=Yii::$app->request->get('type');
        if($src !='all'){
            $name="and name='$src'";
        }else{
            $name='';
        }
        if($type=='whole'){
            $part='';
        }else{
            $part="and part ='$type'";
        }

        $arr= Yii::$app->db->createCommand("select r.*,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=$uid $name $part")->queryAll();
       echo die(json_encode($arr));
    }
}