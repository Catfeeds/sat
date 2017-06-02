<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11 0011
 * Time: 14:04
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\questions;
use app\modules\admin\models\testPaper;
use app\libs\GetData;

class QuestionsController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        // 从数据库获取数据
        $data = Yii::$app->db->createCommand("select * from {{%questions}} order by id desc")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

    public function actionAdd()
    {
        $apps = Yii::$app->request;
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if ($id == '') {
                return $this->render('add');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%questions}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            }
        } else {
            //      添加数据到数据
            $model = new Questions();
            $getdata = new GetData();
            $must = array('content' => '题目', 'answer' => '答案');
            $data = $getdata->PostData($must);
            if ($data['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%questions}}", $data)->execute();
            } else {
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                echo '<script>alert("数据\修改成功")</script>';
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

//ajax删除数据
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $model = new Questions();
        $re = Questions::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }

//    展示试卷
    public function actionTestpaper()
    {
        $data = Yii::$app->db->createCommand("select * from {{%testPaper}} ")->queryAll();
//        var_dump($data);die;
        return $this->render('testpaper', ['data' => $data]);
    }

//    添加试卷信息
    public function actionAdd_testpaper()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if ($id == '') {
                return $this->render('add_testpaper');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%testpaper}} where id=" . $id)->queryOne();
//                var_dump($data);die;
                return $this->render('add_testpaper', ['data' => $data]);
            }
        } else {
            $model = new testPaper();
            $getdata = new GetData();
            $must = array('name' => '试卷名称');
            $data = $getdata->PostData($must);
//            var_dump($data);die;
            if ($data['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%testpaper}}", $data)->execute();
            } else {
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('testpaper');
            } else {
                echo '<script>alert("数据修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    public function actionDel_testpaper()
    {
        $id = Yii::$app->request->get('id', '');
        $re = testPaper::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }

    public function actionEssay()
    {
        $essayData ['essay'] = Yii::$app->request->post('essay', '');
        $essayData ['nums'] = Yii::$app->request->post('nums', '');
        $essayData ['tpID'] = Yii::$app->request->post('tpID', '');
        $re = Yii::$app->db->createCommand()->insert("{{%essay}}", $essayData)->execute();
        if ($re) {
            echo '<script>alert("数据添加成功")</script>';
            $this->redirect('index');
        } else {
            echo '<script>alert("数据添加失败，请重试");history.go(-1);</script>';
            die;
        }

    }
}
