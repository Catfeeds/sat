<?php
//用户模型
namespace app\modules\user\models;

use yii\db\ActiveRecord;
use yii;

class Login extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**s
     * 验证短信码
     * @param $code
     * @Obelisk
     */
    public function checkCode($phone, $code)
    {
        $phoneCode = \Yii::$app->session->get($phone . 'phoneCode');
        if ($phoneCode == $code && $code != '') {
            \Yii::$app->session->remove($phone . 'phoneCode');
            $re = true;
        } else {
            $re = false;
        }
        return $re;
    }

    /**
     * 验证短信的时间是否过期
     * @Obelisk
     */
    public function checkTime()
    {
        $phoneTime = \Yii::$app->session->get('phoneTime');
        $timeLimit = \Yii::$app->params['timeLimit'];
        if (time() - $phoneTime > $timeLimit) {
            $re = false;
        } else {
            $re = true;
        }
        return $re;
    }

    /**
     * 验证邮箱是否合法
     * @Obelisk
     */
    public function checkEmail($email)
    {
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 验证邮箱是否合法
     * @Obelisk
     */
    public function checkTel($phone)
    {
        if (!is_numeric($phone)) {
            return false;
        }
        if (!preg_match("/^1[0-9]{10}$/", $phone)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 验证手机或者邮箱是否已经注册
     */
    public function checkPhoneEmail($str, $type)
    {
        if ($type == 1) {
            $re = $this->find()->where("phone='$str'")->one();
        } else {
            $re = $this->find()->where("email='$str'")->one();
        }
        if ($re) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 验证用户名是否已经被注册
     */
    public function checkUserName($userName)
    {
        $re = $this->find()->where("userName='$userName'")->one();
        if ($re) {
            return false;
        } else {
            return true;
        }
    }
//    密码加密
    public function passProtection($pass){
        $str=substr($pass, 1);
        $str='_@5!'.$str."*a1";
        $str=md5($str);
        return $str;
    }

}
