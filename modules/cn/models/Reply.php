<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:11
 */
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;

class Reply extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%reply}}';
    }



}