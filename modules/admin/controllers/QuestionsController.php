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

class QuestionsController extends ApiControl
{
    public function actionIndex()
    {
////        从数据库获取数据
//        $model      = new Classes();
        $data = Yii::$app->db->createCommand("select * from {{%questions}} ")->queryAll();

//        var_dump($data);
        return $this->render('index', ['data' => $data]);
    }

    public function actionAdd()
    {
        $enableCsrfValidation = false;
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
            $questionsData = Yii::$app->request->post('teachers');
            $questionsData ['id'] = Yii::$app->request->post('id', '');
            $questionsData ['content'] = Yii::$app->request->post('content', '');
            $questionsData ['keyA'] = Yii::$app->request->post('keyA', '');
            $questionsData ['keyB'] = Yii::$app->request->post('keyB', '');
            $questionsData ['keyC'] = Yii::$app->request->post('keyC', '');
            $questionsData ['keyD'] = Yii::$app->request->post('keyD', '');
            $questionsData ['keyE'] = Yii::$app->request->post('keyE', '');
            $questionsData ['answer'] = Yii::$app->request->post('answer', '');
            $questionsData ['score'] = Yii::$app->request->post('score', '');
            $questionsData ['major'] = Yii::$app->request->post('major', '');
            $questionsData ['sourceid'] = Yii::$app->request->post('sourceid', '');
            $questionsData ['leverid'] = Yii::$app->request->post('leverid', '');
            if (empty($questionsData ['essay'])) {
                if (empty($questionsData ['content'])) {
                    die('<script>alert("请添加题目");history.go(-1);</script>');
                }
                if (empty($questionsData ['score'])) {
                    die('<script>alert("请添加分数");history.go(-1);</script>');
                }
                if (empty($questionsData ['answer'])) {
                    die('<script>alert("请添加答案");history.go(-1);</script>');
                }
            } else {

            }
            if ($questionsData['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%questions}}", $questionsData)->execute();
                if ($re) {
                    echo '<script>alert("数据添加成功")</script>';
                    $this->redirect('index');
                } else {
                    echo '<script>alert("数据添加失败，请重试");history.go(-1);</script>';
                    die;
                }
            } else {
                $re = $model->updateAll($questionsData, 'id=:id', array(':id' => $questionsData['id']));
                if ($re) {
                    echo '<script>alert("数据修改成功")</script>';
                    $this->redirect('index');
                } else {
                    echo '<script>alert("数据修改失败，请重试");history.go(-1);</script>';
                    die;
                }
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
    public function actionIndex2()
    {
        $data = Yii::$app->db->createCommand("select * from {{%testPaper}} ")->queryAll();
//        var_dump($data);die;
        return $this->render('Index2', ['data' => $data]);
    }

//    添加试卷信息
    public function actionAdd2()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if ($id == '') {
                return $this->render('Add2');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%testpaper}} where id=" . $id)->queryOne();
//                var_dump($data);die;
                return $this->render('Add2', ['data' => $data]);
            }
        } else {
            $model = new testPaper();
            $paperData = Yii::$app->request->post('testPaper');
            $paperData ['name'] = Yii::$app->request->post('name', '');
            $paperData ['major'] = Yii::$app->request->post('major', '');
            $paperData['id'] = Yii::$app->request->post('id', '');
            $paperData ['time'] = Yii::$app->request->post('time', '');
            $paperData ['source'] = Yii::$app->request->post('source', '');
            if (empty($paperData['name'])) {
                die('<script>alert("请添加试卷名称");history.go(-1);</script>');
            }
            if (empty($paperData['major'])) {
                die('<script>alert("请选择科目");history.go(-1);</script>');
            }
            if ($paperData['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%testpaper}}", $paperData)->execute();
                if ($re) {
                    echo '<script>alert("数据添加成功")</script>';
                    $this->redirect('index2');
                } else {
                    echo '<script>alert("数据添加失败，请重试");history.go(-1);</script>';
                    die;
                }
            } else {
                $re = $model->updateAll($paperData, 'id=:id', array(':id' => $paperData['id']));
                if ($re) {
                    echo '<script>alert("数据修改成功")</script>';
                    $this->redirect('index2');
                } else {
                    echo '<script>alert("数据修改失败，请重试");history.go(-1);</script>';
                    die;
                }
            }
        }
    }

    public function actionDel2()
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
