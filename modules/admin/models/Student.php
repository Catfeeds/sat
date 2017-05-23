<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;
use yii;

class Student extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%student_case}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'direction', 'major', 'matriculate'], 'required'],

        ];
    }

}