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
use app\libs\Pager;
use app\modules\cn\models\teachers;

class SatController extends Controller
{
//    public $layout='cn.php';
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select id,cate,introduction,cate from {{%classes}} ")->queryAll();
        $banner = Yii::$app->db->createCommand("select pic,url,alt from {{%banner}}  where module='classes'")->queryAll();
//        var_dump($banner);
        $teachers = Yii::$app->db->createCommand("select pic,name,subject,introduction from {{%teachers}} ")->queryAll();
        $info1 = Yii::$app->db->createCommand("select id,content from {{%info}} where cate='公开课' and isShow='1' order by id desc limit 5")->queryAll();
//        $info2= Yii::$app->db->createCommand("select id,title from {{%info}} where cate='公告'order by id desc limit 5")->queryAll();
        $info3 = Yii::$app->db->createCommand("select id,title,summary from {{%info}} order by id desc limit 10")->queryAll();

//        var_dump($info);die;
        return $this->renderPartial('index', ['data' => $data, 'banner' => $banner, 'teachers' => $teachers, 'info1' => $info1, 'info3' => $info3]);
    }
}