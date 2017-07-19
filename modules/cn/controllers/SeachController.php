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


class SeachController extends Controller
{
    public function actionIndex(){
        $data['name'] = Yii::$app->request->get('name');
        $data['country'] = Yii::$app->request->get('country');
        $data['goal'] = Yii::$app->request->get('score');
        $data['examinationTime'] = Yii::$app->request->get('time');
        $data['time'] = time();
        $data['email'] = Yii::$app->request->get('email');
        $data['phone'] = Yii::$app->request->get('tel');
        $data['code'] = Yii::$app->request->get('code', '');
        $model=new Login();
        $code=$model->checkCode($data['phone'],$data['code']);// 验证码是否正确
        if($code){
            $time=$model->checkTime(); // 是否过期
            if($time){
                unset($data['code']);
                $re = Yii::$app->db->createCommand()->insert("{{%message}}", $data)->execute();
                if($re){
                    $res['message']='提交成功，工作人员将在1-2个工作日内与您联系';
                    $res['code']=1;
                }else{
                    $res['message']='提交失败，请与管理员联系';
                    $res['code']=0;
                }
            }else{
                $re['code'] = 0;
                $re['message'] = '验证码已过期';
                die(json_encode($re));
            }
        }else{
            $re['code'] = 0;
            $re['message'] = '验证码不正确';
            die(json_encode($re));
        }
        die(json_encode($res));
    }
}