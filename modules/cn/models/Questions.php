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
    // 练习二级页面分页逻辑
    public function data(){
        $major=Yii::$app->request->get('m','Math');
        if($major=='Math'){
            $m="major = 'Math1' or major='Math2'";
        }else{
            $m="major = '$major'";
        }
        $cate=Yii::$app->request->get('c','');
        $now_path=ltrim($_SERVER['REQUEST_URI'],'/');
        // 判断地址栏参数是否存在，构建where语句
        if($cate==false){
            $where="where $m";
            $url='exercise.html?m='.$major.'&p';
        }else{
            $where2="where name='$cate'";
            $ids= Yii::$app->db->createCommand("select id from {{%testpaper}} $where2")->queryAll();
            $str='';
            foreach($ids as $v){
                $str.=$v['id'].',';
            }
            $str=rtrim($str,',');
            $where="where tpId in ($str) and ($m)";
            $url='exercise.html?m='.$major.'&c='.$cate.'&p';
        }
        $page = Yii::$app->request->get('p', 1);
        $pagesize=2;
        $offset = $pagesize * ($page - 1);
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId $where limit $offset,$pagesize")->queryAll();
        $count = Yii::$app->db->createCommand("select count(*) from {{%questions}} $where")->queryOne();
        $count = $count['count(*)'];
        $page = new Pager("$url", $count, $page, $pagesize);
        $data['str'] = $page->GetPager();
        return $data;
    }
    /* 做题正确率 时间的更新
     *@time每题做题时间
     * @answer做题答案
     * @data题目数据
    */
    public function avg($answer,$time,$data){
        if($answer==$data['answer']){
            $data['correctRate']=($data['peopleNum']*$data['correctRate']/100+1)/($data['peopleNum']+1)*100;
        }else{
            $data['correctRate']=($data['peopleNum']*$data['correctRate']/100)/($data['peopleNum']+1)*100;
        }
        // 答题时间的计算
        $data['avgTime']=($data['avgTime']*$data['peopleNum']+$time)/($data['peopleNum']+1);
        $data['correctRate']=$data['peopleNum']*$data['correctRate']/($data['peopleNum']+1);
        $data['peopleNum']+=1;
//        var_dump($data);die;
        $re = $this->updateAll($data, 'id=:id', array(':id' => $data['id']));
        return $re;
    }

}