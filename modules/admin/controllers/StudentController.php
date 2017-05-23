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
use app\modules\admin\models\student;
use app\libs\GetData;

class StudentController extends ApiControl
{
    public $enableCsrfValidation = false;

//    所有资讯的显示
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%student_case}}")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

//    添加资讯
    public function actionCase()
    {
        $enableCsrfValidation = false;
//        var_dump($_POST);die;
        if (!$_POST) {
//            查找资讯，取出资讯的分类信息，展示到添加页面
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
//               添加时
                return $this->render('case');
            } else {
//                修改时显示到修改页面的数据
                $data = Yii::$app->db->createCommand("select * from {{%student_case}} where id=" . $id)->queryOne();
                return $this->render('case', ['data' => $data]);
            }

        } else {
//            提交数据处理
            $student = new Student();
            $getdata = new GetData();
            $must = array('name' => '姓名', 'major' => '专业', 'direction' => '申请方向', 'matriculate' => '录取学校');
            $data = $getdata->PostData($must);
//            添加时不带id
//            无上传图片时
            if (empty($data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%student_case}}", $data)->execute();
            } else {
//                修改时，提交id
                $re = $student->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加/修改失败，请重试");history.go(-1);</script>';
                die;
            }

        }
    }

//    删除课程
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = student::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }


}