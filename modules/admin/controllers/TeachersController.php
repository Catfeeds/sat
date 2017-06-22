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
use app\modules\admin\models\Teachers;
use app\libs\GetData;

class TeachersController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%teachers}} ")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

    // 添加讲师
    public function actionAdd()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if ($id == '') {
                return $this->render('add');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%teachers}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            }
        } else {
            $getdata = new GetData();
            $must = array('name' => '教师名字', 'introduction' => '教师简介', 'subject' => '主讲课程');
            $data = $getdata->PostData($must, 'teachers');
//            var_dump($data);die;
            if ($data['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%teachers}}", $data)->execute();
            } else {
                $model = new Teachers();
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Teachers::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }


}