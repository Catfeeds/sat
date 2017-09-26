<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use app\libs\Format;
use app\libs\GetScore;
use yii\web\Controller;
use app\libs\KeepAnswer;
use app\modules\cn\models\Login;
use app\modules\cn\models\Notes;
use app\modules\cn\models\Report;
use app\modules\cn\models\Questions;
use app\modules\cn\models\Collection;

class WapApiController extends Controller
{
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }

    public $enableCsrfValidation = false;
    //设置登录过期时间
    public $loginOutTime = 86400;
    /**
     *
     * wap登录
     * @Obelisk
     */

    public function actionCheckLogin()
    {
        $apps = Yii::$app->request;

        $session = Yii::$app->session;

        $logins = new Login();
//        $cartModel = new ShoppingCart();
        if ($apps->isGet) {
            $userName = $apps->get('userName');

            $userPass = $apps->get('userPass');

            if (!$userName) {

                $re['code'] = 0;

                $re['message'] = '请输入用户名';

                $callback = $_GET['callback'];
                echo $callback.'('.json_encode($re).')';
                exit;

            }

            $userPass = md5($userPass);
            list($uid, $username, $password, $email,$merge,$phone) = uc_user_login($userName, $userPass);
            if($uid < 0){
                list($uid, $username, $password, $email,$merge,$phone) = uc_user_login($userName, $userPass,2);
                if($uid < 0){
                    list($uid, $username, $password, $email,$merge,$phone) = uc_user_login($userName, $userPass,3);
                }
            }
            if($uid > 0) {
                $success_content =  uc_user_synlogin($uid);
                $loginsdata = $logins->find()->asArray()->where("(phone='$userName' or userName='$userName' or email='$userName')")->one();

                if (empty($loginsdata['id'])) {
                    $login = new Login();
                    $login->phone = $phone;

                    $login->userPass = $password;

                    $login->email = $email;

                    $login->createTime = time();

                    $login->userName = $username;
                    $login->uid = $uid;
                    $login->save();
                    $loginsdata = $logins->find()->asArray()->where("(phone='$userName' or userName='$userName' or email='$userName')")->one();
                }else{
                    if($phone != $loginsdata['phone']){
                        Login::updateAll(['phone' => $phone],"id={$loginsdata['id']}");
                    }
                    if($email != $loginsdata['email']){
                        Login::updateAll(['email' => "$email"],"id={$loginsdata['id']}");
                    }
                    if($username != $loginsdata['userName']){
                        Login::updateAll(['userName' => "$username"],"id={$loginsdata['id']}");
                    }
                    if($uid != $loginsdata['uid']){
                        Login::updateAll(['uid' => "$uid"],"id={$loginsdata['id']}");
                    }
                    $loginsdata = $logins->find()->asArray()->where("id={$loginsdata['id']}")->one();
                }
                $session->set('userId', $loginsdata['id']);
//                $cartModel->mergeCart();
//                $answerModel = new UserAnswer();
//                $answerNum = $answerModel->getAnswerNum($loginsdata['id']);
//                $historyModel = new TestStatistics();
//                $tpoNum = $historyModel->getTpoNum($loginsdata['id']);
//                $userLevel = Yii::$app->params['userLevel'];
//                foreach($userLevel as $k=>$v){
//                    if($k>$loginsdata['level']){
//                        if(($answerNum >= $v['practiceBegin'] && $answerNum <= $v['practiceEnd']) || ($tpoNum >= $v['tpoBegin'] && $tpoNum <= $v['tpoEnd']) ){
//                            $logins->updateAll(['level' => $k],"id={$loginsdata['id']}");
//                            $loginsdata['level'] = $k;
//                            uc_user_edit_integral($username,'练习等级提升',1,$v['integral']);
//                            break;
//                        }
//                    }
//                }
                $session->set('userData', $loginsdata);
                $re['code'] = 1;
                $re['message'] = '登录成功';
                $re['userData'] = $loginsdata;
                $re['userId'] = $loginsdata['id'];
                $re['success_content'] = $success_content;
            } elseif($uid == -1) {
                $re['code'] = 0;
                $re['message'] = '用户名或密码错误';
            } elseif($uid == -2) {
                $re['code'] = 0;
                $re['message'] = '用户名或密码错误';
            } else {
                $re['code'] = 0;
                $re['message'] = '未定义';
            }
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode($re).')';
            exit;

        }

    }

    /**
     * wap注销账户
     * @return string
     * */

    public function actionLoginOut()

    {

        $session = Yii::$app->session;

        $startListening = $session->get('startListening');

        $userId = $session->get('userId');

//        if ($startListening) {
//
//            $testId = Yii::$app->session->get('testId');
//
//            $deltaTime = time() - $startListening;
//
////            $sign = HistoryRecord::find()->where("userId=$userId AND testId=$testId AND recordType=2")->one();
//
////            HistoryRecord::updateAll(['deltaTime' => $sign->deltaTime + $deltaTime], "userId=$userId AND testId=$testId AND recordType=2");
//
////            Yii::$app->session->remove('startListening');
//
////            Yii::$app->session->remove('testId');
//
//        }
        $session->remove('userData');
        $session->remove('userId');
        $loginOut = uc_user_synlogout();
        $data = ['code' => 1,'loginOut' =>$loginOut];
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode($data).')';
        exit;

    }

    /**
     * wap注册
     * @Obelisk
     */

    public function actionRegister()
    {
        $login = new Login();
        $registerStr = Yii::$app->request->get('registerStr');

        $pass = Yii::$app->request->get('pass');

        $code = Yii::$app->request->get('code');

        $type = Yii::$app->request->get('type');

        $source = Yii::$app->request->get('source','托福wap');

        $userName = Yii::$app->request->get('userName','');

        if($userName == ''){
            $userName =  'toefl'.time();
        }

        $checkTime = $login->checkTime();

        if ($checkTime) {

            $checkCode = $login->checkCode($registerStr, $code);

            if ($checkCode) {

                if ($type == 1) {

                    $login->phone = $registerStr;

                    $login->userPass = md5($pass);

                    $login->createTime = time();

                    $login->userName = $userName;
                    $uid = uc_user_register($userName,md5($pass),'',$registerStr,$source,time());

                } else {

                    $login->email = $registerStr;

                    $login->userPass = md5($pass);

                    $login->createTime = time();

                    $login->userName = $userName;
                    $uid = uc_user_register($userName,md5($pass),$registerStr,'',$source,time());
                }
                if($uid <0){
                    if($uid == -1) {
                        $res['code'] = 0;
                        $res['message'] = '用户名已经被注册';
                    } elseif($uid == -2) {
                        $res['code'] = 0;
                        $res['message'] = '包含要允许注册的词语';
                    } elseif($uid == -3) {
                        $res['code'] = 0;
                        $res['message'] = '用户名已经存在';
                    } elseif($uid == -4) {
                        $res['code'] = 0;
                        $res['message'] = 'Email 格式有误';
                    } elseif($uid == -5) {
                        $res['code'] = 0;
                        $res['message'] = 'Email 不允许注册';
                    } elseif($uid == -6) {
                        $res['code'] = 0;
                        $res['message'] = '该 Email 已经被注册';
                    } elseif($uid == -7){
                        $res['code'] = 0;
                        $res['message'] = '电话已被注册';
                    }
                }else{
                    $login->uid = $uid;
                    $re = $login->save();
                    if ($re) {
//                        $model = new News();
//                        $model->news = '终于等到你，欢迎成为小申托福备考团队的一员，小申托福QQ学习群314584547，微信公众号：小申托福在线；题库管理员QQ\微信:2649471578，做题过程中遇到任何问题均可及时反馈给管理员,小申托福在线课程，助你早日预见想象的100+';
//                        $model->userId = $login->primaryKey;
//                        $model->status = 1;
//                        $model->type = 2;
//                        $model->createTime = time();
//                        $model->sendId = 1;
//                        $model->save();
                        $res['code'] = 1;
                        $res['message'] = '注册成功';

                        uc_user_edit_integral($userName,'注册成功',1,10);

                    } else {

                        $res['code'] = 0;

                        $res['message'] = '注册失败，请重试';

                        $res['type'] = '3';

                    }
                }
            } else {

                $res['code'] = 0;

                $res['message'] = '验证码错误';

                $res['type'] = '1';

            }

        } else {

            $res['code'] = 0;

            $res['message'] = '验证码过期';

            $res['type'] = '1';

        }
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode($res).')';
        exit;

    }





    // 练习二级页面接口
    public function actionExerIndex()
    {
        $paper = Yii::$app->db->createCommand("select id,time,name from {{%testpaper}} where name!='测评'")->queryAll();
        $data=array();
        foreach($paper as $k=>$v){
            $data[$v['name']][]=[
                'id'=>$v['id'],
                'name'=>$v['name'].$v['time']
            ];
        }
        $data['code']=0;
        die(json_encode(['data' => $data]));
    }

    //做题详情,有待商榷
    public function actionExerDetails()
    {
        $qid=Yii::$app->request->get('id','');
        $tid=Yii::$app->request->get('tid');
        $major=Yii::$app->request->get('major');
//        var_dump($qid);die;
//        $number=Yii::$app->request->post('number',2);
//        $section=Yii::$app->request->post('section',2);
        if($major=='Math'){
            $major="major='Math1' or major='Math2'";
        }else{
            $major="major='".$major."'";
        }
        $q = new Questions();
        if($qid!=false){
            $data['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid  from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.id=" . $qid)->queryOne();
        }else{
            $data['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.number=1 and q.tpId=$tid and ($major) ")->queryOne();
        }
//        echo '<pre>';
//        var_dump($data['data']);
//        echo '</pre>';die;
        $data['n'] = $q->Progress($major, $qid, $data['section'], $data['tpId'], $data['essayId']);
        $data['nextid'] = Yii::$app->db->createCommand("select id from {{%questions}} where number>" . $data['data']['number'] . "  and  tpId=" . $tid . " and ($major) order by number asc limit 1")->queryOne()['id'];
        $data['upid']= Yii::$app->db->createCommand("select id from {{%questions}} where number<" . $data['data']['number'] . "  and   tpId=" . $tid . " and ($major) order by number desc limit 1")->queryOne()['id'];
        if($data['nextid']==false||$data['upid']==false){
            $data['code']=1;
            $data['msg']='没有更多数据了';
        }else{
            $data['code']=0;
        }

        die(json_encode(['data' => $data]));
    }

    // 将登陆用户的做题数据存入数据库
    public function actionNotes()
    {
        $answer = Yii::$app->request->post('answer');
        $time = Yii::$app->request->post('time');
        $qid = Yii::$app->request->post('qid');
        $up = Yii::$app->request->post('up');
        $date = time();
        $data['uid'] = Yii::$app->session->get('uid');
        $que = Yii::$app->db->createCommand("select  answer,peopleNum,correctRate,avgTime,id  from {{%questions}} where id=" . $qid)->queryOne();
        $model = new Questions();
        $re = $model->avg($answer, $time, $que);
        // 将做题的数据存入数据库
        $data['notes'] = $qid . ',' . $answer . ',' . $time . ',' . $date . ';';
        if ($data['uid']) {
            $userData = Yii::$app->session->get('userData');
            uc_user_edit_integral($userData['userName'], 'SAT做题一道', 1, 2);
            $arr = Yii::$app->db->createCommand("select notes,correctRate,count,id,uid from {{%notes}} where uid=" . $data['uid'])->queryOne();
            if (!$arr) {
                $data['count'] = 1;
                $answer == $que['answer'] ? $data['correctRate'] = 100 : $data['correctRate'] = 0;
                $re = Yii::$app->db->createCommand()->insert("{{%notes}}", $data)->execute();
            } else {
                $model = new Notes();
                $data['count'] = $arr['count'] + 1;
                $arr['correctRate'] == 0 ? $correct = 0 : ($correct = $arr['correctRate'] * $arr['count'] / 100);
                if ($answer == $que['answer']) {
                    $data['correctRate'] = ($correct + 1) / $data['count'] * 100;
                } else {
                    $data['correctRate'] = $correct / $data['count'] * 100;
                }

                $data['notes'] = $arr['notes'] . $qid . ',' . $answer . ',' . $time . ',' . $date . ';';
                $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }

//            if ($up == 'next') {
//                $res = Yii::$app->db->createCommand("select id from {{%questions}} where id>" . $qid . " and major='" . $que['major'] . "' and section=" . $que['section'] . " and tpId=" . $que['tpId'] . " order by id asc limit 1")->queryOne();
//            } else {
//                $res = Yii::$app->db->createCommand("select id from {{%questions}} where id<" . $qid . " and major='" . $que['major'] . "' and section=" . $que['section'] . " and tpId=" . $que['tpId'] . " order by id desc limit 1")->queryOne();
//            }
        }
        if(!isset($re)||$re==false){
            $res['code']=1;
            $res['msg']='数据未保存';
        }else{
            $res['code']=0;
        }

        echo die(json_encode($re));
    }

    // 收藏题目与取消收藏
    public function actionCollection()
    {
        $data['qid'] =(string)Yii::$app->request->post('qid', '');
        $data['uid'] =Yii::$app->session->get('uid', '');
        $flag=Yii::$app->request->post('flag');// 是否收藏
        $model=new Collection();
        // 查找 uid 是否存在
        $arr= Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=".$data['uid'])->queryOne();
        if($flag==0){
            $data['qid'] =','.$data['qid'];
            if(!$arr){
                $re = Yii::$app->db->createCommand()->insert("{{%collection}}", $data)->execute();
            }else{
                $data['qid']=$arr['qid'].$data['qid'];
                $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }
            if($re){
                $res['message']='收藏成功';
                $res['code']=0;
            }else{
                $res['message']='收藏失败';
                $res['code']=1;
            }
            die(json_encode($res));
        }elseif($flag==1){
            // 查找',qid,'存在再替换
            $qids=explode(',',$arr['qid']);
            foreach($qids as $k=>$v){
                if($v==$data['qid']){
                    unset($qids[$k]);
                    break;
                }
            }
            $data['qid']=implode(',',$qids);
            $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            if($re){
                $res['message']='取消成功';
                $res['code']=0;
            }else{
                $res['message']='取消失败';
                $res['code']=2;
            }
            die(json_encode($res));
        }
    }

    // 模考二级页面
    public function actionMockIndex()
    {
        $paper = Yii::$app->db->createCommand("select id,time,name  from {{%testpaper}} where name!='测评'")->queryAll();
        $data=array();
        foreach($paper as $k=>$v){
            $data[$v['name']][]=[
                'tid'=>$v['id'],
                'name'=>$v['name'].$v['time']
            ];
        }
        $data['code']=0;
        die(json_encode(['data' => $data]));
    }

    // 模考通知页面
    public function actionMockNotice()
    {
        $tid=Yii::$app->request->post('tid');
        $major=Yii::$app->request->post('major','');
        $data['Reading']['count']=52;
        $data['Reading']['time']=65;
        $data['Writing']['count']=44;
        $data['Writing']['time']=35;
        $data['Math1']['count']=38;
        $data['Math1']['time']=55;
        $data['Math2']['count']=20;
        $data['Math2']['time']=25;
        $data['total']['count']=154;
        $data['total']['time']=180;
        if($major==false){
            die(json_encode(['data' => $data,'tid'=>$tid,'major'=>$major]));
        }elseif($major=='Math'){
            $data['total']['count']=58;
            $data['total']['time']=80;
            $math=array('math1'=>$data['Math1'],'math2'=>$data['Math2'],'total'=>$data['total']);
            die(json_encode(['data' =>$math,'tid'=>$tid,'major'=>$major]));
        }else{
            $arr=array("$major"=>$data["$major"],'total'=>$data["$major"]);
            die(json_encode(['data' => $arr,'tid'=>$tid,'major'=>$major]));
        }

    }

    // 模考详情页
    public function actionMockDetails()
    {
        $tid=Yii::$app->request->post('tid');
        $major=Yii::$app->request->post('major','');// 如果为单科模考
        if(!is_numeric($tid)){
            $re['msg']='请求错误！';
            $re['code']=1;
            die(json_encode($re));
        }
        if ($major != false) {
            if ($major == 'Math') {
                $major = '(major="Math1" or major="Math2")';
                $where = "where tpId=" . $tid . " and $major";
            } else {
                $where = "where tpId=" . $tid . " and major='$major'";
            }
            $section = Yii::$app->db->createCommand("select section from {{%questions}} $where order by section asc limit 1")->queryOne()['section'] ;
            if($section==false) {
                $re['msg']='题目正在更新中！';
                $re['code']=2;
                die(json_encode($re));
            }
        } else {
            $section = 1;
        }
        $data = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $section. "  and q.number=1 and tpId=$tid")->queryOne();
        if($data==false){
            $re['msg']='题目正在更新中！';
            $re['code']=2;
            die(json_encode($re));
        }
        if($data['major']=='Math1'){
            $data['time']  =55;
            $data['count']=38;
        }elseif($data['major']=='Math2') {
            $data['time']=25;
            $data['count']=20;
        }elseif ($data['major']=='Reading'){
            $data['time']=65;
            $data['count']=52;
        }else{
            $data['time']  =35;
            $data['count']=44;
        }
        $data['code']=1;
        die(json_encode(['data' => $data, 'count' =>  $data['count'], 'time' => $data['time']]));
    }

    // 保存答案，下一题
    public function actionMockNext()
    {
        // 是只存id 和答案，还是报告所需数据都存
        $answer = Yii::$app->request->post('answer');// 用户提交的答案
        $major    = Yii::$app->request->post('major','');// 全科时不传，单科目时传
        $tid      = Yii::$app->request->post('tid');
        $qid      = Yii::$app->request->post('qid');
        $uid      = Yii::$app->session->get('uid','');
        $utime    = Yii::$app->request->post('utime');
        $number   = Yii::$app->request->post('number');
        $section  = Yii::$app->request->post('section');
        session_start();
        $a        = KeepAnswer::getCat();
        $re       = $a->addPro($qid, $answer,$utime);
//        $count = $a->Gettype();//存入session之后再统计
        // 正确率等的计算
        $model    =new Questions();
        $data     = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id from {{%questions}} where id=" . $qid)->queryOne();
        $re       =$model->avg($answer,$utime,$data);
        $_SESSION['uid'] = $uid;
        $_SESSION['tid'] = $tid;
        $next['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        // 可能有问题
        $next['isfinal']= Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $next['number'] . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne()['qid'];
        if($major=='Math1'){
            $time =55;
            $num=38;
        }elseif($major=='Math2') {
            $time =25;
            $num=20;
        }elseif ($major=='Reading'){
            $time= 65;
            $num = 52;
        }elseif ($major=='Writing'){
            $time = 35;
            $num = 44;
        }else{
            $time=180;
            $num=154;
        }
        $data['code']=0;
        echo die(json_encode(['data'=>$next,'time'=>$time,'num'=>$num]));
    }

    // 中途离开
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
//        $count   = Yii::$app->request->post('allPos');// 做题总数,可能不需要
        $major    = Yii::$app->request->post('major','');// 全科时不传，单科目时传
        $tid     = Yii::$app->request->post('tpId');
        $qid     = Yii::$app->request->post('qid');
        $utime   = Yii::$app->request->post('utime');// 每题的做题时间
        $time    = Yii::$app->request->post('allTime');// 做题总时间
        $answer= Yii::$app->request->post('answer');// 用户提交的答案
        Yii::$app->session->set('time',$time);
        $a       = KeepAnswer::getCat();
        $re      = $a->addPro($qid, $answer,$utime);// 将答案保存到session里
        // 正确率等的计算
        $model   =new Questions();
        $arr    = Yii::$app->db->createCommand("select notes,correctRate,count,id,uid from {{%questions}} where id=" . $qid)->queryOne();
        $re      =$model->avg($answer,$utime,$arr);
        // 根据数据判断是否是最后一题
        if($major=='Reading'||$major=='Writing'){
            $arr['isfinal']=true;
        }elseif($major=='Math'||$major==''){
            if($arr['major']=='Math2'){
                $arr['isfinal']=true;
            }else{
                $arr['isfinal']=false;
            }
        }
        if(!$arr['isfanil']){
            $data= Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number=1 and tpId=" . $tid . " and section='$section' limit 1 ")->queryOne();
            $data['code']=0;
        }else{
            $data['code']=1;
            $data['msg']='本试卷已全部答完';
        }
        die(json_encode($data));
    }

    // 模考报告页面
    public function actionMockReport()
    {
        // 生成报告页面
        //个人中心页面
        //登录状态直接点击‘报告’
        // 将session 的数据存到数据库有uid的情况下，无uid的情况下只生成报告页面
        $uid = Yii::$app->session->get('uid');
        $user = Yii::$app->session->get('userData');
        $major = Yii::$app->session->get('part');
        $id = Yii::$app->request->post('id','');// 个人中心才传参,报告的id
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
                    if($id==false){
                        $res = $report->Show($uid, '');
                    }else{
                        $res = $report->Show($uid,$id);
                    }
                    $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                    $tp = array_reverse($tp);
                }else {
                    $res['message']='还没有报告，赶紧做套模考题吧！';
                    $res['code']=1;
                    die(json_encode($res));
                }
            } else {
                $res['message']='还没有报告，赶紧做套模考题吧！';
                $res['code']=1;
                die(json_encode($res));
            }
        }
        $suggest['Math'] = Yii::$app->db->createCommand("select suggestion from {{%tactics}} where max>" . $res['Math'] . " and min<=" . $res['Math'] . " and major='Mock-Math'")->queryOne();
        $suggest['Reading'] = Yii::$app->db->createCommand("select suggestion from {{%tactics}} where max>" . $res['Reading'] . "  and min<=" . $res['Reading'] . " and major='Mock-Reading'")->queryOne();
        $suggest['Writing'] = Yii::$app->db->createCommand("select suggestion from {{%tactics}} where max>" . $res['Writing'] . "  and min<=" . $res['Writing'] . " and major='Mock-Writing'")->queryOne();
        if ($res['part'] == 'all') {
            die( json_encode(['report' => $res, 'suggest' => $suggest, 'tp' => $tp, 'user' => $user]));
        } else {
            $info  = Yii::$app->db->createCommand("select id,pic from {{%info}} where cate='公开课' order by id DESC limit 3")->queryAll();
            $math  = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Math' order by r.score limit 5")->queryAll();
            $read  = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Reading' order by r.score limit 5")->queryAll();
            $write = Yii::$app->db->createCommand("select t.name,t.time,r.score,u.nickname,u.username,r.part from ({{%report}} r left join {{%testpaper}} t on r.tpId=t.id) left join {{%user}} u on r.uid=u.uid where r.part='Writing' order by r.score limit 5")->queryAll();
            $score = array_merge($write, array_merge($math, $read));
            die( json_encode( ['report' => $res, 'suggest' => $suggest, 'tp' => $tp, 'user' => $user, 'info' => $info, 'score' => $score]));
        }

    }
    public function Question($tid, $answer)
    {
        $s = Yii::$app->db->createCommand("select id,answer,section from {{%questions}} where tpId=$tid")->queryAll();
        $arr = explode(';', $answer);
        static $brr = array();
        static $que = array();
        // 获取做题的数据
        foreach ($arr as $k => $v) {
            $key = explode(',', $v)[0];
            $brr[$key] = explode(',', $v);
            $s = Yii::$app->db->createCommand("select id,answer,section from {{%questions}} where id=$key")->queryOne();
            if ($brr[$key][1] == $s['answer']) {
                $que[$s['section']][$k][0] = 1;
                $que[$s['section']][$k][1] = $s['id'];
            } else {
                $que[$s['section']][$k][0] = 0;
                $que[$s['section']][$k][1] = $s['id'];
            }
        }
        return $que;
    }
    // 测评卷
    public function actionEvaulationIndex(){
        $paper = Yii::$app->db->createCommand("select id,time,name  from {{%testpaper}} where name like '%测评%' limit 3")->queryAll();
        $data=array();
        foreach($paper as $k=>$v){
            $data[$v['name']][]=[
                'tid'=>$v['id'],
                'name'=>$v['name'].$v['time']
            ];
        }
        $data['code']=0;
        die(json_encode(['data' => $data]));
    }
    // 测评通知页面
    public function actionEvaulationNotice(){
        $tid=Yii::$app->request->post('tid');
        die(json_encode($tid));
    }





}