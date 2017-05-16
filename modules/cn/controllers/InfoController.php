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
        $countNews = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='新闻资讯'")->queryOne();
        $countNews = $countNews['count'];
        $countTest = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='备考资讯'")->queryOne();
        $countTest = $countTest['count'];
        $infoNews = Yii::$app->db->createCommand("select * from {{%info}} where cate='新闻资讯' limit $offset,$pagesize")->queryAll();
        $infoTest= Yii::$app->db->createCommand("select * from {{%info}} where cate='备考资讯' limit $offset,$pagesize")->queryAll();
        $info  = Yii::$app->db->createCommand("select * from {{%info}} order by hits desc limit 5")->queryAll();
        $student= Yii::$app->db->createCommand("select * from {{%student_case}} limit 5")->queryAll();
        $pageTest=new Pager('info.html?p',$countTest,$page,$pagesize);
        $pageNews=new Pager('info.html?p',$countNews,$page,$pagesize);
        $strTest=$pageTest->GetPager();
        $strNews=$pageTest->GetPager();

        return $this->renderPartial('index', ['student' => $student,'infoTest' => $infoTest,'infoNews' => $infoNews,'strTest'=>$strTest,'strNews'=>$strNews,'info' => $info,]);
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