<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<?php
    $now_path=ltrim($_SERVER['REQUEST_URI'],'/');
    $st =stripos($now_path,'/');
    if($st!=false){
        $url=substr($now_path,0,($st));
    }else{
        $st =stripos($now_path,'.');
        $url=substr($now_path,0,($st));
    }
    if($url!='info_details'){
    $data = Yii::$app->db->createCommand("select * from {{%seo}} where url='$url'")->queryOne();
//        var_dump($url);die;
    }else{
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select id,title,summary,keywords from {{%info}} where id=" . $id)->queryOne();
        $data['description']=$data['summary'];
    }
//var_dump($data);die;

?>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?d3a93ed2e8ed268c979dadb13369a1d4";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

    <title><?php echo isset($data['title'])?$data['title']:'【官方】雷哥网SAT培训_SAT课程_SAT考试培训_SAT官网_SAT模考_SAT培训班_SAT培训机构_雷哥SAT_ACT培训_美国本科留学'?></title>
    <meta name="keywords" content="<?php echo isset($data['keywords'])?$data['keywords']:'【雷哥SAT官网】专业提供SAT考试培训，SAT小班，SAT VIP班，SAT模考，SAT在线题库，SAT公开课，SAT学习资料，ACT培训，美国本科留学，定制SAT VIP培训班。雷哥SAT培训课程欢迎咨询：400-1816-180'?>">
    <meta name="description" content="<?php echo isset($data['description'])?$data['description']:'雷哥网,雷哥SAT,雷哥SAT课程,SAT培训,SAT时间,SAT备考,SAT培训,SAT考试培训,SAT培训机构,SAT网络课程,SAT网课,SAT课程,SAT是什么,SAT资料,SAT视频课程,SAT考试真题,SAT在线课程,SAT暑期班,申友SAT,备考SAT,SAT备考资料,SAT考试资料,考SAT,SAT,SAT模考软件,SAT论坛,雷哥网培训。'?>">
    <!--阻止浏览器缓存-->
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--    让IE浏览器用最高级内核渲染页面 还有用 Chrome 框架的页面用webkit 内核-->
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
<!--    让360双核浏览器用webkit内核渲染页面-->
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
    <link rel="stylesheet" href="/cn/css/public.css">
    <script src="/cn/js/jquery-2.1.1.min.js"></script>
    <script src="/cn/js/bootstrap.min.js"></script>
    <script src="/cn/js/jquery.cookie.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/public.js"></script>
</head>
<body>
<!--导航-->
<?php use app\commands\front\NavWidget;?>
<?php NavWidget::begin();?>
<?php NavWidget::end();?>
<?= $content ?>
<!--底部-->
<?php use app\commands\front\FootWidget;?>
<?php FootWidget::begin();?>
<?php FootWidget::end();?>
</body>
</html>
