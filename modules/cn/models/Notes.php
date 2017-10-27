<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class Notes extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%notes}}';
    }
    // 做题时重复题目重新记录数据
//    public function note(){
    // 若题目已答，更改答案
//                if ($arr['notes'] != false) {
//                    $brr = explode(';', $arr['notes']);
//                    static $crr = array();
//                    foreach ($brr as $k => $v) {
//                        if ($v != false) {
//                            $key = $v[0];
//                            $crr[$key] = explode(',', $v);
//                        }
////                        array_push($crr,explode(',',$v));
//                    }
//
//                    if (array_key_exists($qid, $crr)) {
//                        $crr[$qid][1] = $answer;
//                        $crr[$qid][2] = $time;
//                    } else {
//                        $crr[$qid][0] = $qid;
//                        $crr[$qid][1] = $answer;
//                        $crr[$qid][2] = $time;
//                    }
//
//                    // 将数组组装成字符串
//                    static $temp = array();
//                    foreach ($crr as $v) {
//                        $v = join(",", $v); //可以用implode将一维数组转换为用逗号连接的字符串
//                        $temp[] = $v;
//                    }
//                    $t = "";
//                    foreach ($temp as $v) {
//                        $t .= $v . ";";
//                    }
//                    $t = substr($t, 0, -1);
//                    $data['notes'] = $t;
////                    var_dump($t);
//                }else{
//                    $data['notes']=$qid.','.$answer.','.$time.';';
//                }

//
//    }
    // 根据条件取数据
    public function Ex($uid,$name,$major,$error,$offset,$pagesize,$p)
    {
        $arr= Yii::$app->db->createCommand("select uid,notes,count,correctRate from {{%notes}} where uid=".$uid)->queryOne();
        if ($arr['notes'] != false) {
            $brr = explode(';', $arr['notes']);
            static $crr = array();
            static $s ='';
            foreach ($brr as $k => $v) {
                if ($v !='') {
                    $key=explode(',', $v)[0];
                    $crr[$key]=explode(',', $v);
                    $s.=$key.',';
                }

            }
        }
        $qid=rtrim($s,',');
        if($major=='Math'){
            $major="and (major='Math1' or major='Math2')";
        }elseif($major=='all'){
            $major="";
        }else{
            $major="and major='$major'";
        }
        if($name=='all'){$name='';}
        $where=(($name!=false)?"and t.name='$name'":'').(($major!=false)?" $major ":'');
        if($error=='all'){
            static $data = array();
            $qe = Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid) $where limit $offset,$pagesize")->queryAll();
            $total= count(Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid) $where")->queryAll());
                foreach($qe as $k=>$v) {
                    if($crr[$v['qid']][0]==$v['qid']){
                        array_push($v,$crr[$v['qid']][1]);
                        array_push($v,$crr[$v['qid']][2]);
                        array_push($v,$crr[$v['qid']][3]);
                        array_push($data,$v);
                    }
                }

        }else{
            static $a = array();
            foreach($crr as $k=>$v){
                $qe=Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid) $where and answer!= '$v[1]' ")->queryOne();
                if($qe){
                    array_push($qe,$v[1]);
                    array_push($qe,$v[2]);
                    array_push($qe,$v[3]);
                    array_push($a,$qe);
                }
            }
            $total=count($a);
            static $data = array();
            foreach($a as $k=>$v){
                if($k>=$offset && $k<=$offset+$pagesize){
                    array_push($data,$v);
                }
            }

        }
        if($data){
            foreach($data as $k=>$v){
                $question['list'][]= array(
                    'qid'     => $v['qid'],
                    'name'    => $v['name'],
                    'time'    => $v['time'],
                    'major'   => $v['major'],
                    'number'  => $v['number'],
                    'content' => $v['content'],
                    0         =>$v[0],
                    1         =>$v[1],
                    2         =>$v[2],
                );
            }
        }else{
            $question='';
        }
        $question['total']=$total;
        return $question;
    }

    // 个人中心题目
    public function Details($major,$p)
    {
        $uid = Yii::$app->session->get('uid');
        $uid=14329;
        $arr= Yii::$app->db->createCommand("select uid,notes,count,correctRate from {{%notes}} where uid=".$uid)->queryOne();
        if ($arr['notes'] != false) {
            $brr = explode(';', $arr['notes']);
            static $crr = array();
            static $s =array();
            foreach ($brr as $k => $v) {
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
        }
        $pagesize=20;
        $data['data']['Math'] =$this->Data('Math',$pagesize,1,$s);
        $data['data']['Reading'] = $this->Data('Reading',$pagesize,1,$s);
        $data['data']['Writing'] =$this->Data('Writing',$pagesize,1,$s);
        $data['data']['all'] = $this->Data('ALL',$pagesize,1,$s);
        $data['data'][$major] = $this->Data($major,$pagesize,$p,$s);
//        echo'<pre>';
//        var_dump($data);
//        echo '</pre>';die;
        return $data;
    }

    private function Data($major,$pagesize,$p,$s){
        $offset = $pagesize * ($p - 1);
        if($major=='all'){
            $s['ALL']=rtrim($s['Math'].$s['Reading'].$s['Writing'],',');
        }
        if($s[$major]!=false){
            $s[$major]=rtrim($s[$major],',');
            $data['data'] = Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in (".$s[$major].")  limit $offset,$pagesize")->queryAll();
            $data["$major"."Total"] =count(Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in (".$s[$major].")  ")->queryAll());
            $data["$major"."Page"] =ceil($data["$major"."Total"]/$pagesize);
        }else{
            $data=array();
        }
        return $data;
    }
}