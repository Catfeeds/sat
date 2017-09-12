<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:04
 */
namespace app\modules\admin\controllers;

use app\modules\admin\models\Apply;
use app\modules\admin\models\Message;
use yii;
use app\libs\ApiControl;
use app\modules\admin\models\User;
use app\modules\admin\models\Tactics;
use app\libs\GetData;

class UserController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionApply()
    {
        // 公开课的ID，报名者电话，的取到title
        $data = Yii::$app->db->createCommand("select c.*,i.title from {{%class_apply}} c join {{%info}} i on c.pubclass_id=i.id ")->queryALL();
        return $this->render('apply',['data'=>$data]);
    }
    public function actionApply_edit()
    {
        $id= Yii::$app->request->get('id', '');
        if(!$_POST){
            return $this->render('apply_edit',['id'=>$id]);
        }else{
            $data['id'] = Yii::$app->request->post('id', '');
            $data['address'] = Yii::$app->request->post('address', '');
            $model = new Apply();
            $re = $model->updateAll($data,'id=:id', array(':id'=> $data['id']));
            if ($re) {
                $this->redirect('apply');
            } else {
                echo '<script>alert("数据添加/修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }


    }
    public function actionMessage()
    {
        // 公开课的ID，报名者电话，的取到title
       $data = Yii::$app->db->createCommand("select * from {{%message}}")->queryALL();
        return $this->render('message',['data'=>$data]);
    }
    public function actionSuggest_edit()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
                return $this->render('suggest_edit');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%tactics}} where id=" . $id)->queryOne();
                $data['models']=explode('-',$data['major'])[0];
                $data['major']=explode('-',$data['major'])[1];
                return $this->render('suggest_edit', ['data' => $data]);
            }

        } else {
            $tactics = new Tactics();
            $data["major"]=Yii::$app->request->post("models",'')."-".Yii::$app->request->post("major",'');
            $data["min"]=Yii::$app->request->post("min",'');
            $data["max"]=Yii::$app->request->post("max",'');
            $data["suggestion"]=Yii::$app->request->post("suggestion",'');

            if (empty($data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%tactics}}", $data)->execute();
            } else {
                // 修改时，提交id
                $re = $tactics->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('suggest');
            } else {
                echo '<script>alert("数据添加/修改失败，请重试");history.go(-1);</script>';
                die;
            }

        }

    }
    public function actionSuggest()
    {
        // 公开课的ID，报名者电话，的取到title
        $data = Yii::$app->db->createCommand("select * from {{%tactics}}")->queryALL();
        return $this->render('suggest',['data'=>$data]);
    }
    public function actionDel3()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Tactics::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }
    public function actionCheck()
    {
        $data['flag']= Yii::$app->request->post('flag', '');
        $data['id'] = Yii::$app->request->post('id', '');
//        $data['address'] = Yii::$app->request->post('address', '');
        $model = new Message();
        $re = $model->updateAll($data,'id=:id', array(':id'=> $data['id']));
        if($re){
            $res['code'] = 1;
            $res['message'] = '修改成功';
        } else {
            $res['code'] = 0;
            $res['message'] = '修改失败';
        }
        die(json_encode($res));
    }

}