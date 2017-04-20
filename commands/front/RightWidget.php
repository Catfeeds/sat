<?php
/**
 * 二，三级页面右侧组件
 * bottom组件
 * obelisk
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
    use app\modules\cn\models\Content;
	class RightWidget extends Widget  {
        public $type = 0;
        public $studyInSpeech;
        public $trainingSpeech;
        public $activity;
        public $activityDate;
        /**
         * 定义函数
         * */
        public function init()
        {
            $this->studyInSpeech = Content::getContent(['fields' => 'abstract,smallPhoto','category' => '102,178','pageSize' => 8,'order' => "c.viewCount DESC"]);
            $this->trainingSpeech = Content::getContent(['fields' => 'abstract,smallPhoto','category' => '102,177','pageSize' => 8,'order' => "c.viewCount DESC"]);
            $re = Content::getActive();
            $this->activity = $re['activity'];
            $this->activityDate = $re['activityDate'];
        }

        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('right',['type' => $this->type,'studyInSpeech' => $this->studyInSpeech,'trainingSpeech' => $this->trainingSpeech,'activity' => $this->activity,'activityDate' => $this->activityDate]);
        }
	}
?>