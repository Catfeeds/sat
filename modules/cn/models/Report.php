<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;

use yii;
class Report extends ActiveRecord{
    public static function tableName()
    {
        return '{{%report}}';
    }
    public function Assignment()
    {
        static $mathnum=0;
        static $readnum=0;
        static $writnum=0;
        static $expression=0;
        static $english=0;
        static $algebra=0;
        static $analysis=0;
        static $math=0;
        static $words=0;
        static $evidence=0;
        static $social=0;
        static $science=0;
        static $kip=0;
        return true;
    }
}