<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 9:57
 */
namespace app\libs;
use yii;
class KeepAnswer {
    // 单例模式
    static protected $ins;
    public $item = array();
    private function __construct(){}
    private function __clone(){}
    // 类的实例化
    static protected function getIns(){
        if(!self::$ins instanceof self){
            self::$ins= new self();
        }
        return self::$ins;
    }
    static public function getCat(){
        //  将对象放入session中
        if((!isset($_SESSION['answer']))||(!($_SESSION['answer'] instanceof self))){
            $_SESSION['answer']=self::getIns();
        }
        return $_SESSION['answer'];
    }
    /*添加题目答案,
     *@$n_id题目的id
     *@$answer题目的答案
    */
//    public function addPro($n_id,$answer,$solution,$major,$crossScore='',$subScore=''){
    public function addPro($n_id,$solution,$utime){
        if (array_key_exists($n_id,$this->item)) {
//            $this->item[$n_id][2]=$solution;
            $this->item[$n_id][1]=$solution;
            $this->item[$n_id][2]=$utime;
            return;
        }
        $this->item[$n_id] = array();
        array_push( $this->item[$n_id], $n_id);
//        array_push( $this->item[$n_id], $answer);
        array_push( $this->item[$n_id], $solution);
        array_push( $this->item[$n_id], $utime);
//        array_push( $this->item[$n_id], $major);
//        array_push( $this->item[$n_id], $crossScore);
//        array_push( $this->item[$n_id], $subScore);
        return true;
    }

    // 总答题数
    public function Gettype(){
        return count($this->item);
    }
    // 清空所有答案，重新答题
    public function Emptyitem(){
        $this->item = array();
        return true;
    }
}