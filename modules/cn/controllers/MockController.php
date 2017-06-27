<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use yii\web\Controller;
use app\libs\KeepAnswer;

class MockController extends Controller
{
    public $layout=' ';
    public function actionIndex()
    {
        $this->layout='cn.php';
        $data=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}}")->queryAll();
        $og=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='OG'")->queryAll();
        $princeton=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='princeton'")->queryAll();
        $kaplan=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='kaplan'")->queryAll();
        $barron=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='BARRON'")->queryAll();
//        var_dump($data);die;
        return $this->render('index',['data'=>$data,'og'=>$og,'princeton'=>$princeton,'kaplan'=>$kaplan,'barron'=>$barron]);



//        $this->actionAnswer();
    }

    public function actionDetails()
    {
        $this->layout='cn1.php';
        $major=Yii::$app->request->get('m','');
        $id=Yii::$app->request->get('id');
        if($major!=false){
            if($major=='math'){
                $where="where tpId=".$id." and (major='math1' or major='math2')";
                $modle='mock_math';
            }else{
                $where="where tpId=".$id." and major='$major'";
                $modle='mock_read';
            }
        }else{
            // 全科怎么显示模板 //一题一判断还是每个章节判断
            $where="where tpId=".$id;
            $modle='mock_read';
        }
        $id=Yii::$app->db->createCommand("select id from {{%questions}} $where order by id asc limit 1")->queryOne();
        $data=Yii::$app->db->createCommand("select q.*,qe.* from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=".$id['id']." order by q.id asc ")->queryOne();
        return $this->render($modle,['data'=>$data]);
    }


    // 模考报告的生成
    // 1、判断正确略
    // 2、得出报告分数（数学，reading。writing）
    // 选题逻辑
    // 将题目的ID，答案都传过来
    public function actionAnswer(){

//        $solution=Yii::$app->request->post('solution');// 用户提交的答案
        $solution='C';// 用户提交的答案
//        $answer=Yii::$app->request->post('answer');// 正确答案
        $answer='A';// 正确答案
//        $id=Yii::$app->request->post('qid');
        $id=6;
        // 调用方法
//        $a=new KeepAnswer();
        session_start();
        $a=KeepAnswer::getCat();
        $re=$a->addPro($id,$answer,$solution);
        var_dump($_SESSION['answer']);
//        var_dump($a->addPro($id,$answer,$solution));die;
        $data=Yii::$app->db->createCommand("select q.*,qe.* from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id>".$id." order by q.id asc limit 1 ")->queryOne();
        var_dump($data);
    }
    // 前端点击传递id，和用户所选答案过来，
    // 下一题
    public function actionNext(){
        $solution=Yii::$app->request->post('solution');// 用户提交的答案
        $answer=Yii::$app->request->post('answer');// 正确答案
        $id=Yii::$app->request->post('id');
        session_start();
        $a=KeepAnswer::getCat();
        $re=$a->addPro($id,$answer,$solution);
        var_dump($_SESSION['answer']);
        $data=Yii::$app->db->createCommand("select q.*,qe.* from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id>".$id." limit 1 ")->queryOne();
        return $data;
    }

}