<?php
/**
 * 左悬浮窗组件
 * obelisk
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
    use app\modules\cn\models\CategoryExtend;
	class LeftSuspensionWidget extends Widget  {
        public $extendData;
        /**
         * 定义函数
         * */
        public function init()
        {
            $this->extendData = CategoryExtend::find()->where("catId=222")->orderBy('id ASC')->all();
        }

        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('leftSuspension',['extendData' => $this->extendData]);
        }
	}
?>