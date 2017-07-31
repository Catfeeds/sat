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
use app\libs\KeepAnswer;
use app\modules\cn\models\Questions;

class MockController extends Controller
{
    public $layout = ' ';

    public function actionIndex()
    {
        $this->layout = 'cn.php';
        $data = Yii::$app->db->createCommand("select * from {{%testpaper}}")->queryAll();
        $og = Yii::$app->db->createCommand("select * from {{%testpaper}} where name='OG'")->queryAll();
        $princeton = Yii::$app->db->createCommand("select * from {{%testpaper}} where name='princeton'")->queryAll();
        $kaplan = Yii::$app->db->createCommand("select * from {{%testpaper}} where name='kaplan'")->queryAll();
        $barron = Yii::$app->db->createCommand("select * from {{%testpaper}} where name='BARRON'")->queryAll();
        $score=Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid order by r.score limit 10")->queryAll();
        return $this->render('index', ['data' => $data, 'og' => $og, 'princeton' => $princeton, 'kaplan' => $kaplan, 'barron' => $barron,'score'=>$score]);

    }
    // 注意事项的页面
    public function actionNotice()
    {
        $this->layout = 'cn1.php';
        $tid = Yii::$app->request->get('tid');
        $uid = Yii::$app->session->get('uid','');
        $isLogin= Yii::$app->db->createCommand("select isLogin from {{%testpaper}} where id=".$tid)->queryOne();
        $url=Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
        if($uid==false && $isLogin['isLogin']==1){
            echo "<script>alert('该题目需要登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
            die;
        }
        $major = Yii::$app->request->get('m', '');
        if(isset($_SESSION['answer'])){
           unset($_SESSION['answer']);
        }
        $_SESSION['part']=$major;
        return $this->render('mock_notice', ['tid' => $tid, 'major' => $major]);
    }

    // 开始模考功能，无qid取第一道题，有qid取题目详情
    public function actionDetails()
    {
        session_start();
        $this->layout = 'cn1.php';
        $major = Yii::$app->request->get('m', '');
        $id = Yii::$app->request->get('tid');
        $qid = Yii::$app->request->get('qid', '');
        $a = KeepAnswer::getCat();
        $count = $a->Gettype();
//        var_dump($major);die;
        if ($major != false) {
            if ($major == 'Math') {
                $major = '(major="Math1" or major="Math2")';
                $where = "where tpId=" . $id . " and $major";
            } else {
                $where = "where tpId=" . $id . " and major='$major'";
            }
//            var_dump($where);die;
            $section = Yii::$app->db->createCommand("select section from {{%questions}} $where order by section asc limit 1")->queryOne();
          if($section['section'] ==false) {
              echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";
              die;
          }
        } else {
             $section['section'] = 1;
        }
        if (!$qid) {
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where section=" . $section['section'] . "  and q.number='1' and tpId=$id")->queryOne();
        } elseif($qid=='undefined') {
            echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";
            die;
        }else{
            // 有qid的时候直接根据qid取
            $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.id=" . $qid)->queryOne(); // 这里是一维还是二唯数据

        }
//        var_dump($section);die;
        if($data==false){
           echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";die;
        }
        if($data['major']=='Math1'){
            $time  =55;
            $amount=38;
            $amount=1;
            $modle = 'mock_math';
        }elseif($data['major']=='Math2') {
            $time  =25;
            $amount=20;
            $amount=2;
            $modle = 'mock_math';
        }elseif ($data['major']=='Reading'){
            $time  =62;
            $amount=52;
            $amount=2;
            $modle = 'mock_read';
        }else{
            $time  =35;
            $amount=44;
            $amount=2;
            $modle = 'mock_read';
        }
        return $this->render($modle, ['data' => $data, 'time' => $time, 'count' => $count, 'amount' => $amount]);
    }

    // 下一题
    public function actionNext()
    {
        // 是只存id 和答案，还是报告所需数据都存
        $solution = Yii::$app->request->get('solution');// 用户提交的答案
        $major    = Yii::$app->request->get('major');// 学科
        $tid      = Yii::$app->request->get('tid');
        $qid      = Yii::$app->request->get('qid');
        $uid      = Yii::$app->request->get('uid');
        $utime    = Yii::$app->request->get('utime');
        $number   = Yii::$app->request->get('number');
        $section  = Yii::$app->request->get('section');
        session_start();
        $a        = KeepAnswer::getCat();
        $re       = $a->addPro($qid, $solution,$utime);
        // 正确率等的计算
        $model    =new Questions();
        $data     = Yii::$app->db->createCommand("select * from {{%questions}} where id=" . $qid)->queryOne();
        $re       =$model->avg($solution,$utime,$data);

        $_SESSION['uid'] = $uid;
        $_SESSION['tid'] = $tid;
        $next = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        echo die(json_encode($next));

    }

    // 做题中途离开
    public function actionLeave()
    {
        $a = KeepAnswer::getCat();
        $re = $a->Emptyitem();
        echo die(json_encode($re));
    }
    // 提交当前小节，进入下一小节
    public function actionSection()
    {
        $section = Yii::$app->request->get('section')+1;
        $count   = Yii::$app->request->get('allPos');// 做题总数
        $tid     = Yii::$app->request->get('tpId');
        $qid     = Yii::$app->request->get('qid');
        $utime   = Yii::$app->request->get('utime');// 每题的做题时间
        $time    = Yii::$app->request->get('allTime');// 做题总时间
        $solution= Yii::$app->request->get('solution');// 用户提交的答案
        Yii::$app->session->set('time',$time);
//        session_start();
        $a       = KeepAnswer::getCat();
        $re      = $a->addPro($qid, $solution,$utime);// 将答案保存到session里
        // 正确率等的计算
        $model   =new Questions();
        $data    = Yii::$app->db->createCommand("select * from {{%questions}} where id=" . $qid)->queryOne();
        $re      =$model->avg($solution,$utime,$data);
        // 统计答题总数，根据答题总数，返回数据
        if($count<8){
            $data= Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number=1 and tpId=" . $tid . " and section='$section' limit 1 ")->queryOne();
            echo die(json_encode($data));
        }else{
            echo die(json_encode('rep'));
        }

    }

}