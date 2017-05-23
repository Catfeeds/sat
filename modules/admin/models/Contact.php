<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 10:02
 */
namespace app\modules\admin\models;

use yii;
use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%contact}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['city', 'telephone', 'address'], 'required'],

        ];
    }
//    public function contactAdd(){
//
//    }
}