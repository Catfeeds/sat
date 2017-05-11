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
class Teachers extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%info}}';
    }
public function formatting ($arr){
    foreach($arr as $k=>$v){
        $name=($v['name']!=false)?$v['name'].',':'';
        $school=($v['school']!=false)?$v['school']."-":'';
        $major=($v['major']!=false)?$v['major'].',':'';
        $GPA=($v['GPA']!=false)?'GPA:'.$v['GPA'].',':'';
        $TOFEL=($v['TOFEL']!=false)?'TOFEL:'.$v['TOFEL'].',':'';
        $GMAT=($v['GMAT']!=false)?'GMAT'.$v['GMAT'].',':'';
        $direction=($v['direction']!=false)?'申请方向：'.$v['direction'].',':'';
        $matriculate=($v['matriculate']!=false)?'录取学校：'.$v['matriculate']:'';
        $brr[$k]['str1']=$name.$school.$major.$GPA.$TOFEL.$GMAT;
        $brr[$k]['str2']=$direction.$matriculate;
    }
    return $brr;
}
}