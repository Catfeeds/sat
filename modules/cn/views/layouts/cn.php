<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

<!--    <title>资讯</title>-->
    <meta name="keywords" content="SAT课程 SAT培训 申友SAT">
    <meta name="description" content="SAT课程 SAT培训 申友SAT">
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
    <link rel="stylesheet" href="/cn/css/public.css">
    <script src="/cn/js/jquery-2.1.3.js"></script>
    <script src="/cn/js/bootstrap.js"></script>
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