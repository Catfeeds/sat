<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:11
 */
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use yii;
class Info extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%info}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['title', 'content'], 'required'],

        ];
    }
    public function add(){
        $infoData = Yii::$app->request->post('info');
        $infoData['id'] = Yii::$app->request->post('id','');
        $infoData['title'] = Yii::$app->request->post('title','');
        $infoData['cate']      = Yii::$app->request->post('cate','');
        $infoData['summary']      = Yii::$app->request->post('summary','');
        if($infoData['cate'] =="公开课"){
            $infoData['name']      = Yii::$app->request->post('name','');
            $infoData['activeTime']      = Yii::$app->request->post('activeTime','');
            $infoData['hits']=10;
        }else{
            $infoData['name']      = '';
            $infoData['activeTime']      = '';
            $infoData['hits']=rand(100,500);
        }
        $infoData['content']      = Yii::$app->request->post('editorValue','');
        if(Yii::$app->request->post('validTime','')==false){
            $infoData['validTime']="2038-00-00";
        }else{
            $infoData['validTime']  = Yii::$app->request->post('validTime','');
        }
        $infoData['validTime']=strtotime($infoData['validTime']);
        $infoData['publishTime']=time();

        return $infoData;
    }

}