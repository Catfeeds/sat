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

class MockController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
//        $keyword='OG';
        $data=Yii::$app->db->createCommand("select name,time from {{%testpaper}}")->queryAll();
        $og=Yii::$app->db->createCommand("select name,time from {{%testpaper}} where name='OG'")->queryAll();
        $princeton=Yii::$app->db->createCommand("select name,time from {{%testpaper}} where name='普林斯顿'")->queryAll();
        $kaplan=Yii::$app->db->createCommand("select name,time from {{%testpaper}} where name='开普兰'")->queryAll();
        $barron=Yii::$app->db->createCommand("select name,time from {{%testpaper}} where name='BARRON'")->queryAll();
        return $this->render('index',['data'=>$data,'og'=>$og,'princeton'=>$princeton,'kaplan'=>$kaplan,'barron'=>$barron]);
    }

    public function actionDetails()
    {
        $id=10;
        $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=".$id)->queryAll();
    }

//    public function actionMock()
//    {
//        $keyword=Yii::$app->request->post('keyword');
//        $data=Yii::$app->db->createCommand("select name,time from {{%testpaper}} where name='$keyword'")->queryAll();
//        $arr=array();
//        foreach($data as $k=>$v){
//            $arr[$k]=$v['name'].$v['time'];
//        }
//        die(json_encode($data));
//    }
}