<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:11
 */
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;

class Info extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%info}}';
    }

    public function Data($cate,$page,$pageSize){
        $offset = $pageSize * ($page - 1);
        $data['data'] = Yii::$app->db->createCommand("select hits,title,pic,id,cate,publishTime,summary from {{%info}} where cate='".$cate ."'order by isShow asc,id desc limit $offset,$pageSize")->queryAll();
        $data['Total'] =count(Yii::$app->db->createCommand("select id from {{%info}} where cate='".$cate."' order by isShow asc,id desc ")->queryAll());
        $data['Current'] =$page;
        $data['Page']=($data['Total']!=false?ceil($data['Total']/$pageSize):1);
        return $data;
    }

}