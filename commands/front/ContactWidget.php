<?php
/**
 * 联系我们组件
 * obelisk
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
    use app\modules\cn\models\Content;
	class ContactWidget extends Widget  {
        public $data;
        /**
         * 定义函数
         * */
        public function init()
        {
            $this->data = Content::getContent(['fields' => 'email,metroRoutes,busRoutes,phone,place','category' => '210']);
        }

        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('contact',['data' => $this->data]);
        }
	}
?>