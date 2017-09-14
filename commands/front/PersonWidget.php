<?php
/**
 * 主导航菜单组件
 */
namespace app\commands\front;
use yii\base\Widget;
use yii;;
class PersonWidget extends Widget  {
    public $session;
    public $crr;
    public $n;
    public $now_path;
    /**
     * 定义函数
     * */
    public function init()
    {
        $this->url();
    }
    /**
     * 运行覆盖程序
     * */
    public function run(){
        $crr=$this->rate();
        $user=Yii::$app->session->get('userData');
        return $this->render('person',['crr'=>$crr,'path'=>$this->now_path,'user'=>$user]);
    }
    public function rate(){
        $uid=Yii::$app->session->get('uid');
        $crr = Yii::$app->db->createCommand("select count,correctRate,nickname,username from {{%notes}} n  left join {{%user}} u on u.uid=n.uid  where n.uid=$uid")->queryOne();
        return $crr;
    }
    public function url(){
        $this->now_path=ltrim($_SERVER['REQUEST_URI'],'/');
    }
}
?>