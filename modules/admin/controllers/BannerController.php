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
use app\modules\admin\models\banner;
class BannerController extends ApiControl
{
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select * from {{%banner}}")->queryAll();
        return $this->render('index', ['data' => $data]);
    }

    public function actionAdd()
    {
        $enableCsrfValidation = false;
        if (!$_POST) {
            $id=Yii::$app->request->get('id', '');
//            $data = Yii::$app->db->createCommand("select * from {{%banner}} where pid=0")->queryAll();
            if(empty($id)){
                return $this->render('add');
            }else{
                $data  = Yii::$app->db->createCommand("select * from {{%banner}} where id=".$id)->queryOne();
                return $this->render('add', ['data'=>$data]);
            }
//            var_dump($data);die;

        } else {
            $banner=new Banner();
            $bannerData['module'] = Yii::$app->request->post('module', '');
            $bannerData['url'] = Yii::$app->request->post('url', '');
            $bannerData['alt'] = Yii::$app->request->post('alt', '');
            $bannerData['id'] = Yii::$app->request->post('id', '');
            $bannerData['time']=date("Y-m-d",time());

            if (empty($bannerData['module'] || $bannerData['url']|| $bannerData['alt'])) {
                die('<script>alert("请将信息填完整");history.go(-1);</script>');
            }
            if(empty($bannerData['id'])){
                $path=$this->upImage('banner');
                $bannerData['pic']       = $path;
                $re = Yii::$app->db->createCommand()->insert("{{%banner}}", $bannerData)->execute();
            }else{
//                var_dump($_POST);die;
                $bannerData['pic']= Yii::$app->request->post('up', '');
                $re = $banner->updateAll($bannerData,'id=:id',array(':id'=>$bannerData['id']));
            }
//            var_dump($nodeData);die;
            if ($re) {
                $this->redirect('index');
            } else {
                echo '<script>alert("数据修改/添加失败，请重试");history.go(-1);</script>';
                die;
            }
        }

    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Banner::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }

    }
}