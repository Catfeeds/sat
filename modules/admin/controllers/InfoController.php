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
use app\modules\admin\models\info;
class InfoController extends ApiControl {
//    所有资讯的显示
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%info}} ")->queryAll();
        return $this->render('index',['data'=>$data]);
    }
//    添加资讯
    public function actionAdd()
    {
        $enableCsrfValidation = false;
//        var_dump($_POST);die;
        if(!$_POST){
//            查找资讯，取出资讯的分类信息，展示到添加页面
            $id= Yii::$app->request->get('id','');
            if(empty($id)){
//               添加时
                return $this->render('add');
            }else{
//                修改时显示到修改页面的数据
                $data= Yii::$app->db->createCommand("select * from {{%info}} where id=".$id)->queryOne();
                return $this->render('add',['data'=>$data]);
            }

        }else{
//            提交数据处理
            $info=new Info();
            $infoData=$info->add();
//            var_dump($infoData);die;
            if(empty($infoData['title'])){
                die('<script>alert("请添加资讯标题");history.go(-1);</script>');
            }
            if(empty($_POST['editorValue'])){
                die('<script>alert("请添加内容");history.go(-1);</script>');
            }
            if(empty($infoData['cate'])){
                die('<script>alert("请选择分类");history.go(-1);</script>');
            }
//            添加时不带id
//            无上传图片时
            if(empty( $infoData['id'])){
//                var_dump($_FILES);die;
                if(empty($_FILES['up']['name'])){
                    $infoData['pic']='';
                }else{
                    $path=$this->upImage('info');
                    $infoData['pic']       = $path;
                }
                $re = Yii::$app->db->createCommand()->insert("{{%info}}",$infoData)->execute();
            }else{
//                修改时，提交id
                $infoData['pic']       = Yii::$app->request->post('up','');
                $re = $info->updateAll($infoData,'id=:id',array(':id'=>$infoData['id']));
           }
            if($re){
                $this->redirect('index');
            }else{
                echo '<script>alert("数据添加/修改失败，请重试");history.go(-1);</script>';
                die;
            }

        }
    }
//    删除课程
    public function actionDel(){
        $id= Yii::$app->request->get('id','');
        $re =Info::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }



}