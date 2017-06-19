<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Topic extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%topic}}';
    }


}
