<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class Notes extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%notes}}';
    }
    // 做题时重复题目重新记录数据
//    public function note(){
    // 若题目已答，更改答案
//                if ($arr['notes'] != false) {
//                    $brr = explode(';', $arr['notes']);
//                    static $crr = array();
//                    foreach ($brr as $k => $v) {
//                        if ($v != false) {
//                            $key = $v[0];
//                            $crr[$key] = explode(',', $v);
//                        }
////                        array_push($crr,explode(',',$v));
//                    }
//
//                    if (array_key_exists($qid, $crr)) {
//                        $crr[$qid][1] = $answer;
//                        $crr[$qid][2] = $time;
//                    } else {
//                        $crr[$qid][0] = $qid;
//                        $crr[$qid][1] = $answer;
//                        $crr[$qid][2] = $time;
//                    }
//
//                    // 将数组组装成字符串
//                    static $temp = array();
//                    foreach ($crr as $v) {
//                        $v = join(",", $v); //可以用implode将一维数组转换为用逗号连接的字符串
//                        $temp[] = $v;
//                    }
//                    $t = "";
//                    foreach ($temp as $v) {
//                        $t .= $v . ";";
//                    }
//                    $t = substr($t, 0, -1);
//                    $data['notes'] = $t;
////                    var_dump($t);
//                }else{
//                    $data['notes']=$qid.','.$answer.','.$time.';';
//                }

//
//    }
}