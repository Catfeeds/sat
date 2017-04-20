<?php

namespace app\controllers;

use Yii;
use app\libs\ApiControl;


class IndexController extends ApiControl
{

    public function actionIndex()
    {
        $userId = Yii::$app->session->get('adminId');
        if(!$userId){
            $this->redirect('/user/login/index');
        }else{
            return $this->render('index');
        }
    }

//    public function actionIndex()
//    {
////        $userId = Yii::$app->session->get('adminId');
////        if(!$userId){
////            $this->redirect('/user/login/index');
////        }else{
////            return $this->render('index');
////        }
//         return $this->renderPartial('index');
//    }
//
//    public function actionAbout()
//    {
////        $userId = Yii::$app->session->get('adminId');
////        if(!$userId){
////            $this->redirect('/user/login/index');
////        }else{
////            return $this->render('index');
////        }
//        return $this->renderPartial('about');
//    }
//
//    public function actionContact()
//    {
////        $userId = Yii::$app->session->get('adminId');
////        if(!$userId){
////            $this->redirect('/user/login/index');
////        }else{
////            return $this->render('index');
////        }
//        return $this->renderPartial('contact');
//    }

}
