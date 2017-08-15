<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\GetScore;
use yii;
class Report extends ActiveRecord{
    public static function tableName()
    {
        return '{{%report}}';
    }

    // 数组转化成字符串
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

    /* 报告页面根据条件获取题目详情
    *@$brr 所有题目的数组
    *@$classify 题范围
    *@$major 单科报告科目
    */
    function queDetails($brr,$classify,$major)
    {
        if($major=='Math'){
            $major="(major='Math1' or major='Math2')";
        }else{
            $major="major='$major'";
        }
        static $que=array();
        // 全部题目
        if($classify=='all'){
            foreach($brr as $k=>$v){
                $data=Yii::$app->db->createCommand("select id,content,answer from {{%questions}} where id=$v[0] and $major")->queryOne();
                if($data){
                    array_push($data,$v[1]);
                    array_push($data,$v[2]);
                    array_push($que,$data);// 查看全部的题目
                }
            }
        }
        // 错题
        if($classify=='wrong'){
            foreach($brr as $k=>$v){
                $data=Yii::$app->db->createCommand("select id,content,answer from {{%questions}} where id=$v[0] and $major and answer!= '$v[1]' ")->queryOne();
                if($data){
                    array_push($data,$v[1]);
                    array_push($data,$v[2]);
                    array_push($que,$data);// 查看耗时较长的题目
                }
            }
        }
        if($classify=='long'){
            foreach($brr as $k=>$v){
                $data=Yii::$app->db->createCommand("select id,content,answer from {{%questions}} where id=$v[0] and $major and avgTime<$v[2]")->queryOne();
                if($data){
                    array_push($data,$v[1]);
                    array_push($data,$v[2]);
                    array_push($que,$data);// 查看错题目
                }
            }
        }
        return $que;
    }

    // 用户的最新一套试题数据
    function Show($uid,$id)
    {
        if($id==false){
            $data = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid. " order by id desc limit 1")->queryOne();
        }else{
            $data = Yii::$app->db->createCommand("select * from {{%report}} where id=" . $id)->queryOne();
        }
        $getscore   = new GetScore();
        $number['Math']      =$data['mathnum'];
        $number['Writing']   =$data['writenum'];
        $number['Reading']   =$data['readnum'];
        $score      = $getscore->Score($number);// 各科分数均有，按科目的分类
        $re         = array_merge($data, $score);
        $suggest['Math']    = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Math']  . "  and min<" . $re['Math'] . " and major='Math'")->queryOne();
        $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Reading']  . "  and min<" . $re['Reading'] . " and major='Reading'")->queryOne();
        $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Writing']  . "  and min<" . $re['Writing']." and major='Writing'")->queryOne();
        array_push($re,$suggest);
        return $re;
    }

}