<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6 0006
 * Time: 17:11
 */
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
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
//    上传文件处理
    public function upImage(){
        $up=new \UploadFile();
        $savePath="D:/phpStudy/WWW/shenyousat/Upload/images/";
        $file=$_FILES['up'];
        $data= $up->uploadOne($file,$savePath);

        $a=$data['arr_data']['arr_data'][0];
        $path=$a['savepath'].$a['savename'];
//        var_dump($path);
        return $path;

    }
}