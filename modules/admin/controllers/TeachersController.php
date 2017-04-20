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
use app\modules\admin\models\teachers;
class TeachersController extends ApiControl {
//    所有教师
    public function actionIndex()
    {
//        从数据库获取数据
        $model      = new teachers();
        $data = Yii::$app->db->createCommand("select * from {{%teachers}} ")->queryAll();
//        var_dump($data);die;
        return $this->render('index',['data' => $data]);
    }
//    添加讲师
    public function actionAdd()
    {
//        $apps     = Yii::$app->request;
        if(!$_POST){
            $id= Yii::$app->request->get('id','');
            if($id==''){
                return $this->render('add');
            }else{
                $data = Yii::$app->db->createCommand("select * from {{%teachers}} where id=".$id)->queryOne();
//                var_dump($data);die;
                return $this->render('add',['data' => $data]);
            }
        }else{
            //      添加数据到数据
            if(empty($_FILES['up']['name'])){
                $pic='';
            }else{
//                $classes      = new Classes();
                $pic=$this->upImage('teachers');
            }
            $model      = new Teachers();
            $teachersData = Yii::$app->request->post('teachers');
            $teachersData['id'] = Yii::$app->request->post('id','');
            $teachersData['name'] = Yii::$app->request->post('name','');
            $teachersData['pic']       = $pic;
            $teachersData['introduction']      = Yii::$app->request->post('introduction','');
            $teachersData['subject']  = Yii::$app->request->post('subject','');
            $teachersData['honorary']  = Yii::$app->request->post('honorary','');
            $teachersData['seniority']     = Yii::$app->request->post('seniority','');
//            var_dump($teachersData);die;
            if(empty($teachersData['name'])){
                die('<script>alert("请添加讲师名字");history.go(-1);</script>');
            }
            if(empty($teachersData['introduction'])){
                die('<script>alert("请添加教师简介");history.go(-1);</script>');
            }
            if(empty($teachersData['subject'])){
                die('<script>alert("请添加主讲");history.go(-1);</script>');
            }
//            var_dump($className);exit;
            if($teachersData['id']==''){
                $re = Yii::$app->db->createCommand()->insert("{{%teachers}}",$teachersData)->execute();
                if($re){
                    echo '<script>alert("数据添加成功")</script>';
                    $this->redirect('index');
                }else{
                    echo '<script>alert("数据添加失败，请重试");history.go(-1);</script>';
                    die;
                }
            }else{
//                   修改
                $teachersData['pic']       = Yii::$app->request->post('up','');
                $re = $model->updateAll($teachersData,'id=:id',array(':id'=>$teachersData['id']));
                if($re){
                    echo '<script>alert("数据修改成功")</script>';
                    $this->redirect('index');
                }else{
                    echo '<script>alert("数据修改失败，请重试");history.go(-1);</script>';
                    die;
                }
            }
        }
    }
//    删除讲师信息
    public function actionDel(){
        $id= Yii::$app->request->get('id','');
//        $model  =  new Teachers();
        $re =Teachers::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }


}