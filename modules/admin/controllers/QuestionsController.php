<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11 0011
 * Time: 14:04
 */
namespace app\modules\admin\controllers;

use yii;
use app\libs\ApiControl;
use app\modules\admin\models\QuestionsExtend;
use app\modules\admin\models\Questions;
use app\modules\admin\models\Paper;
use app\libs\GetData;
use app\libs\Pager;

class QuestionsController extends ApiControl
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        // 从数据库获取数据
        $data = Yii::$app->db->createCommand("select * from {{%questions_extend}} order by id desc")->queryAll();
        $arr= Yii::$app->db->createCommand("select * from {{%questions}} order by id desc")->queryAll();
        return $this->render('index', ['data' => $data,'arr'=>$arr]);
    }

    public function actionAdd()
    {
        $apps = Yii::$app->request;
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            // 取出试卷的名称
            $arr = Yii::$app->db->createCommand("select * from {{%testpaper}}")->queryAll();
//            var_dump($arr);die;
            if ($id == '') {
                return $this->render('add', ['arr' => $arr]);
            } else {
                $data= Yii::$app->db->createCommand("select * from {{%questions}} where id=" . $id)->queryOne();
                return $this->render('add', ['data' => $data, 'arr' => $arr]);
            }
        } else {
            // 添加数据到数据
            $model = new Questions();
            $getdata = new GetData();
            $must = array('content' => '题目','tpId'=>'试卷','section'=>'所属的小节');
            $data = $getdata->PostData($must);
//            var_dump($data);die;
            if ($data['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%questions}}", $data)->execute();
            } else {
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                echo '<script>alert("数据\修改成功")</script>';
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加\修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    // ajax删除数据
    public function actionDel()
    {
        $id = Yii::$app->request->get('id', '');
        $re = Questions::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }
    public function actionDel2()
    {
        $id = Yii::$app->request->get('id', '');
        $re = QuestionsExtend::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }

    // 展示试卷
    public function actionTestpaper()
    {
        $data = Yii::$app->db->createCommand("select * from {{%testPaper}} ")->queryAll();
        return $this->render('testpaper', ['data' => $data]);
    }

    // 添加试卷信息
    public function actionAdd_testpaper()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            if ($id == '') {
                return $this->render('add_testpaper');
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%testpaper}} where id=" . $id)->queryOne();
                return $this->render('add_testpaper', ['data' => $data]);
            }
        } else {
            $model = new Paper();
//            $model = new TestPaper();
            $getdata = new GetData();
            $must = array('name' => '试卷名称');
            $data = $getdata->PostData($must);
            if ($data['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%testpaper}}", $data)->execute();
            } else {
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                $this->redirect('testpaper');
            } else {
                echo '<script>alert("数据修改失败，请重试");history.go(-1);</script>';
                die;
            }
        }
    }

    public function actionDel_testpaper()
    {
        $id = Yii::$app->request->get('id', '');
        $re = TestPaper::deleteAll("id=:id", array(':id' => $id));
        if ($re) {
            echo true;
        }
    }

    public function actionExtend()
    {
        if (!$_POST) {
            $id = Yii::$app->request->get('id', '');
            $arr = Yii::$app->db->createCommand("select * from {{%testpaper}}")->queryAll();
            if ($id == '') {
                return $this->render('questions_extend',['arr'=>$arr]);
            } else {
                $data = Yii::$app->db->createCommand("select * from {{%questions_extend}} where id=" . $id)->queryOne();
                return $this->render('questions_extend', ['data' => $data,'arr'=>$arr]);
            }
        } else {
            $getdata = new GetData();
            $model = new QuestionsExtend();
            $must = array('essay' => '短文');
            $data = $getdata->PostData($must);
            if ($data['id'] == '') {
                $re = Yii::$app->db->createCommand()->insert("{{%questions_extend}}", $data)->execute();
            } else {
                $re = $model->updateAll($data, 'id=:id', array(':id' => $data['id']));
            }
            if ($re) {
                echo '<script>alert("数据添加成功")</script>';
                $this->redirect('index');
            } else {
                echo '<script>alert("数据添加失败，请重试");history.go(-1);</script>';
                die;
            }

        }
    }
    public function actionContent()
    {
        $pagesize = 15;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $count = Yii::$app->db->createCommand("select count(*) as count from {{%questions}} ")->queryOne();
        $arr= Yii::$app->db->createCommand("select * from {{%questions}} order by id desc limit $offset,$pagesize")->queryAll();
        $url='/admin/questions/content?p';
        $count = $count['count'];
        $page = new Pager("$url", $count, $page, $pagesize);
        $str = $page->GetPager();


        return $this->render('content', ['str' => $str,'arr'=>$arr]);
    }
    public function actionTopic()
    {
//        $data = Yii::$app->db->createCommand("select * from {{%questions_extend}} order by id desc")->queryAll();

        $pagesize = 5;
        $page = Yii::$app->request->get('p', 1);
        $offset = $pagesize * ($page - 1);
        $count = Yii::$app->db->createCommand("select count(*) as count from {{%questions_extend}} ")->queryOne();
        $data = Yii::$app->db->createCommand("select qe.*,t.name,t.time from {{%questions_extend}} qe left join {{%testpaper}} t on t.id=qe.tid order by id desc limit $offset,$pagesize")->queryAll();
        $url='/admin/questions/topic?p';
        $count = $count['count'];
        $page = new Pager("$url", $count, $page, $pagesize);
        $str = $page->GetPager();
        return $this->render('topic', ['data' => $data,'str'=>$str]);
    }
}
