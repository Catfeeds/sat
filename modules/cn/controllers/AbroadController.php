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

class AbroadController extends Controller
{
    public $layout='';
    public function actionIndex()
    {
        $this->layout="cn1.php";
        $order="order by isShow asc,id desc";
        $info = Yii::$app->db->createCommand("select id,title,keywords,pic from {{%info}} where cate='留学案例' $order")->queryAll();
        $data = Yii::$app->db->createCommand("select * from {{%teachers}} where seniority!='讲师' ORDER BY flag ASC,id ASC")->queryAll();
        foreach($data as $k=>$v){
            $data[$k]['case']= Yii::$app->db->createCommand("select id,title,keywords,pic from {{%info}} where cate='留学案例' and name='".$data[$k]['name']."'")->queryAll();
        }
//        echo '<pre>';
//        var_dump($data);
//        echo '</pre>';die;
        return $this->render('index',['info'=>$info,'data'=>$data]);
    }


}