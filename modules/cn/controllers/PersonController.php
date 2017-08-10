<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\libs\Format;
use yii;
use yii\web\Controller;
use app\modules\cn\models\Notes;
use app\modules\cn\models\Collection;
use app\modules\cn\models\Report;


class PersonController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;

    public function actionCollect()
    {
        $uid = Yii::$app->session->get('uid');
        $arr = Yii::$app->db->createCommand("select * from {{%collection}} where uid=" . $uid)->queryOne();
        $qid = ltrim($arr['qid'], ',');
        $data = Yii::$app->db->createCommand("select q.id as qid,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid)")->queryAll();
//        var_dump($data);die;

        return $this->render('person_collect', ['data' => $data]);
    }

    public function actionExercise()
    {
        $uid = Yii::$app->session->get('uid');
        $arr = Yii::$app->db->createCommand("select * from {{%notes}} where uid=" . $uid)->queryOne();
        if ($arr['notes'] != false) {
            $brr = explode(';', $arr['notes']);
            static $crr = array();
            static $s = '';
            foreach ($brr as $k => $v) {
                if ($v != '') {
                    $key = explode(',', $v)[0];
                    $crr[$key] = explode(',', $v);
                    $s .= $key . ',';
                }

            }
            $qid = rtrim($s, ',');
            $data = Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid)")->queryAll();
            static $n = 0;
            foreach ($data as $k => $v) {
                if ($v['answer'] == $crr[$v['qid']][1]) {
                    $n += 1;
                }
            }
        } else {
            $crr = array();
            $data = array();
            $n = 0;
        }

//        var_dump($data);die;
        return $this->render('person_exercise', ['data' => $data, 'crr' => $crr, 'n' => $n]);
    }

    public function actionMock()
    {
        $uid = Yii::$app->session->get('uid');
        $arr = Yii::$app->db->createCommand("select r.*,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=" . $uid)->queryAll();
        $model = new Format();
        foreach ($arr as $k => $v) {
            $arr[$k]['rtime'] = $model->FormatTime($v['rtime']);
        }
        return $this->render('person_mock', ['arr' => $arr]);
    }

    public function actionColl()
    {
        $uid = Yii::$app->session->get('uid');
        $name = Yii::$app->request->post('src');
        $p = Yii::$app->request->post('p', '1');
        $major = Yii::$app->request->post('classify');
        $model = new collection();
        $pagesize = 2;
        $offset = $pagesize * ($p - 1);
        $data = $model->CollectionDate($name, $uid, $major, $offset, $pagesize);
        $data['curPage'] = $p;
        echo die(json_encode($data));
    }

    public function actionExer()
    {
        $uid = Yii::$app->session->get('uid');
//        $uid = 222;
        $name = Yii::$app->request->post('src');
        $major = Yii::$app->request->post('classify');
        $error = Yii::$app->request->post('case');
        $p = Yii::$app->request->post('p', '1');
        $pagesize = 2;
        $offset = $pagesize * ($p - 1);

        $notes = new Notes();
        $arr = $notes->Ex($uid, $name, $major, $error, $offset, $pagesize, $p);


        $arr['totalPage'] = ceil($arr['total'] / $pagesize);// 总页数
        $arr['curPage'] = $p;
        $arr['pageSize'] = $pagesize;
        echo die(json_encode($arr));
    }

    public function actionMo()
    {
        $uid = Yii::$app->session->get('uid');
        $src = Yii::$app->request->post('src');
        $type = Yii::$app->request->post('type');
        $arr['curPage'] = $p = Yii::$app->request->post('p', '1');
        $arr['pageSize'] = $pagesize = 2;
        if ($src != 'all') {
            $name = "and name='$src'";
        } else {
            $name = '';
        }
        if ($type == 'whole') {
            $part = '';
        } else {
            $part = "and part ='$type'";
        }
        $offset = $pagesize * ($p - 1);
        $data = Yii::$app->db->createCommand("select r.*,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=$uid $name $part limit $offset,$pagesize")->queryAll();
        $arr['total'] = count(Yii::$app->db->createCommand("select r.*,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=$uid $name $part ")->queryAll());
        $arr['totalPage'] = ceil($arr['total'] / $pagesize);// 总页数
        $model = new Format();
//        var_dump($arr);
        foreach ($data as $k => $v) {
            $arr['list'][] = array(
                'part' => $v['part'],
                'id' => $v['id'],
                'tpId' => $v['tpId'],
                'name' => $v['name'],
                'time' => $v['time'],
                'mathnum' => $v['mathnum'],
                'readnum' => $v['readnum'],
                'writenum' => $v['writenum'],
                'date' => $v['date'],
                'rtime' => $model->FormatTime($v['rtime']),
            );
        }

        echo die(json_encode($arr));
    }

    public function actionDel()
    {
        $id = Yii::$app->request->post('id');
        $re = Report::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            $res['code'] = 1;
            $res['message'] = '删除成功';
        } else {
            $res['code'] = 0;
            $res['message'] = '删除失败';
        }
        echo die(json_encode($res));
    }

    public function actionRemoved()
    {
        $uid = Yii::$app->session->get('uid');
        $id = Yii::$app->request->post('id');
        $arr = Yii::$app->db->createCommand("select * from {{%notes}} where uid=" . $uid)->queryOne();
        if ($arr['notes'] != false) {
            $brr = explode(';', $arr['notes']);
            static $crr = array();
            foreach ($brr as $k => $v) {
                if ($v != '') {
                    $key = explode(',', $v)[0];
                    $crr[$key] = explode(',', $v);
                }

            }
            unset($crr[$id]);
        }
        $model = new Format();
        $data['notes'] = $model->arrToStr($crr);
//        var_dump($data['notes']);
        $notes = new Notes();
        $re = $notes->updateAll($data, 'id=:id', array(':id' => $arr['id']));
        if ($re) {
            $res['code'] = 1;
            $res['message'] = '删除成功';
        } else {
            $res['code'] = 0;
            $res['message'] = '删除失败';
        }

        echo die(json_encode($res));
    }
}