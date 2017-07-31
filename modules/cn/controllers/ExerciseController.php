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
    public $layout='cn.php';

    public function actionIndex()
    {
        $model=new Questions();
        $data=$model->data();
        $str=$data['str'];
        unset($data['str']);
        $arr = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId order by q.id desc limit 6")->queryAll();
        return $this->render('index',['data'=>$data,'page'=>$str,'arr'=>$arr]);
    }

    public function actionExercise()
    {
        $id=Yii::$app->request->get('id');
        $uid=Yii::$app->session->get('uid');
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time  from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId  left join {{%testpaper}} t on q.tpId=t.id where q.id=".$id)->queryOne();
        $isLogin=Yii::$app->db->createCommand("select isLogin from {{%testpaper}} where id=".$data['tpId'])->queryOne();
        if($isLogin['isLogin']==1&&$uid==false){
            $url=Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
            echo "<script>alert('请登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
            die;
        }
        $knowledge = Yii::$app->db->createCommand("select * from {{%knowledge}} order by id desc limit 6")->queryAll();
        $question = Yii::$app->db->createCommand("select id as qid,content  from {{%questions}} limit 5")->queryAll();
        $mock = Yii::$app->db->createCommand("select id,name,time  from {{%testpaper}} limit 5")->queryAll();
        // 统计做题的时间 和正确率
        $major=$data['major'];
        $nextid = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$id." and major= '$major' and section=".$data['section']." and tpId=".$data['tpId']." order by id asc limit 1" )->queryOne();
        if($major=='Math1'||$major=="Math2"){
            $a=1;
            $n=1;
        }else{
            $a=count(Yii::$app->db->createCommand("select id from {{%questions}} where id<".$id." and major= '$major' and section=".$data['section']." and tpId=".$data['tpId']." and essayId=".$data['essayId'] )->queryAll())+1;
            $n=count(Yii::$app->db->createCommand("select id from {{%questions}} where major= '$major' and section=".$data['section']." and tpId=".$data['tpId']." and essayId=".$data['essayId'] )->queryAll());
        }

       $upid = Yii::$app->db->createCommand("select id from {{%questions}} where id<".$id." and major='$major' and section=".$data['section']." and tpId=".$data['tpId']." order by id desc limit 1" )->queryOne();
        // 查找题目是否收藏
        $data['uid']=Yii::$app->session->get('uid');
        if($data['uid']){
            $arr= Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=".$data['uid'])->queryOne();
            $collection=explode(',',$arr['qid']);
            if(in_array($data['qid'],$collection)){
                $data['collection']=1;
            }else{
                $data['collection']=0;
            }
        }
//        var_dump($n);die;
        return $this->render('exercise',['data'=>$data,'nextid'=>$nextid['id'],'upid'=>$upid['id'],'knowledge'=>$knowledge,'question'=>$question,'mock'=>$mock,'a'=>$a,'n'=>$n]);

    }
    // 将登陆用户的做题数据存入数据库
    public function actionNotes(){
        $answer=Yii::$app->request->get('ans');
        $time=Yii::$app->request->get('time');
        $qid=Yii::$app->request->get('qid');
        $up=Yii::$app->request->get('up');
        $date=time();
        $data['uid']=Yii::$app->session->get('uid');
        $data['uid']=222;
        // 计算平均时间等
        $que = Yii::$app->db->createCommand("select *  from {{%questions}} where id=".$qid)->queryOne();
        $model=new Questions();
        $re=$model->avg($answer,$time,$que);
        // 将做题的数据存入数据库
        $data['notes']=$qid.','.$answer.','.$time.','.$date.';';
        if($data['uid']){
            $arr= Yii::$app->db->createCommand("select notes,id from {{%notes}} where uid=".$data['uid'])->queryOne();
            if(!$arr){
                $re = Yii::$app->db->createCommand()->insert("{{%notes}}", $data)->execute();
            }else {
                $model = new Notes();
                $data['notes']=$arr['notes'].$qid.','.$answer.','.$time.','.$date.';';
                $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }

        }
        if($up=='next'){
            $res = Yii::$app->db->createCommand("select id from {{%questions}} where id>".$qid." and major='".$que['major']."' and section=".$que['section']." and tpId=".$que['tpId']." order by id asc limit 1" )->queryOne();
        }else{
            $res = Yii::$app->db->createCommand("select id from {{%questions}} where id<".$qid." and major='".$que['major']."' and section=".$que['section']." and tpId=".$que['tpId']." order by id desc limit 1" )->queryOne();
        }
//        var_dump($res);
        echo die(json_encode($res));
    }

}