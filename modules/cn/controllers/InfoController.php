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
//        $data = Yii::$app->db->createCommand("select * from {{%info}} where isShow=1 and cate='公开课'")->queryAll();
//        $arr = Yii::$app->db->createCommand("select * from {{%info}} where isShow=0 and cate='公开课'")->queryAll();
//        var_dump($data);die;
        return $this->renderPartial('index');
    }
    public function actionDetails(){
//        从数据表获取数据

        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%info}} where id=$id")->queryOne();
        if($data['cate']=="公开课"){
            $arr = Yii::$app->db->createCommand('select * from {{%info}} where cate="公开课" order by hits desc ')->queryAll();
        }elseif($data['cate']=="新闻资讯"){
            $arr = Yii::$app->db->createCommand('select * from {{%info}} where cate="新闻资讯" order by hits desc ')->queryAll();
        }else{
            $arr = Yii::$app->db->createCommand('select * from {{%info}} where cate="备考资讯" order by hits desc ')->queryAll();
        }
        $brr = Yii::$app->db->createCommand('select * from {{%info}} where isShow=1 order by hits desc limit 5 ')->queryAll();
//        var_dump($arr);die;
        return $this->renderPartial('details',['data'=>$data,'arr'=>$arr,'brr'=>$arr]);
    }
}