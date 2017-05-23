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

class Joboffers extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%job_offers}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['job', 'demand'], 'required'],

        ];
    }
}