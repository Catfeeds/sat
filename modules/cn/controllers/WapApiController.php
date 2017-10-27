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

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
$allow_origin = array(
    'http://www.yii.com',
    'http://localhost:8080'
);
if (in_array($origin, $allow_origin)) {
    header("Access-Control-Allow-Origin:$origin");
}
header('Access-Control-Allow-Headers: X-Requested-With, accept, content-type, xxxx');
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
Header("Access-Control-Allow-Credentials: true");

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
            $userName = $apps->post('userName');
            $userPass = $apps->post('pass');
            if (!$userName) {
                $re['code'] = 1;
                $re['message'] = '请输入用户名';
                die(json_encode($re));
            }

            $userPass = md5($userPass);
            list($uid, $username, $password, $email, $merge, $phone) = uc_user_login($userName, $userPass);
            if ($uid < 0) {
                list($uid, $username, $password, $email, $merge, $phone) = uc_user_login($userName, $userPass, 2);
                if ($uid < 0) {
                    list($uid, $username, $password, $email, $merge, $phone) = uc_user_login($userName, $userPass, 3);
                }
            }
            $str = substr($password, 1);
            $str = '_@5!' . $str . "*a1";
            if ($uid > 0) {
                $success_content = uc_user_synlogin($uid);
                $loginsdata = $logins->find()->where("(phone='$userName' or username='$userName' or email='$userName')")->one();
                if (empty($loginsdata['id'])) {
                    $login = new Login();
                    $login->phone = $phone;
                    $login->password = md5($str);
                    $login->email = $email;
                    $login->createTime = time();
                    $login->username = $username;
                    $login->uid = $uid;
                    $login->save();
                    $loginsdata = $logins->find()->where("(phone='$userName' or username='$userName' or email='$userName')")->one();
                } else {
                    if ($phone != $loginsdata['phone']) {
                        Login::updateAll(['phone' => $phone], "id={$loginsdata['id']}");
                    }
                    if ($email != $loginsdata['email']) {
                        Login::updateAll(['email' => "$email"], "id={$loginsdata['id']}");
                    }
                    if ($username != $loginsdata['username']) {
                        Login::updateAll(['username' => "$username"], "id={$loginsdata['id']}");
                    }
                    if ($uid != $loginsdata['uid']) {
                        Login::updateAll(['uid' => "$uid"], "id={$loginsdata['id']}");
                    }
                    $loginsdata = $logins->find()->where("id={$loginsdata['id']}")->one();
                }
                $session->set('userId', $loginsdata['id']);
//                $userLevel = Yii::$app->params['userLevel'];  // 用户等级
                $session->set('userData', $loginsdata);
                $re['code'] = 0;
                $re['message'] = '登录成功';
                $session->set('success_content', $success_content);
            } elseif ($uid == -1) {
                $re['code'] = 1;
                $re['message'] = '用户名或密码错误';
            } elseif ($uid == -2) {
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
        $phone = Yii::$app->request->post('phone');
        if (!empty($phone)) {
            $phoneCode = mt_rand(100000, 999999);
            $session->set($phone . 'phoneCode', $phoneCode);
            $session->set('phoneTime', time());
            $content = '【雷哥SAT】验证码：' . $phoneCode . '（10分钟有效），您正在通过手机注册雷哥网免费会员！关注微信:雷哥SAT微助手，获取更多信息；若有SAT题库和课程问题，请咨询管理员QQ:2992826058。';
            $sms->send($phone, $content, $ext = '', $stime = '', $rrid = '');
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
        $verificationCode = Yii::$app->request->post('verificationCode');
        $type = Yii::$app->request->post('type');// 手机注册为1 ，邮箱注册为2
        $source = Yii::$app->request->post('source', 'SATwap');
        $userName = Yii::$app->request->post('userName', '');
        if ($userName == '') {
            $userName = 'lgw' . time();
        }
        $checkTime = $login->checkTime();
        if ($checkTime) {
            $checkCode = $login->checkCode($registerStr, $verificationCode);
            if ($checkCode) {
                if ($type == 1) {
                    $login->phone = $registerStr;
                    $str = substr($pass, 1);
                    $str = '_@5!' . $str . "*a1";
                    $login->password = md5($str);
                    $login->createTime = time();
                    $login->username = $userName;
                    $uid = uc_user_register($userName, md5($pass), '', $registerStr, $source, time());
                } else {
                    $login->email = $registerStr;
                    $str = substr($pass, 1);
                    $str = '_@5!' . $str . "*a1";
                    $login->password = md5($str);
                    $login->createTime = time();
                    $login->username = $userName;
                    $uid = uc_user_register($userName, md5($pass), $registerStr, '', $source, time());
                }
                if ($uid < 0) {
                    if ($uid == -1) {
                        $res['code'] = 1;
                        $res['message'] = '用户名已经被注册';
                    } elseif ($uid == -2) {
                        $res['code'] = 1;
                        $res['message'] = '包含不允许注册的词语';
                    } elseif ($uid == -3) {
                        $res['code'] = 1;
                        $res['message'] = '用户名已经存在';
                    } elseif ($uid == -4) {
                        $res['code'] = 1;
                        $res['message'] = 'Email 格式有误';
                    } elseif ($uid == -5) {
                        $res['code'] = 1;
                        $res['message'] = 'Email 不允许注册';
                    } elseif ($uid == -6) {
                        $res['code'] = 1;
                        $res['message'] = '该 Email 已经被注册';
                    } elseif ($uid == -7) {
                        $res['code'] = 1;
                        $res['message'] = '电话已被注册';
                    }
                } else {
                    $login->uid = $uid;
                    $re = $login->save();
                    if ($re) {
                        $res['code'] = 0;
                        $res['message'] = '注册成功';
                        uc_user_edit_integral($userName, '注册成功', 1, 10);
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
        if (isset($_SESSION['answer'])) {
            $session->remove($_SESSION['answer']);
        }
        $session->remove('userId');
        $loginOut = uc_user_synlogout();
        $session->set('loginOut', $loginOut);
        die(json_encode(['code' => 0]));
    }

    /**
     * 找回密码
     * @return string
     * */

    public function actionFindPass()
    {
        $login = new Login();
        $registerStr = Yii::$app->request->post('registerStr');
        $pass = Yii::$app->request->post('pass');
        $verificationCode = Yii::$app->request->post('verificationCode');
        $type = Yii::$app->request->post('type');// 邮箱还是电话，1是电话，2或其他事邮箱
        $re = $login->find()->where("phone='$registerStr' or email='$registerStr'")->one();
        $userData = [1 => $re->username];
        if (!$re) {
            if ($type == 1) {
                $status = uc_user_checkphone($registerStr);
                if ($status) {
                    $userData = uc_get_user($registerStr, 2);
                    $login->username = $userData[1];
                    $login->email = $userData[2];
                    $login->phone = $userData[3];
                    $login->createTime = time();
                    $login->save();
                } else {
                    $res['code'] = 2;
                    $res['message'] = '此电话还没有注册！';
                    die(json_encode($res));
                }
            } else {
                $status = uc_user_checkemail($registerStr);
                if ($status) {
                    $userData = uc_get_user($registerStr, 3);
                    $login->username = $userData[1];
                    $login->email = $userData[2];
                    $login->phone = $userData[3];
                    $login->createTime = time();
                    $login->save();
                } else {
                    $res['code'] = 2;
                    $res['message'] = '此邮箱还没有注册！';
                    die(json_encode($res));
                }
            }
        }
        $checkTime = $login->checkTime();
        if ($checkTime) {
            $checkCode = $login->checkCode($registerStr, $verificationCode);
            if ($checkCode) {
                $str = substr($pass, 1);
                $str = '_@5!' . $str . "*a1";
                if ($type == 1) {
                    $re = $login->updateAll(['userPass' => md5($str)], "phone='$registerStr'");
                } else {
                    $re = $login->updateAll(['userPass' => md5($str)], "email='$registerStr'");
                }
                if ($re) {
                    uc_user_edit($userData[1], '', $pass, '', '', 1);
                    $res['code'] = 0;
                    $res['message'] = '密码找回成功';
                } else {
                    $res['code'] = 3;
                    $res['message'] = '找回失败，请重试';
                    $res['type'] = '3';
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

    // 练习二级页面接口
    public function actionExerIndex()
    {
        $paper = Yii::$app->db->createCommand("select id,time,name from {{%testpaper}} where name!='测评'")->queryAll();
        $data = array();
        foreach ($paper as $k => $v) {
            $data[$v['name']][] = [
                'tpId' => $v['id'],
                'name' => $v['name'] . $v['time']
            ];
        }
        $code = 0;
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    //做题详情,有待商榷
    public function actionExerDetails()
    {
        $qid = Yii::$app->request->post('qid');
        $tpId = Yii::$app->request->post('tpId');
        $major = Yii::$app->request->post('major', 'Reading');
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
            $data['data'] = Yii::$app->db->createCommand("select q.content,q.analysis,q.answer,q.essayId,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tpId  from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.id=" . $qid)->queryOne();
            $answerData = isset($_SESSION['answer']) ? (array)$_SESSION['answer'] : '';
            if (isset($answerData['item'][$qid])) {
                $data['userans'] = (isset($answerData['item'][$qid]) ? $answerData['item'][$qid][1] : '');// 获取用户的答题数据
            } else {
                $question = new Questions();
                $data['userans'] = $question->details($qid, $data['data']['tpId'], $major);
            }
        } else {
            if (isset($_SESSION['answer'])) {
                $_SESSION['answer'] = array();
            }
            if ($major == 'Math1' || $major == 'Math2') {
                $data['data'] = Yii::$app->db->createCommand("select q.content,q.analysis,q.answer,q.essayId,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tpId from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.number=1 and q.tpId=$tpId and major='" . $major . "' order by q.number asc limit 1 ")->queryOne();
            } else {
                $data['data'] = Yii::$app->db->createCommand("select q.content,q.analysis,q.answer,q.essayId,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tpId from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where qe.num=$num and q.tpId=$tpId and major='" . $major . "' order by q.number asc limit 1 ")->queryOne();
            }
        }
        $data['n'] = $q->Progress($data['data']['major'], $data['data']['qid'], $data['data']['section'], $data['data']['tpId'], $data['data']['essayId']);
        if ($data['data']['major'] == 'Reading' || $data['data']['major'] == 'Writing') {
            $data['nextId'] = Yii::$app->db->createCommand("select id from {{%questions}} where number>" . $data['data']['number'] . "  and  tpId=" . $data['data']['tpId'] . " and major='" . $data['data']['major'] . "' and essayId=" . $data['data']['essayId'] . " order by number asc limit 1")->queryOne()['id'];
            $data['upId'] = Yii::$app->db->createCommand("select id from {{%questions}} where number<" . $data['data']['number'] . "  and   tpId=" . $data['data']['tpId'] . " and major='" . $data['data']['major'] . "' and essayId=" . $data['data']['essayId'] . " order by number desc limit 1")->queryOne()['id'];
        } else {
            $data['nextId'] = Yii::$app->db->createCommand("select id from {{%questions}} where number>" . $data['data']['number'] . "  and  tpId=" . $data['data']['tpId'] . " and major='" . $data['data']['major'] . "'  order by number asc limit 1")->queryOne()['id'];
            $data['upId'] = Yii::$app->db->createCommand("select id from {{%questions}} where number<" . $data['data']['number'] . "  and   tpId=" . $data['data']['tpId'] . " and major='" . $data['data']['major'] . "'  order by number desc limit 1")->queryOne()['id'];
        }

        if ($data == false) {
            $re['code'] = 1;
            $re['msg'] = '没有更多数据了';
            die(json_encode($re));
        } else {
            $code = 0;
        }
        $data['data']['isFilling'] = ($data['data']['isFilling'] == false ? false : true);
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 将登陆用户的做题数据存入数据库,练习的上下一题
    public function actionNotes()
    {
        $answer = Yii::$app->request->post('answer');
        $uesrTime = Yii::$app->request->post('userTime');
        $qid = Yii::$app->request->post('qid');
        $pos = Yii::$app->request->post('pos', 'next');
        $date = time();
        $data['uid'] = Yii::$app->session->get('uid');
        $que = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id,number,section,tpId,major,essayId  from {{%questions}} where id=" . $qid)->queryOne();
        $model = new Questions();
        $re = $model->avg($answer, $uesrTime, $que);
        // 将做题的数据存入数据库
        $data['notes'] = $qid . ',' . $answer . ',' . $uesrTime . ',' . $date . ';';
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $answer, $uesrTime);
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
                $data['notes'] = $arr['notes'] . $qid . ',' . $answer . ',' . $uesrTime . ',' . $date . ';';
                $re = $notes->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }
        }
        if ($pos == 'next') {
            if ($que['major'] == 'Math1' || $que['major'] == 'Math2') {
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " order by q.number asc limit 1 ")->queryOne();
            } else {
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " and essayId=" . $que['essayId'] . " order by q.number asc limit 1 ")->queryOne();
            }
        } else {
            if ($que['major'] == 'Math1' || $que['major'] == 'Math2') {
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number<" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " order by q.number desc limit 1 ")->queryOne();
            } else {
                $res['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.essayId,q.answer,q.analysis,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number<" . $que['number'] . " and tpId=" . $que['tpId'] . " and section=" . $que['section'] . " and essayId=" . $que['essayId'] . " order by q.number desc limit 1 ")->queryOne();
            }
        }
        if ($res == false) {
            $res['code'] = 1;
            $res['msg'] = '请求错误';
            die(json_encode($res));
        }
        if ($res['data']['major'] == 'Math1' || $res['data']['major'] == 'Math2') {
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " order by q.number asc limit 1 ")->queryOne()['qid'] != false) ? $res['nextId'] = true : $res['nextId'] = false;
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number<" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " order by q.number desc limit 1 ")->queryOne()['qid'] != false) ? $res['upId'] = true : $res['upId'] = false;
        } else {
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " and essayId=" . $res['data']['essayId'] . " order by q.number asc limit 1 ")->queryOne()['qid'] != false) ? $res['nextId'] = true : $res['nextId'] = false;
            (Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number<" . $res['data']['number'] . " and tpId=" . $res['data']['tpId'] . " and section=" . $res['data']['section'] . " and essayId=" . $res['data']['essayId'] . " order by q.number desc limit 1 ")->queryOne()['qid'] != false) ? $res['upId'] = true : $res['upId'] = false;
        }
//        var_dump($_SESSION);die;
        if (isset($_SESSION['answer'])) {
            $answerData = ((array)$_SESSION['answer']);
            $res['userans'] = (isset($answerData['item'][$res['data']['qid']]) ? $answerData['item'][$res['data']['qid']][1] : '');// 获取用户的答题数据
            $res['userTime'] = (isset($answerData['item'][$res['data']['qid']]) ? $answerData['item'][$res['data']['qid']][2] : '');// 获取用户的答题时间
        }
//        var_dump($res['userans']);die;
        $res['n'] = $model->Progress($res['data']['major'], $res['data']['qid'], $res['data']['section'], $res['data']['tpId'], $res['data']['essayId']);
        $res['collection'] = $model->isCollection($data['uid'], $res['qid']);
        $code = 0;
        $res['data']['isFilling'] = ($res['data']['isFilling'] == false ? false : true);
        die(json_encode(['data' => $res, 'code' => $code]));
    }

    // 练习的结果页面
    public function actionResult()
    {
        session_start();
        if (isset($_SESSION['answer'])) {
            $answerData = ((array)$_SESSION['answer']);
            $answerData = $answerData['item'];// 获取用户的答题数据
            static $que = array();
            // 获取做题的数据
//            var_dump($answerData);die;
            static $i = 0;
            static $a = 0;
            foreach ($answerData as $k => $v) {

                $s = Yii::$app->db->createCommand("select id,answer,section,number from {{%questions}} where id=$k")->queryOne();
                if ($answerData[$k][1] == $s['answer']) {
                    $que['data'][$i]['correct'] = true;
                    $a++;
                } elseif ($answerData[$k][1] != $s['answer']) {
                    $que['data'][$i]['correct'] = false;
                }
                $que['data'][$i]['qid'] = $s['id'];
                $que['data'][$i]['number'] = $s['number'];
                $i++;
            }
            $b = ($que['data'] != false && $a != false) ? ($a / count($que['data']) * 100) : 0;
            $que['correctRate'] = sprintf("%.2f", $b);
        } else {
            $re['code'] = 1;
            $re['msg'] = '无做题数据';
            die(json_encode($re));
        }
        die(json_encode(['data' => $que, 'code' => 0]));
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
                'tpId' => $v['id'],
                'name' => $v['name'] . $v['time']
            ];
        }
        $code = 0;
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 模考通知页面
    public function actionMockNotice()
    {
        $tpId = Yii::$app->request->post('tpId');
        $major = Yii::$app->request->post('major', '');
        $uid = Yii::$app->session->get('userid', '');
//        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        if (isset($_SESSION['answer'])) {
            unset($_SESSION['answer']);
        }
        if (isset($_SESSION['tpId'])) {
            unset($_SESSION['tpId']);
        }
        $data['Reading']['count'] = 52;
        $data['Reading']['time'] = 65;
        $data['Writing']['count'] = 44;
        $data['Writing']['time'] = 35;
        $data['total']['count'] = 154;
        $data['total']['time'] = 180;
        $data['Math']['count'] = 58;
        $data['Math']['time'] = 80;
        if ($major == false) {
            die(json_encode(['data' => $data, 'tpId' => $tpId, 'major' => $major, 'code' => 0]));
        } else {
            $arr = array("$major" => $data["$major"], 'total' => $data["$major"]);
            die(json_encode(['data' => $arr, 'tpId' => $tpId, 'major' => $major, 'code' => 0]));
        }
    }

    // 模考详情页
    public function actionMockDetails()
    {
        $tpId = Yii::$app->request->post('tpId');
        $major = Yii::$app->request->post('major', '');// 如果为单科模考
        if (!is_numeric($tpId)) {
            $re['msg'] = '请求错误！';
            $re['code'] = 1;
            die(json_encode($re));
        }
        //        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        if ($major != false) {
            if ($major == 'Math') {
                $major = '(major="Math1" or major="Math2")';
                $where = "where tpId=" . $tpId . " and $major";
                $data['nextSection'] = 4;
            } else {
                $where = "where tpId=" . $tpId . " and major='$major'";
                $data['nextSection'] = false;
            }
            $section = Yii::$app->db->createCommand("select section from {{%questions}} $where order by section asc limit 1")->queryOne()['section'];
            if ($section == false) {
                $re['msg'] = '题目正在更新中！';
                $re['code'] = 2;
                die(json_encode($re));
            }
        } else {
            $section = 1;
            $data['nextSection'] = 2;
        }
        $data['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tpId from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $section . "  and q.number=1 and tpId=$tpId")->queryOne();
        $data['nextId'] = Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>1  and tpId=" . $tpId . " and section='$section' order by q.number asc limit 1 ")->queryOne()['qid'];
        if ($data == false) {
            $re['msg'] = '题目正在更新中！';
            $re['code'] = 2;
            die(json_encode($re));
        }

        if ($data['data']['major'] == 'Math1') {
            $data['sectionTime'] = 55;
            $data['sectionNum'] = 38;
        } elseif ($data['data']['major'] == 'Math2') {
            $data['sectionTime'] = 25;
            $data['sectionNum'] = 20;
        } elseif ($data['data']['major'] == 'Reading') {
            $data['sectionTime'] = 65;
            $data['sectionNum'] = 52;
        } else {
            $data['sectionTime'] = 35;
            $data['sectionNum'] = 44;
        }
        $data['data']['isFilling'] = ($data['data']['isFilling'] == false ? false : true);
        $code = 0;
        $data['isFilling'] = ($data['isFilling'] == false ? false : true);
//        die(json_encode(['data' => $data, 'count' => $data['count'], 'time' => $data['time'], 'code' => $code]));
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 保存答案，下一题
    public function actionMockNext()
    {
        $answer = Yii::$app->request->post('answer');// 用户提交的答案
        $major = Yii::$app->request->post('major', '');// 全科时不传
        $tpId = Yii::$app->request->post('tpId');
        $qid = Yii::$app->request->post('qid');
        $uid = Yii::$app->session->get('uid', '');
        $userTime = Yii::$app->request->post('userTime');
        $time = Yii::$app->request->post('time', 0);// 总的做题时间
        $number = Yii::$app->request->post('number');
        $section = Yii::$app->request->post('section');
        Yii::$app->session->set('time', $time);
        session_start();
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $answer, $userTime);
        // 正确率等的计算
        $model = new Questions();
        $data = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id from {{%questions}} where id=" . $qid)->queryOne();
        $re = $model->avg($answer, $userTime, $data);
        $_SESSION['uid'] = $uid;
        $_SESSION['tpId'] = $tpId;
        $now['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tpId . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        if ($now['data'] == false) {
            $re['code'] = 1;
            $re['msg'] = "题目正在更新中....";
            die(json_encode($re));
        } else {
            $now['nextId'] = Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $now['data']['number'] . " and tpId=" . $tpId . " and section='$section' order by q.number asc limit 1 ")->queryOne()['qid'];
            if ($major == 'Reading' || $major == 'Writing') {
                $now['nextSection'] = false;
            } elseif ($major == 'Math' || $major == '') {
                if ($now['data']['major'] == 'Math2') {
                    $now['nextSection'] = false;
                } else {
                    $now['nextSection'] = Yii::$app->db->createCommand("select section from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where  tpId=" . $tpId . " and section>'$section' order by q.section asc limit 1 ")->queryOne()['section'];
                }
            }
            if ($now['data']['major'] == 'Math1') {
                $now['sectionTime'] = 55;
                $now['sectionNum'] = 38;
            } elseif ($now['data']['major'] == 'Math2') {
                $now['sectionTime'] = 25;
                $now['sectionNum'] = 20;
            } elseif ($now['data']['major'] == 'Reading') {
                $now['sectionTime'] = 65;
                $now['sectionNum'] = 52;
            } elseif ($now['data']['major'] == 'Writing') {
                $now['sectionTime'] = 35;
                $now['sectionNum'] = 44;
            }
            $code = 0;
            $now['data']['isFilling'] = ($now['data']['isFilling'] == false ? false : true);
            echo die(json_encode(['data' => $now, 'code' => $code]));
        }

    }

    // 中途离开
    public function actionLeave()
    {
        $a = KeepAnswer::getCat();
        $re = $a->Emptyitem();
        echo die(json_encode(['re' => $re, 'code' => 0]));
    }

    // 模考报告页面
    public function actionMockReport()
    {
        // 生成报告页面
        //个人中心页面
        //登录状态直接点击‘报告’
        // 将session 的数据存到数据库有uid的情况下，无uid的情况下只生成报告页面
        $uid = Yii::$app->session->get('uid', '');
        $uid = 14329;
        $data['user'] = Yii::$app->session->get('userData', '');
        $major = Yii::$app->session->get('part', '');
        $id = Yii::$app->request->post('id', '');// 个人中心才传参,报告的id
        $id = 25;// 个人中心才传参,报告的id
        if ($id == false) {
            if (isset($_SESSION['answer']) && isset($_SESSION['tpId'])) {
                $answerData = ((array)$_SESSION['answer']);
                $answerData = $answerData['item'];// 获取用户的答题数据
                $getscore = new GetScore();
                $number = $getscore->Number($answerData);
                $score = $getscore->Score($number);// 各科分数均有，按科目的分类
                $subscore = $getscore->Subscore($number);
                $crosstest = $getscore->CrossTest($number);
                // 需要存到数据库里的数据
                $re['tpId'] = $_SESSION['tpId'];
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
                $format = new Format();
                if ($uid) {
                    // 将答案组合成字符串
                    $re['answer'] = $format->arrToStr($answerData);
                    if ($re['answer'] != false && $re['time'] != false) {
                        $date = Yii::$app->db->createCommand("select date from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 1")->queryOne()['date'];
                        if (time() - $date > 300) {
                            $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                            if ($res != false) unset($_SESSION['tpId']);
                        }
                    }
                    // 历史报告
                    $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                    $data['tp'] = array_reverse($tp);
                    // 取出最新的一次报告
                    $report = new Report();
                    $data['res'] = $report->Show($uid, '');
                    $data['que'] = $this->Question($data['res']['id'], $data['res']['answer']);
                } else {
                    $data['res'] = array_merge($re, $score);
                    $re['answer'] = $format->arrToStr($answerData);
                    $data['que'] = $this->Question($re['tpId'], $re['answer']);
                    $data['tp'] = '';
                }
            } else {
                if ($uid) {
                    $re = Yii::$app->db->createCommand("select id,answer from {{%report}} where uid=" . $uid . " order by id desc limit 1")->queryOne();
                    if ($re) {
                        $report = new Report();
                        $data['res'] = $report->Show($uid, $re['id']);
                        $data['que'] = $this->Question($re['id'], $re['answer']);
                        $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                        $data['tp'] = array_reverse($tp);
                    } else {
                        $res['message'] = '还没有报告，赶紧做套模考题吧！';
                        $res['code'] = 1;
                        die(json_encode($res));
                    }
                } else {
                    $res['message'] = '未登录，无法查看数据！';
                    $res['code'] = 5;
                    die(json_encode($res));
                }
            }
        } else {
            if ($uid) {
                $report = new Report();
                $data['res'] = $report->Show($uid, $id);
                $data['que'] = $this->Question($id, $data['res']['answer']);
                $tp = Yii::$app->db->createCommand("select t.name,t.time,r.score from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id where r.uid=$uid and part='all' order by r.id desc limit 5")->queryAll();
                $data['tp'] = array_reverse($tp);
            } else {
                $res['message'] = '未登录，无法查看数据！';
                $res['code'] = 5;
                die(json_encode($res));
            }

        }
        die(json_encode(['data' => $data, 'code' => 0],true));
    }

    // 做题详情，正确与否 ture or false，题目的id
    public function Question($tpId, $answer)
    {
        $arr = explode(';', $answer);
        static $brr = array();
        static $que = array();
        static $a = 0;
        static $i = 0;
        // 获取做题的数据
        foreach ($arr as $k => $v) {
            $key = explode(',', $v)[0];
            $brr[$key] = explode(',', $v);
            $s = Yii::$app->db->createCommand("select id,answer,major,number from {{%questions}} where id=$key")->queryOne();
            if ($brr[$key][1] == $s['answer']) {
                $a++;
            }
            $i++;
            $que[$s['major']]['data'][]= [
                'qid' => $s['id'],
                'number' => $s['number'],
                'correct' =>$brr[$key][1] == $s['answer']?true:false,
            ];
        }
        $b = ($i != false && $a != false) ? ($a / $i * 100) : 0;
        $que['correctRate'] = sprintf("%.2f", $b);
        return $que;
    }

    // 测评卷
    public function actionEvaulationIndex()
    {
        $paper = Yii::$app->db->createCommand("select id,time,name  from {{%testpaper}} where name like '%测评%' limit 3")->queryAll();
        $data = array();
        foreach ($paper as $k => $v) {
            $data['data'][] = [
                'tpId' => $v['id'],
                'name' => $v['name'] . $v['time']
            ];
        }
        $code = 0;
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 测评通知页面
    public function actionEvaulationNotice()
    {
        $data['tpId'] = Yii::$app->request->post('tpId');
        $uid = Yii::$app->session->get('uid', '');
        $data['evaulation'] = true;
//        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        if (isset($_SESSION['answer'])) {
            unset($_SESSION['answer']);
        }
        if (isset($_SESSION['tpId'])) {
            unset($_SESSION['tpId']);
        }
        $code = 0;
        die(json_encode(['code' => $code, 'data' => $data]));
    }

    // 测评详情
    public function actionEvaulationTest()
    {
        $tpId = Yii::$app->request->post('tpId');
        $data['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.answer,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tpId from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where number=1 and section=1  and tpId=$tpId order by q.number limit 1")->queryOne();
        $data['nextSection'] = 2;
        $data['nextId'] = Yii::$app->db->createCommand("select q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>1  and tpId=" . $tpId . " and section='" . $data['data']['section'] . "' order by q.number asc limit 1 ")->queryOne()['qid'];
        if ($data == false) {
            $re['code'] = 1;
            $re['mmessage'] = '题目正在更新中，换一套题吧！';
            die(json_encode($re));
        }
        $data['data']['isFilling'] = ($data['data']['isFilling'] == false ? false : true);
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 测评的下一题及下一小节
    public function actionEvaulationNext()
    {
        $answer = Yii::$app->request->post('answer');// 用户提交的答案
        $major = Yii::$app->request->post('major');// 学科
        $tpId = Yii::$app->request->post('tpId');
        $qid = Yii::$app->request->post('qid');
        $uid = Yii::$app->request->post('uid');
        $userTime = Yii::$app->request->post('userTime');
        $number = Yii::$app->request->post('number');
        $section = Yii::$app->request->post('section');
        session_start();
        $a = KeepAnswer::getCat();
        $re = $a->addPro($qid, $answer, $userTime);//保存做题数据
        $model = new Questions();
        $details = Yii::$app->db->createCommand("select answer,peopleNum,correctRate,avgTime,id from {{%questions}} where id=" . $qid)->queryOne();
        $re = $model->avg($answer, $userTime, $details);
        $_SESSION['uid'] = $uid;
        $_SESSION['tpId'] = $tpId;
        $data['data'] = Yii::$app->db->createCommand("select q.content,q.number,q.keyA,q.keyB,q.keyC,q.keyD,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $number . " and tpId=" . $tpId . " and section='$section' order by q.number asc limit 1 ")->queryOne();
        if ($data['data'] == false) {
            $res['message'] = '题目正在更新中！';
            $res['code'] = 1;
            die(json_encode($res));
        }
        $data['nextId'] = Yii::$app->db->createCommand("select q.id as qid,q.subScores from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where q.number>" . $data['data']['number'] . " and tpId=" . $tpId . " and section='$section' order by q.number asc limit 1 ")->queryOne()['qid'];
        $data['nextSection'] = Yii::$app->db->createCommand("select q.section from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId where  tpId=" . $tpId . " and section>'$section' order by q.section asc limit 1 ")->queryOne()['section'];
        $data['data']['isFilling'] = ($data['data']['isFilling'] == false ? false : true);
        echo die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 测评生成报告
    public function actionEvaulationReport()
    {
        $id = Yii::$app->request->post('id', '');// 报告的id
        $uid = Yii::$app->session->get('uid', '');
        $uid = 14329;
        if ($id == false) {
            if (isset($_SESSION['answer']) && isset($_SESSION['tpId'])) {
                $data = ((array)$_SESSION['answer']);
                $data = $data['item'];// 获取用户的答题数据
                $getScore = new GetScore();
                $number = $getScore->number($data);
                $re['tpId'] = $_SESSION['tpId'];
                $re['readnum'] = $number['Reading'];
                $re['mathnum'] = $number['Math'];
                $re['writenum'] = $number['Writing'];
                $re['jumpnum'] = $number['Vocabulary'];// jumpnum字段来保存词汇正确个数
                $re['part'] = Yii::$app->db->createCommand("select name from {{%testpaper}} where id=" . $re['tpId'])->queryOne()['name'] . Yii::$app->db->createCommand("select time from {{%testpaper}} where id=" . $re['tpId'])->queryOne()['time'];
                $re['uid'] = Yii::$app->session->get('uid');
                $re['uid'] = 14329;
                $re['matherror'] = $number['matherror'];
                $re['readerror'] = $number['readerror'];
                $re['writeerror'] = $number['writeerror'];
                $re['score'] = $this->actionScore($data) + $number['Math'] * 3 + $number['Reading'] * (30 / ($number['Reading'] + $number['readerror'])) + $number['Writing'] * 2 + $number['Vocabulary'];
                $re['date'] = time();
                $re['time'] = Yii::$app->session->get('time');// 做题总时间
                $re['uid'] = 14329;
                if ($uid) {
                    // 将答案组合成字符串
                    $format = new Format();
                    $re['answer'] = $format->arrToStr($data);
                    if ($re['answer'] != false && $re['time'] != false) {
                        $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                        if ($res) {
//                            unset($_SESSION['answer']);
                            unset($_SESSION['tpId']);
                        }//入库完成
                    }
                    $res = $this->Show('');
                } else {
                    $res['code'] = 5;
                    $res['message'] = '未登录，无法查看报告';
                    die(json_encode($res));
                }

            } else {
                if ($uid) {
                    $res = $this->Show('');
                } else {
                    $res['code'] = 5;
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
            $data['que'] = $this->Question($data['report']['tpId'], $res['report']['answer']);
            $data['win'] = count(Yii::$app->db->createCommand("select id from {{%report}} where part='" . $data['report']['part'] . "' and score<" . $data['report']['score'])->queryOne());
            $code = 0;
        }
        die(json_encode(['data' => $data, 'code' => $code]));
    }

    // 获取测评的分数
    public function actionScore($data)
    {
        $translation = Yii::$app->db->createCommand("select id as qid,answer from {{%questions}} where  major='Translation' and tpId=" . Yii::$app->session->get('tpId'))->queryAll();
        $count = 0;
        $trans = 0;
        foreach ($translation as $k => $v) {
            $answer = explode(',', $v['answer']);
            foreach ($answer as $key => $val) {
                if (strpos($val, $data[$v['qid']][1]) !== false) {
                    $count += 1;
                }
            }
            $trans += ($count >= 6 ? 3 : ($count > 4 ? 2 : 1));
        }
        return $trans;
    }

    // 测评报告数据
    public function Show($id = '')
    {
        $uid = Yii::$app->session->get('uid');
        $uid = 14329;
        if ($id == false) {
            $data = Yii::$app->db->createCommand("select answer,id,mathnum,jumpnum,writenum,readnum,readerror,writeerror,matherror,score,tpId,subScore,crossScore,time,part from {{%report}} where uid=" . $uid . " order by id desc limit 1")->queryOne();
        } else {
            $data = Yii::$app->db->createCommand("select answer,id,mathnum,jumpnum,writenum,readnum,readerror,writeerror,matherror,score,tpId,subScore,crossScore,time,part from {{%report}} where id=" . $id)->queryOne();
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
//            $report['question'] = $this->Question($data['id'],$data['answer']);
            return $report;
        } else {
            $re['message'] = '没有测评报告';
            $re['code'] = 1;
            return $re;
        }
    }

    // 给出的复习建议
    public function Suggest($tpId, $re)
    {
        $data = Yii::$app->db->createCommand("select id,time,name from {{%testpaper}} where id=" . $tpId)->queryOne();
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

    // 个人中心收藏页面
    public function actionPersonCollect()
    {
        $uid = Yii::$app->session->get('uid');
        $uid = 14329;
        $p = Yii::$app->request->post('p', '1');
        $major = Yii::$app->request->post('major', '');
        //        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        $model = new collection();
        $pagesize = 10;
        $offset = $pagesize * ($p - 1);
        $data = $model->CateData($uid, $major, $offset, $pagesize, $p);
        $data['curPage'] = $p;
        echo die(json_encode($data));
    }

    // 个人中心练习题目
    public function actionPersonExercise()
    {
        $uid = Yii::$app->session->get('uid');
        $uid = 14329;
        $major = Yii::$app->request->post('major','');
        $p = Yii::$app->request->post('p', '1');
//        var_dump($page);die;
        //        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }

        $notes = new Notes();
        $arr = $notes->details($major, $p);
        echo die(json_encode(['data' => $arr, 'code' => 0]));
    }

    // 个人中心模考记录
    public function actionPersonMock()
    {
        $uid = Yii::$app->session->get('uid');
        $p = Yii::$app->request->post('p', 1);
        $major = Yii::$app->request->post('major','');
        $pagesize = 10;
        $offset = $pagesize * ($p - 1);
        $uid = 14329;
        //        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        $data = Yii::$app->db->createCommand("select r.id,r.part,r.tpId,r.mathnum,r.readnum,r.writenum,r.date,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=$uid and t.name!='测评'")->queryAll();
        $model = new Format();
        foreach ($data as $k => $v) {
            $v['date'] = date('Y-m-d H:i:s', $v['date']);
            $v['rtime'] = $model->FormatTime($v['rtime']);
            if ($v['part'] == 'all') {
                $arr['data']['all'][] = $v;
            } else {
                $arr['data']['single'][] = $v;
            }
        }
        $collect = new Collection();
        $brr['data']['single'] = $collect->Data('single', $pagesize, 0, $arr,1);
        $brr['data']['all'] = $collect->Data('all', $pagesize, 0, $arr,1);
        if($major!=false) $brr['data'][$major] = $collect->Data("$major", $pagesize, $offset, $p);
        echo die(json_encode(['data' => $brr, 'code' => 0]));
    }

    // 删除模考记录
    public function actionDel()
    {
        $uid = Yii::$app->session->get('uid');
        //        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
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
        $qid = Yii::$app->request->post('qid');
        //        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
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
            unset($crr[$qid]);
        }
        $model = new Format();
        $data['notes'] = $model->arrToStr($crr);
        $notes = new Notes();
        $re = $notes->updateAll($data, 'id=:id', array(':id' => $arr['id']));
        if ($re) {
            $res['code'] = 0;
            $res['message'] = '删除成功';
        } else {
            $res['code'] = 1;
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
            $re['code'] = 5;
            $re  ['msg'] = '未登录';
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
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 测评记录
    public function actionEval()
    {
//        $cate = Yii::$app->request->post('cate');
        $uid = Yii::$app->session->get('uid');
        $uid = 14329;
        $arr['curPage'] = $p = Yii::$app->request->post('p', '1');
        //        if($uid==false){
//            $re['code'] = 5;
//            $re['msg'] = '用户未登录';
//            die(json_encode($re));
//        }
        $arr['pageSize'] = $pagesize = 15;
        $offset = $pagesize * ($p - 1);
        $data = Yii::$app->db->createCommand("select r.id,r.part,r.tpId,r.mathnum,r.readnum,r.writenum,r.date,t.name,t.time,r.time as rtime from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=" . $uid . " and part like '%测评%' limit $offset,$pagesize")->queryAll();
        $arr['total'] = count(Yii::$app->db->createCommand("select r.id from {{%report}} r left join {{%testpaper}} t on r.tpId=t.id  where uid=" . $uid . " and part like '%测评%'")->queryAll());
        $arr['totalPage'] = ceil($arr['total'] / $pagesize);// 总页数
        $model = new Format();
        foreach ($data as $k => $v) {
            $arr['data'][] = array(
                'part' => $v['part'],
                'id' => $v['id'],
                'tpId' => $v['tpId'],
                'name' => $v['name'],
                'time' => $v['time'],
                'score' => $v['score'],
                'date' => $v['date'],
                'rtime' => $model->FormatTime($v['rtime']),
            );
        }
        die(json_encode(['data' => $arr, 'code' => 0]));
    }

    //banner图
    public function actionSat()
    {

        $data['banner'] = Yii::$app->db->createCommand("select pic,url,alt from {{%banner}}  where module='wapIndex' order by id DESC limit 5")->queryAll();
        $data['publicClass'] = Yii::$app->db->createCommand("select id,pic,title,name,hits,activeTime,summary from {{%info}} where cate='公开课' order by id desc limit 4")->queryAll();
        $data['classs'] = Yii::$app->db->createCommand("select id,pic,cate,duration,plan,introduction from {{%classes}} limit 4")->queryAll();
        $data['teacher'] = Yii::$app->db->createCommand("select id,name,pic,introduction,subject,honorary from {{%teachers}} where seniority='讲师' ORDER BY flag ASC,id ASC limit 2")->queryAll();
        $data['news'] = Yii::$app->db->createCommand("select title,pic,id,cate,publishTime,summary from {{%info}} where cate='新闻资讯' order by isShow asc,id desc limit 5")->queryAll();
        $data['academic'] = Yii::$app->db->createCommand("select title,pic,id,cate,publishTime,summary from {{%info}} where cate='学术报告' order by isShow asc,id desc limit 5")->queryAll();
        $data['score'] = Yii::$app->db->createCommand("select title,pic,id,cate,publishTime,summary from {{%info}} where cate='高分经验' order by isShow asc,id desc limit 5")->queryAll();
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 课程二级
    public function actionClass()
    {
        $data['publicClass'] = Yii::$app->db->createCommand("select id,pic,title,name,hits,activeTime,summary from {{%info}} where cate='公开课' order by id desc limit 5")->queryAll();
        $data['classs'] = Yii::$app->db->createCommand("select id,pic,cate,duration,plan,introduction from {{%classes}} limit 4")->queryAll();
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 课程详情
    public function actionClassDetails()
    {
        $id = $p = Yii::$app->request->post('id');
        $data = Yii::$app->db->createCommand("select id,pic,cate,duration,plan,introduction,teacher,student from {{%classes}} where id=$id ")->queryOne();
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 公开课
    public function actionPubClass()
    {
        // 观看往期视频需登录
        $data = array();
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 名师
    public function actionTeacher()
    {
        $data = Yii::$app->db->createCommand("select id,name,pic,introduction,subject,honorary from {{%teachers}} where seniority='讲师' ORDER BY flag ASC,id ASC ")->queryAll();
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 资讯
    public function actionInfo()
    {
        $pageSize = 10;
        $page = Yii::$app->request->post('p', 1);
        $offset = $pageSize * ($page - 1);
        $data['news'] = Yii::$app->db->createCommand("select title,pic,id,cate,publishTime,summary from {{%info}} where cate='新闻资讯' order by isShow asc,id desc limit $offset,$pageSize")->queryAll();
        $data['report'] = Yii::$app->db->createCommand("select title,pic,id,cate,publishTime,summary from {{%info}} where cate='学术报告' order by isShow asc,id desc limit $offset,$pageSize")->queryAll();
        $data['experience'] = Yii::$app->db->createCommand("select title,pic,id,cate,publishTime,summary from {{%info}} where cate='备考经验' order by isShow asc,id desc limit $offset,$pageSize")->queryAll();
        die(json_encode(['data' => $data, 'code' => 0]));
    }

    // 资讯详情
    public function actionInfoDetails()
    {
        $id = Yii::$app->request->post('id', '');
        if ($id == false) {
            $res['code'] = 1;
            $res['message'] = '请求错误';
            die(json_encode($res));
        }
        $data = Yii::$app->db->createCommand("select title,pic,id,cate,publishTime,summary,content,hits from {{%info}} where id=$id")->queryOne();
        die(json_encode(['data' => $data, 'code' => 0]));
    }

}