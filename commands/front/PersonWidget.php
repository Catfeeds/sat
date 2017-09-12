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
        {//这个可以取侧边栏数
//            $this->udata();
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
//            $uid=14329;
//            $arr= Yii::$app->db->createCommand("select * from {{%notes}} where uid=".$uid)->queryOne();
//            if($arr['notes'] != false) {
//                $brr = explode(';', $arr['notes']);
//                static $crr = array();
//                static $s ='';
//                foreach ($brr as $k => $v) {
//                    if ($v !='') {
//                        $key=explode(',', $v)[0];
//                        $crr[$key]=explode(',', $v);
//                        $s.=$key.',';
//                    }
//
//                }
//                $qid=rtrim($s,',');
//                $data= Yii::$app->db->createCommand("select q.id as qid,q.answer,q.number,q.content,q.major ,t.name,t.time from {{%questions}} q left join {{%testpaper}} t on q.tpId=t.id where q.id in ($qid)")->queryAll();
//                static $n=0;
//                foreach($data as $k=>$v){
//                    if($v['answer']==$crr[$v['qid']][1]){
//                        $n+=1;
//                    }
//                }
//
//            }else{
//                $crr=array();
//                $data=array();
//                $n=0;
//            }
//            $crr['n']=$n;
            $crr = Yii::$app->db->createCommand("select count,correctRate,nickname,username from {{%notes}} n  left join {{%user}} u on u.uid=n.uid  where n.uid=$uid")->queryOne();
            return $crr;

        }
        public function url(){
            $this->now_path=ltrim($_SERVER['REQUEST_URI'],'/');
        }

    }
?>

