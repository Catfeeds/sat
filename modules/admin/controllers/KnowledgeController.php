<?php
namespace app\modules\admin\controllers;
use Yii;
use app\libs\ApiControl;
use app\modules\admin\models\knowledge;
class KnowledgeController extends ApiControl
{
    public function actionIndex()
    {
        $data= Yii::$app->db->createCommand("select * from {{%knowledge}}")->queryAll();
        return $this->render('index',['data'=>$data]);
    }

    public function actionAdd()
    {
        $enableCsrfValidation = false;
        if(!$_POST){
            $id=Yii::$app->request->get('id','');
            if(empty($id)){
                return $this->render('add');
            }else{
                $data= Yii::$app->db->createCommand("select * from {{%knowledge}} where id=".$id)->queryOne();
                return $this->render('add',['data'=>$data]);
            }
        }else{
            $knowledgeData['major'] = Yii::$app->request->post('major','');
            $knowledgeData['name'] = Yii::$app->request->post('name','');
            $knowledgeData['id'] = Yii::$app->request->post('id','');
            $knowledgeData['analysis']      = Yii::$app->request->post('analysis','');
            $knowledgeData['related']  = Yii::$app->request->post('related','');
            if(empty($knowledgeData['major'])){
                die('<script>alert("请选择科目");history.go(-1);</script>');
            }
            if(empty($knowledgeData['name'])){
                die('<script>alert("请添加知识点名");history.go(-1);</script>');
            }
            if(empty($knowledgeData['analysis'])){
                die('<script>alert("请添加知识点分析");history.go(-1);</script>');
            }
            $model=new Knowledge();
//            添加时不带id
            if(empty( $knowledgeData['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%knowledge}}", $knowledgeData)->execute();
            }else{
                $re = $model->updateAll($knowledgeData,'id=:id',array(':id'=>$knowledgeData['id']));
            }
            if($re){
                $this->redirect('index');
            }else{
                echo '<script>alert("数据修改/添加失败，请重试");history.go(-1);</script>';
                die;
            }
        }

    }

    public function actionDel()
    {
        $id= Yii::$app->request->get('id','');
        $re =Knowledge::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }
}