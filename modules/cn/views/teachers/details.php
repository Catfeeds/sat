<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <title>名师详情页</title>
  <link rel="stylesheet" href="/cn/css/reset.css">
  <link rel="stylesheet" href="/cn/css/bootstrap.css">
  <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
  <link rel="stylesheet" href="/cn/css/public.css">
  <link rel="stylesheet" href="/cn/css/teacher-detail.css">

  <script src="/cn/js/less.js"></script>
  <script src="/cn/js/jquery-2.1.3.js"></script>
  <script src="/cn/js/bootstrap.js"></script>
  <script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
  <script src="/cn/js/public.js"></script>
</head>
<body>
  <!--导航-->
  <?php use app\commands\front\NavWidget;?>
  <?php NavWidget::begin();?>
  <?php NavWidget::end();?>
  <section class="s-teacher-detail s-w1200">
    <a href="#" class="s-adv">
      <img src="/cn/images/teacher-detail01.png" alt="">
    </a>
    <div class="s-introduce clearfix">
      <div class="s-head-img pull-left">
        <img class="img-circle border-blue" src="<?php echo $data['pic']?>" alt="">
      </div>
      <div class="s-cnt">
        <h2><?php echo $data['name']?> SAT主讲名师</h2>
        <a class="border-blue" href="#">点我聊聊</a>
        <p class="s-cnt-introduce"><?php echo $data['introduction']?></p>
        <div class="s-title">
          <img src="/cn/images/teacher-detail02.png" alt="成功案例">
          <h3>成功案例</h3>
        </div>
        <ul>
          <?php foreach($brr as $v){?>
          <li>
            <p><?php echo $v['str1']?></p>
            <p><?php echo $v['str2']?></p>
          </li>
          <?php }?>
        </ul>
        <img class="s-foot-img" src="/cn/images/teacher-detail03.png" alt="图片">
      </div>
    </div>
  </section>
  <!--底部-->
  <?php use app\commands\front\FootWidget;?>
  <?php FootWidget::begin();?>
  <?php FootWidget::end();?>

</body>
</html>