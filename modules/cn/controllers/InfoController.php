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
use app\modules\admin\models\Info;
use app\libs\Pager;

class InfoController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
        // isShow 为0即推荐，1不推荐
        $order="order by isShow asc,id desc";
        $pagesize = 6;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $cate = Yii::$app->request->get('c', 'n');
        if ($cate == 'n') {
            $count = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='新闻资讯'")->queryOne();
            $info = Yii::$app->db->createCommand("select * from {{%info}} where cate='新闻资讯' $order limit $offset,$pagesize")->queryAll();
        } elseif ($cate == 't') {
            $count = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='学术报告'")->queryOne();
            $info = Yii::$app->db->createCommand("select * from {{%info}} where cate='学术报告' $order limit $offset,$pagesize")->queryAll();
        }elseif ($cate == 's') {
            $count = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='高分经验'")->queryOne();
            $info = Yii::$app->db->createCommand("select * from {{%info}} where cate='高分经验' $order limit $offset,$pagesize")->queryAll();
        }
        $count = $count['count'];
        if ($cate != false) {
            $url = 'info.html?' . "c=" . $cate . "&p";
        } else {
            $url = 'info.html?p';
        }
        $page = new Pager("$url", $count, $page, $pagesize);
        $str = $page->GetPager();
        $hot = Yii::$app->db->createCommand("select * from {{%info}} order by hits desc limit 5")->queryAll();
        $student = Yii::$app->db->createCommand("select * from {{%student_case}} order by id desc limit 5")->queryAll();
        $newinfo = Yii::$app->db->createCommand("select * from {{%info}} order by id desc limit 6")->queryAll();
        $controller = Yii::$app->controller->id;
        $pic = Yii::$app->db->createCommand("select * from {{%banner}} where module='$controller'")->queryAll();
        return $this->render('index', ['student' => $student, 'info' => $info, 'str' => $str, 'hot' => $hot, 'newinfo' => $newinfo,'pic'=>$pic]);
    }

    public function actionDetails()
    {
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%info}} where id=$id")->queryOne();
        $data['hits']+=1;
        $model=new Info;
        $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
        $cate = $data['cate'];
        $arr = Yii::$app->db->createCommand("select * from {{%info}} where cate='$cate' order by hits desc ")->queryAll();
        $brr = Yii::$app->db->createCommand('select * from {{%info}} where isShow=0 order by hits desc limit 5 ')->queryAll();
        return $this->render('details', ['data' => $data, 'arr' => $arr, 'brr' => $brr]);
    }
}