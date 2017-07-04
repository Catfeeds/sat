<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;

use yii;
class Report extends ActiveRecord{
    public static function tableName()
    {
        return '{{%report}}';
    }
    function arrToStr ($array)
    {
        // 定义存储所有字符串的数组
        static $r_arr = array();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    // 递归遍历
                    arrToStr($value);
                } else {
                    $r_arr[] = $value;
                }
            }
        } else if (is_string($array)) {
            $r_arr[] = $array;
        }

        //数组去重
//        $r_arr = array_unique($r_arr);
        $string = implode(",", $r_arr);
        return $string;
    }
}