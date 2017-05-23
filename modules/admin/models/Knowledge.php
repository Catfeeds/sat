<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:11
 */
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Knowledge extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%knowledge}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['major', 'name', 'analysis'], 'required'],

        ];
    }
}