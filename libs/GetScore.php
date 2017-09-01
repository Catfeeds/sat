<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 9:57
 */
namespace app\libs;
use yii;
class GetScore {
    /*判断对错（各科的对错，跨学科对错个数，subscore对错个数）

    大分数
    跨学科分数
    subscore
    */
//    public $number;
    public function Number($data){
        // 获取session 里的答案与数据库的答案对比得到个数 number['math'],number['Reading']number['writing']number['math'],number['subscore'],
        // 获取session里的数据并对比
//        $data = ((array)$_SESSION['answer']);
//        $data = $data['item'];
        static $mathnum=0;
        static $readnum=0;
        static $writnum=0;
        static $vocabularynum=0;
        static $expression=0;
        static $english=0;
        static $algebra=0;
        static $analysis=0;
        static $math=0;
        static $words=0;
        static $evidence=0;
        static $social=0;
        static $science=0;
        static $kip=0;
        static $matherror=0;
        static $readerror=0;
        static $writeerror=0;
//        var_dump($data);die;
        foreach($data as $k=>$v) {
            $que = Yii::$app->db->createCommand("select * from {{%questions}}  where id=" . $k)->queryOne();
            if ($que['major'] == 'Math1' or $que['major'] == 'Math2') {
                if(strlen($que['answer'])>1){
                    $modle=new Format();
                    if(strpos('/',$que['answer'])!==false){
                        $que['answer']=$modle->FractionToFloat($que['answer']);
                    }
                    if(strpos('/',$v[1]!==false)){
                        $v[1]=$modle->FractionToFloat($v[1]);
                    }
                }
                $que['answer']= rtrim($que['answer'], 0);
                $v[1] = rtrim($v[1], 0);
                if ($v[1] == $que['answer']) {
                    $mathnum =$mathnum+ 1;
                }else{
                    $matherror+=1;
                }
            } elseif ($que['major'] == 'Reading') {
                if ($v[1] == $que['answer']) {
                    $readnum =$readnum + 1;
                }else{
                    $readerror+=1;
                }

            } elseif ($que['major'] == 'Writing') {
                if ($v[1] == $que['answer']) {
                    $writnum =$writnum + 1;
                }else{
                    $writeerror+=1;
                }

            }elseif ($que['major'] == 'Vocabulary') {
                if ($v[1] == $que['answer']) {
                    $vocabularynum =$vocabularynum + 1;
                }
            }
        }
        foreach($data as $k=>$v) {
            $que = Yii::$app->db->createCommand("select * from {{%questions}}  where id=" . $k)->queryOne();
            // subScores可能存在的两种情况
            if(strpos($que['subScores'],',')!=false){
                $que['subScores2']=explode(',',$que['subScores'])[1];
                $que['subScores']=explode(',',$que['subScores'])[0];
                if ($que['subScores'] == 'expression'||$que['subScores2']== 'expression') {
                    if ($v[1] == $que['answer']) {
                        $expression =$expression+ 1;
                    }

                } elseif ($que['subScores'] == 'english'||$que['subScores2'] == 'english') {
                    if ($v[1] == $que['answer']) {
                        $english =$english + 1;
                    }

                } elseif ($que['subScores'] == 'algebra'||$que['subScores2'] == 'algebra') {
                    if ($v[1] == $que['answer']) {
                        $algebra =$algebra + 1;
                    }

                } elseif ($que['subScores'] == 'analysis'||$que['subScores2'] == 'analysis') {
                    if ($v[1] == $que['answer']) {
                        $analysis =$analysis + 1;
                    }

                } elseif ($que['subScores'] == 'math'||$que['subScores2'] == 'math') {
                    if ($v[1] == $que['answer']) {
                        $math =$math + 1;
                    }

                } elseif ($que['subScores'] == 'words'||$que['subScores2'] == 'words') {
                    if ($v[1] == $que['answer']) {
                        $words = $words +1;
                    }

                } elseif ($que['subScores'] == 'evidence'||$que['subScores2'] == 'evidence') {
                    if ($v[1] == $que['answer']) {
                        $evidence =$evidence + 1;
                    }

                }
            }else{
                if ($que['subScores'] == 'expression') {
                    if ($v[1] == $que['answer']) {
                        $expression =$expression+ 1;
                    }

                } elseif ($que['subScores'] == 'english') {
                    if ($v[1] == $que['answer']) {
                        $english =$english + 1;
                    }

                } elseif ($que['subScores'] == 'algebra') {
                    if ($v[1] == $que['answer']) {
                        $algebra =$algebra + 1;
                    }

                } elseif ($que['subScores'] == 'analysis') {
                    if ($v[1] == $que['answer']) {
                        $analysis =$analysis + 1;
                    }

                } elseif ($que['subScores'] == 'math') {
                    if ($v[1] == $que['answer']) {
                        $math =$math + 1;
                    }

                } elseif ($que['subScores'] == 'words') {
                    if ($v[1] == $que['answer']) {
                        $words = $words +1;
                    }

                } elseif ($que['subScores'] == 'evidence') {
                    if ($v[1] == $que['answer']) {
                        $evidence =$evidence + 1;
                    }

                }
            }

        }
        foreach($data as $k=>$v){
            $que=Yii::$app->db->createCommand("select * from {{%questions}}  where id=".$k)->queryOne();
            if($que['crosstestScores']=='social'){
                if($v[1]==$que['answer']){
                    $social+=1;
                }

            }elseif($que['crosstestScores']=='science'){
                if($v[1]==$que['answer']){
                    $science+=1;
                }

            }
            if($v[1]==''){$kip+=1;}
        }
        $number['Math']=$mathnum;
        $number['Reading']=$readnum;
        $number['Writing']=$writnum;
        $number['Vocabulary']=$vocabularynum;
        $number['matherror']=$matherror;
        $number['readerror']=$readerror;
        $number['writeerror']=$writeerror;
        $number['expression']=$expression;
        $number['english']=$english;
        $number['algebra']=$algebra;
        $number['analysis']=$analysis;
        $number['math']=$math;
        $number['words']=$words;
        $number['evidence']=$evidence;
        $number['social']=$social;
        $number['science']=$science;
        $number['kip']=$kip;
       return $number;

    }
    public function Score($number)
    {
        $score['Math']=$this->Math($number);
        $score['Reading']=$this->Reading($number);
        $score['Writing']=$this->Writing($number);
        $score['total']=$score['Math']+($score['Reading']+$score['Writing'])*10;
        return $score;
    }
    public function Math($number)
    {
        if ($number['Math'] == 0 || $number['Math'] == 1) {
            $score['Math'] = 200;
            return $score['Math'];
        } elseif ($number['Math'] == 2) {
            $score['Math'] = 210;
            return $score['Math'];
        } elseif ($number['Math'] == 3) {
            $score['Math'] = 230;
            return $score['Math'];
        } elseif ($number['Math'] == 4) {
            $score['Math'] = 240;
            return $score['Math'];
        } elseif ($number['Math'] == 5) {
            $score['Math'] = 260;
            return $score['Math'];
        } elseif ($number['Math'] == 6) {
            $score['Math'] = 280;
            return $score['Math'];
        } elseif ($number['Math'] == 7) {
            $score['Math'] = 290;
            return $score['Math'];
        } elseif ($number['Math'] == 8) {
            $score['Math'] = 310;
            return $score['Math'];
        } elseif ($number['Math'] == 9) {
            $score['Math'] = 320;
            return $score['Math'];
        } elseif ($number['Math'] == 10) {
            $score['Math'] = 330;
            return $score['Math'];
        } elseif ($number['Math'] == 11) {
            $score['Math'] = 340;
            return $score['Math'];
        } elseif ($number['Math'] == 12) {
            $score['Math'] = 360;
            return $score['Math'];
        } elseif ($number['Math'] == 13) {
            $score['Math'] = 370;
            return $score['Math'];
        } elseif ($number['Math'] == 14) {
            $score['Math'] = 380;
            return $score['Math'];
        } elseif ($number['Math'] == 15) {
            $score['Math'] = 390;
            return $score['Math'];
        } elseif ($number['Math'] == 16) {
            $score['Math'] = 410;
            return $score['Math'];
        } elseif ($number['Math'] == 17) {
            $score['Math'] = 420;
            return $score['Math'];
        } elseif ($number['Math'] == 18) {
            $score['Math'] = 430;
            return $score['Math'];
        } elseif ($number['Math'] == 19) {
            $score['Math'] = 440;
            return $score['Math'];
        } elseif ($number['Math'] == 20) {
            $score['Math'] = 450;
            return $score['Math'];
        } elseif ($number['Math'] == 21) {
            $score['Math'] = 460;
            return $score['Math'];
        } elseif ($number['Math'] == 22) {
            $score['Math'] = 470;
            return $score['Math'];
        } elseif ($number['Math'] == 23 || $number['Math'] == 24) {
            $score['Math'] = 480;
            return $score['Math'];
        } elseif ($number['Math'] == 25) {
            $score['Math'] = 490;
            return $score['Math'];
        } elseif ($number['Math'] == 26) {
            $score['Math'] = 500;
            return $score['Math'];
        } elseif ($number['Math'] == 27) {
            $score['Math'] = 510;
            return $score['Math'];
        } elseif ($number['Math'] == 28 || $number['Math'] == 29) {
            $score['Math'] = 520;
            return $score['Math'];
        } elseif ($number['Math'] == 30) {
            $score['Math'] = 530;
            return $score['Math'];
        } elseif ($number['Math'] == 31) {
            $score['Math'] = 540;
            return $score['Math'];
        } elseif ($number['Math'] == 32) {
            $score['Math'] = 550;
            return $score['Math'];
        } elseif ($number['Math'] == 33 || $number['Math'] == 34) {
            $score['Math'] = 560;
            return $score['Math'];
        } elseif ($number['Math'] == 35) {
            $score['Math'] = 570;
            return $score['Math'];
        } elseif ($number['Math'] == 36) {
            $score['Math'] = 580;
            return $score['Math'];
        } elseif ($number['Math'] == 37) {
            $score['Math'] = 590;
            return $score['Math'];
        } elseif ($number['Math'] == 38 || $number['Math'] == 39) {
            $score['Math'] = 600;
            return $score['Math'];
        } elseif ($number['Math'] == 40) {
            $score['Math'] = 610;
            return $score['Math'];
        } elseif ($number['Math'] == 41) {
            $score['Math'] = 620;
            return $score['Math'];
        } elseif ($number['Math'] == 42) {
            $score['Math'] = 630;
            return $score['Math'];
        } elseif ($number['Math'] == 43) {
            $score['Math'] = 640;
            return $score['Math'];
        } elseif ($number['Math'] == 44) {
            $score['Math'] = 650;
            return $score['Math'];
        } elseif ($number['Math'] == 45) {
            $score['Math'] = 660;
            return $score['Math'];
        } elseif ($number['Math'] == 46 || $number['Math'] == 47) {
            $score['Math'] = 670;
            return $score['Math'];
        } elseif ($number['Math'] == 48) {
            $score['Math'] = 680;
            return $score['Math'];
        } elseif ($number['Math'] == 49) {
            $score['Math'] = 690;
            return $score['Math'];
        } elseif ($number['Math'] == 50) {
            $score['Math'] = 700;
            return $score['Math'];
        } elseif ($number['Math'] == 51) {
            $score['Math'] = 710;
            return $score['Math'];
        } elseif ($number['Math'] == 52) {
            $score['Math'] = 730;
            return $score['Math'];
        } elseif ($number['Math'] == 53) {
            $score['Math'] = 740;
            return $score['Math'];
        } elseif ($number['Math'] == 54) {
            $score['Math'] = 750;
            return $score['Math'];
        } elseif ($number['Math'] == 55) {
            $score['Math'] = 760;
            return $score['Math'];
        } elseif ($number['Math'] == 56) {
            $score['Math'] = 780;
            return $score['Math'];
        } elseif ($number['Math'] == 57) {
            $score['Math'] = 790;
            return $score['Math'];
        } else {
            $score['Math'] = 800;
            return $score['Math'];
        }
    }
    public function Reading($number)
    {

        if ($number['Reading'] == 0 || $number['Reading'] == 1 || $number['Reading'] == 2) {
            $score['Reading'] = 10;
            return $score['Reading'];
        } elseif ($number['Reading'] == 3) {
            $score['Reading'] = 11;
            return $score['Reading'];
        } elseif ($number['Reading'] == 4) {
            $score['Reading'] = 12;
            return $score['Reading'];
        } elseif ($number['Reading'] == 5) {
            $score['Reading'] = 13;
            return $score['Reading'];
        } elseif ($number['Reading'] == 6) {
            $score['Reading'] = 14;
            return $score['Reading'];
        } elseif ($number['Reading'] == 7 || $number['Reading'] == 8) {
            $score['Reading'] = 15;
            return $score['Reading'];
        } elseif ($number['Reading'] == 9) {
            $score['Reading'] = 16;
            return $score['Reading'];
        } elseif ($number['Reading'] == 10 || $number['Reading'] == 11) {
            $score['Reading'] = 17;
            return $score['Reading'];
        } elseif ($number['Reading'] == 12) {
            $score['Reading'] = 18;
            return $score['Reading'];
        } elseif ($number['Reading'] == 13 || $number['Reading'] == 14) {
            $score['Reading'] = 19;
            return $score['Reading'];
        } elseif ($number['Reading'] == 15 || $number['Reading'] == 16) {
            $score['Reading'] = 20;
            return $score['Reading'];
        } elseif ($number['Reading'] == 17 || $number['Reading'] == 18) {
            $score['Reading'] = 21;
            return $score['Reading'];
        } elseif ($number['Reading'] == 19 || $number['Reading'] == 20) {
            $score['Reading'] = 22;
            return $score['Reading'];
        } elseif ($number['Reading'] == 21 || $number['Reading'] == 22) {
            $score['Reading'] = 23;
            return $score['Reading'];
        } elseif ($number['Reading'] == 23 || $number['Reading'] == 24) {
            $score['Reading'] = 24;
            return $score['Reading'];
        } elseif ($number['Reading'] == 25 || $number['Reading'] == 26) {
            $score['Reading'] = 25;
            return $score['Reading'];
        } elseif ($number['Reading'] == 27 || $number['Reading'] == 28) {
            $score['Reading'] = 26;
            return $score['Reading'];
        } elseif ($number['Reading'] == 29) {
            $score['Reading'] = 27;
            return $score['Reading'];
        } elseif ($number['Reading'] == 30 || $number['Reading'] == 31) {
            $score['Reading'] = 28;
            return $score['Reading'];
        } elseif ($number['Reading'] == 32 || $number['Reading'] == 33) {
            $score['Reading'] = 29;
            return $score['Reading'];
        } elseif ($number['Reading'] == 34 || $number['Reading'] == 35) {
            $score['Reading'] = 30;
            return $score['Reading'];
        } elseif ($number['Reading'] == 36 || $number['Reading'] == 37) {
            $score['Reading'] = 31;
            return $score['Reading'];
        } elseif ($number['Reading'] == 38 || $number['Reading'] == 39) {
            $score['Reading'] = 32;
            return $score['Reading'];
        } elseif ($number['Reading'] == 40 || $number['Reading'] == 41) {
            $score['Reading'] = 33;
            return $score['Reading'];
        } elseif ($number['Reading'] == 42) {
            $score['Reading'] = 34;
            return $score['Reading'];
        } elseif ($number['Reading'] == 43 || $number['Reading'] == 44) {
            $score['Reading'] = 35;
            return $score['Reading'];
        } elseif ($number['Reading'] == 45) {
            $score['Reading'] = 36;
            return $score['Reading'];
        } elseif ($number['Reading'] == 46 || $number['Reading'] == 47) {
            $score['Reading'] = 37;
            return $score['Reading'];
        } elseif ($number['Reading'] == 48 || $number['Reading'] == 49) {
            $score['Reading'] = 38;
            return $score['Reading'];
        } elseif ($number['Reading'] == 50) {
            $score['Reading'] = 39;
            return $score['Reading'];
        } else {
            $score['Reading'] = 40;
            return $score['Reading'];
        }
    }
    public function Writing($number){

        if($number['Writing']==0||$number['Writing']==1||$number['Writing']==2||$number['Writing']==3){
            $score['Writing']=10;return $score['Writing'];
        }elseif($number['Writing']==4){
            $score['Writing']=11;return $score['Writing'];
        }elseif($number['Writing']==5){
            $score['Writing']=12;return $score['Writing'];
        }elseif($number['Writing']==6||$number['Writing']==7){
            $score['Writing']=13;return $score['Writing'];
        }elseif($number['Writing']==8){
            $score['Writing']=14;return $score['Writing'];
        }elseif($number['Writing']==9){
            $score['Writing']=15;return $score['Writing'];
        }elseif($number['Writing']==10||$number['Writing']==11){
            $score['Writing']=16;return $score['Writing'];
        }elseif($number['Writing']==12){
            $score['Writing']=17;return $score['Writing'];
        }elseif($number['Writing']==13){
            $score['Writing']=18;return $score['Writing'];
        }elseif($number['Writing']==14||$number['Writing']==15){
            $score['Writing']=19;return $score['Writing'];
        }elseif($number['Writing']==16){
            $score['Writing']=20;return $score['Writing'];
        }elseif($number['Writing']==17||$number['Writing']==18){
            $score['Writing']=21;return $score['Writing'];
        }elseif($number['Writing']==19){
            $score['Writing']=22;return $score['Writing'];
        }elseif($number['Writing']==20||$number['Writing']==21){
            $score['Writing']=23;return $score['Writing'];
        }elseif($number['Writing']==22){
            $score['Writing']=24;return $score['Writing'];
        }elseif($number['Writing']==23||$number['Writing']==24){
            $score['Writing']=25;return $score['Writing'];
        }elseif($number['Writing']==25||$number['Writing']==26){
            $score['Writing']=26;return $score['Writing'];
        }elseif($number['Writing']==27){
            $score['Writing']=27;return $score['Writing'];
        }elseif($number['Writing']==28||$number['Writing']==29){
            $score['Writing']=28;return $score['Writing'];
        }elseif($number['Writing']==30){
            $score['Writing']=29;return $score['Writing'];
        }elseif($number['Writing']==31||$number['Writing']==32){
            $score['Writing']=30;return $score['Writing'];
        }elseif($number['Writing']==33){
            $score['Writing']=31;return $score['Writing'];
        }elseif($number['Writing']==34||$number['Writing']==35){
            $score['Writing']=32;return $score['Writing'];
        }elseif($number['Writing']==36){
            $score['Writing']=33;return $score['Writing'];
        }elseif($number['Writing']==37||$number['Writing']==38){
            $score['Writing']=34;return $score['Writing'];
        }elseif($number['Writing']==39){
            $score['Writing']=35;return $score['Writing'];
        }elseif($number['Writing']==40){
            $score['Writing']=36;return $score['Writing'];
        }elseif($number['Writing']==41){
            $score['Writing']=37;return $score['Writing'];
        }elseif($number['Writing']==42){
            $score['Writing']=38;return $score['Writing'];
        }elseif($number['Writing']==43){
            $score['Writing']=39;return $score['Writing'];
        }elseif($number['Writing']==44){
            $score['Writing']=40;return $score['Writing'];
        }
    }
    public function Subscore($number)
    {
        $subScore['expression']=$this->Expression($number);
        $subScore['english']=$this->English($number);
        $subScore['algebra']=$this->Algebra($number);
        $subScore['analysis']=$this->Analysis($number);
        $subScore['math']=$this->subMath($number);
        $subScore['words']=$this->Words($number);
        $subScore['evidence']=$this->Evidence($number);
        $subScore['total']=$subScore['expression']+$subScore['english']+$subScore['algebra']+ $subScore['analysis']+ $subScore['math']+$subScore['words']+$subScore['evidence'];
        return $subScore;
      }
    public function Expression($number)
    {
        if ($number['expression'] == 0 || $number['expression'] == 1 || $number['expression'] == 2) {
            $subScore['expression'] = 1;
            return $subScore['expression'];
        } elseif ($number['expression'] == 3) {
            $subScore['expression'] = 2;
            return $subScore['expression'];
        } elseif ($number['expression'] == 4) {
            $subScore['expression'] = 3;
            return $subScore['expression'];
        } elseif ($number['expression'] == 5) {
            $subScore['expression'] = 4;
            return $subScore['expression'];
        } elseif ($number['expression'] == 6) {
            $subScore['expression'] = 5;
            return $subScore['expression'];
        } elseif ($number['expression'] == 7 || $number['expression'] == 8) {
            $subScore['expression'] = 6;
            return $subScore['expression'];
        } elseif ($number['expression'] == 9 || $number['expression'] == 10) {
            $subScore['expression'] = 7;
            return $subScore['expression'];
        } elseif ($number['expression'] == 11 || $number['expression'] == 12) {
            $subScore['expression'] = 8;
            return $subScore['expression'];
        } elseif ($number['expression'] == 13 || $number['expression'] == 14) {
            $subScore['expression'] = 9;
            return $subScore['expression'];
        } elseif ($number['expression'] == 15 || $number['expression'] == 16) {
            $subScore['expression'] = 10;
            return $subScore['expression'];
        } elseif ($number['expression'] == 17 || $number['expression'] == 18) {
            $subScore['expression'] = 11;
            return $subScore['expression'];
        } elseif ($number['expression'] == 19 || $number['expression'] == 20) {
            $subScore['expression'] = 12;
            return $subScore['expression'];
        } elseif ($number['expression'] == 21) {
            $subScore['expression'] = 13;
            return $subScore['expression'];
        } elseif ($number['expression'] == 22 || $number['expression'] == 23) {
            $subScore['expression'] = 14;
            return $subScore['expression'];
        } else {
            $subScore['expression'] = 15;
            return $subScore['expression'];
        }
    }
    public function English($number)
    {
        if ($number['english'] == 0 || $number['english'] == 1 || $number['english'] == 2) {
            $subScore['english'] = 1;
            return $subScore['english'];
        } elseif ($number['english'] == 3 || $number['english'] == 4) {
            $subScore['english'] = 2;
            return $subScore['english'];
        } elseif ($number['english'] == 5) {
            $subScore['english'] = 3;
            return $subScore['english'];
        } elseif ($number['english'] == 6) {
            $subScore['english'] = 4;
            return $subScore['english'];
        } elseif ($number['english'] == 7) {
            $subScore['english'] = 5;
            return $subScore['english'];
        } elseif ($number['english'] == 8 || $number['english'] == 9) {
            $subScore['english'] = 6;
            return $subScore['english'];
        } elseif ($number['english'] == 10 || $number['english'] == 11) {
            $subScore['english'] = 7;
            return $subScore['english'];
        } elseif ($number['english'] == 12 || $number['english'] == 13) {
            $subScore['english'] = 8;
            return $subScore['english'];
        } elseif ($number['english'] == 14) {
            $subScore['english'] = 9;
            return $subScore['english'];
        } elseif ($number['english'] == 15 || $number['english'] == 16) {
            $subScore['english'] = 10;
            return $subScore['english'];
        } elseif ($number['english'] == 17) {
            $subScore['english'] = 11;
            return $subScore['english'];
        } elseif ($number['english'] == 18) {
            $subScore['english'] = 12;
            return $subScore['english'];
        } elseif ($number['english'] == 19) {
            $subScore['english'] = 13;
            return $subScore['english'];
        } else {
            $subScore['english'] = 15;
            return $subScore['english'];
        }
    }
    public function Algebra($number)
    {
        if ($number['algebra'] == 0 || $number['algebra'] == 1) {
            $score['algebra'] = 1;
            return $score['algebra'];
        } elseif ($number['algebra'] == 2) {
            $score['algebra'] = 2;
            return $score['algebra'];
        } elseif ($number['algebra'] == 3) {
            $score['algebra'] = 3;
            return $score['algebra'];
        } elseif ($number['algebra'] == 4) {
            $score['algebra'] = 4;
            return $score['algebra'];
        } elseif ($number['algebra'] == 5) {
            $score['algebra'] = 5;
            return $score['algebra'];
        } elseif ($number['algebra'] == 6 || $number['algebra'] == 7) {
            $score['algebra'] = 6;
            return $score['algebra'];
        } elseif ($number['algebra'] == 8) {
            $score['algebra'] = 7;
            return $score['algebra'];
        } elseif ($number['algebra'] == 9 || $number['algebra'] == 10) {
            $score['algebra'] = 8;
            return $score['algebra'];
        } elseif ($number['algebra'] == 11 || $number['algebra'] == 12 || $number['algebra'] == 13) {
            $score['algebra'] = 9;
            return $score['algebra'];
        } elseif ($number['algebra'] == 14 || $number['algebra'] == 15) {
            $score['algebra'] = 10;
            return $score['algebra'];
        } elseif ($number['algebra'] == 16) {
            $score['algebra'] = 11;
            return $score['algebra'];
        } elseif ($number['algebra'] == 17) {
            $score['algebra'] = 12;
            return $score['algebra'];
        } elseif ($number['algebra'] == 18) {
            $score['algebra'] = 13;
            return $score['algebra'];
        } else {
            $score['algebra'] = 15;
            return $score['algebra'];
        }
    }
    public function Analysis($number)
    {

        if ($number['analysis'] == 0 || $number['analysis'] == 1) {
            $score['analysis'] = 1;
            return $score['analysis'];
        } elseif ($number['analysis'] == 2) {
            $score['analysis'] = 2;
            return $score['analysis'];
        } elseif ($number['analysis'] == 3) {
            $score['analysis'] = 3;
            return $score['analysis'];
        } elseif ($number['analysis'] == 4) {
            $score['analysis'] = 4;
            return $score['analysis'];
        } elseif ($number['analysis'] == 5) {
            $score['analysis'] = 5;
            return $score['analysis'];
        } elseif ($number['analysis'] == 6) {
            $score['analysis'] = 6;
            return $score['analysis'];
        } elseif ($number['analysis'] == 7) {
            $score['analysis'] = 7;
            return $score['analysis'];
        } elseif ($number['analysis'] == 8 || $number['analysis'] == 9) {
            $score['analysis'] = 8;
            return $score['analysis'];
        } elseif ($number['analysis'] == 10) {
            $score['analysis'] = 9;
            return $score['analysis'];
        } elseif ($number['analysis'] == 11 || $number['analysis'] == 12) {
            $score['analysis'] = 10;
            return $score['analysis'];
        } elseif ($number['analysis'] == 13) {
            $score['analysis'] = 11;
            return $score['analysis'];
        } elseif ($number['analysis'] == 14) {
            $score['analysis'] = 12;
            return $score['analysis'];
        } elseif ($number['analysis'] == 15) {
            $score['analysis'] = 13;
            return $score['analysis'];
        } elseif ($number['analysis'] == 16) {
            $score['analysis'] = 14;
            return $score['analysis'];
        } else {
            $score['analysis'] = 15;
            return $score['analysis'];
        }
    }
    public function subMath($number)
    {

        if ($number['math'] == 0 || $number['math'] == 1) {
            $score['math'] = 1;
            return $score['math'];
        } elseif ($number['math'] == 2) {
            $score['math'] = 2;
            return $score['math'];
        } elseif ($number['math'] == 3) {
            $score['math'] = 3;
            return $score['math'];
        } elseif ($number['math'] == 4) {
            $score['math'] = 4;
            return $score['math'];
        } elseif ($number['math'] == 5) {
            $score['math'] = 5;
            return $score['math'];
        } elseif ($number['math'] == 6) {
            $score['math'] = 6;
            return $score['math'];
        } elseif ($number['math'] == 7) {
            $score['math'] = 7;
            return $score['math'];
        } elseif ($number['math'] == 8) {
            $score['math'] = 8;
            return $score['math'];
        } elseif ($number['math'] == 9) {
            $score['math'] = 9;
            return $score['math'];
        } elseif ($number['math'] == 10 || $number['math'] == 11) {
            $score['math'] = 10;
            return $score['math'];
        } elseif ($number['math'] == 12) {
            $score['math'] = 11;
            return $score['math'];
        } elseif ($number['math'] == 13) {
            $score['math'] = 12;
            return $score['math'];
        } elseif ($number['math'] == 14) {
            $score['math'] = 13;
            return $score['math'];
        } elseif ($number['math'] == 15) {
            $score['math'] = 14;
            return $score['math'];
        } elseif ($number['math'] == 16) {
            $score['math'] = 15;
            return $score['math'];
        }
    }
    public function Words($number)
    {
        if ($number['words'] == 0 || $number['words'] == 1) {
            $score['words'] = 1;
            return $score['words'];
        } elseif ($number['words'] == 2) {
            $score['words'] = 2;
            return $score['words'];
        } elseif ($number['words'] == 3) {
            $score['words'] = 3;
            return $score['words'];
        } elseif ($number['words'] == 4) {
            $score['words'] = 4;
            return $score['words'];
        } elseif ($number['words'] == 5) {
            $score['words'] = 5;
            return $score['words'];
        } elseif ($number['words'] == 6 || $number['words'] == 7) {
            $score['words'] = 6;
            return $score['words'];
        } elseif ($number['words'] == 8) {
            $score['words'] = 7;
            return $score['words'];
        } elseif ($number['words'] == 9 || $number['words'] == 10) {
            $score['words'] = 8;
            return $score['words'];
        } elseif ($number['words'] == 11 || $number['words'] == 12) {
            $score['words'] = 9;
            return $score['words'];
        } elseif ($number['words'] == 13) {
            $score['words'] = 10;
            return $score['words'];
        } elseif ($number['words'] == 14) {
            $score['words'] = 11;
            return $score['words'];
        } elseif ($number['words'] == 15) {
            $score['words'] = 12;
            return $score['words'];
        } elseif ($number['words'] == 16) {
            $score['words'] = 13;
            return $score['words'];
        } elseif ($number['words'] == 17) {
            $score['words'] = 14;
            return $score['words'];
        } elseif ($number['words'] == 18) {
            $score['words'] = 15;
            return $score['words'];
        }
    }
    public function Evidence($number)
    {
        if ($number['evidence'] == 0 || $number['evidence'] == 1) {
            $score['evidence'] = 1;
            return $score['evidence'];
        } elseif ($number['evidence'] == 2) {
            $score['evidence'] = 2;
            return $score['evidence'];
        } elseif ($number['evidence'] == 3) {
            $score['evidence'] = 3;
            return $score['evidence'];
        } elseif ($number['evidence'] == 4) {
            $score['evidence'] = 4;
            return $score['evidence'];
        } elseif ($number['evidence'] == 5) {
            $score['evidence'] = 5;
            return $score['evidence'];
        } elseif ($number['evidence'] == 6) {
            $score['evidence'] = 6;
            return $score['evidence'];
        } elseif ($number['evidence'] == 7) {
            $score['evidence'] = 7;
            return $score['evidence'];
        } elseif ($number['evidence'] == 8 || $number['evidence'] == 9) {
            $score['evidence'] = 8;
            return $score['evidence'];
        } elseif ($number['evidence'] == 10) {
            $score['evidence'] = 9;
            return $score['evidence'];
        } elseif ($number['evidence'] == 11 || $number['evidence'] == 12) {
            $score['evidence'] = 10;
            return $score['evidence'];
        } elseif ($number['evidence'] == 13) {
            $score['evidence'] = 11;
            return $score['evidence'];
        } elseif ($number['evidence'] == 14) {
            $score['evidence'] = 12;
            return $score['evidence'];
        } elseif ($number['evidence'] == 15) {
            $score['evidence'] = 13;
            return $score['evidence'];
        } elseif ($number['evidence'] == 16) {
            $score['evidence'] = 14;
            return $score['evidence'];
        } elseif ($number['evidence'] == 17 || $number['evidence'] == 18) {
            $score['evidence'] = 15;
            return $score['evidence'];
        }
    }
    public function CrossTest($number)
    {
//        $this->number = $this->Number($data);
        $CrossTest['social'] = $this->Social($number);
        $CrossTest['science'] = $this->Science($number);
        $CrossTest['total']= $CrossTest['science']+ $CrossTest['social'];
//        var_dump($number);die;
        return $CrossTest;

    }
    public function Social($number)
    {
        if ($number['social'] == 0 || $number['social'] == 1) {
            $CrossTest['social'] = 10;
            return $CrossTest['social'];
        } elseif ($number['social'] == 2) {
            $CrossTest['social'] = 11;
            return $CrossTest['social'];
        } elseif ($number['social'] == 3) {
            $CrossTest['social'] = 12;
            return $CrossTest['social'];
        } elseif ($number['social'] == 4) {
            $CrossTest['social'] = 14;
            return $CrossTest['social'];
        } elseif ($number['social'] == 5) {
            $CrossTest['social'] = 15;
            return $CrossTest['social'];
        } elseif ($number['social'] == 6) {
            $CrossTest['social'] = 16;
            return $CrossTest['social'];
        } elseif ($number['social'] == 7) {
            $CrossTest['social'] = 17;
            return $CrossTest['social'];
        } elseif ($number['social'] == 8) {
            $CrossTest['social'] = 18;
            return $CrossTest['social'];
        } elseif ($number['social'] == 9) {
            $CrossTest['social'] = 20;
            return $CrossTest['social'];
        } elseif ($number['social'] == 10) {
            $CrossTest['social'] = 21;
            return $CrossTest['social'];
        } elseif ($number['social'] == 11) {
            $CrossTest['social'] = 22;
            return $CrossTest['social'];
        } elseif ($number['social'] == 12) {
            $CrossTest['social'] = 23;
            return $CrossTest['social'];
        } elseif ($number['social'] == 13) {
            $CrossTest['social'] = 24;
            return $CrossTest['social'];
        } elseif ($number['social'] == 14) {
            $CrossTest['social'] = 25;
            return $CrossTest['social'];
        } elseif ($number['social'] == 15) {
            $CrossTest['social'] = 26;
            return $CrossTest['social'];
        } elseif ($number['social'] == 16) {
            $CrossTest['social'] = 27;
            return $CrossTest['social'];
        } elseif ($number['social'] == 17 || $number['social'] == 18) {
            $CrossTest['social'] = 28;
            return $CrossTest['social'];
        } elseif ($number['social'] == 19) {
            $CrossTest['social'] = 29;
            return $CrossTest['social'];
        } elseif ($number['social'] == 20 || $number['social'] == 21) {
            $CrossTest['social'] = 30;
            return $CrossTest['social'];
        } elseif ($number['social'] == 22) {
            $CrossTest['social'] = 31;
            return $CrossTest['social'];
        } elseif ($number['social'] == 23 || $number['social'] == 24) {
            $CrossTest['social'] = 32;
            return $CrossTest['social'];
        } elseif ($number['social'] == 25) {
            $CrossTest['social'] = 33;
            return $CrossTest['social'];
        } elseif ($number['social'] == 26) {
            $CrossTest['social'] = 34;
            return $CrossTest['social'];
        } elseif ($number['social'] == 27 || $number['social'] == 28) {
            $CrossTest['social'] = 35;
            return $CrossTest['social'];
        } elseif ($number['social'] == 29) {
            $CrossTest['social'] = 36;
            return $CrossTest['social'];
        } elseif ($number['social'] == 30) {
            $CrossTest['social'] = 37;
            return $CrossTest['social'];
        } elseif ($number['social'] == 31 || $number['social'] == 32) {
            $CrossTest['social'] = 38;
            return $CrossTest['social'];
        } elseif ($number['social'] == 33) {
            $CrossTest['social'] = 39;
            return $CrossTest['social'];
        } elseif ($number['social'] == 34 || $number['social'] == 35) {
            $CrossTest['social'] = 40;
            return $CrossTest['social'];
        }
    }
    public function Science($number){
        if($number['science']==0){
            $CrossTest['science']=10;return $CrossTest['science'];
        }elseif($number['science']==1){
            $CrossTest['science']=11;return $CrossTest['science'];
        }elseif($number['science']==2){
            $CrossTest['science']=12;return $CrossTest['science'];
        }elseif($number['science']==3){
            $CrossTest['science']=13;return $CrossTest['science'];
        }elseif($number['science']==4){
            $CrossTest['science']=14;return $CrossTest['science'];
        }elseif($number['science']==5){
            $CrossTest['science']=15;return $CrossTest['science'];
        }elseif($number['science']==6){
            $CrossTest['science']=16;return $CrossTest['science'];
        }elseif($number['science']==7){
            $CrossTest['science']=17;return $CrossTest['science'];
        }elseif($number['science']==8){
            $CrossTest['science']=18;return $CrossTest['science'];
        }elseif($number['science']==9){
            $CrossTest['science']=19;return $CrossTest['science'];
        }elseif($number['science']==10||$number['science']==11){
            $CrossTest['science']=20;return $CrossTest['science'];
        }elseif($number['science']==12){
            $CrossTest['science']=21;return $CrossTest['science'];
        }elseif($number['science']==13){
            $CrossTest['science']=22;return $CrossTest['science'];
        }elseif($number['science']==14){
            $CrossTest['science']=23;return $CrossTest['science'];
        }elseif($number['science']==15||$number['science']==16){
            $CrossTest['science']=24;return $CrossTest['science'];
        }elseif($number['science']==17){
            $CrossTest['science']=25;return $CrossTest['science'];
        }elseif($number['science']==18){
            $CrossTest['science']=26;return $CrossTest['science'];
        }elseif($number['science']==19||$number['science']==20){
            $CrossTest['science']=27;return $CrossTest['science'];
        }elseif($number['science']==21){
            $CrossTest['science']=28;return $CrossTest['science'];
        }elseif($number['science']==22){
            $CrossTest['science']=29;return $CrossTest['science'];
        }elseif($number['science']==23||$number['science']==24){
            $CrossTest['science']=30;return $CrossTest['science'];
        }elseif($number['science']==25){
            $CrossTest['science']=31;return $CrossTest['science'];
        }elseif($number['science']==26){
            $CrossTest['science']=32;return $CrossTest['science'];
        }elseif($number['science']==27||$number['science']==28){
            $CrossTest['science']=33;return $CrossTest['science'];
        }elseif($number['science']==29){
            $CrossTest['science']=34;return $CrossTest['science'];
        }elseif($number['science']==30){
            $CrossTest['science']=35;return $CrossTest['science'];
        }elseif($number['science']==31){
            $CrossTest['science']=36;return $CrossTest['science'];
        }elseif($number['science']==32){
            $CrossTest['science']=37;return $CrossTest['science'];
        }elseif($number['science']==33){
            $CrossTest['science']=38;return $CrossTest['science'];
        }elseif($number['science']==34){
            $CrossTest['science']=39;return $CrossTest['science'];
        }elseif($number['science']==35){
            $CrossTest['science']=40;return $CrossTest['science'];
        }

    }

}