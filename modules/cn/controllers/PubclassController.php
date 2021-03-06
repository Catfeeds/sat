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
use app\modules\cn\models\Pubclass;
use app\modules\cn\models\Info;

class PubclassController extends Controller
{
    public $layout='cn.php';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand("select id,pic,title,videoAddress,name,hits,activeTime,summary,publishTime from {{%info}} where validTime>".time()."  and cate='公开课'")->queryAll();
        $arr = Yii::$app->db->createCommand("select id,pic,title,videoAddress,name,hits,activeTime,summary,publishTime from {{%info}} where validTime<".time()." and cate='公开课'")->queryAll();
        $controller = Yii::$app->controller->id;
        $pic = Yii::$app->db->createCommand("select pic,url,alt from {{%banner}} where module='$controller'")->queryAll();
        return $this->render('index', ['data' => $data, 'arr' => $arr,'pic'=>$pic]);

    }

    public function actionApply()
    {
        $arr['pubclass_id']= Yii::$app->request->post('classId', '');
        session_start();
        if($_SESSION['userData']['phone']!=false){
            $arr['phone']=$_SESSION['userData']['phone'];
        }else{
            $arr['phone']=$_SESSION['userData']['email'];
        }
        $id=$arr['pubclass_id'] ;
        $add_re = Yii::$app->db->createCommand()->insert("{{%class_apply}}", $arr)->execute();
        $data = Yii::$app->db->createCommand("select hits,id from {{%info}} where id=$id ")->queryOne();
        $data['hits'] += 1;
        $info = new Info();
        $re = $info->updateAll($data, 'id=:id', array(':id' => $id));
        if ($re&&$add_re) {
            $res['code']=1;
            $res['hits']=$data['hits'];
            $res['message']='报名成功';
        } else {
            $res['code']=0;
            $res['hits']=$data['hits']-1;
            $res['message']='报名失败';
        }
        die(json_encode($res));
    }
    // ajax分页
    public function actionPage()
    {
        $p = Yii::$app->request->post('p','1');
        $pagesize=6;
        $data= Yii::$app->db->createCommand("select id,pic,title,videoAddress,name,hits,activeTime,summary,publishTime from {{%info}} where validTime<".time()." and cate='公开课' limit ".($p-1)*$pagesize.",".$pagesize)->queryAll();
        $re= Yii::$app->db->createCommand("select count(id) from {{%info}} where validTime<".time()." and cate='公开课'")->queryAll();
        $total = $re[0]['count(id)'];//总记录数
        $totalPage = ceil($total/$pagesize);// 总页数
        $arr['total'] = $total;
        $arr['pageSize'] = $pagesize;
        $arr['totalPage'] = $totalPage;
        $arr['curPage'] = $p;
        foreach($data as $k=>$v){
            $time=explode(' ',$v['activeTime']);
            $arr['list'][]= array(
                'summary' => $v['summary'],
                'title' => $v['title'],
                'pic' => $v['pic'],
                'videoAddress' => $v['videoAddress'],
                'publishTime' => date('Y-m-d',$v['publishTime']),
                'activeDate' =>$time[0],
                'activeTime' =>$time[1]
            );
        }
        echo json_encode($arr);
    }
}