<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Essay extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%essay}}';
    }


}
