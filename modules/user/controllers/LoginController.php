<?php
namespace app\modules\user\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\Admin;
use yii\web\Controller;

class LoginController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * 登陆界面
     * @return string
     */
    public function actionLogin()
    {
        $session = Yii::$app->session;
        $userId = $session->get('adminId');
        if ($userId) {
            $this->redirect('admin/index/index');
        } else {
            return $this->renderPartial('index');
        }
    }


    /**
     * 登陆验证
     * @return string
     * */
    public function actionCheck()
    {
        header('Content-Type:text/html;charset=utf-8');
        $apps = Yii::$app->request;
        $session = Yii::$app->session;
        $logins = new Admin();
        if ($apps->isPost) {
            $userName = $apps->post('userName');
            $userPass = md5($apps->post('userPass'));
            $loginsdata = $logins->find()->where(['userName' => $userName, 'userPass' => $userPass])->one();
            if (!empty($loginsdata['id'])) {
                $session->set('adminId', $loginsdata['id']);
                $session->set('userName', $loginsdata['userName']);
                $session->set('rid', $loginsdata['roleId']);
                $this->redirect('/index/index');
            } else {
                echo '<script>alert("帐号或密码不正确");history.go(-1);</script>';
                exit;
            }
        }
    }

    public function actionRegister()
    {
//        var_dump(Yii::$app->params);die;

        $login = new Login();

        $registerStr = Yii::$app->request->post('registerStr');

        $pass = Yii::$app->request->post('pass');

        $code = Yii::$app->request->post('code');

        $type = Yii::$app->request->post('type');

        $userName = Yii::$app->request->post('userName');

        $checkPhoneEmail = $login->checkPhoneEmail($registerStr, $type);

        if (!$checkPhoneEmail) {

            $res['code'] = 0;

            if ($type == 1) {

                $res['message'] = '手机已经被注册';

            } else {

                $res['message'] = '邮箱已经被注册';

            }

            $res['type'] = '3';

            die(json_encode($res));

        }

        $checkUserName = $login->checkUserName($userName);

        if (!$checkUserName) {

            $res['code'] = 0;

            $res['message'] = '用户名已经被注册';

            $res['type'] = '2';

            die(json_encode($res));

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

                } else {

                    $login->email = $registerStr;

                    $login->userPass = md5($pass);

                    $login->createTime = time();

                    $login->userName = $userName;

                }

                $re = $login->save();

                if ($re) {

                    $res['code'] = 1;

                    $res['message'] = '注册成功';

                } else {

                    $res['code'] = 0;

                    $res['message'] = '注册失败，请重试';

                    $res['type'] = '3';

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

        die(json_encode($res));

    }

    /**
     * 注销账户
     * @return string
     * */
    public function actionLoginOut()
    {
        $session = Yii::$app->session;
        $session->remove('adminData');
        $session->remove('adminId');
        $this->redirect('/admin/login');
    }
}