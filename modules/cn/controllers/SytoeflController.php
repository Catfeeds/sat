<?php
/**
 * Created by PhpStorm.
 * User: daicunya
 * Date: 2018/1/15
 * Time: 14:45
 */

namespace app\modules\cn\controllers;


class SytoeflController
{
  public $layout='';
  public function actionIndex()
  {
    $this->layout="cn1.php";
    return $this->render('index');
  }

}