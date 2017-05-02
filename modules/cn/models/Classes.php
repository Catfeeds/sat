<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class Classes extends ActiveRecord{
    public static function tableName()
    {
        return '{{%classes}}';
    }

   /*
    * @table数据表名
    * @fields需要查询的字段
    * @order=排序方式,
    * @limit限制输出的条数
    * */
    public function getData($table,$fields="*",$order="",$limit=10){
        if(empty($where)){
           $where='' ;
        }else{
            $where="where $where";
        }
        if(empty($order)){
            $order='';
        }else{
            $order="order by $order";
        }
        if(empty($limit)){
            $limit='';
        }else{
            $limit="limit $limit";
        }
        $data = Yii::$app->db->createCommand("select $fields from {{%$table}} $where $order $limit")->queryAll();
        return $data;
    }
    public function getDataOne($fields="*",$order,$where="",$limit=10){
        $data = Yii::$app->db->createCommand("select $fields from {{%classes}} ")->queryOne();
        return $data;
    }
}