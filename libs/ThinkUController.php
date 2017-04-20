<?php
namespace app\libs;
use yii;
use yii\web\Controller;
use app\models\Login;
use app\modules\basic\models\Params;
class ThinkUController extends Controller {
    public function init() {
        $this->config();
        $session  = Yii::$app->session;
        $userId = $session->get('userId','');
    }

    public function config(){
        define('baseUrl',Yii::$app->params['baseUrl']);
        define('tablePrefix',Yii::$app->db->tablePrefix);
        $data = Params::find()->all();
        foreach($data as $v){
            define($v->key,$v->value);
        }
    }

    public function exitData($arr,$dataType,$view=""){
        if($dataType == "arr"){
            return $this->renderPartial($view,$arr);
        }else{
            die(json_encode($arr));
        }
    }

}
?>