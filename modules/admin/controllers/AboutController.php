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
use app\modules\admin\models\Contact;
use app\modules\admin\models\Joboffers;
use app\libs\GetData;
class AboutController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $data = Yii::$app->db->createCommand("select * from {{%contact}} ")->queryAll();
        return $this->render('contact', ['data' => $data]);
    }

    public function actionContact_add()
    {
        if(!$_POST){
//            判断是修改还是添加$id
            $id = Yii::$app->request->get('id', '');
            if(empty($id)){
                return $this->render('contact_add');
            }else{
                $data = Yii::$app->db->createCommand("select * from {{%contact}} where id=" . $id)->queryOne();
                return $this->render('contact_add', ['data' => $data]);
            }
        }else{
            //      添加数据到数据
            $model      = new Contact();
            $getdata=new GetData();
            $must=array('city'=>'城市','telephone'=>'电话','address'=>'地址');
            $data=$getdata->PostData($must);
            if(empty($data['id'])){
                $re = Yii::$app->db->createCommand()->insert("{{%contact}}",$data)->execute();
            }else{
                $re = $model->updateAll($data,'id=:id',array(':id'=>$data['id']));
            }
            if($re){
                $this->redirect('contact');
            }else{
                echo '<script>alert("数据添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }

    }

    public function actionContact_del(){
        $id= Yii::$app->request->get('id','');
        $model  =  new Contact();
        $re =Contact::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }
    public function actionJoin()
    {
        $data = Yii::$app->db->createCommand("select * from {{%job_offers}} ")->queryAll();
        return $this->render('join', ['data' => $data]);
    }
    public function actionJoin_add()
    {
        if(!$_POST){
//            判断是修改还是添加$id
            $id = Yii::$app->request->get('id', '');
            if(empty($id)){
                return $this->render('join_add');
            }else{
                $data = Yii::$app->db->createCommand("select * from {{%job_offers}} where id=" . $id)->queryOne();
                return $this->render('join_add', ['data' => $data]);
            }
        }else{
            //      添加数据到数据
            $getdata=new GetData();
            $must=array('job'=>'职位名称','demand'=>'任职要求');
            $data=$getdata->PostData($must);
            if(empty($data['id'])){
                $re = Yii::$app->db->createCommand()->insert("{{%job_offers}}",$data)->execute();
            }else{
                $model=new Joboffers();
                $re = $model->updateAll($data,'id=:id',array(':id'=>$data['id']));
            }
            if($re){
                $this->redirect('join');
            }else{
                echo '<script>alert("数据添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }
    public function actionJoin_del(){
        $id= Yii::$app->request->get('id','');
        $re =Joboffers::deleteAll("id=:id",array(':id' => $id));
        if($re){
            echo true;
        }
    }
    public function actionSuggest()
    {
        $data = Yii::$app->db->createCommand("select * from {{%suggest}} ")->queryAll();
        return $this->render('suggest', ['data' => $data]);
    }
}