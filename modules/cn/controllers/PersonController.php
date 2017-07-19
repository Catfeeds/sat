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


class PersonController extends Controller
{
    public $layout='cn.php';
    public function actionCollect(){
        return $this->render('person_collect');
    }
    public function actionExercise(){
        return $this->render('person_exercise');
    }
    public function actionMock(){
        return $this->render('person_mock');
    }
}