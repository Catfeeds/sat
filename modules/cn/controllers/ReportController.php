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
//    Public function actionIndex(){
//        $uid=Yii::$app->session->get('uid', '');
//        if ($uid) {
//            // 二级页面只需要给出模考的名称即可
//            $report = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid . " order by id desc ")->queryAll();
//
////            $number['Reading']=$report['readnum'];
////            $number['Writing']=$report['writenum'];
////            $number['Math']=$report['mathnum'];
////            $getscore = new GetScore();
////            $score = $getscore->Score($number);
////            $re=array_merge($report,$score);
////            $tpId=Yii::$app->db->createCommand("select tpId from {{%report}} where uid=".$uid)->queryAll();
////            $report=new Report();
////            $ids=$report->arrToStr($tpId);
////            $tp=Yii::$app->db->createCommand("select name,time,id from {{%testpaper}} where id in ('$ids')")->queryAll();
//        }else{
//            echo "<script>alert('请先登录')</script>";die;
//        }
//
////        $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Math']  . "  and min<" . $score['Math'] . " and major='Math'")->queryOne();
////        $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Reading']  . "  and min<" . $score['Reading'] . " and major='Reading'")->queryOne();
////        $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $score['Writing']  . "  and min<" . $score['Writing']." and major='Writing'")->queryOne();
//        //        var_dump( $score);die;
//        //        var_dump( $suggest);die;
//        return $this->render('details', ['report' => $report]);
//    }

    // 做完题后生成报告 将查看报告和生成报告分开
    public function actionReport()
    {
//        $this->actionQue();die;
        // 将session 的数据存到数据库有uid的情况下，无uid的情况下只生成报告页面
        $uid=Yii::$app->session->get('uid');
        $uid=222;
        $user=Yii::$app->session->get('userData');
        $major=Yii::$app->session->get('part'); // 从前台得到还是从地址栏得到
//        var_dump($major);die;
        if(isset($_SESSION['answer'])) {
            $answerData = ((array)$_SESSION['answer']);
            $answerData = $answerData['item'];// 获取用户的答题数据
            $getscore = new GetScore();
            $number = $getscore->Number($answerData);
            $score = $getscore->Score($number);// 各科分数均有，按科目的分类
            $subscore = $getscore->Subscore($number);
            $crosstest = $getscore->CrossTest($number);
            // 需要存到数据库里的数据
            $re['tpId'] = $_SESSION['tid'];
            $re['readnum'] = $number['Reading'];
            $re['part'] = ($major==false)?'all':"$major";
            $re['uid'] = $uid;
            $re['mathnum'] = $number['Math'];
            $re['writenum'] = $number['Writing'];
            $re['matherror'] = $number['matherror'];
            $re['readerror'] = $number['readerror'];
            $re['writeerror'] = $number['writeerror'];
            $re['subScore'] = $subscore['total'];
            $re['score'] = $score['total'];
            $re['crossScore'] = $crosstest['total'];
            $re['date'] = time();
            $re['time'] = Yii::$app->session->get('time');// 做题总时间
            if ($uid) { // 可能存在问题
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
                if($re['answer']!=false){
                    $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                    if ($res) {
                        $a = KeepAnswer::getCat();
                        $a->Emptyitem();
                    }//入库完成
                }
                // 历史报告
                $tp=Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                $tp=array_reverse($tp);
//              // 取出最新的一次报告
//                $res = $this->actionShow($uid);
                $re=new Report();
                $res=$re->Show($uid,'');
                $suggest=$res[0];
                unset($res[0]);
            } else {
                $res = array_merge($re, $score);
                $tp = '';
            }

        }else{
            if($uid){
//                $res = $this->actionShow($uid);
                $re=new Report();
                $res=$re->Show($uid,'');
                $suggest=$res[0];
                unset($res[0]);
                if($res){
                    $tp=Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                    $tp=array_reverse($tp);
                }else{
                    echo '<script>alert("还没有报告，赶紧做套模考题吧！");location.href="/mock.html"</script>';
                    die;
                }
            }else{
                echo '<script>alert("还没有报告，赶紧做套模考题吧！");location.href="/mock.html"</script>';
                die;
            }
        }
//        var_dump($tp);
//        $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $res['Math']  . "  and min<" . $res['Math'] . " and major='Math'")->queryOne();
//        $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $res['Reading']  . "  and min<" . $res['Reading'] . " and major='Reading'")->queryOne();
//        $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $res['Writing']  . "  and min<" . $res['Writing']." and major='Writing'")->queryOne();
        if($major==''){
            return $this->render('details', ['report' => $res, 'suggest' => $suggest,'tp' => $tp,'user'=>$user]);
        }else{
            $info= Yii::$app->db->createCommand("select id,pic from {{%info}} where cate='公开课' order by id DESC limit 3")->queryAll();
            $score=Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part!='all' order by r.score limit 10")->queryAll();
            return $this->render('single_report', ['report' => $res, 'suggest' => $suggest,'tp' => $tp,'user'=>$user,'info'=>$info,'score'=>$score]);
        }

    }
    // 根据二级页面的点击进入详情页面
    public function actionDetails()
    {
        // 将session 的数据存到数据库
        $uid=Yii::$app->session->get('uid', '');
        $uid=222;
        $user=Yii::$app->session->get('userData');
        $id=Yii::$app->request->get('id', '');
        $re=new Report();
        $res=$re->Show($uid,$id);
        $suggest=$res[0];
        unset($res[0]);
        if($res['part']=='all'){
            $tp=Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
            $tp=array_reverse($tp);
            return $this->render('details', ['report' => $res, 'suggest' => $suggest,'tp' => $tp,'user'=>$user]);
        }else{
            $tp=Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='".$res['part']."' order by r.id desc limit 5")->queryAll();
            $tp=array_reverse($tp);
            $info= Yii::$app->db->createCommand("select id,pic from {{%info}} where cate='公开课' order by id DESC limit 3")->queryAll();
            $score=Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part!='all' order by r.score limit 10")->queryAll();
            return $this->render('single_report', ['report' => $res, 'suggest' => $suggest,'tp' => $tp,'user'=>$user,'info'=>$info,'score'=>$score]);
        }

    }

    public function actionQue(){
        // 接受的试卷的id
        $uid=Yii::$app->session->get('uid');
        $uid=222;
        $tpId=Yii::$app->request->get('tid');
        $major=Yii::$app->request->get('sub');
        $classify=Yii::$app->request->get('classify');
        // 存在uid的情况
        if($uid){
            $data=Yii::$app->db->createCommand("select * from {{%report}} where uid=$uid and tpId=$tpId order by id desc limit 1")->queryOne();
            $arr=explode(';',$data['answer']);
//            var_dump($arr);
            static $brr=array();
            // 获取做题的数据
            foreach($arr as $k =>$v){

                $key=explode(',', $v)[0];
                $brr[$key]=explode(',', $v);
            }
//            var_dump($arr);die;
            $report=new Report();
            $que=$report->queDetails($brr,$classify,$major);
        }else{

            if(isset($_SESSION['answer'])){
                $arr=(array)$_SESSION['answer'];
                $brr=$arr['item'];
                $report=new Report();
                $que=$report->queDetails($brr,$classify,$major);
//                var_dump($que);die;
            }else{
                die;
            }

        }
        die(json_encode($que));

    }
}