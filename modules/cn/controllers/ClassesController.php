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
use app\modules\cn\models\teachers;

class ClassesController extends Controller
{
    public $layout="cn.php";
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%classes}} ")->queryAll();
        $banner = Yii::$app->db->createCommand("select pic,url,alt from {{%banner}}  where module='classes'")->queryAll();
//        var_dump($banner);
//        $teachers= Yii::$app->db->createCommand("select pic,name,subject,introduction from {{%teachers}} ")->queryAll();
//        $info= Yii::$app->db->createCommand("select id,title,summary from {{%info}} where isShow=1 and cate='开班信息'")->queryAll();
//        var_dump($info);die;
        return $this->render('index', ['data' => $data, 'banner' => $banner]);
    }

    public function actionDetails()
    {
//        从数据表获取数据
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=$id ")->queryOne();
        return $this->render('details', ["data" => $data]);
    }
}