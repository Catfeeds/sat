<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class Questions extends ActiveRecord{
    public static function tableName()
    {
        return '{{%questions}}';
    }
    public function data(){
//        $major=Yii::$app->request->get('m','');
//        $cate=Yii::$app->request->get('c','');
//        // 判断地址栏参数是否存在，构建where语句
//        if($cate==false){
//            if($major!=false ){
//                $where="where u.major = '$major'";
//            }else{
//                $where='';
//            }
//        }else{
//            $where2="where name='$cate'";
//                $ids= Yii::$app->db->createCommand("select id from {{%testpaper}} $where2")->queryAll();
//                $str='';
//                foreach($ids as $v){
//                    $str.=$v['id'].',';
//                }
//                $str=rtrim($str,',');
//                $where="where u.sourceId in ($str) and u.major='$major'";
//        }
////        if($major!='math'){
////            $data = Yii::$app->db->createCommand("select distinct q.id as pid,q.essay as pessay from {{%questions}} q join {{%questions}} u on q.id=u.pid $where and u.content=''")->queryAll();
////            var_dump($data);die;
////        }else{
////            $data = Yii::$app->db->createCommand("select id,content from {{%questions}} where major='math'")->queryAll();
////        }
//        $data = Yii::$app->db->createCommand("select distinct  id,pid,content from {{%questions}}  ")->queryAll();
//        foreach($data as $k=>$v){
//            if($v['pid']){
//                $arr[$k]= Yii::$app->db->createCommand("select distinct essay from {{%questions}}  where pid=".$v['id'].' limit 1')->queryOne();
//            }
//        }
//        var_dump($arr);die;
//        return $data;
    }
}