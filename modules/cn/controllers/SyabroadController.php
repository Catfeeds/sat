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

class SyabroadController extends Controller
{
    public $layout='';
    public function actionIndex()
    {
        $this->layout="cn1.php";
        $info = Yii::$app->db->createCommand("select name,pic,direction,matriculate from {{%student_case}} order by id DESC limit 100")->queryAll();
        $data = Yii::$app->db->createCommand("select id,name,pic,introduction,subject,honorary,seniority from {{%teachers}} where seniority!='讲师' ORDER BY flag ASC,id ASC limit 100")->queryAll();
        foreach($data as $k=>$v){
            $data[$k]['case']= Yii::$app->db->createCommand("select name,direction,matriculate from {{%student_case}} where teacher like '%".$data[$k]['name']."%'")->queryAll();
        }
        return $this->render('index',['info'=>$info,'data'=>$data]);
    }
}