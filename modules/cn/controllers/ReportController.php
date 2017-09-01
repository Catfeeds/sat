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
use app\libs\GetScore;
use app\libs\KeepAnswer;
use app\libs\Format;
use app\modules\cn\models\Report;

class ReportController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;
    public function actionReport()
    {
        // 将session 的数据存到数据库有uid的情况下，无uid的情况下只生成报告页面
        $uid = Yii::$app->session->get('uid');
        $user = Yii::$app->session->get('userData');
        $major = Yii::$app->session->get('part');
        if (isset($_SESSION['answer']) && isset($_SESSION['tid'])) {
            $answerData  = ((array)$_SESSION['answer']);
            $answerData  = $answerData['item'];// 获取用户的答题数据
            $getscore    = new GetScore();
            $number      = $getscore->Number($answerData);
            $score       = $getscore->Score($number);// 各科分数均有，按科目的分类
            $subscore    = $getscore->Subscore($number);
            $crosstest   = $getscore->CrossTest($number);
            // 需要存到数据库里的数据
            $re['tpId']       = $_SESSION['tid'];
            $re['readnum']    = $number['Reading'];
            $re['part']       = ($major == false) ? 'all' : "$major";
            $re['uid']        = $uid;
            $re['mathnum']    = $number['Math'];
            $re['writenum']   = $number['Writing'];
            $re['matherror']  = $number['matherror'];
            $re['readerror']  = $number['readerror'];
            $re['writeerror'] = $number['writeerror'];
            $re['subScore']   = $subscore['total'];
            $re['crossScore'] = $crosstest['total'];
            $re['date']       = time();
            $re['time']       = Yii::$app->session->get('time');// 做题总时间
            ($re['part'] == 'all') ? ($re['score'] = $score['total']) : ($re['score'] = $score["$major"]);
            if ($uid) {
                // 将答案组合成字符串
                $format = new Format();
                $re['answer'] = $format->arrToStr($answerData);
                if ($re['answer'] != false && $re['time']!=false) {
                    $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                    if ($res) {
                        unset($_SESSION['answer']);
                        unset($_SESSION['tid']);
                    }//入库完成
                }else {
//                    echo '<script>alert("还没有报告，赶紧做套模考题吧！");location.href="/mock.html"</script>';
//                    die;
                    $report = new Report();
                    $res = $report->Show($uid, '');
                }
                // 历史报告
                $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                $tp = array_reverse($tp);
                // 取出最新的一次报告
                $report = new Report();
                $res = $report->Show($uid, '');
            } else {
                $res = array_merge($re, $score);
                $tp = '';
            }

        } else {
            if ($uid) {
                if(Yii::$app->db->createCommand("select id from {{%report}} where uid=".$uid)->queryAll()) {
                    $report = new Report();
                    $res = $report->Show($uid, '');
                    $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                    $tp = array_reverse($tp);
                }else {
                    echo '<script>alert("还没有报告，赶紧做套模考题吧！");location.href="/mock.html"</script>';
                    die;
                }
            } else {
                echo '<script>alert("还没有报告，赶紧做套模考题吧！");location.href="/mock.html"</script>';
                die;
            }
        }
        $suggest['Math'] = Yii::$app->db->createCommand("select suggestion from {{%tactics}} where max>" . $res['Math'] . " and min<=" . $res['Math'] . " and major='Math'")->queryOne();
        $suggest['Reading'] = Yii::$app->db->createCommand("select suggestion from {{%tactics}} where max>" . $res['Reading'] . "  and min<=" . $res['Reading'] . " and major='Reading'")->queryOne();
        $suggest['Writing'] = Yii::$app->db->createCommand("select suggestion from {{%tactics}} where max>" . $res['Writing'] . "  and min<=" . $res['Writing'] . " and major='Writing'")->queryOne();
        if ($res['part'] == 'all') {
            return $this->render('details', ['report' => $res, 'suggest' => $suggest, 'tp' => $tp, 'user' => $user]);
        } else {
            $info  = Yii::$app->db->createCommand("select id,pic from {{%info}} where cate='公开课' order by id DESC limit 3")->queryAll();
            $math  = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Math' order by r.score limit 5")->queryAll();
            $read  = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Reading' order by r.score limit 5")->queryAll();
            $write = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Writing' order by r.score limit 5")->queryAll();
            $score = array_merge($write, array_merge($math, $read));
            return $this->render('single_report', ['report' => $res, 'suggest' => $suggest, 'tp' => $tp, 'user' => $user, 'info' => $info, 'score' => $score]);
        }


    }

    // 根据个人中心点击进入报告详情页面
    public function actionDetails()
    {
        $uid = Yii::$app->session->get('uid', '');
        if($uid){
            $user = Yii::$app->session->get('userData');
            $id = Yii::$app->request->get('id', '');
            $re = new Report();
            $res = $re->Show($uid, $id);
            $suggest = $res[0];
            unset($res[0]);
            if ($res['part'] == 'all') {
                $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                $tp = array_reverse($tp);
                return $this->render('details', ['report' => $res, 'suggest' => $suggest, 'tp' => $tp, 'user' => $user]);
            } else {
                $tp    = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='" . $res['part'] . "' order by r.id desc limit 5")->queryAll();
                $tp    = array_reverse($tp);
                $info  = Yii::$app->db->createCommand("select id,pic from {{%info}} where cate='公开课' order by id DESC limit 3")->queryAll();
                $math  = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Math' order by r.score limit 5")->queryAll();
                $read  = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Reading' order by r.score limit 5")->queryAll();
                $write = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Writing' order by r.score limit 5")->queryAll();
                $score = array_merge($write, array_merge($math, $read));
                return $this->render('single_report', ['report' => $res, 'suggest' => $suggest, 'tp' => $tp, 'user' => $user, 'info' => $info, 'score' => $score]);
            }
        }else{
            echo '<script>alert("还没有报告，赶紧做套模考题吧！");location.href="/mock.html"</script>';
            die;
        }


    }
    // 报告页面 用户做题详情
    public function actionQue()
    {
        // 接受的试卷的id
        $uid      = Yii::$app->session->get('uid');
        $tpId     = Yii::$app->request->post('tid');
        $rid      = Yii::$app->request->post('rid');
        $major    = Yii::$app->request->post('sub');
        $classify = Yii::$app->request->post('classify');

        if ($uid) {
            if (!$rid) {
                $data = Yii::$app->db->createCommand("select * from {{%report}} where uid=$uid and tpId=$tpId order by id desc limit 1")->queryOne();
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%report}} where id=$rid")->queryOne();
            }
            $arr = explode(';', $data['answer']);
            static $brr = array();
            // 获取做题的数据
            foreach ($arr as $k => $v) {
                $key = explode(',', $v)[0];
                $brr[$key] = explode(',', $v);
                // $v[1] = rtrim($v[1], 0);
            }
            $report = new Report();
            $que = $report->queDetails($brr, $classify, $major);
        } else {
            if (isset($_SESSION['answer'])) {
                $arr = (array)$_SESSION['answer'];
                $brr = $arr['item'];
                $report = new Report();
                $que = $report->queDetails($brr, $classify, $major);
            } else {
                die;
            }

        }
        die(json_encode($que));

    }
}