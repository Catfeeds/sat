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
use app\libs\Pager;
use app\modules\cn\models\Teachers;

class SatController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
        $classes = Yii::$app->db->createCommand("select id,cate,introduction,cate from {{%classes}} ")->queryAll();
        $banner = Yii::$app->db->createCommand("select pic,url,alt from {{%banner}}  where module='classes'")->queryAll();
        $teachers = Yii::$app->db->createCommand("select pic,name,subject,introduction from {{%teachers}} ")->queryAll();
        $info1 = Yii::$app->db->createCommand("select id,content from {{%info}} where cate='公开课' and isShow='1' order by id desc limit 5")->queryAll();
        $infoNews = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='新闻资讯'order by id desc limit 6")->queryAll();
        $infoTest = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='备考资讯' order by id desc limit 6")->queryAll();
        $info3 = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='高分经验' order by id desc limit 6")->queryAll();
        $infoAd = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='公告' order by id desc limit 6")->queryAll();
        $controller = Yii::$app->controller->id;
        $pic = Yii::$app->db->createCommand("select * from {{%banner}} where module='$controller'")->queryAll();
        $session = Yii::$app->session;
        $user=$session->get('userData');
//        var_dump($_SESSION);die;
        return $this->render('index', ['classes' => $classes, 'infoNews' => $infoNews, 'infoAd' => $infoAd,'infoTest' => $infoTest,'user'=>$user, 'banner' => $banner, 'teachers' => $teachers, 'info1' => $info1, 'info3' => $info3,'pic'=>$pic]);
    }
}