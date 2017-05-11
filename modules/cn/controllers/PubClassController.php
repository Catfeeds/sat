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
use app\modules\cn\models\Info;
class PubclassController extends Controller{
    public function actionIndex(){
        $pubclass=new pubclass();
        $pubclass->getTime();
        $data = Yii::$app->db->createCommand("select * from {{%info}} where isShow=1 and cate='公开课'")->queryAll();
        $arr = Yii::$app->db->createCommand("select * from {{%info}} where isShow=0 and cate='公开课'")->queryAll();
//        var_dump($data);die;
        return $this->renderPartial('index',['data'=>$data,'arr'=>$arr]);
    }
    public function actionApply(){
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select hits,id from {{%info}} where id=$id ")->queryOne();
        $data['hits']+=1;
//        var_dump($hits);die();
        $info = new Info();
        $re=$info->updateAll($data,'id=:id',array(':id'=>$id));
        if ($re){
            echo $data['hits'];
        }else{
            echo "报名失败！";
        }

    }
}