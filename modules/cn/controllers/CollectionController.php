<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21 0021
 * Time: 10:40
 */
namespace app\modules\cn\controllers;

use app\modules\cn\models\Collection;
use yii;
use yii\web\Controller;

class CollectionController extends Controller
{
//    public $layout = 'cn.php';
    public $enableCsrfValidation = false;
    // 收藏与取消收藏
    public function actionCollection()
    {
        $data['qid'] =(string)Yii::$app->request->post('subId', '');
        $data['uid'] =Yii::$app->request->post('uid', '');
//        $data['uid'] =222;
        $flag=Yii::$app->request->post('val');
        $model=new Collection();
        // 查找 uid 是否存在
        $arr= Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=".$data['uid'])->queryOne();
        if($flag==0){
            $data['qid'] =','.$data['qid'];
            if(!$arr){
                $re = Yii::$app->db->createCommand()->insert("{{%collection}}", $data)->execute();
            }else{
                    $data['qid']=$arr['qid'].$data['qid'];
                    $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            }
            if($re){
                $res['message']='收藏成功';
                $res['code']=1;
            }else{
                $res['message']='收藏失败';
                $res['code']=0;
            }
            die(json_encode($res));
        }elseif($flag==1){
            // 查找',qid,'存在再替换
            $qids=explode(',',$arr['qid']);
            foreach($qids as $k=>$v){
                if($v==$data['qid']){
                    unset($qids[$k]);
                    break;
                }
            }
            $data['qid']=implode(',',$qids);
            $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            if($re){
                $res['message']='取消成功';
                $res['code']=2;
            }else{
                $res['message']='取消失败';
                $res['code']=0;
            }
            die(json_encode($res));
        }
    }


}