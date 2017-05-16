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
use app\modules\admin\models\role;
class RoleController extends ApiControl {

    public function actionIndex(){
        return $this->render('index');
    }
    public function actionRole_node(){
    $data= Yii::$app->db->createCommand("select * from {{%role}}")->queryAll();
    return $this->render('role_node',['data'=>$data]);
    }
    public function actionAdd(){
        $enableCsrfValidation = false;
        $id=Yii::$app->request->get('id', '');
        $role=new Role();
        if(!$_POST){
            $data= Yii::$app->db->createCommand("select * from {{%node}}")->queryAll();
            $data=$role->getCateList($data);
//            #id 为空即为非修改页面
            if(empty($id)){
                return $this->render('add',['data'=>$data]);
            }else{
                $data1= Yii::$app->db->createCommand("select id,name,ids from {{%role}} where id=".$id)->queryOne();
                return $this->render('add',['data'=>$data,'data1'=>$data1]);
            }

        }else{
            $ids = Yii::$app->request->post('ids', '');
            if(!empty($ids)) $ids = implode(',', $ids);
            $roleData['ids'] = $ids;
            $roleData['name'] = Yii::$app->request->post('name', '');
            $roleData['id'] = Yii::$app->request->post('id', '');
            if(!empty($ids)){
                $data = Yii::$app->db->createCommand("select path from {{%node}} where id in ($ids)")->queryAll();
                $str='';
                foreach($data as $v){
                    $str .=$v['path'].","."</br>";
                }
            }else{
                $str='';
            }
//            组装path；
            $roleData['path']=$str;
            if (empty($roleData['name'] || $roleData['ids']) ) {
                die('<script>alert("请将数据填写完整");history.go(-1);</script>');
            }
//            存在$roleData['id']即为修改提交，否则为添加
            if(empty($roleData['id'])){
                $re = Yii::$app->db->createCommand()->insert("{{%role}}", $roleData)->execute();
            }else{
                $re = $role->updateAll($roleData,'id=:id',array(':id'=>$roleData['id']));
            }
            if ($re) {
                $this->redirect('role_node');
            } else {
                echo '<script>alert("数据添加添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }
    public function actionDel(){
        $id= Yii::$app->request->get('id','');
        $re =Role::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }
}