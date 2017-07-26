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

class SearchController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        $keyword = Yii::$app->request->post('keyword', '');
        $cate = Yii::$app->request->get('c', 'i');
//        var_dump($keyword);die;
        $pagesize = 6;
        $p = Yii::$app->request->get('p', 1);
        $offseti = $pagesize * ($p - 1);
        $info = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%' limit $offseti,$pagesize")->queryAll();
        $countinfo = count(Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%'")->queryAll());


        $page = Yii::$app->request->get('page', 1);
        $offsetq = $pagesize * ($page - 1);
        $que = Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'  order by q.id desc limit $offsetq,$pagesize")->queryAll();
        $countque = count(Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'")->queryAll());
        if ($cate != false) {
//                $url = '/search.html?c=q&page';
            $pageque = new Pager("/search.html?c=q&page", $countque, $page, $pagesize);
            $pageinfo = new Pager("/search.html?c=i&p", $countinfo, $p, $pagesize);
        } else {
            $pageque = new Pager("/search.html?page", $countque, $page, $pagesize);
            $pageinfo = new Pager("/search.html?p", $countinfo, $p, $pagesize);
//            $url = '/search.html?p';
        }


        $strinfo = $pageinfo->GetPager();
        $strque = $pageque->GetPager();
//        echo die(json_encode($data));
//        var_dump($data);die;
        return $this->render('index',['info'=>$info,'que'=>$que,'strinfo'=>$strinfo,'strque'=>$strque]);
    }
}