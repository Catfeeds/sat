<?php
<?php
namespace app\modules\user\models;
use yii\db\ActiveRecord;
class User extends ActiveRecord {
    public static function tableName(){
        return '{{%user}}';
    }

    public function getAllUser($where,$pageSize = 10,$page =1){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT * from {{%user}} where ".$where." order by createTime DESC ".$limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT * from {{%user}} where ".$where." order by createTime DESC ")->queryAll());
        return ['data' => $data,'count' => $count];
    }
}
