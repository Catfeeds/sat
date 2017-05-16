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
use app\libs\Pager;
class Info extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%info}}';
    }
    public function Page($table,$pagesize,$cate){
        $countNews = Yii::$app->db->createCommand("select count(*) as count from {{%info}} where cate='新闻资讯'")->queryOne();
        $countNews = $countNews['count'];
        $pagesize = 1;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $infoNews = Yii::$app->db->createCommand("select * from {{%info}} where cate='$cate' limit $offset,$pagesize")->queryAll();
        return $infoNews;

    }



}