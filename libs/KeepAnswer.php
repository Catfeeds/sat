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
    public function getCat(){
        //  将对象放入session中
        if(!($_SESSION['answer'])||!($_SESSION['answer'] instanceof self)){
            $_SESSION['answer']=self::getIns();
        }
        return $_SESSION['answer'];
    }
    // 判断是否在item里,@$n_id题目的id
    public function inItem($n_id){
        if($this->getType()==0){
            return false;
        }
        if(!(array_key_exists($n_id,$this->item))){
            return false;
        }else{
            return $this->item[$n_id][1];
        }
    }
    /*添加题目答案,
     *@$n_id题目的id
     *@$answer题目的答案
    */
    public function addPro($n_id,$answer){
        if (array_key_exists($n_id,$this->item)) {
            $this->item[$n_id][1]=$answer;
            return;
        }
        $this->item[$n_id] = array();
        array_push( $this->item[$n_id], $n_id);
        array_push( $this->item[$n_id], $answer);
        return true;
    }

    // 总答题数
    public function Gettype(){
        return count($this->item);
    }
//    // 查询购物车中有多少个商品
//    public function Getnumber(){
//        $num = 0;
//        if($this->Gettype() == 0){
//            return 0;
//        }
//        foreach($this->item as $k=>$v){
//            $num += $v['num'];
//        }
//        return $num;
//    }
//    //计算总价格
//    public function Getprice(){
//        $price = 0;
//        if($this->Gettype() == 0){
//            return 0;
//        }
//        foreach($this->item as $k=>$v){
//            $price += $v['price']*$v['num'];
//        }
//        return $price;
//    }
    // 清空所有答案，重新答题
    public function Emptyitem(){
        $this->item = array();
        return true;
    }
    // 将session中存入的数据进一步处理的方法
    public function cartPublic()
    {
//        $proIds = $_SESSION[cat]->item;
//        $pro = D('Product');
//        $brr = array();
//        foreach ($proIds as $key => $val) {
//            $brr[$val[0]] = $pro->where('pro_id=' . $val[0])->find();
//            $brr[$val[0]][num] = $val[1];
//        }
////        dump($brr);
//        return $brr;
    }
}