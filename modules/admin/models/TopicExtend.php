<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:11
 */
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class TopicExtend extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%topic_extend}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['content' ], 'required'],

        ];
    }
}