<?php
/**
 * 登录管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\Cate;

class CateController extends ApiControl
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $model = new Cate();
        $data = Yii::$app->db->createCommand("select * from {{%cate}} ")->queryAll();
        // 重新排序递归
        $data = $model->getCateList($data);
        // var_dump($data);
        return $this->render('index', ['data' => $data]);
    }

    public function actionAdd()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if (!empty($id)) {
                $data = Yii::$app->db->createCommand("select * from {{%cate}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            } else {
                return $this->render('add');
            }

        } else {
            $cateData = Yii::$app->request->post('cate');
            $cateData['name'] = Yii::$app->request->post('name', '');
            $cateData['level'] = Yii::$app->request->post('level', '');
            $cateData['pid'] = Yii::$app->request->post('pid', '0');
            $re = Yii::$app->db->createCommand()->insert("{{%cate}}", $cateData)->execute();
            if ($re) {
                echo '<script>alert("数据添加成功")</script>';
                $this->redirect('index');
            } else {
                echo '<script>alert("数据修改失败，请重试");history.go(-1);</script>';
                die;
            }

        }
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Cate::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }


}