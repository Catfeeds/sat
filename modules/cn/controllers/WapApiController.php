<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use app\libs\Sms;
use app\libs\Format;
use app\libs\GetScore;
use yii\web\Controller;
use app\libs\KeepAnswer;
use app\modules\cn\models\Login;
use app\modules\cn\models\Notes;
use app\modules\cn\models\Report;
use app\modules\cn\models\Questions;
use app\modules\cn\models\Collection;

header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: X-Requested-With');
//header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');


class WapApiController extends Controller
{
    function init()
    {
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'] . '/../libs/ucenter/ucenter.php');
    }

    public $enableCsrfValidation = false;
    //设置登录过期时间
    public $loginOutTime = 86400;

    /**
     * 用户登录
     */

    public function actionCheckLogin()

    {
        $apps = Yii::$app->request;
        $session = Yii::$app->session;
        $logins = new Login();
        if ($apps->isPost) {
            $verificationCode   = $apps->post('verificationCode',''); // 验证码
            if($verificationCode){
                if(strtolower($session->get('verificationCode'))!=strtolower($verificationCode )){
                    $re['code'] = 1;
                    $re['message'] = '验证码错误';
                    die(json_encode($re));
                }
            }
            $userName = $apps->post('userName');
            $userPass = $apps->post('userPass');
            if (!$userName) {
                $re['code'] = 1;
                $re['message'] = '请输入用户名';
                die(json_encode($re));
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
                $loginsdata = $logins->find()->where("(phone='$userName' or username='$userName' or email='$userName')")->one();
                if (empty($loginsdata['id'])) {
                    $login = new Login();
                    $login->phone = $phone;
                    $login->password = $password;
                    $login->email = $email;
                    $login->createTime = time();
                    $login->username = $username;
                    $login->uid = $uid;
                    $login->save();
                    $loginsdata = $logins->find()->where("(phone='$userName' or username='$userName' or email='$userName')")->one();
                }else{
                    if($phone != $loginsdata['phone']){
                        Login::updateAll(['phone' => $phone],"id={$loginsdata['id']}");
                    }
                    if($email != $loginsdata['email']){
                        Login::updateAll(['email' => "$email"],"id={$loginsdata['id']}");
                    }
                    if($username != $loginsdata['username']){
                        Login::updateAll(['username' => "$username"],"id={$loginsdata['id']}");
                    }
                    if($uid != $loginsdata['uid']){
                        Login::updateAll(['uid' => "$uid"],"id={$loginsdata['id']}");
                    }
                    $loginsdata = $logins->find()->where("id={$loginsdata['id']}")->one();
                }
                $session->set('userId', $loginsdata['id']);
//                $userLevel = Yii::$app->params['userLevel'];  // 用户等级
                $session->set('userData', $loginsdata);
                $re['code'] = 0;
                $re['message'] = '登录成功';
                $session->set('success_content',$success_content);
            } elseif($uid == -1) {
                $re['code'] = 1;
                $re['message'] = '用户名或密码错误';
            } elseif($uid == -2) {
                $re['code'] = 1;
                $re['message'] = '用户名或密码错误';
            } else {
                $re['code'] = 1;
                $re['message'] = '未定义';
            }
            die(json_encode($re));

        }

    }


    /**
     * 短信接口
     */

    public function actionPhoneCode()

    {

        $session = Yii::$app->session;

        $sms = new Sms();

        $phoneNum = Yii::$app->request->post('phoneNum');

        if (!empty($phoneNum)) {

            $phoneCode = mt_rand(100000, 999999);

            $session->set($phoneNum . 'phoneCode', $phoneCode);

            $session->set('phoneTime', time());

            $content = '【雷哥SAT】验证码：' . $phoneCode . '（10分钟有效），您正在通过手机注册雷哥网免费会员！关注微信:雷哥SAT微助手，获取更多信息；若有SAT题库和课程问题，请咨询管理员QQ:2992826058。';
            $sms->send($phoneNum, $content, $ext = '', $stime = '', $rrid = '');

            $res['code'] = 0;

            $res['message'] = '短信发送成功！';

        } else {

            $res['code'] = 1;

            $res['message'] = '发送失败!手机号码为空！';

        }

        die(json_encode($res));

    }


    /**
     * 用户注册
     */

    public function actionRegister()
    {
        $login = new Login();
        $registerStr = Yii::$app->request->post('registerStr');

        $pass = Yii::$app->request->post('pass');

        $code = Yii::$app->request->post('code');

        $type = Yii::$app->request->post('type');// 手机注册为1 ，邮箱注册为2

        $source = Yii::$app->request->post('source','SATwap');

        $userName = Yii::$app->request->post('userName','');

        if($userName == ''){
            $userName =  'SAT'.time();
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
                        $res['code'] = 1;
                        $res['message'] = '用户名已经被注册';
                    } elseif($uid == -2) {
                        $res['code'] = 1;
                        $res['message'] = '包含不允许注册的词语';
                    } elseif($uid == -3) {
                        $res['code'] = 1;
                        $res['message'] = '用户名已经存在';
                    } elseif($uid == -4) {
                        $res['code'] = 1;
                        $res['message'] = 'Email 格式有误';
                    } elseif($uid == -5) {
                        $res['code'] = 1;
                        $res['message'] = 'Email 不允许注册';
                    } elseif($uid == -6) {
                        $res['code'] = 1;
                        $res['message'] = '该 Email 已经被注册';
                    } elseif($uid == -7){
                        $res['code'] = 1;
                        $res['message'] = '电话已被注册';
                    }
                }else{
                    $login->uid = $uid;
                    $re = $login->save();
                    if ($re) {
                        $res['code'] = 0;
                        $res['message'] = '注册成功';
                        uc_user_edit_integral($userName,'注册成功',1,10);
                    } else {

                        $res['code'] = 1;

                        $res['message'] = '注册失败，请重试';

                        $res['type'] = '3';

                    }
                }
            } else {

                $res['code'] = 1;

                $res['message'] = '验证码错误';

                $res['type'] = '1';

            }

        } else {

            $res['code'] = 1;

            $res['message'] = '验证码过期';

            $res['type'] = '1';

        }

        die(json_encode($res));

    }


    /**
     * 发送邮箱验证码
     */

    public function actionSendMail()
    {

        $session = Yii::$app->session;

        $emailCode = mt_rand(100000, 999999);

        $email = Yii::$app->request->post('email');
//        $email = "yanyao_feng@163.com";

        $session->set($email . 'phoneCode', $emailCode);

        $session->set('phoneTime', time());

        $mail = Yii::$app->mailer->compose();

        $mail->setTo($email);

        $mail->setSubject("【雷哥SAT(http://www.thinkusat.com)】邮件验证码");

        $mail->setHtmlBody('

            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

            <div style="width: 800px;margin: 0 auto;margin-bottom: 10px">

                 <img src="http://test.toeflonline.cn/cn/images/TF_logo.png" alt="logo">

            </div>

            <div style="width: 830px;border: 1px #dcdcdc solid;margin: 0 auto;overflow: hidden">

                 <p style="font-weight: bold;font-size: 18px;margin-left: 20px;color: #34388e;font-family: 微软雅黑;">亲爱的用户 ：</p>

                <span style="margin-left: 20px;font-family: 微软雅黑;">

            你好！你正在注册雷哥SAT会员，网址<a href="http://www.thinkusat.com">http://www.thinkusat.com</a>。你的验证码为：【<span style="color:#ff913e;">' . $emailCode . '</span>】。（有效期为：此邮件发出后48小时）
                </span>
                <p style="margin-left: 20px;font-family: 微软雅黑;">
                添加微信公众号：<span style="color:green;font-weight:bold">雷哥SAT微助手</span>，获取SAT最新信息~
                </p>
                <p style="margin-left: 20px;font-family: 微软雅黑;">
                            <span style="font-weight:bold">注：</span>有问题请咨询题库管理员QQ：2992826058；
                </p>

            <div style="width: 100%;background: #e8e8e8;padding:5px 20px;font-size:12px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;margin-top: 30px;color: #808080;font-family: 微软雅黑;">

            温馨提示：请你注意保护你的邮箱，避免邮件被他人盗用哟！

            </div>

            </div>

            <div style="font-size: 12px;width: 800px;margin: 0 auto;text-align: right;color: #808080;">


        </div>

        '

        );    //发布可以带html标签的文本

        if ($mail->send()) {

            $res['code'] = 0;

            $res['message'] = '邮件发送成功！';

        } else {

            $res['code'] = 1;

            $res['message'] = '邮件发送失败！';

        }

        die(json_encode($res));

    }


    /**
     * 注销账户
     * @return string
     * */

    public function actionLoginOut()
    {
        $session = Yii::$app->session;
        $session->remove('userData');
        if(isset($_SESSION['answer'])){
            $session->remove($_SESSION['answer']);
        }
        $session->remove('userId');
        $loginOut = uc_user_synlogout();
        $session->set('loginOut',$loginOut);
        die(json_encode(['code' => 0]));
    }


    // 练习二级页面接口
    public function actionExerIndex()
    {
        $paper = Yii::$app->db->createCommand("select id,time,name from {{%testpaper}} where name!='测评'")->queryAll();
        $data = array();
        foreach ($paper as $k => $v) {
            $data[$v['name']][] = [
                'id' => $v['id'],
                'name' => $v['name'] . $v['time']
            ];
        }
        $code = 0;
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    //做题详情,有待商榷
    public function actionExerDetails()
    {
        $qid = Yii::$app->request->post('id');
        $tid = Yii::$app->request->post('tid');
        $major = Yii::$app->request->post('major','Reading');
        $uid = Yii::$app->session->get('uid');
        $num = Yii::$app->request->post('num');
//        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        $q = new Questions();
        $data['collection'] = $q->isCollection($uid, $qid);
        if ($qid != false) {
            $data['data'] = Yii::$app->db->createCommand("select q.content,q.analysis,q.answer,q.essayId,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid  from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.id=" . $qid." and qe.num= $num")->queryOne();
            if(isset($_SESSION['answer'])){
                $answerData = ((array)$_SESSION['answer']);
                $data['answer'] =(isset($answerData['item'][$qid])?$answerData['item'][$qid][1]:'');// 获取用户的答题数据
            }
        } else {
            if(isset($_SESSION['answer'])){
                $_SESSION['answer']= array();
            }
            if($major=='Math1'|| $major=='Math2' ){
                $data['data'] = Yii::$app->db->createCommand("select q.content,q.analysis,q.answer,q.essayId,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.number=1 and q.tpId=$tid and major='".$major."' order by q.number asc limit 1 ")->queryOne();
            }else{
                $data['data'] = Yii::$app->db->createCommand("select q.content,q.analysis,q.answer,q.essayId,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where qe.num=$num and q.tpId=$tid and major='".$major."' order by q.number asc limit 1 ")->queryOne();
            }
        }
        $data['n'] = $q->Progress($major, $data['data']['qid'], $data['data']['section'], $data['data']['tpId'], $data['data']['essayId']);
        if($major!='Math1' && $major!='Math2') {
            $data['nextid'] = Yii::$app->db->createCommand("select id from {{%questions}} where number>" . $data['data']['number'] . "  and  tpId=" . $tid . " and major='".$major."' and essayId=" . $data['data']['essayId'] . " order by number asc limit 1")->queryOne()['id'];
            $data['upid'] = Yii::$app->db->createCommand("select id from {{%questions}} where number<" . $data['data']['number'] . "  and   tpId=" . $tid . " and major='".$major."' and essayId=" . $data['data']['essayId'] . " order by number desc limit 1")->queryOne()['id'];
        }else{
            $data['nextid'] = Yii::$app->db->createCommand("select id from {{%questions}} where number>" . $data['data']['number'] . "  and  tpId=" . $tid . " and major='".$major."'  order by number asc limit 1")->queryOne()['id'];
            $data['upid'] = Yii::$app->db->createCommand("select id from {{%questions}} where number<" . $data['data']['number'] . "  and   tpId=" . $tid . " and major='".$major."'  order by number desc limit 1")->queryOne()['id'];
        }
        if ($data == false) {
            $re['code'] = 1;
            $re['msg'] = '没有更多数据了';
            die(json_encode($re));
        } else {
            $code = 0;
        }
        $data['data']['isFilling']=($data['data']['isFilling']==false?false:true);

//        var_dump($data);die;
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 将登陆用户的做题数据存入数据库,练习的上下一题
    public function actionNotes()
    {
        $answer = Yii::$app->request->post('answer');
        $time = Yii::$app->request->post('time');
        $qid = Yii::$app->request->post('qid');
        $pos = Yii::$app->request->post('pos','next');
        $date = time();
        $data['uid'] = Yii::$app->session->get('uid');
        $que = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id,number,section,tpId,major,essayId  from {{%questions}} where id=" . $qid)->queryOne();
        $model = new Questions();
        $re = $model->avg($answer, $time, $que);
        // 将做题的数据存入数据库
        $data['notes'] = $qid . ',' . $answer . ',' . $time . ',' . $date . ';';
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $answer, $time);
        if ($data['uid']) {
            $userData = Yii::$app->session->get('userData');
            uc_user_edit_integral($userData['userName'], 'SAT做题一道', 1, 2);
            $arr = Yii::$app->db->createCommand("select notes,correctRate,count,id,uid from {{%notes}} where uid=" . $data['uid'])->queryOne();
            if (!$arr) {
                $data['count'] = 1;
                $answer == $que['answer'] ? $data['correctRate'] = 100 : $data['correctRate'] = 0;
                $re = Yii::$app->db->createCommand()->insert("{{%notes}}", $data)->execute();
            } else {
                $notes = new Notes();
                $data['count'] = $arr['count'] + 1;
                $arr['correctRate'] == 0 ? $correct = 0 : ($correct = $arr['correctRate'] * $arr['count'] / 100);
                if ($answer == $que['answer']) {
                    $data['correctRate'] = ($correct + 1) / $data['count'] * 100;
                } else {
                    $data['correctRate'] = $correct / $data['count'] * 100;
                }
                $data['notes'] = $arr['notes'] . $qid . ',' . $answer . ',' . $time . ',' . $date . ';';
                $re = $notes->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }
        }
        if ($pos == 'next') {
            if($que['major']=='Math1'||$que['major']=='Math2'){
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " order by q.number asc limit 1 ")->queryOne();
            }else{
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " and essayId=".$que['essayId']." order by q.number asc limit 1 ")->queryOne();
            }
        } else {
            if($que['major']=='Math1'||$que['major']=='Math2'){
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number<" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " order by q.number desc limit 1 ")->queryOne();
            }else {
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number<" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " and essayId=".$que['essayId']." order by q.number desc limit 1 ")->queryOne();
            }
        }
        if ($res == false) {
            $res['code'] =1;
            $res['msg'] = '请求错误!';
            die(json_encode($res));
        }
        if($res['data']['major']=='Math1'||$res['data']['major']=='Math2'){
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " order by q.number asc limit 1 ")->queryOne()['qid']!=false)?$res['nextId']=true:$res['nextId']=false;
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " order by q.number desc limit 1 ")->queryOne()['qid']!=false)?$res['upId']=true:$res['upId']=false;
        }else{
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " and essayId=".$res['data']['essayId']." order by q.number asc limit 1 ")->queryOne()['qid']!=false)?$res['nextId']=true:$res['nextId']=false;
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " and essayId=".$res['data']['essayId']." order by q.number desc limit 1 ")->queryOne()['qid']!=false)?$res['upId']=true:$res['upId']=false;
        }
        if(isset($_SESSION['answer'])){
            $answerData = ((array)$_SESSION['answer']);
            $res['userans'] =(isset($answerData['item'][$res['qid']])?$answerData['item'][$res['qid']][1]:'');// 获取用户的答题数据
        }
        $res['n'] = $model->Progress($res['data']['major'], $res['data']['qid'], $res['data']['section'], $res['data']['tpId'], $res['data']['essayId']);
        $res['collection'] = $model ->isCollection($data['uid'], $res['qid']);
        $code= 0;
        $res['data']['isFilling']=($res['data']['isFilling']==false?false:true);
        die(json_encode(['data' => $res,'code'=>$code]));
    }

    // 练习的结果页面
    public function actionResult()
    {
        session_start();
        $answerData = ((array)$_SESSION['answer']);
        $answerData =$answerData['item'];// 获取用户的答题数据
        // var_dump($answerData);
        static $que = array();
        // 获取做题的数据
        foreach ($answerData as $k => $v) {
            $s = Yii::$app->db->createCommand("select id,answer,section,number from {{%questions}} where id=$k")->queryOne();
            if ($answerData[$k][1] == $s['answer']) {
                $que[$s['number']][0] = 1;
                $que[$s['number']][1] = $s['id'];
            } else {
                $que[$s['number']][0] = 0;
                $que[$s['number']][1] = $s['id'];
            }
        }
        if($que==false){
            $re['code']=1;
            $re['msg']='无做题数据';
            die(json_encode($re));
        }
        die(json_encode(['que'=>$que,'code'=>0])) ;
    }

    // 收藏题目与取消收藏
    public function actionCollection()
    {
        $data['qid'] = (string)Yii::$app->request->post('qid', '');
        $data['uid'] = Yii::$app->session->get('uid', '');
        $flag = Yii::$app->request->post('flag');// 是否收藏
        $model = new Collection();
        // 查找 uid 是否存在
        $arr = Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=" . $data['uid'])->queryOne();
        if ($flag == 0) {
            $data['qid'] = ',' . $data['qid'];
            if (!$arr) {
                $re = Yii::$app->db->createCommand()->insert("{{%collection}}", $data)->execute();
            } else {
                $data['qid'] = $arr['qid'] . $data['qid'];
                $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }
            if ($re) {
                $res['message'] = '收藏成功';
                $res['code'] = 0;
            } else {
                $res['message'] = '收藏失败';
                $res['code'] = 1;
            }
            die(json_encode($res));
        } elseif ($flag == 1) {
            // 查找',qid,'存在再替换
            $qids = explode(',', $arr['qid']);
            foreach ($qids as $k => $v) {
                if ($v == $data['qid']) {
                    unset($qids[$k]);
                    break;
                }
            }
            $data['qid'] = implode(',', $qids);
            $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            if ($re) {
                $res['message'] = '取消成功';
                $res['code'] = 0;
            } else {
                $res['message'] = '取消失败';
                $res['code'] = 2;
            }
            die(json_encode($res));
        }
    }

    // 模考二级页面
    public function actionMockIndex()
    {
        $paper = Yii::$app->db->createCommand("select id,time,name  from {{%testpaper}} where name!='测评'")->queryAll();
        $data = array();
        foreach ($paper as $k => $v) {
            $data[$v['name']][] = [
                'tid' => $v['id'],
                'name' => $v['name'] . $v['time']
            ];
        }
        $code = 0;
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 模考通知页面
    public function actionMockNotice()
    {
        $tid = Yii::$app->request->post('tid');
        $major = Yii::$app->request->post('major', '');
        $uid = Yii::$app->session->get('userid', '');
//        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        $data['Reading']['count'] = 52;
        $data['Reading']['time'] = 65;
        $data['Writing']['count'] = 44;
        $data['Writing']['time'] = 35;
        $data['total']['count'] = 154;
        $data['total']['time'] = 180;
        $data['Math']['count'] = 58;
        $data['Math']['time'] = 80;
        if ($major == false) {
            die(json_encode(['data' => $data, 'tid' => $tid, 'major' => $major, 'code' => 0]));
        } else {
            $arr = array("$major" => $data["$major"], 'total' => $data["$major"]);
            die(json_encode(['data' => $arr, 'tid' => $tid, 'major' => $major, 'code' => 0]));
        }
    }

    // 模考详情页
    public function actionMockDetails()
    {
        $tid = Yii::$app->request->post('tid');
        $major = Yii::$app->request->post('major', '');// 如果为单科模考
        if (!is_numeric($tid)) {
            $re['msg'] = '请求错误！';
            $re['code'] = 1;
            die(json_encode($re));
        }
        if ($major != false) {
            if ($major == 'Math') {
                $major = '(major="Math1" or major="Math2")';
                $where = "where tpId=" . $tid . " and $major";
            } else {
                $where = "where tpId=" . $tid . " and major='$major'";
            }
            $section = Yii::$app->db->createCommand("select section from {{%questions}} $where order by section asc limit 1")->queryOne()['section'];
            if ($section == false) {
                $re['msg'] = '题目正在更新中！';
                $re['code'] = 2;
                die(json_encode($re));
            }
        } else {
            $section = 1;
        }
        $data['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $section . "  and q.number=1 and tpId=$tid")->queryOne();
        if ($data == false) {
            $re['msg'] = '题目正在更新中！';
            $re['code'] = 2;
            die(json_encode($re));
        }
        if ($data['data']['major'] == 'Math1') {
            $data['time'] = 55;
            $data['count'] = 38;
        } elseif ($data['data']['major'] == 'Math2') {
            $data['time'] = 25;
            $data['count'] = 20;
        } elseif ($data['data']['major'] == 'Reading') {
            $data['time'] = 65;
            $data['count'] = 52;
        } else {
            $data['time'] = 35;
            $data['count'] = 44;
        }
        $data['data']['isFilling']=($data['data']['isFilling']==false?false:true);
        $code = 0;
        $data['isFilling']=($data['isFilling']==false?false:true);
//        die(json_encode(['data' => $data, 'count' => $data['count'], 'time' => $data['time'], 'code' => $code]));
        die(json_encode(['data' => $data,'code' => $code]));
    }

    // 保存答案，下一题
    public function actionMockNext()
    {
        $answer = Yii::$app->request->post('answer',"a");// 用户提交的答案
        $major = Yii::$app->request->post('major', '');// 全科时不传
        $tid = Yii::$app->request->post('tid',1);
        $qid = Yii::$app->request->post('qid',3);
        $uid = Yii::$app->session->get('uid', '');
        $utime = Yii::$app->request->post('utime',3);
        $number = Yii::$app->request->post('number',1);
        $section = Yii::$app->request->post('section',1);
        session_start();
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $answer, $utime);
        // 正确率等的计算
        $model = new Questions();
        $data = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id from {{%questions}} where id=" . $qid)->queryOne();
        $re = $model->avg($answer, $utime, $data);
        $_SESSION['uid'] = $uid;
        $_SESSION['tid'] = $tid;
        $now['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        if ($now['data'] == false) {
            $re['code'] = 1;
            $re['msg'] = "题目正在更新中....";
            die(json_encode($re));
        } else {
            $now['nextId'] = Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $now['data']['number'] . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne()['qid'];
            if($major=='Reading'||$major=='Writing'){
                $now['nextSection']=false;
            }elseif($major=='Math'||$major==''){
                if($now['data']['major']=='Math2'){
                    $now['nextSection']=false;
                }else{
                    $now['nextSection'] = Yii::$app->db->createCommand("select section from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where  tpId=" . $tid . " and section>'$section' order by q.section asc limit 1 ")->queryOne()['section'];
                }
            }
            if ($major == 'Math1') {
                $data['time'] = 55;
                $data['num'] = 38;
            } elseif ($major == 'Math2') {
                $data['time'] = 25;
                $data['num']= 20;
            } elseif ($major == 'Reading') {
                $data['time'] = 65;
                $data['num'] = 52;
            } elseif ($major == 'Writing') {
                $data['time'] = 35;
                $data['num']= 44;
            } else {
                $data['time'] = 180;
                $data['num'] = 154;
            }
            $code = 0;
            $now['data']['isFilling']=($now['data']['isFilling']==false?false:true);
            echo die(json_encode(['data' => $now, 'code' => $code]));
        }

    }

    // 中途离开
    public function actionLeave()
    {
        $a = KeepAnswer::getCat();
        $re = $a->Emptyitem();
        echo die(json_encode($re));
    }

//    // 提交当前小节，进入下一小节
//    public function actionSection()
//    {
//        $section = Yii::$app->request->post('section')+1;
////        $count   = Yii::$app->request->post('allPos');// 做题总数,可能不需要
//        $major    = Yii::$app->request->post('major','');// 全科时不传，单科目时传
//        $tid     = Yii::$app->request->post('tpId');
//        $qid     = Yii::$app->request->post('qid');
//        $utime   = Yii::$app->request->post('utime');// 每题的做题时间
//        $time    = Yii::$app->request->post('allTime');// 做题总时间
//        $answer= Yii::$app->request->post('answer');// 用户提交的答案
//        Yii::$app->session->set('time',$time);
//        $a       = KeepAnswer::getCat();
//        $re      = $a->addPro($qid, $answer,$utime);// 将答案保存到session里
//        // 正确率等的计算
//        $model   =new Questions();
//        $arr    = Yii::$app->db->createCommand("select notes,correctRate,count,id,uid from {{%questions}} where id=" . $qid)->queryOne();
//        $re      =$model->avg($answer,$utime,$arr);
//        // 根据数据判断是否是最后一题
//        if($major=='Reading'||$major=='Writing'){
//            $arr['isfinal']=true;
//        }elseif($major=='Math'||$major==''){
//            if($arr['major']=='Math2'){
//                $arr['isfinal']=true;
//            }else{
//                $arr['isfinal']=false;
//            }
//        }
//        if(!$arr['isfanil']){
//            $data= Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number=1 and tpId=" . $tid . " and section='$section' limit 1 ")->queryOne();
//            $data['code']=0;
//        }else{
//            $data['code']=1;
//            $data['msg']='本试卷已全部答完';
//        }
//        die(json_encode($data));
//    }

    // 模考报告页面, 可能有问题
    public function actionMockReport()
    {
        // 生成报告页面
        //个人中心页面
        //登录状态直接点击‘报告’
        // 将session 的数据存到数据库有uid的情况下，无uid的情况下只生成报告页面
        $uid = Yii::$app->session->get('uid');
        $user = Yii::$app->session->get('userData');
        $major = Yii::$app->session->get('part');
        $id = Yii::$app->request->post('id', '');// 个人中心才传参,报告的id
        if ($id == false) {
            if (isset($_SESSION['answer']) && isset($_SESSION['tid'])) {
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
                $re['part'] = ($major == false) ? 'all' : "$major";
                $re['uid'] = $uid;
                $re['mathnum'] = $number['Math'];
                $re['writenum'] = $number['Writing'];
                $re['matherror'] = $number['matherror'];
                $re['readerror'] = $number['readerror'];
                $re['writeerror'] = $number['writeerror'];
                $re['subScore'] = $subscore['total'];
                $re['crossScore'] = $crosstest['total'];
                $re['date'] = time();
                $re['time'] = Yii::$app->session->get('time');// 做题总时间
                ($re['part'] == 'all') ? ($re['score'] = $score['total']) : ($re['score'] = $score["$major"]);
                if ($uid) {
                    // 将答案组合成字符串
                    $format = new Format();
                    $re['answer'] = $format->arrToStr($answerData);
                    if ($re['answer'] != false && $re['time'] != false) {
                        $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                        if ($res) {
                            unset($_SESSION['answer']);
                            unset($_SESSION['tid']);
                        }//入库完成
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
                    if (Yii::$app->db->createCommand("select id from {{%report}} where uid=" . $uid)->queryAll()) {
                        $report = new Report();
                        $res = $report->Show($uid , $id);
                        $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                        $tp = array_reverse($tp);
                    } else {
                        $res['message'] = '还没有报告，赶紧做套模考题吧！';
                        $res['code'] = 1;
                        die(json_encode($res));
                    }
                } else {
                    $res['message'] = '未登录，无法查看数据！';
                    $res['code'] = 2;
                    die(json_encode($res));
                }
            }
        } else {
            if ($uid) {
                $report = new Report();
                $res = $report->Show($uid,$id);
                $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                $tp = array_reverse($tp);
            } else {
                $res['message'] = '未登录，无法查看数据！';
                $res['code'] = 2;
                die(json_encode($res));
            }

        }
        die(json_encode(['report' => $res, 'tp' => $tp, 'user' => $user]));
    }

    public function Question($tid, $answer)
    {
        $s = Yii::$app->db->createCommand("select id,answer,section from {{%questions}} where tpId=$tid limit 100")->queryAll();
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
    public function actionEvaulationIndex()
    {
        $paper = Yii::$app->db->createCommand("select id,time,name  from {{%testpaper}} where name like '%测评%' limit 3")->queryAll();
        $data = array();
        foreach ($paper as $k => $v) {
            $data[$v['name']][] = [
                'tid' => $v['id'],
                'name' => $v['name'] . $v['time']
            ];
        }
        $code = 0;
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 测评通知页面
    public function actionEvaulationNotice()
    {
        $tid= Yii::$app->request->post('tid');
        $data['evaulation']= true;
        if (isset($_SESSION['answer'])) {
            unset($_SESSION['answer']);
        }
        if (isset($_SESSION['tid'])) {
            unset($_SESSION['tid']);
        }
        $code=0;
        die(json_encode(['tid'=>$tid,'code'=>$code,'data'=>$data]));
    }

    // 测评详情
    public function actionEvaulationTest()
    {
        $tid = Yii::$app->request->post('tid');
//        $number=Yii::$app->request->post('number',1);
//        $section = Yii::$app->request->post('section', 1);
        $data = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=1  and tpId=$tid order by q.number limit 1")->queryAll();
        if ($data == false) {
            $re['code'] = 1;
            $re['mmessage'] = '题目正在更新中，换一套题吧！';
            die(json_encode($re));
        }
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 测评的下一题及下一小节
    public function actionEvaulationNext()
    {
        $solution = Yii::$app->request->post('solution');// 用户提交的答案
        $major = Yii::$app->request->post('major');// 学科
        $tid = Yii::$app->request->post('tid');
        $qid = Yii::$app->request->post('qid');
        $uid = Yii::$app->request->post('uid');
        $utime = Yii::$app->request->post('utime');
        $number = Yii::$app->request->post('number');
        $section = Yii::$app->request->post('section');
        session_start();
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $solution, $utime);//保存做题数据
        $model = new Questions();
        $data = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id from {{%questions}} where id=" . $qid)->queryOne();
        $re = $model->avg($solution, $utime, $data);
        $_SESSION['uid'] = $uid;
        $_SESSION['tid'] = $tid;
        $now['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        if ($now['data'] == false) {
            $res['message'] = '题目正在更新中！';
            $res['code'] = 1;
            die(json_encode($res));
        }
        $now['nextId'] = Yii::$app->db->createCommand("select q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $now['data']['number'] . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne()['qid'];
        $now['nextSection'] = Yii::$app->db->createCommand("select q.section from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $now['number'] . " and tpId=" . $tid . " and section='$section' order by q.number asc limit 1 ")->queryOne()['section'];
        echo die(json_encode(['now' => $now, 'code' => 0]));
    }

    // 测评生成报告
    public function actionEvaulationReport()
    {
        $id = Yii::$app->request->post('id', '');
        $uid = Yii::$app->session->get('uid', '');
        if ($id == false) {
            if (isset($_SESSION['answer']) && isset($_SESSION['tid'])) {
                $data = ((array)$_SESSION['answer']);
                $data = $data['item'];// 获取用户的答题数据
                $getScore = new GetScore();
                $number = $getScore->number($data);
                $re['tpId'] = $_SESSION['tid'];
                $re['readnum'] = $number['Reading'];
                $re['mathnum'] = $number['Math'];
                $re['writenum'] = $number['Writing'];
                $re['jumpnum'] = $number['Vocabulary'];// jumpnum字段来保存词汇正确个数
                $re['part'] = Yii::$app->db->createCommand("select name from {{%testpaper}} where id=" . $re['tpId'])->queryOne()['name'] . Yii::$app->db->createCommand("select time from {{%testpaper}} where id=" . $re['tpId'])->queryOne()['time'];
                $re['uid'] = Yii::$app->session->get('uid');
                $re['matherror'] = $number['matherror'];
                $re['readerror'] = $number['readerror'];
                $re['writeerror'] = $number['writeerror'];
                $re['score'] = $this->actionScore($data) + $number['Math'] * 3 + $number['Reading'] * (30 / ($number['Reading'] + $number['readerror'])) + $number['Writing'] * 2 + $number['Vocabulary'];
                $re['date'] = time();
                $re['time'] = Yii::$app->session->get('time');// 做题总时间
                if ($uid) {
                    // 将答案组合成字符串
                    $format = new Format();
                    $re['answer'] = $format->arrToStr($data);
                    if ($re['answer'] != false && $re['time'] != false) {
                        $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                        if ($res) {
                            unset($_SESSION['answer']);
                            unset($_SESSION['tid']);
                        }//入库完成
                    }
                    $res = $this->Show('');
                } else {
                    $res['code'] = 2;
                    $res['message'] = '未登录，无法查看报告';
                    die(json_encode($res));
                }

            } else {
                if ($uid) {
                    $res = $this->Show('');
                } else {
                    $res['code'] = 2;
                    $res['message'] = '未登录，无法查看报告';
                    die(json_encode($res));
                }
            }

        } else {
            $res = $this->Show($id);
        }
        if ($res == false) {
            $res['code'] = 1;
            $res['message'] = '没有评测报告';
            die(json_encode($res));
        } else {
            $data = $res;
            $data['code'] = 0;
            $data['que'] = $this->actionQuestion($data['report']['tpId'], $res['report']['answer']);
            $data['win'] = count(Yii::$app->db->createCommand("select id from {{%report}} where part='" . $data['report']['part'] . "' and score<" . $data['report']['score'])->queryOne());
        }
        die(json_encode(['data' => $data]));
    }

    // 获取测评的分数
    public function actionScore($data)
    {
        $translation = Yii::$app->db->createCommand("select id,answer from {{%questions}} where  major='Translation' and tpId=" . Yii::$app->session->get('tid'))->queryAll();
        $count = 0;
        $trans = 0;
        foreach ($translation as $k => $v) {
            $answer = explode(',', $v['answer']);
            foreach ($answer as $key => $val) {
                if (strpos($val, $data[$v['id']][1]) !== false) {
                    $count += 1;
                }
            }
            $trans += ($count >= 6 ? 3 : ($count > 4 ? 2 : 1));
        }
        return $trans;
    }

    // 报告数据
    public function Show($id = '')
    {
        $uid = Yii::$app->session->get('uid');
        if ($id == false) {
            $data = Yii::$app->db->createCommand("select answer,id,mathnum,jumpnum,writenum,readnum,readerror,,jumpunm,writeerror,matherror,score,tpId,subScore,crosstestScores,time,part from {{%report}} where uid=" . $uid . " order by id desc limit 1")->queryOne();
        } else {
            $data = Yii::$app->db->createCommand("select answer,id,mathnum,jumpnum,writenum,readnum,readerror,jumpnum.writeerror,matherror,score,tpId,subScore,crosstestScores,time,part from {{%report}} where id=" . $id)->queryOne();
        }
        if ($data) {
            $re['Math'] = $data['mathnum'] * 3;
            $re['Reading'] = $data['readnum'] * (30 / ($data['readerror'] + $data['readnum']));
            $re['Writing'] = $data['writenum'] * 2;
            $re['Vocabulary'] = $data['jumpnum'];
            $re['Translation'] = $data['score'] - $re['Math'] - $re['Reading'] - $re['Writing'] - $re['Vocabulary'];
            $re['score'] = $data['score'];
            $suggest = $this->Suggest($data['tpId'], $re);
            $report['score'] = $re;
            $report['suggest'] = $suggest;
            $report['report'] = $data;
            return $report;
        } else {
            $re['message'] = '没有测评报告';
            $re['code'] = 1;
            return $re;
        }
    }

    // 给出的复习建议
    public function Suggest($tid, $re)
    {
        $data = Yii::$app->db->createCommand("select id,time,name from {{%testpaper}} where id=" . $tid)->queryOne();
        if ($data['time'] == '初级卷') {
            $models = "Ping01";
        } elseif ($data['time'] == '中级卷') {
            $models = "Ping02";
        } elseif ($data['time'] == '高级卷') {
            $models = "Ping03";
        }
        $suggest['Reading'] = Yii::$app->db->createCommand("select major,suggestion from {{%tactics}} where max>" . $re['Reading'] . "  and min<" . $re['Reading'] . " and major='" . $models . "-Reading'")->queryOne();
        $suggest['Writing'] = Yii::$app->db->createCommand("select major,suggestion from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Writing'")->queryOne();
        $suggest['Math'] = Yii::$app->db->createCommand("select major,suggestion from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Math'")->queryOne();
        $suggest['Vocabulary'] = Yii::$app->db->createCommand("select major,suggestion from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Vocabulary'")->queryOne();
        $suggest['Translation'] = Yii::$app->db->createCommand("select major,suggestion from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Translation'")->queryOne();
        $suggest['All'] = Yii::$app->db->createCommand("select major,suggestion from {{%tactics}} where max>" . $re['score'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-All'")->queryOne();
        return $suggest;
    }

    // 具体题目
    public function actionQuestion($tid, $answer)
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

    // 个人中心收藏页面
    public function actionPensonCollect()
    {
        $uid = Yii::$app->session->get('uid');
        $source = Yii::$app->request->post('source');
        $p = Yii::$app->request->post('p', '1');
        $major = Yii::$app->request->post('major');
        $model = new collection();
        $pagesize = 15;
        $offset = $pagesize * ($p - 1);
        $data = $model->CollectionDate($source, $uid, $major, $offset, $pagesize);
        $data['curPage'] = $p;
        echo die(json_encode($data));
    }

    // 个人中心练习题目
    public function actionPersonExercise()
    {
        $uid = Yii::$app->session->get('uid');
        $source = Yii::$app->request->post('source');
        $major = Yii::$app->request->post('major');
        $error = Yii::$app->request->post('case');
        $p = Yii::$app->request->post('p', '1');
        $pagesize = 15;
        $offset = $pagesize * ($p - 1);
        $notes = new Notes();
        $arr = $notes->Ex($uid, $source, $major, $error, $offset, $pagesize, $p);
        $arr['totalPage'] = ceil($arr['total'] / $pagesize);// 总页数
        $arr['curPage'] = $p;
        $arr['pageSize'] = $pagesize;
        echo die(json_encode($arr));
    }

    // 个人中心模考记录
    public function actionPersonMock()
    {
        $uid = Yii::$app->session->get('uid');
        $source = Yii::$app->request->post('source');
        $type = Yii::$app->request->post('major');
        $arr['curPage'] = $p = Yii::$app->request->post('p', '1');
        $arr['pageSize'] = $pagesize = 15;
        if ($source != 'all') {
            $name = "and name='$source'";
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

    // 删除报告
    public function actionDel()
    {
        $id = Yii::$app->request->post('id');
        $re = Report::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            $res['code'] = 0;
            $res['msg'] = '删除成功';
        } else {
            $res['code'] = 1;
            $res['msg'] = '删除失败';
        }
        echo die(json_encode($res));
    }

    // 删除做题记录
    public function actionRemoved()
    {
        $uid = Yii::$app->session->get('uid');
        $id = Yii::$app->request->post('id');
        $arr = Yii::$app->db->createCommand("select id,notes,uid from {{%notes}} where uid=" . $uid)->queryOne();
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
    // 获取用户积分
    public function actionGetIntegral()
    {
        $session = Yii::$app->session;
        $uid = $session->get('uid');
        if (!$uid) {
            $re['code'] = 1;
            $re  ['msg']= '未登录';
            die(json_encode($re));
        }
        $userData = $session->get('userData');
        $data = uc_user_integral($userData['username']);
        if (!is_array($data['details'])) {
            $data['details'] = [];
        }
        foreach ($data['details'] as $k => $v) {
            $data['details'][$k]['createTime'] = date('Y-m-d', $v['createTime']);
        }
        die(json_encode(['data'=>$data,'code'=>0]));
    }

    // 测评记录
    public function actionEval()
    {
//        $cate = Yii::$app->request->post('cate');
        $uid = Yii::$app->session->get('uid');
        $arr['curPage'] = $p = Yii::$app->request->post('p', '1');
        $arr['pageSize'] = $pagesize = 15;
        $offset = $pagesize * ($p - 1);
        $data = Yii::$app->db->createCommand("select r.*,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=" . $uid . " and part like '%测评%' limit $offset,$pagesize")->queryAll();
        $arr['total'] = count(Yii::$app->db->createCommand("select r.*,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=" . $uid . " and part like '%测评%'")->queryAll());
        $arr['totalPage'] = ceil($arr['total'] / $pagesize);// 总页数
        $model = new Format();
        foreach ($data as $k => $v) {
            $arr['list'][] = array(
                'part' => $v['part'],
                'id' => $v['id'],
                'tpId' => $v['tpId'],
                'name' => $v['name'],
                'time' => $v['time'],
                'score' => $v['score'],
                'mathnum' => $v['mathnum'],
                'readnum' => $v['readnum'],
                'writenum' => $v['writenum'],
                'date' => $v['date'],
                'rtime' => $model->FormatTime($v['rtime']),
            );
        }
        die(json_encode($arr));
    }


}