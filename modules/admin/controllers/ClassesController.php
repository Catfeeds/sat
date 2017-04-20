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
use app\modules\admin\models\classes;
use app\libs\AppControl;
use app\libs\Method;
class ClassesController extends ApiControl {
//    所有课程的显示
    public function actionIndex()
    {
//        从数据库获取数据
        $model  = new Classes();
        $data = Yii::$app->db->createCommand("select * from {{%classes}} ")->queryAll();
//        var_dump($data);
        return $this->render('index',['data' => $data]);
    }
//    添加课程
    public function actionAdd()
    {
//        $apps     = Yii::$app->request;
        if(!$_POST){
//            单独分类
//            $arr1=$this->getCate('班级');
//            $arr2=$this->getCate('科目');
//            return $this->render('add',['arr1'=>$arr1,'arr2'=>$arr2]);
            return $this->render('add');
        }else{
            //      添加数据到数据
            if(empty($_FILES['up']['name'])){
                $pic='';
            }else{
//                $classes      = new Classes();
                $pic=$this->upImage('classes');
            }
            $classesData = Yii::$app->request->post('category');
            $classesData['className'] = Yii::$app->request->post('className','');
            $classesData['pic']       = $pic;
            $classesData['cate']      = Yii::$app->request->post('cate','');
            $classesData['duration']  = Yii::$app->request->post('duration','');
            $classesData['price']  = Yii::$app->request->post('price','');
            $classesData['major']     = Yii::$app->request->post('major','');
            $classesData['teacher']   = Yii::$app->request->post('teacher','');
            $classesData['introduction']   = Yii::$app->request->post('introduction','');
            if(empty($classesData['className'])){
                die('<script>alert("请添加课程名称");history.go(-1);</script>');
            }
            if(empty($classesData['cate'])){
                die('<script>alert("请添加分类");history.go(-1);</script>');
            }
            if(empty($classesData['teacher'])){
                die('<script>alert("请添加讲师");history.go(-1);</script>');
            }
//            var_dump($className);exit;
            $re = Yii::$app->db->createCommand()->insert("{{%classes}}",$classesData)->execute();
            if($re){
                echo '<script>alert("数据添加成功")</script>';
                $this->redirect('index');
            }else{
                echo '<script>alert("数据添加失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }
//    删除课程
    public function actionDel(){
        $id= Yii::$app->request->get('id','');
        $model  =  new Classes();
        $re =Classes::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }
//    编辑课程
    public function actionEdit()
    {
        $id= Yii::$app->request->get('id','');
        if(!$_POST){
            $data = Yii::$app->db->createCommand("select * from {{%classes}} where(id=$id)")->queryOne();
//            var_dump($data);exit;
            return $this->render('edit',['data' => $data]);
        }else{
            //      添加数据到数据
            $model      = new Classes();
            $classesData = Yii::$app->request->post('category');
            $classesData['id'] = Yii::$app->request->post('id','');
            $classesData['className'] = Yii::$app->request->post('className','');
            $classesData['pic']       = Yii::$app->request->post('pic','');
            $classesData['cate']      = Yii::$app->request->post('cate','');
            $classesData['duration']  = Yii::$app->request->post('duration','');
            $classesData['price']  = Yii::$app->request->post('price','');
            $classesData['major']     = Yii::$app->request->post('major','');
            $classesData['teacher']   = Yii::$app->request->post('teacher','');
            $classesData['introduction']   = Yii::$app->request->post('introduction','');
            if(empty($classesData['className'])){
                die('<script>alert("课程名称不能为空");history.go(-1);</script>');
            }
            if(empty($classesData['cate'])){
                die('<script>alert("请选择分类");history.go(-1);</script>');
            }
            if(empty($classesData['teacher'])){
                die('<script>alert("请添加讲师");history.go(-1);</script>');
            }
//            var_dump($classesData);exit;
            $re = $model->updateAll($classesData,'id=:id',array(':id'=>$classesData['id']));
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