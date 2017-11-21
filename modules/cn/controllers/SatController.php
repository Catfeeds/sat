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
        require($_SERVER['DOCUMENT_ROOT'] . '/../libs/Mobile_Detect.php');
        $detect = new \Mobile_Detect;
        $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        switch ($deviceType){
            case 'tablet':
                header('Location: http://m.thinkusat.com/');die;
                break;

            case 'phone':
                header('Location: http://m.thinkusat.com/');die;
                break;

            default:
                break;
        }
        $classes = Yii::$app->db->createCommand("select id,cate,smallIntro,cate from {{%classes}} ")->queryAll();
        $banner = Yii::$app->db->createCommand("select pic,url,alt from {{%banner}}  where module='classes'")->queryAll();
        $teachers = Yii::$app->db->createCommand("select pic,name,subject,introduction from {{%teachers}} ")->queryAll();
        $info1 = Yii::$app->db->createCommand("select id,pic,title,name,hits,activeTime,summary from {{%info}} where cate='公开课' order by id desc limit 5")->queryAll();
        $infoNews = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='新闻资讯'order by id desc limit 6")->queryAll();
        $infoTest = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='学术报告' order by id desc limit 6")->queryAll();
        $info3 = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='高分经验' order by id desc limit 6")->queryAll();
        $infoAd = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where cate='公告' order by id desc limit 6")->queryAll();
        $que = Yii::$app->db->createCommand("select q.id as qid,content,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id order by q.id limit 20")->queryAll();
        $controller = Yii::$app->controller->id;
        $pic = Yii::$app->db->createCommand("select url,pic,alt from {{%banner}} where module='$controller'")->queryAll();
        $session = Yii::$app->session;
        $user=$session->get('userData');
        return $this->render('index', ['classes' => $classes, 'infoNews' => $infoNews, 'infoAd' => $infoAd,'infoTest' => $infoTest,'user'=>$user, 'banner' => $banner, 'teachers' => $teachers, 'que' => $que, 'info1' => $info1, 'info3' => $info3,'pic'=>$pic]);
    }
    public function actionSurprise()
    {
        return $this->render('surprise');
    }

}