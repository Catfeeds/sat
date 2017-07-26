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

        $keyword = Yii::$app->request->get('keyword', '');
        $cate = Yii::$app->request->get('cate', 'q');
        $page = Yii::$app->request->get('p', '1');

        if($keyword){
            $pagesize = 6;
            $p = Yii::$app->request->get('p', 1);
            $offset= $pagesize * ($p - 1);
            if($cate=='i'){
                $data = Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%' limit $offset,$pagesize")->queryAll();
                $count= count(Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%'")->queryAll());
                $page= new Pager("/search.html?c=i&keyword=$keyword&p", $count,$page, $pagesize);
            }elseif($cate=='q'){
                $data= Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'  order by q.id desc limit $offset,$pagesize")->queryAll();
                $count= count(Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'")->queryAll());
                $page= new Pager("/search.html?c=q&keyword=$keyword&p", $count,$page, $pagesize);
            }
            else{
                $data=array();
                $count=0;
                $page=new Pager("/search.html?keyword=$keyword&p", $count,$page, $pagesize);
            }
            $str = $page->GetPager();

        }else{
            $data=array();
            $str='';
        }

        return $this->render('index',['data'=>$data,'str'=>$str]);
    }


    public function actionAjax()
    {

        $keyword = Yii::$app->request->post('keyword', '');
        $arr['info']['curPage'] =$p = Yii::$app->request->get('p','1');
        $arr['que']['curPage'] =$page = Yii::$app->request->get('page','1');
        $arr['que']['pageSize']=$pagesize=6;
        $arr['info']['pageSize']=$pagesize=6;
        $offseti = $pagesize * ($p - 1);
        $info= Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%' limit $offseti,$pagesize")->queryAll();
        $arr['info']['total']= count(Yii::$app->db->createCommand("select id,title,summary from {{%info}} where title like '%$keyword%'")->queryAll());
        $arr['info']['totalPage'] = ceil( $arr['info']['total']/$pagesize);// 总页数
        $offsetq = $pagesize * ($page - 1);
        $que = Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'  order by q.id desc limit $offsetq,$pagesize")->queryAll();
        $arr['que']['total'] = count(Yii::$app->db->createCommand("select q.content,qe.essay,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where content like '%$keyword%'")->queryAll());
        $arr['que']['totalPage'] = ceil($arr['que']['total']/$pagesize);// 总页数

        foreach($info as $k=>$v){
            $arr['info']['list'][]= array(
                'title' => $v['title'],
                'id' => $v['id'],
                'summary' => $v['summary'],
            );
        }
        foreach($que as $k=>$v){
            $arr['que']['list'][]= array(
                'content' => $v['content'],
                'essay' => $v['essay'],
                'qid' => $v['qid'],
            );
        }

        echo die(json_encode($arr));
    }
}