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
use app\libs\GetScore;
use app\libs\Format;
use app\libs\KeepAnswer;
use app\modules\cn\models\Report;

class EvaulationController extends Controller
{
    public $layout = '';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $this->layout = 'cn.php';
        $data[0]= Yii::$app->db->createCommand("select * from {{%testpaper}} where name='测评'  and time='初级卷' ")->queryOne();
        $data[1]= Yii::$app->db->createCommand("select * from {{%testpaper}} where name='测评' and time='中级卷' ")->queryOne();
        $data[2]= Yii::$app->db->createCommand("select * from {{%testpaper}} where name='测评' and time='高级卷' ")->queryOne();
//        var_dump($data);die;
        return $this->render('index',['data'=>$data]);
    }
    public function actionNotice()
    {
        $this->layout = 'cn1.php';
        $tid = Yii::$app->request->get('tid');
        $uid = Yii::$app->session->get('uid','');
        $url=Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
/*        if($uid==false){
//            echo "<script>alert('该题目需要登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
//            die;
//        }
*/
        if(isset($_SESSION['answer'])){
            unset($_SESSION['answer']);
        }
        if(isset($_SESSION['tid'])){
            unset($_SESSION['tid']);
        }
//        $_SESSION['part']=$major;
        return $this->render('notice', ['tid' => $tid]);
    }

    public function actionDetails()
    {
//        session_start();
        $this->layout = 'cn1.php';
        $s = Yii::$app->request->get('s',1);
        $tid = Yii::$app->request->get('tid');
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $s . "   and tpId=$tid order by q.number")->queryAll();
        if($data==false){
            echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";die;
        }
//        var_dump($data);die;
        return $this->render("subject", ['data' => $data]);
    }

    // 下一小节
    public function actionNext()
    {
        // 最后一次提交也将tid 存入session中
        $s      = Yii::$app->request->post('s',1);
        $tid    = Yii::$app->request->post('id');
        $answer = Yii::$app->request->post('ans');
        $time   = Yii::$app->request->post('time','');
        session_start();
        $_SESSION['tid']=$tid;
//        $answer=array(array(51,'D'),array(52,'D'),array(53,'D'),array(54,'D'));
        static $item=array();
        foreach($answer as $k=>$v){
            $item[$v[0]][]=$answer[$k][0];
            $item[$v[0]][]=$answer[$k][1];
        }
        if($s==1){
            $_SESSION['answer']['item']=array();
            $_SESSION['answer']['item']=$item;
        }else{
            $_SESSION['answer']['item']=$_SESSION['answer']['item']+$item;
        }
        $data['data'] = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . ($s+1) . "   and tpId=$tid order by q.number")->queryAll();
        if($data['data']==false){
            $data['code']=0;
            $data['message']='没有更多的章节了！';
            echo die(json_encode('data'));
        }
        $data['code']=1;
        $data['section']=$data['data'][0]['section'];
//        $score=$this->actionScore($item);
        var_dump($_SESSION);die;
       echo die(json_encode($data));
    }

    // 正确个数
    public function actionNumber($data)
    {
        $getScore=new GetScore();
        $number=$getScore->number($data);// $data为做题的数据
        return $number;
    }

    // 获取测评的分数
    public function actionScore($data)
    {
        $number=$this->actionNumber($data);
        // 翻译的分数
        $translation= Yii::$app->db->createCommand("select id,answer from {{%questions}} where  major='Translation' and tpId=".Yii::$app->session->get('tid'))->queryAll();
        $count=0;
        $vocabulary=0;
        foreach($translation as $k=>$v){
            $answer=explode(',',$v['answer']);
            foreach($answer as $key=>$val){
                if(strpos($val,$data[$v['id']][1])!==false){
                    $count+=1;
                }
            }
            $vocabulary+=$count>=6?3:($count>4?2:1);
        }
        $vocabulary=$number['vocabularynum']+$vocabulary;
        $score=$number['mathnum']*3+$number['readnum']*3+$number['writnum']*2+$vocabulary;
        return $score;

    }

    // 测评报告
    public function actionReport()
    {
        $id = Yii::$app->request->get('id','');
        $uid = Yii::$app->session->get('uid','');
        if($id==false){
            $data  = ((array)$_SESSION['answer']);
            $data  = $data['item'];// 获取用户的答题数据
            $re['tpId']       = $_SESSION['tid'];
            $re['readnum']    = $this->actionNumber($data)['Reading'];
            $re['mathnum']    = $this->actionNumber($data)['Math'];
            $re['writenum']   = $this->actionNumber($data)['Writing'];
            $re['part']       = Yii::$app->db->createCommand("select name from {{%testpaper}} where id=".$re['tpId'])->queryOne()['name'].Yii::$app->db->createCommand("select time from {{%testpaper}} where id=".$re['tpId'])->queryOne()['time'];
            $re['uid']        = Yii::$app->session->get('uid');
            $re['matherror']  = 10-$re['mathnum'] ;
            $re['readerror']  = 10-$re['readnum'];
            $re['writeerror'] = 10-$re['writenum'];
            $re['score']      = $this->actionScore($data);
            $re['date']       = time();
            $re['time']       = Yii::$app->session->get('time');// 做题总时间
            if ($uid) {
                // 将答案组合成字符串
                $format = new Format();
                $re['answer'] = $format->arrToStr($data);
                if ($re['answer'] != false && $re['time'] != false) {
                    $res = Yii::$app->db->createCommand()->insert("{{%report}}", $re)->execute();
                    if ($res) {
                        unset($_SESSION['answer']);
                        unset($_SESSION['tid']);
                    }//入库完成
                }
            }

            $res = $this->Show('');
        }else{

            $res = $this->Show($id);
        }

    }

    // 显示
    public function Show($id){
        $uid = Yii::$app->session->get('uid');
        if($id==false){
            $data = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid. " order by id desc limit 1")->queryOne();
        }else{
            $data = Yii::$app->db->createCommand("select * from {{%report}} where id=" . $id)->queryOne();
        }
        if($data){
            $re['Math']=$data['mathnum']*3;
            $re['Reading']=$data['Reading']*3;
            $re['Writing']=$data['Writing']*2;
            $re['Vocabulary']=$data['score']-$re['Math']-$re['Reading']-$re['Writing'];
            $suggest['Math']    = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Math']  . "  and min<" . $re['Math'] . " and major='Math'")->queryOne();
            $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Reading']  . "  and min<" . $re['Reading'] . " and major='Reading'")->queryOne();
            $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Writing']  . "  and min<" . $re['Writing']." and major='Writing'")->queryOne();
            $suggest[''] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Writing']  . "  and min<" . $re['Writing']." and major='Writing'")->queryOne();
            array_push($re,$suggest);
            return $re;
        }else{
            echo '<script>alert("还没有报告，赶紧做套模考题吧！");location.href="/mock.html"</script>';
            die;
        }
    }
}