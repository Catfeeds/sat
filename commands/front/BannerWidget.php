<?php
/**
 * 主导航菜单组件
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
    use yii\web\application;
    use yii\web\controller;
	class BannerWidget extends Widget  {
        public $now_path;
        public $banner;
        public $data;
        public $controller;
        /**
         * 定义函数
         * */
        public function init()
        {//这个可以取侧边栏数
        }

        /**
         * 运行覆盖程序
         * */

        public function path(){
            $action = Yii::$app->controller->action->id;
            $this->controller = Yii::$app->controller->id;
//            var_dump($controller);die;
//            $this->data = Yii::$app->db->createCommand("select * from {{%banner}} where module=".$controller)->queryAll();
//            $now_path=$controller.'/'.$action;
//            var_dump($this->data);
        }
        public function run(){
            return $this->render('banner',['data'=>$this->data,'controller'=>$this->controller]);
        }
	}
?>

