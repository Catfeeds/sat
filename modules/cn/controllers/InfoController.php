<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;
use yii;
use yii\web\controller;
use app\modules\cn\models\info;
use app\libs\pager;
class InfoController extends Controller{
    public function actionIndex(){
        $pagesize = 1;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $cate= Yii::$app->request->get('c','n');
        if($cate=='n'){
            $count = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='新闻资讯'")->queryOne();
            $info = Yii::$app->db->createCommand("select * from {{%info}} where cate='新闻资讯' limit $offset,$pagesize")->queryAll();
        }elseif($cate=='t') {
            $count = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='备考资讯'")->queryOne();
            $info = Yii::$app->db->createCommand("select * from {{%info}} where cate='备考资讯' limit $offset,$pagesize")->queryAll();
        }
        $count= $count['count'];
        if($cate!=false){
            $url='info.html?'."c=".$cate."&p";
        }else{
            $url='info.html?p';
        }
        $page=new Pager("$url",$count,$page,$pagesize);
        $str=$page->GetPager();
        $hot  = Yii::$app->db->createCommand("select * from {{%info}} order by hits desc limit 5")->queryAll();
        $student= Yii::$app->db->createCommand("select * from {{%student_case}} limit 5")->queryAll();
        $newinfo=Yii::$app->db->createCommand("select * from {{%info}} order by id desc limit 5")->queryAll();
        return $this->renderPartial('index', ['student' => $student,'info' => $info,'str'=>$str,'hot' => $hot,'newinfo'=>$newinfo]);
    }
    public function actionDetails(){
//        从数据表获取数据
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%info}} where id=$id")->queryOne();
        $cate=$data['cate'];
        $arr = Yii::$app->db->createCommand("select * from {{%info}} where cate='$cate' order by hits desc ")->queryAll();
        $brr = Yii::$app->db->createCommand('select * from {{%info}} where isShow=1 order by hits desc limit 5 ')->queryAll();
        return $this->renderPartial('details',['data'=>$data,'arr'=>$arr,'brr'=>$brr]);
    }
}