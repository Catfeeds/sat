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
use app\libs\GetData;

class MessageController extends Controller
{
    public $layout='cn.php';
    public function actionIndex(){
        $getdata = new GetData();
        $must = array('name' => '姓名','phone'=>'电话','country'=>'国家','goal'=>'分数','examinationTime'=>'考试时间');
        $data = $getdata->PostData($must);
        $re = Yii::$app->db->createCommand()->insert("{{%message}}", $data)->execute();
        if($re){
            $res['message']='提交成功，工作人员将在1-2个工作日内与您联系';
            $res['code']=1;
        }else{
            $res['message']='提交失败，请与管理员联系';
            $res['code']=0;
        }
        die(json_encode($res));
    }

}