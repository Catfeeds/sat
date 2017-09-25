<?php
namespace app\modules\cn\models;

use yii\db\ActiveRecord;
use yii;
use app\libs\Pager;

class Questions extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%questions}}';
    }

    // 练习二级页面分页逻辑
    public function data()
    {
        $major = Yii::$app->request->get('m', 'Reading');
        if ($major == 'Reading' || $major == 'Math' || $major == 'Writing') {
            if ($major == 'Math') {
                $m = "major = 'Math1' or major='Math2'";
            } else {
                $m = "major = '$major'";
            }
            $cate = Yii::$app->request->get('c', '');
            $now_path = ltrim($_SERVER['REQUEST_URI'], '/');
            // 判断地址栏参数是否存在，构建where语句
            if ($cate == false) {
                $where = "where $m";
                $url = 'exercise.html?m=' . $major . '&p';
            } else {
                $where2 = "where name='$cate'";
                $ids = Yii::$app->db->createCommand("select id from {{%testpaper}} $where2")->queryAll();
                $str = '';
                foreach ($ids as $v) {
                    $str .= $v['id'] . ',';
                }
                $str = rtrim($str, ',');
                $where = "where tpId in ($str) and ($m)";
                $url = 'exercise.html?m=' . $major . '&c=' . $cate . '&p';
//            var_dump($str);die;
            }
            $page = Yii::$app->request->get('p', 1);
            $pagesize = 10;
            $offset = $pagesize * ($page - 1);
            if (isset($str) && $str == false) {
                $data = '';
                $count = 0;
            } else {
                $data = Yii::$app->db->createCommand("select q.content,q.number,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id $where limit $offset,$pagesize")->queryAll();
                $count = Yii::$app->db->createCommand("select count(*) from {{%questions}} $where")->queryOne();
                $count = $count['count(*)'];
            }

            $page = new Pager("$url", $count, $page, $pagesize);
            $data['str'] = $page->GetPager();
            return $data;
        } else {
            return 'error';
        }
        $page = Yii::$app->request->get('p', 1);
        $pagesize = 10;
        $offset = $pagesize * ($page - 1);
        if (isset($str) && $str == false) {
            $data = '';
            $count = 0;
        } else {
            $data = Yii::$app->db->createCommand("select q.content,q.number,q.major,q.section,q.tpId,q.isFilling,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id $where limit $offset,$pagesize")->queryAll();
            $count = Yii::$app->db->createCommand("select count(*) from {{%questions}} $where")->queryOne();
            $count = $count['count(*)'];
        }
        $page = new Pager("$url", $count, $page, $pagesize);
        $data['str'] = $page->GetPager();
        return $data;
    }

    /* 做题正确率,做题时间的更新
     * @param,time每题做题时间
     * @param,answer做题答案
     * @param,data题目数据
    */
    public function avg($answer, $time, $data)
    {
        if ($answer == $data['answer']) {
            $data['correctRate'] = (($data['peopleNum'] * $data['correctRate'] / 100 + 1) / ($data['peopleNum'] + 1)) * 100;
        } else {
            $data['correctRate'] = (($data['peopleNum'] * $data['correctRate'] / 100) / ($data['peopleNum'] + 1)) * 100;
        }
        // 答题时间的计算
        $data['avgTime'] = ($data['avgTime'] * $data['peopleNum'] + $time) / ($data['peopleNum'] + 1);
        $data['correctRate'] = $data['peopleNum'] * $data['correctRate'] / ($data['peopleNum'] + 1);
        $data['peopleNum'] += 1;
//        var_dump($data);die;
        $re = $this->updateAll($data, 'id=:id', array(':id' => $data['id']));
        return $re;
    }

    /* 做题进度
    * @param,major科目
    * @param,id 题目的id
    * @param,section 题目所属的部分
    * @param,tpId 试卷id
    * @param,essayId 短文的id
    */
    public function Progress($major, $id, $section, $tpId, $essayId)
    {
        if ($essayId == false) {
            $a = 1;
            $n = 1;
        } else {
            $a = count(Yii::$app->db->createCommand("select id from {{%questions}} where id<" . $id . " and major= '$major' and section=" . $section . " and tpId=" . $tpId . " and essayId=" . $essayId)->queryAll()) + 1;
            $n = count(Yii::$app->db->createCommand("select id from {{%questions}} where major= '$major' and section=" . $section . " and tpId=" . $tpId . " and essayId=" . $essayId)->queryAll());
        }
        return "$a/$n";
    }

    /* 题目是否收藏
    * @param,uid 用户id
    * @param,qid 题目的id
    */
    public function isCollection($uid, $qid)
    {
        if ($uid) {
            $arr = Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=" . $uid)->queryOne();
            $collection = explode(',', $arr['qid']);
            if (in_array($qid, $collection)) {
                $collection = 1;
            } else {
                $collection = 0;
            }
        } else {
            $collection = 0;
        }
        return $collection;
    }

    /* 对讨论进行递归排序
    * @param,data 原始的数组
    * @param,pid  父id
    */
    public function getReplyList($data, $pid = 0)
    {
        static $arr = array();
        foreach ($data as $key => $value) {
            if ($value['pid'] == $pid) {
//                $value['lev'] = $lev;
                $arr[] = $value;
                $this->getReplyList($data, $value['id']);
            }
        }
        return $arr;
    }

    /* 对当前题目的谈论数据
    * @param,data 原始的数组
    * @param,qid  题目id
    */
    public function getReplyData($qid)
    {
        $arr = Yii::$app->db->createCommand("select re.*,u.nickname,u.username from {{%reply}} re left join {{%user}} u on u.uid=re.uid where qid=" . $qid)->queryAll();
        $data = $this->getReplyList($arr, $pid = 0);
        return $data;
    }

    public function que($major, $cate, $p, $tid, $pagesize)
    {
        if ($major == 'Math') {
            $m = "major = 'Math1' or major='Math2'";
        } else {
            $m = "major = '$major'";
        }
        // 判断$cate参数是否存在，构建where语句
        if ($cate == false  ) {
            $where = "where ($m)";
            $paper = Yii::$app->db->createCommand("select id,time,name from {{%testpaper}} where name!='测评'")->queryAll();
        } elseif($cate=='all'){
            if($tid=='all'||$tid==false){
                $where = "where ($m)";
            }else{
                $where = "where ($m) and tpId=$tid";
            }
            $paper = Yii::$app->db->createCommand("select id,time,name from {{%testpaper}} where name!='测评'")->queryAll();

        }else {
            $paper = Yii::$app->db->createCommand("select id,time,name  from {{%testpaper}} where name!='测评' and name='".$cate."'")->queryAll();
            if ($tid == false) {
                $where2 = "where name='$cate'";
                $ids = Yii::$app->db->createCommand("select id from {{%testpaper}} $where2")->queryAll();
                $str = '';
                foreach ($ids as $v) {
                    $str .= $v['id'] . ',';
                }
                $str = rtrim($str, ',');
                $where = "where tpId in ($str) and ($m)";
            }elseif($tid=='all'){
                $where = "where ($m) and t.name='".$cate."'";
            } else {
                $where = "where tpId=$tid and ($m)";
            }

        }
        $offset = $pagesize * ($p - 1);
        static $data=array();
        foreach($paper as $k=>$v){
            $data['paper'][$k][]=$paper[$k]['name'].$paper[$k]['time'];
            $data['paper'][$k][]=$paper[$k]['id'];
        }
        $data['data'] = Yii::$app->db->createCommand("select number,content,q.id as qid,t.name,t.time,major from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id $where and t.name!='测评' limit $offset,$pagesize")->queryAll();
        $data['count'] = count(Yii::$app->db->createCommand("select q.id as qid,t.name,t.time from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id $where and t.name!='测评'")->queryAll());
        $data['pagecount'] = ($data['count']!=0?ceil($data['count']/$pagesize):0);
        $data['page'] = $p;
        $data['tid'] = $tid;

        return $data;

    }
}