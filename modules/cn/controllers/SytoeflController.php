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
  public $layout='';
  public function actionIndex()
  {
    $this->layout="cn1.php";
    return $this->render('index');
  }

}