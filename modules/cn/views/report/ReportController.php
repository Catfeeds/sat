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
use app\modules\cn\models\Report;

class ReportController extends Controller
{
    public $layout='cn.php';
    Public function actionIndex(){
        $uid=Yii::$app->session->get('uid', '');
        if ($uid) {
            // 二级页面只需要给出模考的名称即可
            $report = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid . " order by id desc ")->queryAll();

//            $number['Reading']=$report['readnum'];
//            $number['Writing']=$report['writenum'];
//            $number['Math']=$report['mathnum'];
//            $getscore = new GetScore();
//            $score = $getscore->Score($number);
//            $re=array_merge($report,$score);
//            $tpId=Yii::$app->db->createCommand("select tpId from {{%report}} where uid=".$uid)->queryAll();
//            $report=new Report();
//            $ids=$report->arrToStr($tpId);
//            $tp=Yii::$app->db->createCommand("select name,time,id from {{%testpaper}} where id in ('$ids')")->queryAll();
        }else{
            echo "<script>alert('请先登录')</script>";die;
        }

//        $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Math']  . "  and min<" . $score['Math'] . " and major='Math'")->queryOne();
//        $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Reading']  . "  and min<" . $score['Reading'] . " and major='Reading'")->queryOne();
//        $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Writing']  . "  and min<" . $score['Writing']." and major='Writing'")->queryOne();
        //        var_dump( $score);die;
        //        var_dump( $suggest);die;
        return $this->render('details', ['report' => $report]);
    }

    // 做完题后生成报告
    public function actionReport()
    {
        // 将session 的数据存到数据库有uid的情况下，无uid的情况下只生成报告页面
       $uid=Yii::$app->session->get('uid', '');
       $major=Yii::$app->request->get('major', 'All'); // 从前台得到还是从地址栏得到
       // 历史报告
//        if(isset($_SESSION['answer'])) {
//            $answerData = ((array)$_SESSION['answer']);
//            $item = $answerData['item'];
            // 现在生成的报告
//            if (!empty($item)) {
                $answerData = ((array)$_SESSION['answer']);
                $answerData = $answerData['item'];// 获取用户的答题数据
                $getscore   = new GetScore();
                $number     = $getscore->Number($answerData);
                $score      = $getscore->Score($number);// 各科分数均有，按科目的分类
                $subscore   = $getscore->Subscore($number);
                $crosstest  = $getscore->CrossTest($number);
//        var_dump($score);echo'</br>';
//        var_dump($number);
//        var_dump($number);
//
//        die;
                $re['tpId']       = $_SESSION['tid'];
                $re['readnum']    = $number['Reading'];
                $re['part']       = $major;
                $re['mathnum']    = $number['Math'];
                $re['writenum']   = $number['Writing'];
                $re['matherror']  = $number['matherror'];
                $re['readerror']  = $number['readerror'];
                $re['writeerror'] = $number['writeerror'];
//            $re['jumpnum'] = $number['kip'];
                $re['subScore']   = $subscore['total'];
                $re['score']      = $score['total'];
                $re['crossScore'] = $crosstest['total'];
                $re['data']       = time();
//            $report['time']=$_COOKIE['time'];// 可以在cookie中直接取
                if ($uid) {
                    // 将答案组合成字符串
                    static $temp = array();
                    foreach ($answerData as $v) {
                        $v = join(",", $v); //可以用implode将一维数组转换为用逗号连接的字符串
                        $temp[] = $v;
                    }
                    $t = "";
                    foreach ($temp as $v) {
                        $t .= $v . ";";
                    }
                    $t = substr($t, 0, -1);
                    $re['answer'] = $t;
                    $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                    if ($res) {
                        $a = KeepAnswer::getCat();
                        $a->Emptyitem();
                    }
                    // 历史报告

                    $tpId = Yii::$app->db->createCommand("select tpId from {{%report}} where uid=" . $uid)->queryAll();
                    $report = new Report();
                    $ids = $report->arrToStr($tpId);
                    $tp = Yii::$app->db->createCommand("select name,time,id from {{%testpaper}} where id in ('$ids')")->queryAll();
                } else {
                    // 临时报告怎么处理
                    $tp = '';
                }
                $re = array_merge($re, $score);

//            }
//        }else {
//            // 登录之后才能查看历史报告
//            // $uid=Yii::$app->session->get('uid','0');
//            if ($uid) {
//                $report = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid . " order by id desc limit 1")->queryOne();
//                $number['Reading']=$report['readnum'];
//                $number['Writing']=$report['writenum'];
//                $number['Math']=$report['mathnum'];
//                $getscore = new GetScore();
//                $score = $getscore->Score($number);
//                $re=array_merge($report,$score);
//                $tpId=Yii::$app->db->createCommand("select tpId from {{%report}} where uid=".$uid)->queryAll();
//                $report=new Report();
//                $ids=$report->arrToStr($tpId);
//                $tp=Yii::$app->db->createCommand("select name,time,id from {{%testpaper}} where id in ('$ids')")->queryAll();
//            }else{
//                echo "<script>alert('请先登录')</script>";die;
//            }
//        }
        $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Math']  . "  and min<" . $score['Math'] . " and major='Math'")->queryOne();
        $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Reading']  . "  and min<" . $score['Reading'] . " and major='Reading'")->queryOne();
        $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Writing']  . "  and min<" . $score['Writing']." and major='Writing'")->queryOne();
//        var_dump( $score);die;
//        var_dump( $suggest);die;
        return $this->render('details', ['report' => $re, 'suggest' => $suggest,'tp' => $tp]);
    }
    // 根据二级页面的点击进入详情页面
    public function actionDetails()
    {
        // 将session 的数据存到数据库
        $uid=Yii::$app->session->get('uid', '');
        $id=Yii::$app->request->get('id', '');
        // 根据试卷ID来取相关的数据
        $data = Yii::$app->db->createCommand("select * from {{%report}} where id=" . $id)->queryOne();
//        $data['']
        $getscore   = new GetScore();
//        $number     = $getscore->Number($answerData);

        $number['Math']      =$data['mathnum'];
        $number['Writing']   =$data['writenum'];
        $number['Reading']   =$data['mathnum'];
        $number['subScore']  =$data['subScore'];
        $number['crossScore']=$data['crossScore'];
        $score      = $getscore->Score($number);// 各科分数均有，按科目的分类
        $subscore   = $getscore->Subscore($number);
        $crosstest  = $getscore->CrossTest($number);

//        $major=Yii::$app->request->get('major', 'All'); // 从前台得到还是从地址栏得到
        // 历史报告
//        if(isset($_SESSION['answer'])) {
//            $answerData = ((array)$_SESSION['answer']);
//            $item = $answerData['item'];
//            // 现在生成的报告
//            if (!empty($item)) {
//                $answerData = ((array)$_SESSION['answer']);
//                $answerData = $answerData['item'];// 获取用户的答题数据
//                $getscore   = new GetScore();
//                $number     = $getscore->Number($answerData);
//                $score      = $getscore->Score($number);// 各科分数均有，按科目的分类
//                $subscore   = $getscore->Subscore($number);
//                $crosstest  = $getscore->CrossTest($number);
//                $re['tpId']       = $_SESSION['tid'];
//                $re['readnum']    = $number['Reading'];
//                $re['part']       = $major;
//                $re['mathnum']    = $number['Math'];
//                $re['writenum']   = $number['Writing'];
//                $re['matherror']  = $number['matherror'];
//                $re['readerror']  = $number['readerror'];
//                $re['writeerror'] = $number['writeerror'];
////            $re['jumpnum'] = $number['kip'];
//                $re['subScore']   = $subscore['total'];
//                $re['score']      = $score['total'];
//                $re['crossScore'] = $crosstest['total'];
//                $re['data']       = time();
////            $report['time']=$_COOKIE['time'];// 可以在cookie中直接取
//                if ($uid) {
//                    // 将答案组合成字符串
//                    static $temp = array();
//                    foreach ($answerData as $v) {
//                        $v = join(",", $v); //可以用implode将一维数组转换为用逗号连接的字符串
//                        $temp[] = $v;
//                    }
//                    $t = "";
//                    foreach ($temp as $v) {
//                        $t .= $v . ";";
//                    }
//                    $t = substr($t, 0, -1);
//                    $re['answer'] = $t;
//                    $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
//                    if ($res) {
//                        $a = KeepAnswer::getCat();
//                        $a->Emptyitem();
//                    }
//                    // 历史报告
//
//                    $tpId = Yii::$app->db->createCommand("select tpId from {{%report}} where uid=" . $uid)->queryAll();
//                    $report = new Report();
//                    $ids = $report->arrToStr($tpId);
//                    $tp = Yii::$app->db->createCommand("select name,time,id from {{%testpaper}} where id in ('$ids')")->queryAll();
//                } else {
//                    $tp = '';
//                }
//                $re = array_merge($re, $score);
//
//            }
//        }else {
//            // 登录之后才能查看历史报告
//            // $uid=Yii::$app->session->get('uid','0');
//            if ($uid) {
//                $report = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid . " order by id desc limit 1")->queryOne();
//                $number['Reading']=$report['readnum'];
//                $number['Writing']=$report['writenum'];
//                $number['Math']=$report['mathnum'];
//                $getscore = new GetScore();
//                $score = $getscore->Score($number);
//                $re=array_merge($report,$score);
//                $tpId=Yii::$app->db->createCommand("select tpId from {{%report}} where uid=".$uid)->queryAll();
//                $report=new Report();
//                $ids=$report->arrToStr($tpId);
//                $tp=Yii::$app->db->createCommand("select name,time,id from {{%testpaper}} where id in ('$ids')")->queryAll();
//            }else{
//                echo "<script>alert('请先登录')</script>";die;
//            }
//        }
        $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Math']  . "  and min<" . $score['Math'] . " and major='Math'")->queryOne();
        $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Reading']  . "  and min<" . $score['Reading'] . " and major='Reading'")->queryOne();
        $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Writing']  . "  and min<" . $score['Writing']." and major='Writing'")->queryOne();
//        var_dump( $score);die;
//        var_dump( $suggest);die;
        return $this->render('details', ['report' => $re, 'suggest' => $suggest,'tp' => $tp]);
    }

}