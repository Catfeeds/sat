<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use yii;
class UserAnswer extends ActiveRecord{
    public static function tableName()
    {
        return '{{%user_answer}}';
    }

    public function AnswerKeep($time,$qid,$tid,$useranswer,$answer,$belong){
        $data['uid'] = Yii::$app->session->get('uid');
        $data['qid'] = $qid;
        $data['elapsedTime'] = $time;
        $data['tid'] = $tid;
        $data['answer'] = $answer;
        $data['createTime'] = time();
        $data['answer'] = $useranswer;
        $data['answerType'] = ($useranswer==$answer?1:0);
        $data['belong'] =$belong;
        $ua = Yii::$app->db->createCommand("select id,answer from {{%user_answer}} where uid=" .$data['uid']." and qid=".$data['qid'])->queryOne();
        if($ua['id']){
            $re = $this->updateAll($data, 'id=:id', array(':id' => $ua['id']));
        }else{
            $re = Yii::$app->db->createCommand()->insert("{{%user_answer}}", $data)->execute();
        }
        return $re;
    }
}