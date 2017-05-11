<?php
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use yii;
class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%student_case}}';
    }
    public function rules()
    {
        return [
            // username and password are both required
            [['name','introduction','','subject'], 'required'],

        ];
    }
    public function add(){
        $caseDate= Yii::$app->request->post('case');
        $caseDate['id'] = Yii::$app->request->post('id','');
        $caseDate['name'] = Yii::$app->request->post('name','');
        $caseDate['gender'] = Yii::$app->request->post('gender','');
        $caseDate['school'] = Yii::$app->request->post('school','');
        $caseDate['major'] = Yii::$app->request->post('major','');
        $caseDate['grade'] = Yii::$app->request->post('grade','');
        $caseDate['direction'] = Yii::$app->request->post('direction','');
        $caseDate['teacher'] = Yii::$app->request->post('teacher','');
        $caseDate['gpa'] = Yii::$app->request->post('gpa','');
        $caseDate['tofel'] = Yii::$app->request->post('tofel','');
        $caseDate['gmat'] = Yii::$app->request->post('gmat','');
        $caseDate['matriculate'] = Yii::$app->request->post('matriculate','');
        $caseDate['content'] = Yii::$app->request->post('content','');
        return $caseDate;
    }
}