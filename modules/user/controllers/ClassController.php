<?php
/**
 * 公开课报名管理
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\user\controllers;


use yii;
use app\libs\AppControl;
use app\libs\Method;
use app\modules\user\models\Collect;

class ClassController extends AppControl {
    public $enableCsrfValidation = false;
    //用户列表
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page',1);
        $beginTime = strtotime(Yii::$app->request->get('beginTime',''));
        $endTime = strtotime(Yii::$app->request->get('endTime',''));
        $id  = Yii::$app->request->get('id','');
        $contentId  = Yii::$app->request->get('contentId','');
        $userId  = Yii::$app->request->get('userId','');
        $where="1=1";
        if($beginTime){
            $where .= " AND tc.createTime>=$beginTime";
        }
        if($endTime){
            $where .= " AND tc.createTime<=$endTime";
        }
        if($id){
            $where .= " AND tc.id = $id";
        }
        if($contentId){
            $where .= " AND tc.contentId = $contentId";
        }
        if($userId){
            $where .= " AND tc.userId = $userId";
        }
        $model = new Collect();
        $data = $model->getAllClass($where,10,$page);
        $page = Method::getPagedRows(['count'=>$data['count'],'pageSize'=>10, 'rows'=>'models']);
        return $this->render('index',['page' => $page,'data' => $data['data'],'block' => $this->block]);
    }

    /**
     * 添加资源
     * @return string
     * @Obelisk
     */
    public function actionAddBlock(){
        $model = new UserBlock();
        if($_POST){
            $id = Yii::$app->request->post('id');
            $block = Yii::$app->request->post('block');
            $model->deleteAll("userId = $id");
            $blockArr = explode(",",$block);
            foreach($blockArr as $v){
                $model = new UserBlock();
                $model->userId = $id;
                $model->blockId = $v;
                $model->save();
            }
            $this->redirect("/user/user/index");
        }else{
            $id = Yii::$app->request->get('id');
            $data = $model->find()->where("userId = $id")->all();
            $blockArr = [];
            foreach($data as $v){
                $blockArr[]=$v['blockId'];
            }
            $blockArr = implode(",",$blockArr);
        }
        return $this->render('addBlock',['block' => $blockArr,'id' => $id]);
    }

    /**
     * 删除用户
     * @return string
     * @Obelisk
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $url = $_GET['url'];
        User::findOne($id)->delete();
        $this->redirect($url);
    }

    /**
     * 修改用户信息
     * @return string
     * @Obelisk
     */
    public function actionUpdate(){
        if($_POST){
            $user = Yii::$app->request->post('user');
            $id = Yii::$app->request->post('id');
            foreach($user as $k=>$v){
                if($k != 'image' || $v != ''){
                    $sign = User::find()->where("$k='$v' AND id!=$id")->one();
                    if($sign){
                        die('<script>alert("'.$k.'已被使用");history.go(-1);</script>');
                    }
                }
            }
            $sign = User::findOne($id);
            $userPass = Yii::$app->request->post('userPass');
            if($sign->userPass != $userPass){
                $user['userPass'] = md5($userPass);
            }
            $sign = User::updateAll($user,"id=$id");
            if($sign){
                $this->redirect('/user/user/index');
            }else{
                die('<script>alert("保存失败，请重试");history.go(-1);</script>');
            }
        }else{
            $id = Yii::$app->request->get('id');
            $data = User::findOne($id);
            return $this->render('update',['data' => $data,'id' => $id]);
        }
    }
}