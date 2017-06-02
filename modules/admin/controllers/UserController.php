<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:04
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\user;

class UserController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionApply()
    {
        $data = Yii::$app->db->createCommand("select * from {{%class_apply}} ")->queryALL();
        return $this->render('apply',['data'=>$data]);
    }
}