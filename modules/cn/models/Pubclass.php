<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4 0004
 * Time: 10:01
 */
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\modules\admin\models\info;
use yii;
class Pubclass extends ActiveRecord{
    public function getTime()
    {
        $data = Yii::$app->db->createCommand("select * from {{%info}} where isShow=1")->queryAll();
        $info = new Info();
        $time=time();
        foreach ($data as $v) {
            if($v['validTime']<$time){
                $v['isShow']=0;
                $re = $info->updateAll($v,'id=:id',array(':id'=>$v['id']));
            }
        }
    }
}
