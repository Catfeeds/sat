<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use yii\web\Controller;
use app\modules\cn\models\Questions;
use app\modules\cn\models\Notes;

class ExerciseController extends Controller
{
    public $layout = 'cn.php';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {

        $model = new Questions();
        $data = $model->data();
        $str = $data['str'];
        unset($data['str']);
        $arr = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId order by q.id desc limit 6")->queryAll();
        $rank = Yii::$app->db->createCommand("select count,correctRate,nickname,username from {{%notes}} n  left join {{%user}} u on u.uid=n.uid  order by count desc,correctRate DESC limit 10")->queryAll();

//        var_dump($arr);
        return $this->render('index', ['data' => $data, 'rank' => $rank, 'page' => $str, 'arr' => $arr]);
    }

    public function actionExercise()
    {
        $id = Yii::$app->request->get('id');
        $uid = Yii::$app->session->get('uid','');
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time  from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.id=" . $id)->queryOne();
        $isLogin = Yii::$app->db->createCommand("select isLogin from {{%testpaper}} where id=" . $data['tpId'])->queryOne();
        if ($isLogin['isLogin'] == 1 && $uid == false) {
            $url = Yii::$app->request->hostInfo . Yii::$app->request->getUrl();
            echo "<script>alert('请登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
            die;
        }
        $knowledge = Yii::$app->db->createCommand("select * from {{%knowledge}} order by id desc limit 6")->queryAll();
        $question = Yii::$app->db->createCommand("select id as qid,content  from {{%questions}} limit 5")->queryAll();
        $mock = Yii::$app->db->createCommand("select id,name,time  from {{%testpaper}} limit 5")->queryAll();
        // 统计做题进程
        $major = $data['major'];
        $q= new Questions();
        $n=$q->Progress($major,$id,$data['section'],$data['tpId'],$data['essayId']);
        $nextid = Yii::$app->db->createCommand("select id from {{%questions}} where id>" . $id . " and major= '$major' and section=" . $data['section'] . " and tpId=" . $data['tpId'] . " order by id asc limit 1")->queryOne();
        $upid = Yii::$app->db->createCommand("select id from {{%questions}} where id<" . $id . " and major='$major' and section=" . $data['section'] . " and tpId=" . $data['tpId'] . " order by id desc limit 1")->queryOne();
        // 查找题目是否收藏
        $data['collection']= $q->isCollection($uid,$id);
        $data['uid'] = Yii::$app->session->get('uid');
        // 关于题目的讨论信息
        $dis=$q->getReplyData($id);
//        var_dump($dis);die;
        return $this->render('exercise', ['data' => $data, 'dis'=>$dis ,'nextid' => $nextid['id'], 'upid' => $upid['id'], 'knowledge' => $knowledge, 'question' => $question, 'mock' => $mock, 'n' => $n]);

    }

    // 将登陆用户的做题数据存入数据库
    public function actionNotes()
    {
        $answer = Yii::$app->request->post('ans');
        $time = Yii::$app->request->post('time');
        $qid = Yii::$app->request->post('qid');
        $up = Yii::$app->request->post('up');
        $date = time();
        $data['uid'] = Yii::$app->session->get('uid');
//        $data['uid'] = 333;
        // 计算平均时间等
        $que = Yii::$app->db->createCommand("select *  from {{%questions}} where id=" . $qid)->queryOne();
        $model = new Questions();
        $re = $model->avg($answer, $time, $que);
        // 将做题的数据存入数据库
        $data['notes'] = $qid . ',' . $answer . ',' . $time . ',' . $date . ';';
        if ($data['uid']) {
            $arr = Yii::$app->db->createCommand("select * from {{%notes}} where uid=" . $data['uid'])->queryOne();
            if (!$arr) {
                $data['count'] = 1;
                $answer == $que['answer'] ? $data['correctRate'] = 100 : $data['correctRate'] = 0;
                $re = Yii::$app->db->createCommand()->insert("{{%notes}}", $data)->execute();
            } else {
                $model = new Notes();
                $data['count'] = $arr['count'] + 1;
                $arr['correctRate'] == 0 ? $correct = 0 : ($correct = $arr['correctRate'] * $arr['count'] / 100);
                if ($answer == $que['answer']) {
                    $data['correctRate'] = ($correct + 1) / $data['count'] * 100;
                } else {
                    $data['correctRate'] = $correct / $data['count'] * 100;
                }

                $data['notes'] = $arr['notes'] . $qid . ',' . $answer . ',' . $time . ',' . $date . ';';
                $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }

        }
        if ($up == 'next') {
            $res = Yii::$app->db->createCommand("select id from {{%questions}} where id>" . $qid . " and major='" . $que['major'] . "' and section=" . $que['section'] . " and tpId=" . $que['tpId'] . " order by id asc limit 1")->queryOne();
        } else {
            $res = Yii::$app->db->createCommand("select id from {{%questions}} where id<" . $qid . " and major='" . $que['major'] . "' and section=" . $que['section'] . " and tpId=" . $que['tpId'] . " order by id desc limit 1")->queryOne();
        }
//        var_dump($res);
        echo die(json_encode($res));
    }

    public function actionDiscuss()
    {
        $data['uid']        = Yii::$app->request->get('uId');
        $data['uid']        = 32;
        $data['qid']        = Yii::$app->request->get('qId');
        $data['detail']     = strip_tags(Yii::$app->request->get('cnt'));
        $data['pid']        = Yii::$app->request->get('pId');// 被回复的id
        $data['createTime'] = time();
        //将获取的数据保存到数据库
        if($data['uid']==false){
            $url = Yii::$app->request->hostInfo . Yii::$app->request->getUrl();
            echo "<script>alert('请登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
            die;
        }else{
            $arr = Yii::$app->db->createCommand("select nickname,username from  {{%user}} where uid=" .$data['uid'])->queryOne();
//            var_dump($data['pid']);
            if($data['detail']==false){
                $res['code'] = 0;
                $res['num']  = 3;
                $res['message'] = '请输入内容';
                die(json_encode($res));
            }else{
                $re = Yii::$app->db->createCommand()->insert("{{%reply}}", $data)->execute();
                $rid= (array)(Yii::$app->db->createCommand("SELECT LAST_INSERT_ID()")->queryOne());
                $id=$rid['LAST_INSERT_ID()'];
                if($re){
                    $res['code'] = 1;
                    $res['message'] = '回复成功';
                }else{
                    $res['code'] = 0;
                    $res['message'] = '回复失败，请重试！';
                }
                if($data['pid']==0){
                    $res['num']=1;
                    $res['pid']=0;
                }else{
                    $res['num']=2;
                    $res['pid']=$data['pid'];
                }
                $res['id']=$id;
                $res['nickname']=$arr['nickname'];
                $res['username']=$arr['username'];
                $res['content']=$data['detail'] ;
                $res['floor']=count(Yii::$app->db->createCommand("select id from  {{%reply}} where pid=0 and qid=".$data['qid'])->queryAll());
                $res['time']=date('Y-m-d H:i:s',$data['createTime']);
                echo die(json_encode($res));
            }
        }

    }

}