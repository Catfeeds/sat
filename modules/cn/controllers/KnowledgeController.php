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

class KnowledgeController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%knowledge}} order by id desc")->queryAll();
        return $this->render('index',['data'=>$data]);
    }

    public function actionDetails()
    {
        $id= Yii::$app->request->get('id');
        $data = Yii::$app->db->createCommand("select * from {{%knowledge}} where id=".$id." order by id desc")->queryOne();
        // 相关知识点
        $data = Yii::$app->db->createCommand("select * from {{%knowledge}} where cate=''".$data['cate']."' and major= order by id desc")->queryOne();
//        var_dump($data);die;
        return $this->render('details',['data'=>$data]);
    }
}