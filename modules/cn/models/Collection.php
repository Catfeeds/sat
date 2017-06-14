<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4 0004
 * Time: 10:01
 */
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class Collection extends ActiveRecord{
    public static function tableName()
    {
        return '{{%collection}}';
    }
}
