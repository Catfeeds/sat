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
    public $layout='cn.php';
    public function actionIndex()
    {
        $data=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}}")->queryAll();
        $og=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='OG'")->queryAll();
        $princeton=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='普林斯顿'")->queryAll();
        $kaplan=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='开普兰'")->queryAll();
        $barron=Yii::$app->db->createCommand("select id,name,time from {{%testpaper}} where name='BARRON'")->queryAll();
//        var_dump($data);die;
        return $this->render('index',['data'=>$data,'og'=>$og,'princeton'=>$princeton,'kaplan'=>$kaplan,'barron'=>$barron]);

    }

    public function actionDetails()
    {
        $major=Yii::$app->request->get('m','');
        $id=Yii::$app->request->get('id');
        if($major!=false){
            if($major=='math'){
                $where="where tpId=".$id."and (major='math1' or major='math2')";
            }else{
                $where="where tpId=".$id." and major='$major'";
            }
        }else{
            $where="where tpId=".$id;
        }
        $id=Yii::$app->db->createCommand("select id from {{%topic}} $where order by id asc limit 1")->queryOne();
        $data=Yii::$app->db->createCommand("select t.*,te.* from {{%topic}} t left join {{%topic_extend}} te on  t.id=te.topicId where te.topicId=".$id['id']." order by t.id ASC ")->queryAll();
        var_dump($data);die;
        return $this->render('mock_details');
    }

//    public function actionMock()
//    {
//        $keyword=Yii::$app->request->post('keyword');
//        $data=Yii::$app->db->createCommand("select name,time from {{%testpaper}} where name='$keyword'")->queryAll();
//        $arr=array();
//        foreach($data as $k=>$v){
//            $arr[$k]=$v['name'].$v['time'];
//        }
//        die(json_encode($data));
//    }
    // 模考报告的生成
    // 1、判断正确略
    // 2、得出报告分数（数学，reading。writing）
    // 选题逻辑
    // 将题目的ID，答案都传过来
    public function actionAnswer(){
        $answer=Yii::$app->request->post('answer');
        $id=Yii::$app->request->post('id');
        // 调用方法
        $a=KeepAnswer::getCat();
        $re=$a->addPro($id,$answer);
        var_dump($_SESSION);
        var_dump($re);die;
        if(re){

        }
    }

}