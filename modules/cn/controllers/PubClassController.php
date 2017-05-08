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
use app\modules\cn\models\Pubclass;
class PubclassController extends Controller{
    public function actionIndex(){
        $pubclass=new pubclass();
        $pubclass->getTime();
        $data = Yii::$app->db->createCommand("select * from {{%info}} where isShow=1 and cate='公开课'")->queryAll();
        $arr = Yii::$app->db->createCommand("select * from {{%info}} where isShow=0 and cate='公开课'")->queryAll();
//        var_dump($data);die;
        return $this->renderPartial('index',['data'=>$data,'arr'=>$arr]);
    }
//    public function actionDetails(){
////        从数据表获取数据
//         $id = Yii::$app->request->get('id', '');
//        $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=$id ")->queryOne();
//        $arr = Yii::$app->db->createCommand('select * from {{%info}}  order by hits desc ')->queryAll();
//        return $this->renderPartial('info/details',["data"=>$data,arr''=>$arr]);
//    }
}