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
use app\modules\admin\models\Student;
use app\libs\GetData;

class StudentController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%student_case}}")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

    // 添加
    public function actionCase()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
                return $this->render('case');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%student_case}} where id=" . $id)->queryOne();
                return $this->render('case', ['data' => $data]);
            }

        } else {
            $student = new Student();
            $getdata = new GetData();
            $must = array('name' => '姓名', 'major' => '专业', 'direction' => '申请方向', 'matriculate' => '录取学校');
            $data = $getdata->PostData($must);
            // 无上传图片时
            if (empty($data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%student_case}}", $data)->execute();
            } else {
                // 修改时，提交id
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

    // 删除
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Student::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }


}