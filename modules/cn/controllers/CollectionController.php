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
    public function actionCollection()
    {
        $data['qid'] =(string)Yii::$app->request->get('subID', '');
        $data['uid'] =(string)Yii::$app->request->get('uid', '');
        $flag=(string)Yii::$app->request->get('val');
        $model=new Collection();
        // 查找 uid 是否存在
        $arr= Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=".$data['uid'])->queryOne();
        if($flag=='0'){
            if(!$arr){
                $re = Yii::$app->db->createCommand()->insert("{{%collection}}", $data)->execute();
            }else{
                if(strpos($arr['qid'],$data['qid'])===false){
                    $data['qid']=$arr['qid'].','.$data['qid'];
                    $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
                }
            }
            if($re){
                $res['message']='收藏成功';
                $res['code']=1;
            }else{
                $res['message']='收藏失败';
                $res['code']=0;
            }
            die(json_encode($res));
        }elseif($flag=='1'){
                $data['qid']=str_replace(','.$data['qid'],' ',$arr['qid']);
                $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
                if($re){
                    $res['message']='取消成功';
                    $res['code']=1;
                }else{
                    $res['message']='取消失败';
                    $res['code']=0;
                }
                die(json_encode($res));
//            }
        }


    }

    public function actionDetails()
    {
        $data['qid'] = (string)Yii::$app->request->post('qid', '');
        $data['uid']=Yii::$app->session->get('userId');
        $model=new Collection();
        $arr= Yii::$app->db->createCommand("select qid,id from {{%collection}} where uid=".$data['uid'])->queryOne();
        if(!$arr){
            $res['message']='您并未收藏该题';
            $res['code']=0;
            die(json_encode($res));
        }else{
            $data['qid']=str_replace($data['qid'],'',$arr['qid']);
            $re = $model->updateAll($data, 'id=:id', array(':id' => $arr['id']));
            if($re){
                $res['message']='取消成功';
                $res['code']=1;
            }else{
                $res['message']='取消失败';
                $res['code']=0;
            }
            die(json_encode($res));
        }
    }
}