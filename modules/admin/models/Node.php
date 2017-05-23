<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 10:02
 */
namespace app\modules\admin\models;

use yii;
use yii\db\ActiveRecord;

class Node extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%node}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['controller', 'name', 'action'], 'required'],

        ];
    }

    //    接收数据
    public function add()
    {
        $nodeData['name'] = Yii::$app->request->post('name', '');
        $nodeData['pid'] = Yii::$app->request->post('pid', '');
        $nodeData['id'] = Yii::$app->request->post('id', '');
        $nodeData['module'] = Yii::$app->request->post('module', '');
        $nodeData['controller'] = Yii::$app->request->post('controller', '');
        $nodeData['action'] = Yii::$app->request->post('action', '');
        $nodeData['level'] = Yii::$app->request->post('level', '');
        $nodeData['path'] = Yii::$app->request->post('path', '');
        $nodeData['isShow'] = Yii::$app->request->post('isShow', '');
        return $nodeData;
    }

    public function getList($data, $pid = 0, $lev = 0)
    {
        static $arr = array();
        foreach ($data as $key => $value) {
            if ($value['pid'] == $pid) {
                $value['lev'] = $lev;
                $arr[] = $value;
                $this->getList($data, $value['id'], $lev + 1);
            }
        }
        return $arr;
    }
}