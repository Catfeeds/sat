<?php
/**
 * 主导航菜单组件
 */
    namespace app\commands\background;
    use yii\base\Widget;
    use yii;;
    use app\models\Block;
	class NavWidget extends Widget  {
        public $data;
        public $navData;
        public $blockArr = [];
        /**
         * 定义函数
         * */
        public function init()
        {//这个可以取侧边栏数
        }

        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('nav',['data' => $this->data,'navData' => $this->navData,'blockArr' => $this->blockArr]);
        }
	}
?>