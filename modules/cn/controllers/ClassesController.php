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
    public $brr;
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%classes}} ")->queryAll();
//        var_dump($data);die;
        $arr=$this->brr=array();
        foreach($data as $k=>$v){
            array_push($arr,$v['duration']);
        }
//        var_dump($arr);die;
        for($i=0;$i<count($arr);$i++){
            $this->brr[$i]=explode(',',$arr[$i]);
//            var_dump($brr[$i]);
            for($j=0;$j<count($this->brr[$i]);$j++){
                $this->brr[$i][$j]=explode(':',$this->brr[$i][$j]);
            }
        }
//        var_dump($brr);die;
        return $this->render('index', ['data' => $data,'brr'=>$this->brr]);
    }

    public function actionDetails()
    {
//        从数据表获取数据
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=$id ")->queryOne();
        $teacher=$data['teacher'];
        $teacher = Yii::$app->db->createCommand("select * from {{%teachers}} where name='$teacher'" )->queryOne();
//        var_dump($teacher);die;
        return $this->render('details', ["data" => $data,'brr'=>$this->brr,'teacher'=>$teacher]);
    }
}