<?php
namespace app\modules\user\models;
use yii\db\ActiveRecord;
class Collect extends ActiveRecord {
    public static function tableName(){
        return '{{%th_collect}}';
    }

    public function getAllClass($where,$pageSize = 10,$page =1){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT tc.userId,tc.createTime,u.phone,u.email,c.name,tc.contentId,tc.id from {{%th_collect}} tc LEFT JOIN {{%content}} c ON tc.contentId=c.id LEFT JOIN {{%user}} u ON tc.userId=u.id where ".$where." order by createTime DESC ".$limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT tc.createTime,u.phone,u.email,c.name,tc.contentId,tc.id from {{%th_collect}} tc LEFT JOIN {{%content}} c ON tc.contentId=c.id LEFT JOIN {{%user}} u ON tc.userId=u.id where ".$where." order by createTime DESC ")->queryAll());
        return ['data' => $data,'count' => $count];
    }
}
