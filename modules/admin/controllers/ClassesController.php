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
use app\modules\admin\models\Classes;
use app\libs\GetData;

class ClassesController extends ApiControl
{
    public $enableCsrfValidation = false;

    // 所有课程的显示
    public function actionIndex()
    {
        // 从数据库获取数据
        $data = Yii::$app->db->createCommand("select * from {{%classes}} order by id desc ")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

    // 添加课程
    public function actionAdd()
    {
        if (!$_POST) {
            // 判断是修改还是添加$id
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
                return $this->render('add');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            }
        } else {
            $getdata = new GetData();
            $must = array('student' => '适合学生', 'cate' => '分类');
            $data = $getdata->PostData($must, 'classes');
            if (empty($data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%classes}}", $data)->execute();
            } else {
                $model = new Classes();
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

    //删除课程
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $model = new Classes();
        $re = Classes::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }

}