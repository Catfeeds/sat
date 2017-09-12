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
    $data[0] = Yii::$app->db->createCommand("select * from {{%testpaper}} where name='测评'  and time='初级卷' ")->queryOne();
    $data[1] = Yii::$app->db->createCommand("select * from {{%testpaper}} where name='测评' and time='中级卷' ")->queryOne();
    $data[2] = Yii::$app->db->createCommand("select * from {{%testpaper}} where name='测评' and time='高级卷' ")->queryOne();
//        var_dump($data);die;
    return $this->render('index', ['data' => $data]);
  }
  public function actionNotice()
  {
    $this->layout = 'cn1.php';
    $tid = Yii::$app->request->get('tid');
    $uid = Yii::$app->session->get('uid', '');
    $url = Yii::$app->request->hostInfo . Yii::$app->request->getUrl();
    if($uid==false){
      echo "<script>alert('该题目需要登录'); location.href='http://login.gmatonline.cn/cn/index?source=20&url=<?php echo $url?>'</script>";
      die;
    }
    if (isset($_SESSION['answer'])) {
      unset($_SESSION['answer']);
    }
    if (isset($_SESSION['tid'])) {
      unset($_SESSION['tid']);
    }
    return $this->render('notice', ['tid' => $tid]);
  }
  public function actionDetails()
  {
    $this->layout = 'cn1.php';
    $s = Yii::$app->request->get('s', 1);
    $tid = Yii::$app->request->get('tid');
    $data = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . $s . "   and tpId=$tid order by q.number")->queryAll();
    if ($data == false) {
      echo " <script>alert('题目正在更新中，换一套题吧！'); location.href='/mock.html'</script>";
      die;
    }
    return $this->render("subject", ['data' => $data]);
  }
  // 下一小节
  public function actionNext()
  {
    // 最后一次提交也将tid 存入session中
    $s = Yii::$app->request->post('s', 1);
    $tid = Yii::$app->request->post('id');
    $answer = Yii::$app->request->post('ans');
    $time = Yii::$app->request->post('time', '');
    session_start();
    $_SESSION['tid'] = $tid;
    $_SESSION['time'] = $time;
    static $item = array();
    foreach ($answer as $k => $v) {
      $item[$v[0]][] = $answer[$k][0];
      $item[$v[0]][] = $answer[$k][1];
    }
    if ($s == 1) {
      $_SESSION['answer']['item'] = array();
      $_SESSION['answer']['item'] = $item;
    } else {
      $_SESSION['answer']['item'] = $_SESSION['answer']['item'] + $item;
    }
    $data['data'] = Yii::$app->db->createCommand("select q.*,qe.*,q.id as qid,t.name,t.time,t.id as tid from {{%questions}} q left join {{%questions_extend}} qe on  qe.id=q.essayId left join {{%testpaper}} t on t.id=q.tpId where section=" . ($s + 1) . "   and tpId=$tid order by q.number")->queryAll();
    if ($data['data'] == false) {
      $data['code'] = 0;
      $data['message'] = '没有更多的章节了！';
      echo die(json_encode($data));
    }
    $data['code'] = 1;
    $data['section'] = $data['data'][0]['section'];
    $data['test'] = $data['data'][0]['time'];
    echo die(json_encode($data));
  }
  // 正确个数
  public function actionNumber($data)
  {
    $getScore = new GetScore();
    $number = $getScore->number($data);// $data为做题的数据
    return $number;
  }
  // 获取测评的分数
  public function actionScore($data)
  {
    $translation = Yii::$app->db->createCommand("select id,answer from {{%questions}} where  major='Translation' and tpId=" . Yii::$app->session->get('tid'))->queryAll();
    $count = 0;
    $trans = 0;
    foreach ($translation as $k => $v) {
      $answer = explode(',', $v['answer']);
      foreach ($answer as $key => $val) {
        if (strpos($val, $data[$v['id']][1]) !== false) {
          $count += 1;
        }
      }
      $trans += ($count >= 6 ? 3 : ($count > 4 ? 2 : 1));
    }
    return $trans;
  }
  // 测评报告
  public function actionReport()
  {
    $this->layout = 'cn.php';
    $id = Yii::$app->request->get('id', '');
    $uid = Yii::$app->session->get('uid', '');
    if (isset($_SESSION['answer']) && isset($_SESSION['tid'])) {
      $data = ((array)$_SESSION['answer']);
      $data = $data['item'];// 获取用户的答题数据
      $number = $this->actionNumber($data);
      $re['tpId'] = $_SESSION['tid'];
      $re['readnum'] = $number['Reading'];
      $re['mathnum'] = $number['Math'];
      $re['writenum'] = $number['Writing'];
      $re['jumpnum'] = $number['Vocabulary'];// jumpnum字段来保存词汇正确个数
      $re['part'] = Yii::$app->db->createCommand("select name from {{%testpaper}} where id=" . $re['tpId'])->queryOne()['name'] . Yii::$app->db->createCommand("select time from {{%testpaper}} where id=" . $re['tpId'])->queryOne()['time'];
      $re['uid'] = Yii::$app->session->get('uid');
      $re['matherror'] = $number['matherror'];
      $re['readerror'] = $number['readerror'];
      $re['writeerror'] = $number['writeerror'];
      $re['score'] = $this->actionScore($data) + $number['Math'] * 3 + $number['Reading'] * (30 / ($number['Reading'] + $number['readerror'])) + $number['Writing'] * 2 + $number['Vocabulary'];
      $re['date'] = time();
      $re['time'] = Yii::$app->session->get('time');// 做题总时间
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
    } else {
      $res = $this->Show($id);
    }
    if ($res == false) {
      $data['code'] = 0;
      $data['message'] = '没有评测报告';
    } else {
      $data = $res;
      $data['code'] = 1;
      $data['que'] = $this->Question($data['report']['tpId'], $res['report']['answer']);
      $data['win'] = count(Yii::$app->db->createCommand("select id from {{%report}} where part='" . $data['report']['part'] . "' and score<" . $data['report']['score'])->queryOne());
    }
    return $this->render("report", ['data' => $data]);
  }
  // 显示
  public function Show($id = '')
  {
    $uid = Yii::$app->session->get('uid');
    if ($id == false) {
      $data = Yii::$app->db->createCommand("select * from {{%report}} where uid=" . $uid . " order by id desc limit 1")->queryOne();
    } else {
      $data = Yii::$app->db->createCommand("select * from {{%report}} where id=" . $id)->queryOne();
    }
    if ($data) {
      $re['Math'] = $data['mathnum'] * 3;
      $re['Reading'] = $data['readnum'] * (30 / ($data['readerror'] + $data['readnum']));
      $re['Writing'] = $data['writenum'] * 2;
      $re['Vocabulary'] = $data['jumpnum'];
      $re['Translation'] = $data['score'] - $re['Math'] - $re['Reading'] - $re['Writing'] - $re['Vocabulary'];
      $re['score'] = $data['score'];
      $suggest = $this->Suggest($data['tpId'], $re);
      $report['score'] = $re;
      $report['suggest'] = $suggest;
      $report['report'] = $data;
      return $report;
    } else {
      echo '<script>alert("还没有报告，赶紧测评一下吧！");location.href="/evaulation.html"</script>';
      die;
    }
  }
  public function Suggest($tid, $re)
  {
    $data = Yii::$app->db->createCommand("select * from {{%testpaper}} where id=" . $tid)->queryOne();
    if ($data['time'] == '初级卷') {
      $models = "Ping01";
    } elseif ($data['time'] == '中级卷') {
      $models = "Ping02";
    } elseif ($data['time'] == '高级卷') {
      $models = "Ping03";
    }
    $suggest['Reading'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Reading'] . "  and min<" . $re['Reading'] . " and major='" . $models . "-Reading'")->queryOne();
    $suggest['Writing'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Writing'")->queryOne();
    $suggest['Math'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Math'")->queryOne();
    $suggest['Vocabulary'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Vocabulary'")->queryOne();
    $suggest['Translation'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['Writing'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-Translation'")->queryOne();
    $suggest['All'] = Yii::$app->db->createCommand("select * from {{%tactics}} where max>" . $re['score'] . "  and min<" . $re['Writing'] . " and major='" . $models . "-All'")->queryOne();
    return $suggest;
  }
  public function Question($tid, $answer)
  {
    $s = Yii::$app->db->createCommand("select id,answer,section from {{%questions}} where tpId=$tid")->queryAll();
    $arr = explode(';', $answer);
    static $brr = array();
    static $que = array();
    // 获取做题的数据
    foreach ($arr as $k => $v) {
      $key = explode(',', $v)[0];
      $brr[$key] = explode(',', $v);
      $s = Yii::$app->db->createCommand("select id,answer,section from {{%questions}} where id=$key")->queryOne();
      if ($brr[$key][1] == $s['answer']) {
        $que[$s['section']][$k][0] = 1;
        $que[$s['section']][$k][1] = $s['id'];
      } else {
        $que[$s['section']][$k][0] = 0;
        $que[$s['section']][$k][1] = $s['id'];
      }
    }
    return $que;
  }
}