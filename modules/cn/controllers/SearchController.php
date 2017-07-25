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


class SearchController extends Controller
{
    public $layout='cn.php';
    public $enableCsrfValidation = false;
    public function actionIndex(){

        $keyword= Yii::$app->request->post('keyword', '');
//        $keyword= 'sat';
//        $data = Yii::$app->db->createCommand("select id,title,summay from {{%info}} where title like '%$keyword%'" )->queryAll();
//        var_dump($data);
//        $data2 = Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'  order by q.id desc")->queryAll();
//        return $this->render('index');


        $pagesize = 6;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $cate = Yii::$app->request->get('c', 'i');
        if ($cate == 'i') {
            $data = Yii::$app->db->createCommand("select id,title,summay from {{%info}} where title like '%$keyword%' limit $offset,$pagesize" )->queryAll();
        } elseif ($cate == 'q') {
            $data = Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'  order by q.id desc limit $offset,$pagesize")->queryAll();
        }
        $count=count($data);
        if ($cate != false) {
            $url = 'search.html?' . "c=" . $cate . "&p";
        } else {
            $url = 'search.html?p';
        }
        $page = new Pager("$url", $count, $page, $pagesize);
        $str = $page->GetPager();
    }
}