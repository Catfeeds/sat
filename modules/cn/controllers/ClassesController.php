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
use app\modules\cn\models\Classes;
use app\modules\cn\models\Teachers;

class ClassesController extends Controller
{
    public $layout="cn.php";
    public $brr;
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%classes}} ")->queryAll();
        $arr=$this->brr=array();
        foreach($data as $k=>$v){
            array_push($arr,$v['duration']);
        }
        for($i=0;$i<count($arr);$i++){
            $this->brr[$i]=explode(',',$arr[$i]);
            for($j=0;$j<count($this->brr[$i]);$j++){
                $this->brr[$i][$j]=explode(':',$this->brr[$i][$j]);
            }
        }
        return $this->render('index', ['data' => $data,'brr'=>$this->brr]);
    }

    public function actionDetails()
    {
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=$id ")->queryOne();
        $teacher=$data['teacher'];
        $teacher = Yii::$app->db->createCommand("select * from {{%teachers}} where name='$teacher'" )->queryOne();
        return $this->render('details', ["data" => $data,'brr'=>$this->brr,'teacher'=>$teacher]);
    }
}