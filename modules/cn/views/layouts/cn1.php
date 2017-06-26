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
    }else{
        $id = Yii::$app->request->get('id', '');
        $data = Yii::$app->db->createCommand("select id,title,summary,keywords from {{%info}} where id=" . $id)->queryOne();
        $data['description']=$data['summary'];
    }
    //var_dump($data);die;

    ?>
    <title><?php echo isset($data['title'])?$data['title']:''?></title>
    <meta name="keywords" content="<?php echo isset($data['keywords'])?$data['keywords']:'SAT课程 SAT培训 申友SAT'?>">
    <meta name="description" content="<?php echo isset($data['description'])?$data['description']:'SAT课程 SAT培训 申友SAT'?>">
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
    <link rel="stylesheet" href="/cn/css/bootstrap.css">
    <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="/cn/css/public.css">-->
    <script src="/cn/js/jquery-2.1.3.js"></script>
    <script src="/cn/js/bootstrap.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/public.js"></script>

</head>
<body>
<!--导航-->

<?= $content ?>

<!--底部-->

</body>
</html>
