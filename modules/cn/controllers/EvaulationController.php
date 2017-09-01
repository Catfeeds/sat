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

class EvaulationController extends Controller
{
    public $layout = ' ';
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
        $isLogin= Yii::$app->db->createCommand("select isLogin from {{%testpaper}} where id=".$tid)->queryOne();
        $url=Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
        if($uid==false && $isLogin['isLogin']==1){
            echo "<script>alert('该题目需要登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
            die;
        }
        if(isset($_SESSION['answer'])){
            unset($_SESSION['answer']);
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
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $s . "   and tpId=$tid order by q.number")->queryAll();
        if($data==false){
            echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";die;
        }
        return $this->render("details", ['data' => $data]);
    }
    public function actionNext()
    {
        //接收数据
        $s = Yii::$app->request->post('s',1)+1;
        $tid = Yii::$app->request->post('tid');
        $answer = Yii::$app->request->post('answer');
        $time = Yii::$app->request->post('s');
        $this->layout = 'cn1.php';
        $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $s . "   and tpId=$tid order by q.number")->queryAll();
        if($data==false){
            echo die(json_encode('rep'));
        }
       echo die(json_encode($data));
    }
    public function actionNumber($data)
    {
        $getScore=new GetScore();
        $number=$getScore->number($data);// $data为做题的数据
        return $number;
    }
    public function actionScore()
    {
        $number=$this->actionNumber($data);
        $score=$number['mathnum']*3+$number['readnum']*3+$number['writnum']*2+$number['vocabulary'];

    }
}