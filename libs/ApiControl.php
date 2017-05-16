<?php
/**
 * 后台接口基础类
 * by Obelisk
 */
	namespace app\libs;
    use yii;
    use yii\web\Controller;
	class ApiControl extends Controller {
//        private $m;
		public function init() {
            $this->config();
            $session  = Yii::$app->session;
            $userId   = $session->get('adminId');
//            无登录无法进入后台
            if(!$userId){
                $this->redirect('/admin/login/index');
            }
               $this->role();
		}
        public function config(){
            define('baseUrl',Yii::$app->params['baseUrl']);
            define('tablePrefix',Yii::$app->db->tablePrefix);
//            $data = Params::find()->all();
//            foreach($data as $v){
//                define($v->key,$v->value);
//            }
        }
//        @$name 类别的名称，通过父类来获取子类的id
//        public function getCate($name){
//            $I = Yii::$app->db->createCommand("select id from {{%cate}} where name='$name'")->queryOne();
//            $arr= Yii::$app->db->createCommand("select * from {{%cate}} where pid=".$I['id'])->queryAll();
//            return $arr;
//        }
//        @$position 使用的位置
        public function upImage($position){
//            允许上传的图片格式
            $config=array('arr_allow_exts'=>  array('gif','jpg','jpeg','bmp','png'),);
            $up=new \UploadFile($config);
            $savePath="./Upload/images/".$position."/";
            $file=$_FILES['up'];
            $data= $up->uploadOne($file,$savePath);
//            包含错误信息
            if($data['arr_data']['int_error']){
                die('<script>alert("上传文件失败");history.go(-1);</script>');
            }else{
                $a=$data['arr_data']['arr_data'][0];
                $path=ltrim($a['savepath'].$a['savename'],'.');
                return $path;
            }

	    }
        public function role()
        {
//            获取当前的路径与权限路径对比
            $now_path=ltrim($_SERVER['REQUEST_URI'],'/');
            $now_path=explode('?',$now_path);
            $now_path=$now_path[0];
//            var_dump($now_path) ;
            $rid  =  Yii::$app->session->get('rid');
////            根据管理员的ID，查找权限
            $path= Yii::$app->db->createCommand("select path from {{%role}} where id='$rid'")->queryOne();
            $path=$path['path'];
            if(strpos(rtrim($path,','),$now_path)===false){
                echo '<script>alert("无权限，如有需要请联系管理员");history.go(-1);</script>';
                die;
            }
        }

    }
?>