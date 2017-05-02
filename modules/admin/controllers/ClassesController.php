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
class ClassesController extends ApiControl {
//    所有课程的显示
    public function actionIndex()
    {
//        从数据库获取数据
        $data = Yii::$app->db->createCommand("select * from {{%classes}} ")->queryAll();
        return $this->render('index',['data' => $data]);
    }
//    添加课程
    public function actionAdd()
    {
        $enableCsrfValidation = false;
        if(!$_POST){
//            判断是修改还是添加$id
            $id = Yii::$app->request->get('id', '');
            if(empty($id)){
                return $this->render('add');
            }else{
                $data = Yii::$app->db->createCommand("select * from {{%classes}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            }
        }else{
            //      添加数据到数据
            $model      = new Classes();
            if(empty($_FILES['up']['name'])){
                if( Yii::$app->request->post('up','')){
                    $pic=Yii::$app->request->post('up','');
                }else{
                    $pic='';
                }
            }else{
                $pic=$this->upImage('classes');
            }
            $classesData = Yii::$app->request->post('category');
            $classesData['student'] = Yii::$app->request->post('student','');
            $classesData['id'] = Yii::$app->request->post('id','');
            $classesData['pic']       = $pic;
            $classesData['cate']      = Yii::$app->request->post('cate','');
            $classesData['duration']  = Yii::$app->request->post('duration','');
            $classesData['price']  = Yii::$app->request->post('price','');
            $classesData['major']     = Yii::$app->request->post('major','');
            $classesData['teacher']   = Yii::$app->request->post('teacher','');
            $classesData['introduction']   = Yii::$app->request->post('introduction','');
            if(empty($classesData['student'])||empty($classesData['cate'])){
                die('<script>alert("请添加课程名称/分类/讲师");history.go(-1);</script>');
            }
            if(empty($classesData['id'])){
                $re = Yii::$app->db->createCommand()->insert("{{%classes}}",$classesData)->execute();
            }else{
                $re = $model->updateAll($classesData,'id=:id',array(':id'=>$classesData['id']));
            }
            if($re){
                $this->redirect('index');
            }else{
                echo '<script>alert("数据添加\修改失败，请重试");history.go(-1);</script>';
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

}