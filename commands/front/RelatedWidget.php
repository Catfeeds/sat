<?php
/**
 * 相关文章组件
 * obelisk
 */
    namespace app\commands\front;
    use yii\base\Widget;
    use yii;
	class RelatedWidget extends Widget  {
        public $category;
        public $related;
        /**
         * 定义函数
         * */
        public function init()
        {
            $this->related = Yii::$app->db->createCommand('Select * from {{%content}} c WHERE c.id in (SELECT DISTINCT contentId FROM {{%category_content}} ca WHERE ca.catId IN (118,125,126,127,128,129,130,131)) ORDER BY c.viewCount DESC LIMIT 6')->queryAll();
        }

        /**
         * 运行覆盖程序
         * */
        public function run(){
            return $this->render('related',['related' => $this->related]);
        }
	}
?>