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
use app\modules\cn\models\info;
class InfoController extends Controller{
    public function actionIndex(){
//        $pubclass=new pubclass();
//        $pubclass->getTime();
        $data = Yii::$app->db->createCommand("select * from {{%info}}")->queryAll();
//        $arr = Yii::$app->db->createCommand("select * from {{%info}} where isShow=0 and cate='公开课'")->queryAll();
//        var_dump($data);die;
        return $this->renderPartial('index',['data'=>$data]);
    }
    public function actionDetails(){
//        从数据表获取数据
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%info}} where id=$id")->queryOne();
        $cate=$data['cate'];
        $arr = Yii::$app->db->createCommand("select * from {{%info}} where cate='$cate' order by hits desc ")->queryAll();
        $brr = Yii::$app->db->createCommand('select * from {{%info}} where isShow=1 order by hits desc limit 5 ')->queryAll();
        return $this->renderPartial('details',['data'=>$data,'arr'=>$arr,'brr'=>$brr]);
    }
}