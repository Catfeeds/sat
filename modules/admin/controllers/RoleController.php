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
//use yii\filters\AccessControl;
//use yii\filters\VerbFilter;
class RoleController extends ApiControl {
    public function actionIndex(){
        $data= Yii::$app->db->createCommand("select * from {{%role}}")->queryAll();
        return $this->render('index',['data'=>$data]);
    }
    public function actionAdd(){
//        if(!$_POST){
////            $data= Yii::$app->db->createCommand("select name,id from {{%role}} where pid=0")->queryAll();
//////            var_dump($data);die;
        $data= Yii::$app->db->createCommand("select name,id from {{%node}}")->queryAll();
            return $this->render('add',['data'=>$data]);
//        }else{
////            var_dump($_POST);DIE;
//            $node=new node();
//            $nodeData=$node->add();
//            if(empty($nodeData['name'])){
//                die('<script>alert("请填写节点名");history.go(-1);</script>');
//            }
//
//            if(empty($nodeData['controller'])){
//                die('<script>alert("请添加控制器名");history.go(-1);</script>');
//            }
//            if(empty($nodeData['action'])){
//                die('<script>alert("请添加方法名");history.go(-1);</script>');
//            }
////            var_dump($nodeData);die;
//            $re = Yii::$app->db->createCommand()->insert("{{%node}}", $nodeData)->execute();
//            if($re){
//                $this->redirect('index');
//            }else{
//                echo '<script>alert("数据修改/添加失败，请重试");history.go(-1);</script>';
//                die;
//            }
//        }
//
    }
//    public function actionDel(){
//        $id= Yii::$app->request->get('id','');
//        $re =Node::deleteAll("id=:id",array(':id' => $id));
//        if($re){
//            echo true;
//        }
//
//    }
}