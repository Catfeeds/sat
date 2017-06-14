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
use app\modules\admin\models\Role;
use app\modules\admin\models\Admin;

class RoleController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRole_node()
    {
        $data = Yii::$app->db->createCommand("select * from {{%role}}")->queryAll();
        return $this->render('role_node', ['data' => $data]);
    }

    public function actionAdd()
    {
        $id = Yii::$app->request->get('id', '');
        $role = new Role();
        if (!$_POST) {
            $data = Yii::$app->db->createCommand("select * from {{%node}}")->queryAll();
            $data = $role->getCateList($data);
//            #id 为空即为非修改页面
            if (empty($id)) {
                return $this->render('add', ['data' => $data]);
            } else {
                $data1 = Yii::$app->db->createCommand("select id,name,ids from {{%role}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data, 'data1' => $data1]);
            }

        } else {
            $ids = Yii::$app->request->post('ids', '');
            if (!empty($ids)) $ids = implode(',', $ids);
            $roleData['ids'] = $ids;
            $roleData['name'] = Yii::$app->request->post('name', '');
            $roleData['id'] = Yii::$app->request->post('id', '');
            if (!empty($ids)) {
                $data = Yii::$app->db->createCommand("select path from {{%node}} where id in ($ids)")->queryAll();
                $str = '';
                foreach ($data as $v) {
                    $str .= $v['path'] . "," . "</br>";
                }
            } else {
                $str = '';
            }
            // 组装path；
            $roleData['path'] = $str;
            if (empty($roleData['name'] || $roleData['ids'])) {
                die('<script>alert("请将数据填写完整");history.go(-1);</script>');
            }
            // 存在$roleData['id']即为修改提交，否则为添加
            if (empty($roleData['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%role}}", $roleData)->execute();
            } else {
                $re = $role->updateAll($roleData, 'id=:id', array(':id' => $roleData['id']));
            }
            if ($re) {
                $this->redirect('role_node');
            } else {
                echo '<script>alert("数据添加添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Role::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }
    public function actionAdmin_index(){
        $data = Yii::$app->db->createCommand("select * from {{%admin}}")->queryAll();
        return $this->render('admin_index',['data'=>$data]);
    }
    public function actionAdmin_add(){

        $id = Yii::$app->request->get('id', '');
        $admin = new Admin();
        if (!$_POST) {
            // #id 为空即为非修改页面
            if (empty($id)) {
                return $this->render('admin_add');
            } else {
                $data = Yii::$app->db->createCommand("select id,userPass,userName,roleId from {{%admin}} where id=" . $id)->queryOne();
                return $this->render('admin_add', ['data' => $data]);
            }

        } else {
            $userPass = Yii::$app->request->post('userPass', '');
            if(strlen($userPass)==32){
                $Data['userPass']= $userPass;
            }else{
                $Data['userPass'] = md5($userPass);
            }
            $Data['userName'] = Yii::$app->request->post('userName', '');
            $Data['roleId'] = Yii::$app->request->post('roleId', '');
            $Data['id'] = Yii::$app->request->post('id', '');
            if (empty($Data['userName'] || $Data['userPass']||$Data['roleId'])) {
                die('<script>alert("请将数据填写完整");history.go(-1);</script>');
            }
            // 存在$roleData['id']即为修改提交，否则为添加
            if (empty($Data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%admin}}", $Data)->execute();
            } else {
                $re = $admin->updateAll($Data, 'id=:id', array(':id' => $Data['id']));
            }
            if ($re) {
                $this->redirect('admin_index');
            } else {
                echo '<script>alert("数据添加添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }
    public function actionAdmin_del()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Admin::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }
}