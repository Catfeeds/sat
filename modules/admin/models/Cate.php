<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Cate extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%cate}}';
    }

    public function getAllCate($where, $pageSize = 10, $page = 1)
    {
        $limit = "limit " . ($page - 1) * $pageSize . ",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT * from {{%cate}} where " . $where . " order by createTime DESC " . $limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT * from {{%cate}} where " . $where . " order by createTime DESC ")->queryAll());
        return ['data' => $data, 'count' => $count];
    }

    public function getCateList($data, $pid = 0, $lev = 0)
    {
        static $arr = array();
        foreach ($data as $key => $value) {
            if ($value['pid'] == $pid) {
                $value['lev'] = $lev;
                $arr[] = $value;
                $this->getCateList($data, $value['id'], $lev + 1);
            }
        }
        return $arr;
    }
}
