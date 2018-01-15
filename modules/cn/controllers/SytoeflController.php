<?php
/**
 * Created by PhpStorm.
 * User: daicunya
 * Date: 2018/1/15
 * Time: 14:45
 */

namespace app\modules\cn\controllers;

use yii;
use yii\web\Controller;
class SytoeflController extends Controller
{
  public $layout='cn.php';
  public function actionIndex()
  {
    $data=file_get_contents('http://www.toeflonline.cn/cn/teacher/index?data-type=json');
    $data=json_decode($data,true);
    $teacher=$data['data'];
    return $this->render('index',['teacher'=>$teacher]);
  }

}