<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class Classes extends ActiveRecord{
    public static function tableName()
    {
        return '{{%classes}}';
    }

}