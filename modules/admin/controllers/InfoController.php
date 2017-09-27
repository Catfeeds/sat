<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:04
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\Info;
use app\libs\GetData;
use app\libs\Pager;

class InfoController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $pagesize = 15;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $count = Yii::$app->db->createCommand("select count(*) as count from {{%info}} ")->queryOne();
        $data = Yii::$app->db->createCommand("select id,title,pic,videoAddress,keywords,summary,content,cate,publishTime,hits,validTime from {{%info}} order by id desc limit $offset,$pagesize")->queryAll();
        $url='/admin/info/index?p';
        $count = $count['count'];
        $page = new Pager("$url", $count, $page, $pagesize);
        $str = $page->GetPager();

//        $data = Yii::$app->db->createCommand("select * from {{%info}} order by id desc")->queryAll();
        return $this->render('index', ['data' => $data,'str'=>$str]);
    }

    // 修改和添加资讯，判断依据是$_POST['id']是否提交
    public function actionAdd()
    {

        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if (empty($id)) {
                return $this->render('add');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%info}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data]);
            }
        } else {
            $getdata = new GetData();
            $must = array('title' => '标题', 'summary' => '摘要', 'cate' => '分类');
            $data = $getdata->PostData($must, 'info');
            $arr = $getdata->Auto('publishTime');
            $data = array_merge($data, $arr);
            if (empty($data['id'])) {
                $re = Yii::$app->db->createCommand()->insert("{{%info}}", $data)->execute();
            } else {
                $info = new Info();
                $re = $info->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加/修改失败，请重试");history.go(-1);</script>';
                die;
            }

        }

    }

    // 删除
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Info::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }


}