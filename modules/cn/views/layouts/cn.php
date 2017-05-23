<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
<!--    <title>网站说明</title>-->
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/bootstrap.css">
    <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
    <link rel="stylesheet" href="/cn/css/public.css">
    <link rel="stylesheet" href="/cn/css/about.css">
    <link rel="stylesheet" href="/cn/css/classes-detail.css">
    <link rel="stylesheet" href="cn/css/course-new.css">
    <link rel="stylesheet" href="/cn/css/pubClass.css">
    <link rel="stylesheet" href="/cn/css/pubClass-detail.css">
    <link rel="stylesheet" href="/cn/css/information.css">
    <link rel="stylesheet" href="/cn/css/sat.css">
    <link rel="stylesheet" href="/cn/css/teacher-detail.css">
    <link rel="stylesheet" href="/cn/css/teacher.css">

    <script src="/cn/js/jquery-2.1.3.js"></script>
    <script src="/cn/js/bootstrap.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="/cn/js/public.js"></script>
    <script src="/cn/js/carousel.js"></script>
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
