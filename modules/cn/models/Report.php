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
                    $this->arrToStr($value);
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
    function queDetails($brr,$classify,$major){
        static $que=array();
        if($classify=='all'){
            foreach($brr as $k=>$v){
                $data=Yii::$app->db->createCommand("select id,content,answer from {{%questions}} where id=$v[0] and major ='$major'")->queryOne();
                if($data){
                    array_push($data,$v[1]);
                    array_push($data,$v[2]);
                    array_push($que,$data);// 查看全部的题目
                }
            }
        }
        if($classify=='wrong'){
            foreach($brr as $k=>$v){
                $data=Yii::$app->db->createCommand("select id,content,answer from {{%questions}} where id=$v[0] and major ='$major' and avgTime<$v[2]")->queryOne();
                if($data){
                    array_push($data,$v[1]);
                    array_push($data,$v[2]);
                    array_push($que,$data);// 查看耗时较长的题目
                }
            }
        }
        if($classify=='long'){
            foreach($brr as $k=>$v){
                $data=Yii::$app->db->createCommand("select id,content,answer from {{%questions}} where id=$v[0] and major ='$major' and answer!= '$v[1]'")->queryOne();
                if($data){
                    array_push($data,$v[1]);
                    array_push($data,$v[2]);
                    array_push($que,$data);// 查看错题目
                }
            }
        }
        return $que;
    }
}