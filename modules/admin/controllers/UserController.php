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
use app\modules\admin\models\user;
class UserController extends ApiControl {
//    所有资讯的显示
    public function actionIndex()
    {
        $data= Yii::$app->db->createCommand("select * from {{%student_case}}")->queryAll();
        return $this->render('index',['data'=>$data]);
    }
//    添加资讯
    public function actionCase()
    {
        $enableCsrfValidation = false;
//        var_dump($_POST);die;
        if(!$_POST){
//            查找资讯，取出资讯的分类信息，展示到添加页面
            $id= Yii::$app->request->get('id','');
            if(empty($id)){
//               添加时
                return $this->render('case');
            }else{
//                修改时显示到修改页面的数据
                $data= Yii::$app->db->createCommand("select * from {{%student_case}} where id=".$id)->queryOne();
                return $this->render('case',['data'=>$data]);
            }

        }else{
//            提交数据处理
            $user=new User();
            $caseData=$user->add();
//            var_dump($caseData);die;
            if(empty($caseData['name'])||empty($caseData['major'])||empty($caseData['direction']||empty($infoData['matriculate']))){
                die('<script>alert("姓名、专业、申请方向、录取学校不能为空");history.go(-1);</script>');
            }
//            添加时不带id
//            无上传图片时
            if(empty( $caseData['id'])){
//                var_dump($_FILES);die;
                if(empty($_FILES['up']['name'])){
                    $caseData['pic']='';
                }else{
                    $path=$this->upImage('user');
                    $caseData['pic']       = $path;

                }
                $re = Yii::$app->db->createCommand()->insert("{{%student_case}}",$caseData)->execute();
            }else{
//                修改时，提交id
                $caseData['pic']       = Yii::$app->request->post('up','');
                $re = $user->updateAll($caseData,'id=:id',array(':id'=>$caseData['id']));
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
        $re =user::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }



}