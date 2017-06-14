<?php
namespace app\modules\admin\controllers;

use Yii;
use app\libs\ApiControl;
use app\modules\admin\models\Knowledge;
use app\libs\GetData;
class KnowledgeController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%knowledge}}")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

    public function actionAdd()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
                return $this->render('add');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%knowledge}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            }
        } else {
            $model = new Knowledge();
            $getdata = new GetData();
            $must = array('name' => '知识点名称', 'major' => '科目类', 'analysis' => '知识点分析');
            $knowledgeData = $getdata->PostData($must);
            // 添加时不带id
            if (empty($knowledgeData['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%knowledge}}", $knowledgeData)->execute();
            } else {
                $re = $model->updateAll($knowledgeData, 'id=:id', array(':id' => $knowledgeData['id']));
            }
            if ($re) {
                $this->redirect('index');
            } else {
                echo '<script>alert("数据修改/添加失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Knowledge::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }
}