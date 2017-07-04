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
use app\modules\cn\models\Report;

class ReportController extends Controller
{
    public $layout='cn.php';
    public function actionDetails()
    {
//        return $this->render('details');
        // 将session 的数据存到数据库
       $uid=Yii::$app->session->get('uid', '');
       // 历史报告
        if($uid) {
            $tpId = Yii::$app->db->createCommand("select tpId from {{%report}} where uid=" . $uid)->queryAll();
            $report = new Report();
            $ids = $report->arrToStr($tpId);
            $tp = Yii::$app->db->createCommand("select name,time,id from {{%testpaper}} where id in ('$ids')")->queryAll();
            // 现在生成的报告
            if (isset($_SESSION['answer'])) {
//            $uid=$report['uid'] = $_SESSION['uid'];
                $uid = $report['uid'] = 222;
                $answerData = ((array)$_SESSION['answer']);
                $answerData = $answerData['item'];// 获取用户的答题数据
                $getscore = new GetScore();
                $number = $getscore->Number($answerData);
                $score = $getscore->Score($number);// 各科分数均有，按科目的分类
                $subscore = $getscore->Subscore($number);
//        var_dump($number);die;
                $crosstest = $getscore->CrossTest($number);
                $report['tpId'] = $_SESSION['tpId'];
                $report['readnum'] = $number['Reading'];
                $report['mathnum'] = $number['Math'];
                $report['writenum'] = $number['Writing'];
                $report['jumpnum'] = $number['kip'];
                $report['subScore'] = $subscore['total'];
                $report['score'] = $score['total'];
                $report['crossScore'] = $crosstest['total'];
                $report['data'] = time();
//            $report['time']=$_COOKIE['time'];// 可以在cookie中直接取

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
                $report['answer'] = $t;
                $re = Yii::$app->db->createCommand()->insert("{{%report}}", $report)->execute();
                if ($re) {
                    $a = KeepAnswer::getCat();
                    $re = $a->Emptyitem();
                    $getscore->Assignment();
                }

                $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Math'] . " and min<" . $score['Math'] . " and major='Math'")->queryOne();
                $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Reading'] . " and min<" . $score['Reading'] . " and major='Reading'")->queryOne();
                $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Writing'] . " and min<" . $score['Writing'] . " and major='Writing'")->queryOne();
                return $this->render('details', ['report' => $report, 'suggest' => $suggest, 'tp' => $tp]);


            } else {
//            // 登录之后才能查看历史报告
//            $uid=Yii::$app->session->get('uid','0');
                $report = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid . " order by id desc")->queryAll();
                // 还要取建议
                return $this->render('details', ['tp' => $tp, 'report' => $report]);
            }
        }else{

        }
    }

}