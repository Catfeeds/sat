<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4 0004
 * Time: 10:01
 */
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class Collection extends ActiveRecord{
    public static function tableName()
    {
        return '{{%collection}}';
    }
    public function CollectionDate($name,$uid,$major){
        if($name=='all'){
            $name='';
        }else{
            $name="and name='$name'";
        }
        if($major=='all'){
            $major='';
        }else{
            $major="and major='$major'";
        }
        $arr= Yii::$app->db->createCommand("select * from {{%collection}} where uid=".$uid)->queryOne();
        $qid=ltrim($arr['qid'],',');
        $data= Yii::$app->db->createCommand("select q.id as qid,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid) $name $major")->queryAll();
        return $data;
    }
}
