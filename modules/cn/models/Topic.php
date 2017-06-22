<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
use app\libs\Pager;
class Topic extends ActiveRecord{
    public static function tableName()
    {
        return '{{%topic}}';
    }
    public function data(){
        $major=Yii::$app->request->get('m','');
        $cate=Yii::$app->request->get('c','');
        // 判断地址栏参数是否存在，构建where语句
        if($major!=false){
            if($cate==false){
                if($major=='math'){
                    $where="where major='math1' or major='math2'";
                }else{
                    $where="where major='$major'";
                }
                $url='exercise.html?m='.$major.'&p';
            }else{
                $ids= Yii::$app->db->createCommand("select id from {{%testpaper}} where name='$cate'")->queryAll();
                $str='';
                foreach($ids as $v){
                    $str.=$v['id'].',';
                }
                $str=rtrim($str,',');
                if($major=='math'){
                    $where="where tpId in ($str) and (major='math1' or major='math2')";
                }else{
                    $where="where tpId in ($str) and major='$major'";
                }
                $url='exercise.html?m='.$major.'&c='.$cate.'&p';
            }
        }else{
            $where='';
            $url='exercise.html?p';
        }
        $page = Yii::$app->request->get('p', 1);
        $pagesize=2;
        $offset = $pagesize * ($page - 1);
        $data = Yii::$app->db->createCommand("select id,topic from {{%topic}} $where limit $offset,$pagesize")->queryAll();
        $count = Yii::$app->db->createCommand("select count(*) from {{%topic}} $where")->queryOne();
        $count = $count['count(*)'];
        $page = new Pager("$url", $count, $page, $pagesize);
        $data['str'] = $page->GetPager();
        return $data;
    }
}