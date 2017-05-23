<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%role}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'ids'], 'required'],

        ];
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