<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
use app\libs\Pager;
class Questions extends ActiveRecord{
    public static function tableName()
    {
        return '{{%questions}}';
    }
    public function data(){
        $major=Yii::$app->request->get('m','');
        $cate=Yii::$app->request->get('c','');
        $now_path=ltrim($_SERVER['REQUEST_URI'],'/');
        // 判断地址栏参数是否存在，构建where语句
        if($cate==false){
            if($major!=false ){
                $where="where major = '$major'";
                $url='exercise.html?m='.$major.'&p';
            }else{
                $where='';
                $url='exercise.html?p';
            }
        }else{
            $where2="where name='$cate'";
            $ids= Yii::$app->db->createCommand("select id from {{%testpaper}} $where2")->queryAll();
            $str='';
            foreach($ids as $v){
                $str.=$v['id'].',';
            }
            $str=rtrim($str,',');
            $where="where sourceId in ($str) and major='$major'";
            $url=$now_path.'?p';
        }
        $page = Yii::$app->request->get('p', 1);
        $pagesize=2;
        $offset = $pagesize * ($page - 1);
        $data = Yii::$app->db->createCommand("select id,essay,content,pid from {{%questions}} $where limit $offset,$pagesize")->queryAll();
        $count = Yii::$app->db->createCommand("select count(*) from {{%questions}} $where")->queryOne();
        $count = $count['count(*)'];
        $page = new Pager("$url", $count, $page, $pagesize);
        $data['str'] = $page->GetPager();
        return $data;
    }
}