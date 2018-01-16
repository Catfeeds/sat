<?php
/**
 * Created by PhpStorm.
 * User: daicunya
 * Date: 2018/1/15
 * Time: 14:47
 */

namespace app\modules\cn\controllers;

use yii;
use yii\web\Controller;
class SygmatController extends Controller
{
  public $layout='cn.php';
  public function actionIndex()
  {
    $data=file_get_contents('http://www.thinkwithu.com/cn/api/start-class?source="sat"');
//    $data=file_get_contents('http://thinku.com/cn/api/start-class?source="sat"');
    $data=json_decode($data,true);
    return $this->render('index',['data'=>$data]);
  }
}