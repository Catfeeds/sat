<?php
/**
 * study组件
 * obelisk
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
	class ClassHeadWidget extends Widget  {
        public $userData;
        public $userId;
        /**
         * 定义函数
         * */
        public function init()
        {
            $this->userData = Yii::$app->session->get('userData');
            $this->userId = Yii::$app->session->get('userId');
        }

        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('classHead',['userData' => $this->userData,'userId' => $this->userId]);
        }
	}
?>