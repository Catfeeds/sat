<?php
/**
 * 头部灰字组件
 * obelisk
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
	class NavWidget extends Widget  {
        public $category;
        public $banner;
        /**
         * 定义函数
         * */
        public function init()
        {
        }

        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('nav');
        }
	}
?>