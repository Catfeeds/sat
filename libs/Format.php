<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 9:57
 */
namespace app\libs;
use yii;
class Format {
    // 将秒的格式转换成 0h:0m:0s的格式，参数$secs表示多少秒
    public function FormatTime($secs){
        $r='';
            $h=floor($secs/3600);
            $secs=$secs%3600;
            if($secs>60){
                $m=floor($secs/60);
                $s=$secs%60;
            }else{
                $m=0;
                $s=$secs;
            }
        $r=$h.' h : '.$m.' m : '.$s.' s';
//        var_dump($r);
        return $r;

    }
    // 将二维数组转换成字符串，$data所需转换的数组
    public function arrToStr($data)
    {
        static $temp = array();
        foreach ($data as $v) {
            $v = join(",", $v); //可以用implode将一维数组转换为用逗号连接的字符串
            $temp[] = $v;
        }
        $t = "";
        foreach ($temp as $v) {
            $t .= $v . ";";
        }
        $t = substr($t, 0, -1);
        return $t;
    }
    // 特定字符转化成二唯数组
    public function strToArray($str)
    {
        $arr=explode(';',$str);
        static $brr=array();
        // 获取做题的数据
        foreach($arr as $k =>$v){
            $key=explode(',', $v)[0];
            $brr[$key]=explode(',', $v);
        }
        return $brr;
    }
    // 将分数转换成小数
    public function FractionToFloat($str)
    {
        $s = str_replace(array('[',']','mod'),array('(',')','%'),$str);//将原三字符串中的只有在数学中才会用到的中括号[]、mod等改为程序可识别的()和%
        $str=sprintf("%.2f", $s);
        return $str;
    }
}