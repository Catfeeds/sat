<?php
/**
 * 后台接口基础类
 * by Obelisk
 */
	namespace app\libs;
    use yii;
    use yii\web\Controller;
    use app\modules\basic\models\Params;
    use app\modules\basic\models\Block;
	class ApiControl extends Controller {
		public function init() {
            $this->config();
            $session  = Yii::$app->session;
            $userId   = $session->get('adminId');
            if(!$userId){
                $this->redirect('/admin/login/index');
            }
		}
// 4.12日，目前不知道这个配置嘛用
        public function config(){
            define('baseUrl',Yii::$app->params['baseUrl']);
            define('tablePrefix',Yii::$app->db->tablePrefix);
            $data = Params::find()->all();
            foreach($data as $v){
                define($v->key,$v->value);
            }
        }
//        @$name 类别的名称，通过父类来获取子类的id
        public function getCate($name){
            $I = Yii::$app->db->createCommand("select id from {{%cate}} where name='$name'")->queryOne();
            $arr= Yii::$app->db->createCommand("select * from {{%cate}} where pid=".$I['id'])->queryAll();
            return $arr;
        }
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
	}
?>