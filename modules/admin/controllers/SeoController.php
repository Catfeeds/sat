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
use app\libs\GetData;
use app\modules\admin\models\Seo;
class SeoController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
       $data = Yii::$app->db->createCommand("select * from {{%seo}} order by id desc")->queryAll();
        return $this->render('index',['data'=>$data]);
    }
    public function actionAdd()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
                return $this->render('add');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%seo}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            }
        } else {
            $getdata = new GetData();
            $must = array('title' => '标题', 'url' => '地址');
            $data = $getdata->PostData($must, 'seo');
//            var_dump($data);die;
            $data = array_merge($data);
            if (empty($data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%seo}}", $data)->execute();
            } else {
                $info = new Seo();
                $re = $info->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加/修改失败，请重试");history.go(-1);</script>';
                die;
            }

        }
    }
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Seo::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }

}