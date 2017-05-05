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
use app\modules\cn\models\classes;
class ClassesController extends Controller{
    public function actionIndex(){
        $data = Yii::$app->db->createCommand("select id,major,introduction,cate from {{%classes}} ")->queryAll();
//        $now_path=ltrim($_SERVER['REQUEST_URI'],'/');
//        $classes=new Classes();
//        $fiels="id,major,introduction,cate";
//            $table="classes";
//        $data=$classes->getData($table,$fiels);
//        var_dump($now_path);
        $banner = Yii::$app->db->createCommand("select pic,url,alt from {{%banner}}  where module='classes'")->queryAll();
//        var_dump($banner);
        return $this->renderPartial('index',['data'=>$data,'banner'=>$banner]);
    }
    public function actionDetails(){
//        从数据表获取数据
         $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=$id ")->queryOne();
        return $this->renderPartial('details',["data"=>$data]);
    }
}