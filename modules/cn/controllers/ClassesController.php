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
        $data[0] = Yii::$app->db->createCommand("select * from {{%classes}} where cate='VIP精品班'")->queryOne();
        $data[1] = Yii::$app->db->createCommand("select * from {{%classes}} where cate='全能小班'")->queryOne();
        $data[2] = Yii::$app->db->createCommand("select * from {{%classes}} where cate='冲刺小班'")->queryOne();
        $data[3]= Yii::$app->db->createCommand("select * from {{%classes}} where cate='直播/录播课'")->queryOne();
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
//        var_dump($arr);die;
//        var_dump($this->brr);die;
        return $this->render('index', ['data' => $data,'brr'=>$this->brr]);
    }
    // 课程详情页
    public function actionDetails()
    {
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=$id ")->queryOne();
        $t=explode(',',$data['teacher']);
        foreach($t as $k =>$v){
            $teacher[$k] = Yii::$app->db->createCommand("select * from {{%teachers}} where name='$v' ")->queryOne();
        }
//        var_dump($teacher);die;
        return $this->render('details', ["data" => $data,'brr'=>$this->brr,'teacher'=>$teacher]);
    }
}