<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4 0004
 * Time: 10:01
 */
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\modules\cn\models\Notes;
use yii;
class Collection extends ActiveRecord{
    public static function tableName()
    {
        return '{{%collection}}';
    }
    public function CollectionDate($name,$uid,$major,$offset,$pagesize){
        if($name=='all'){
            $name='';
        }else{
            $name="and name='$name'";
        }
        if($major=='all'){
            $major='';
        }else{
            $major="and major='$major'";
        }
        $arr= Yii::$app->db->createCommand("select id,qid,uid from {{%collection}} where uid=".$uid)->queryOne();
        $qid=ltrim($arr['qid'],',');
        $data= Yii::$app->db->createCommand("select q.id as qid,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid) $name $major limit $offset,$pagesize")->queryAll();
        $brr['total']= count(Yii::$app->db->createCommand("select q.id as qid,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid) $name $major")->queryAll());
        foreach($data as $k=>$v){
            $brr['list'][]= array(
                'qid'      => $v['qid'],
//                'tpId'     => $v['tpId'],
                'name'     => $v['name'],
                'time'     => $v['time'],
                'major'    => $v['major'],
                'number'   => $v['number'],
                'content'  => $v['content'],
            );
        }
        $brr['totalPage'] = ceil($brr['total']/$pagesize);// 总页数

        return $brr;
    }
    // wap个人中心
    public function CateData($uid, $major, $offset, $pagesize,$p)
    {
        $arr= Yii::$app->db->createCommand("select id,qid,uid from {{%collection}} where uid=".$uid)->queryOne();
        $qid=explode(',',ltrim($arr['qid'],','));
        static $crr = array();
        static $s =array();
        foreach ($qid as $k => $v) {
            if ($v !='') {
                $key=explode(',', $v)[0];
                $crr[$key]=explode(',', $v);
                $part= Yii::$app->db->createCommand("select major,id from {{%questions}} where id=".$key)->queryOne()['major'];
                if($part=='Math1' || $part=='Math2'){
                    $s["Math"].=$key.',';
                }else{
                    $s["$part"].=$key.',';
                }
            }
        }
        $notes=new Notes();
        if($major==false){
            $data['data']['Math'] =$notes->Data('Math',$pagesize,1,$s);
            $data['data']['Reading'] = $notes->Data('Reading',$pagesize,1,$s);
            $data['data']['Writing'] =$notes->Data('Writing',$pagesize,1,$s);
        }else{
            $s[$major]=rtrim($s[$major],',');
            $data['data'] = Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in (".$s[$major].")  limit $offset,$pagesize")->queryAll();
            $data["dataTotal"] =count(Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in (".$s[$major].")  ")->queryAll());
            $data["dataCurrent"] = $p;
            $data["dataPage"] =ceil($data["dataTotal"]/$pagesize);
        }
//        var_dump($s);die;
//        static $brr = array();
//        foreach ($qid as $k => $v) {
//            if ($v != '') {
//                $arr = Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id=$v")->queryOne();
//                if ($arr['major'] == 'Math1' || $arr['major'] == 'Math2') {
//                    $brr['data']['Math'][] = $arr;
//                } elseif ($arr['major'] == 'Writing') {
//                    $brr['data']['Writing'][] = $arr;
//                } elseif ($arr['major'] == 'Reading') {
//                    $brr['data']['Reading'][] = $arr;
//                }
//            }
//        }
//        if($major==false){
//            $data['data']['Math'] =$this->Data('Math',$pagesize,0,$brr,1);
//            $data['data']['Reading'] = $this->Data('Reading',$pagesize,0,$brr,1);
//            $data['data']['Writing'] =$this->Data('Writing',$pagesize,0,$brr,1);
//        }else{
//            $data['dataTotal']=count($brr['data']["$major"]);
//            $data['dataPage']=ceil($data['dataTotal']/$pagesize);
//            $data['dataCurrent']=$p;
//            $data['data']=array_slice ($brr['data']["$major"],$offset ,$pagesize);
//        }
//        var_dump($data);die;
        return $data;

    }

    public function Data($major,$pagesize,$offset,$data,$p)
    {
        $arr["$major".'Total']=count( $data['data']["$major"]);
        $arr["$major".'Page']=ceil($arr["$major".'Total']/$pagesize);
        $arr["$major".'Current']=$p;
        $arr['data']=array_slice ($data['data']["$major"],$offset ,$pagesize);
        return $arr;
    }
}
