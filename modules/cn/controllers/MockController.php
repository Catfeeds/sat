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
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $this->layout = 'cn.php';
        $data = Yii::$app->db->createCommand("select id,name,time,isLogin from {{%testpaper}}where name!='测评' and name!='每日一题'")->queryAll();
        $og = Yii::$app->db->createCommand("select id,name,time,isLogin  from {{%testpaper}} where name='OG'")->queryAll();
        $princeton = Yii::$app->db->createCommand("select id,name,time,isLogin  from {{%testpaper}} where name='princeton'")->queryAll();
        $kaplan = Yii::$app->db->createCommand("select id,name,time,isLogin  from {{%testpaper}} where name='kaplan'")->queryAll();
        $barron = Yii::$app->db->createCommand("select id,name,time,isLogin  from {{%testpaper}} where name='BARRON'")->queryAll();
        $score=Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where part='all' order by r.score DESC limit 10")->queryAll();
        $read=Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where part='Reading' order by r.score DESC limit 10")->queryAll();
        $write=Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where part='writing' order by r.score DESC limit 10")->queryAll();
        return $this->render('index', ['data' => $data, 'read'=>$read,'write'=>$write,'og' => $og, 'princeton' => $princeton, 'kaplan' => $kaplan, 'barron' => $barron,'score'=>$score]);
    }
    // 注意事项的页面
    public function actionNotice()
    {
        $this->layout = 'cn1.php';
        $tid = Yii::$app->request->get('tid');
        $uid = Yii::$app->session->get('uid','');
        if(is_numeric($tid)){
            $isLogin= Yii::$app->db->createCommand("select isLogin from {{%testpaper}} where id=".$tid)->queryOne();
            $url=Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
            if($uid==false){
                echo "<script>alert('请登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
                die;
            }

            $major = Yii::$app->request->get('m', '');
            if(isset($_SESSION['answer'])){
                unset($_SESSION['answer']);
            }
            if(isset($_SESSION['tid'])){
                unset($_SESSION['tid']);
            }
            $_SESSION['part']=$major;
            return $this->render('mock_notice', ['tid' => $tid, 'major' => $major]);
        }else{
            $this->layout = 'cn.php';
            return $this->render('/sat/surprise');
        }

    }

    // 开始模考功能，无qid取第一道题，有qid取题目详情
    public function actionDetails()
    {
        session_start();
        $this->layout = 'cn1.php';
        $major = Yii::$app->request->get('m','');
        $id = Yii::$app->request->get('tid');
        $qid = Yii::$app->request->get('qid','');
        $a = KeepAnswer::getCat();
        $count = $a->Gettype();
        if(!is_numeric($id)){
            $this->layout="cn.php";
            return $this->render('/sat/surprise');
        }
        if ($major != false) {
            if ($major == 'Math') {
                $major = '(major="Math1" or major="Math2")';
                $where = "where tpId=" . $id . " and $major";
            } else {
                $where = "where tpId=" . $id . " and major='$major'";
            }
            $section = Yii::$app->db->createCommand("select section from {{%questions}} $where order by section asc limit 1")->queryOne();
            if($section['section'] ==false) {
                echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";
                die;
            }
        } else {
            $section['section'] = 1;
        }
        if (!$qid) {
            $data = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.subScores,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $section['section'] . "  and q.number='1' and tpId=$id")->queryOne();
        }elseif($qid=='undefined') {
            unset($_SESSION['answer']);unset($_SESSION['tid']);
            echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";
            die;
        }else{
            // 有qid的时候直接根据qid取
            if(is_numeric($qid)){
                $data = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.subScores,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where q.id=" . $qid)->queryOne();
            }else{
                $this->layout="cn.php";
                return $this->render('/sat/surprise');
            }
        }
        if($data==false){
            echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";die;
        }
        if($data['major']=='Math1'){
            $time  =25;
            $amount=20;
            $modle = 'mock_math';
        }elseif($data['major']=='Math2') {
            $time  =55;
            $amount=38;
            $modle = 'mock_math';
        }elseif ($data['major']=='Reading'){
            $time  =65;
            $amount=52;
            $modle = 'mock_read';
        }else{
            $time  =35;
            $amount=44;
            $modle = 'mock_read';
        }
//        var_dump($data);die;
        return $this->render($modle, ['data' => $data, 'time' => $time, 'count' => $count, 'amount' => $amount]);
    }
    // 下一题
    public function actionNext()
    {
        // 是只存id 和答案，还是报告所需数据都存
        $solution = Yii::$app->request->post('solution');// 用户提交的答案
        $major    = Yii::$app->request->post('major');// 学科
        $tid      = Yii::$app->request->post('tid');
        $qid      = Yii::$app->request->post('qid');
        $uid      = Yii::$app->request->post('uid');
        $utime    = Yii::$app->request->post('utime');
        $number   = Yii::$app->request->post('number');
        $section  = Yii::$app->request->post('section');
        session_start();
        $a        = KeepAnswer::getCat();
        $re       = $a->addPro($qid, $solution,$utime);
        // 正确率等的计算
        $model    =new Questions();
        $data     = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id from {{%questions}} where id=" . $qid)->queryOne();
        $re       =$model->avg($solution,$utime,$data);
        $_SESSION['uid'] = $uid;
        $_SESSION['tid'] = $tid;
        $next = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne();
//   var_dump($_SESSION);die;
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
        $section = Yii::$app->request->post('section')+1;
        $count   = Yii::$app->request->post('allPos');// 做题总数
        $tid     = Yii::$app->request->post('tpId');
        $qid     = Yii::$app->request->post('qid');
        $utime   = Yii::$app->request->post('utime');// 每题的做题时间
        $time    = Yii::$app->request->post('allTime');// 做题总时间
        $solution= Yii::$app->request->post('solution');// 用户提交的答案
        Yii::$app->session->set('time',$time);
        $a       = KeepAnswer::getCat();
        $re      = $a->addPro($qid, $solution,$utime);// 将答案保存到session里
        // 正确率等的计算
        $model   =new Questions();
        $data    = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id from {{%questions}} where id=" . $qid)->queryOne();
        $re      =$model->avg($solution,$utime,$data);
        // 统计答题总数，根据答题总数，返回数据
        if($count<154){
//    if($count<20){
            $data= Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number=1 and tpId=" . $tid . " and section='$section' limit 1 ")->queryOne();
            echo die(json_encode($data));
        }else{
            echo die(json_encode('rep'));
        }
    }
}