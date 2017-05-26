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
use app\modules\cn\models\Pubclass;
use app\modules\cn\models\Info;

class PubclassController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
        $pubclass = new pubclass();
        $pubclass->getTime();
        $data = Yii::$app->db->createCommand("select * from {{%info}} where isShow=1 and cate='公开课'")->queryAll();
        $arr = Yii::$app->db->createCommand("select * from {{%info}} where isShow=0 and cate='公开课'")->queryAll();
//        var_dump($data);die;
        $controller = Yii::$app->controller->id;
        $pic = Yii::$app->db->createCommand("select * from {{%banner}} where module='$controller'")->queryAll();
        return $this->render('index', ['data' => $data, 'arr' => $arr,'pic'=>$pic]);
    }

    public function actionApply()
    {
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select hits,id from {{%info}} where id=$id ")->queryOne();
        $data['hits'] += 1;
//        var_dump($hits);die();
        $info = new Info();
        $re = $info->updateAll($data, 'id=:id', array(':id' => $id));
        if ($re) {
            echo $data['hits'];
        } else {
            echo "报名失败！";
        }

    }
    // ajax分页
    public function actionPage()
    {
        $p = Yii::$app->request->get('p','1');
        $pagesize=1;
        $data= Yii::$app->db->createCommand("select * from {{%info}} where isShow=0 and cate='公开课' limit ".($p-1)*$pagesize.",".$pagesize)->queryAll();
        $re= Yii::$app->db->createCommand("select count(id) from {{%info}} where isShow=0 and cate='公开课'")->queryAll();
        $total = $re[0]['count(id)'];//总记录数
        $totalPage = ceil($total/$pagesize);// 总页数
        $arr['total'] = $total;
        $arr['pageSize'] = $pagesize;
        $arr['totalPage'] = $totalPage;
        $arr['curPage'] = $p;
        foreach($data as $k=>$v){
            $arr['list'][]= array(
                'summary' => $v['summary'],
                'title' => $v['title'],
                'pic' => $v['pic'],
                'publishTime' => $v['publishTime'],
            );
        }
        echo json_encode($arr);
    }
}