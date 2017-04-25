<?php
/**
 * 后台左菜单组件
 */
    namespace app\commands\background;
    use yii\base\Widget;
    use yii;
	class LeftWidget extends Widget  {
        public $controller;
        public $module;
        public $data;
        public $blockArr = [];
        /**
         * 定义函数
         * */
         public function init()
         {
             $rid=Yii::$app->session->get('rid');
             $ids=  Yii::$app->db->createCommand("select ids from {{%role}} where id=$rid")->queryOne();
             $ids= $ids['ids'];
             $this->data =  Yii::$app->db->createCommand("select path,name,pid,isShow from {{%node}} where id in ($ids)")->queryAll();
         }


        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('left',['data' => $this->data,'controller' => $this->controller,'module' => $this->module,'blockArr' => $this->blockArr]);
        }
	}
?>