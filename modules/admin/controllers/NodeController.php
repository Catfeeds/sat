<?php
/**
 * 权限管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\Node;

class NodeController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%node}}")->queryAll();
        $node = new Node();
        $data = $node->getList($data);
        return $this->render('index', ['data' => $data]);
    }

    public function actionAdd()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            $data = Yii::$app->db->createCommand("select name,id from {{%node}} where pid=0")->queryAll();
            if (empty($id)) {
                return $this->render('add', ['data' => $data]);
            } else {
                $arr = Yii::$app->db->createCommand("select * from {{%node}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data, 'arr' => $arr]);
            }

        } else {
            $node = new node();
            $nodeData = $node->add();
            if (empty($nodeData['name'] || $nodeData['controller'] || $nodeData['action'])) {
                die('<script>alert("请将信息填完整");history.go(-1);</script>');
            }
            if (empty($nodeData['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%node}}", $nodeData)->execute();
            } else {
                $re = $node->updateAll($nodeData, 'id=:id', array(':id' => $nodeData['id']));
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
        $re = Node::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }

    }
}