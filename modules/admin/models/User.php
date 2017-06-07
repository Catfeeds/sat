<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;
use yii;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%student_case}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'introduction', '', 'subject'], 'required'],

        ];
    }

}