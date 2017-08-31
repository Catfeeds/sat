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
use app\libs\Pager;

class EvaulationController extends Controller
{
    public $layout = '';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $this->layout = 'cn.php';
        return $this->render('index');
    }
    public function actionSubject()
    {
        $this->layout = 'cn1.php';
        return $this->render('subject');
    }
    public function actionReport()
    {
        $this->layout = 'cn.php';
        return $this->render('report');
    }
}