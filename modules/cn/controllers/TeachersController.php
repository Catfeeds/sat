<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use yii;
use yii\web\controller;
use app\libs\Pager;
use app\modules\cn\models\teachers;

class TeachersController extends Controller
{
    public $layout='cn.php';
    public function actionIndex()
    {
        $count = Yii::$app->db->createCommand("select count(*) as count from {{%teachers}} ")->queryOne();
        $count = $count['count'];
        $pagesize = 6;
        $page = Yii::$app->request->get('p', 1);
        $maxpage = ceil($count / $pagesize);
        $offset = $pagesize * ($page - 1);
        $data = Yii::$app->db->createCommand("select * from {{%teachers}} limit $offset,$pagesize")->queryAll();
        return $this->render('index', ['data' => $data, 'maxpage' => $maxpage]);
    }

    public function actionDetails()
    {
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select * from {{%teachers}} where id=$id ")->queryOne();
        $name = $data['name'];
        $arr = Yii::$app->db->createCommand("select * from {{%student_case}} where teacher='$name' limit 5")->queryAll();
        if ($arr != false) {
            $teacher = new Teachers();
            $brr = $teacher->formatting($arr);
        } else {
            $brr = array();
        }

        return $this->render('details', ["data" => $data, 'brr' => $brr]);
    }
}