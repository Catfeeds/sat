<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 9:57
 */
namespace app\libs;
use yii;
class Format {
    public function FormatTime($secs){
        if($secs>=86400){$days=floor($secs/86400);$secs=$secs%86400;$r=$days.' day';if($days<>1){$r.='s';}if($secs>0){$r.=', ';}}
        if($secs>=3600){$hours=floor($secs/3600);$secs=$secs%3600;$r.=$hours.' hour';if($hours<>1){$r.='s';}if($secs>0){$r.=', ';}}
        if($secs>=60){$minutes=floor($secs/60);$secs=$secs%60;$r.=$minutes.' minute';if($minutes<>1){$r.='s';}if($secs>0){$r.=', ';}}
        $r.=$secs.' second';if($secs<>1){$r.='s';}
        return $r;
    }
}