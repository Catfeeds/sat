<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:04
 */
namespace app\modules\admin\controllers;

use app\modules\admin\models\Apply;
use yii;
use app\libs\ApiControl;
use app\modules\admin\models\User;

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
}