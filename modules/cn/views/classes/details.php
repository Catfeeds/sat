<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>课程详情页</title>
  <link rel="stylesheet" href="/cn/css/reset.css">
  <link rel="stylesheet" href="/cn/css/bootstrap.css">
  <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
  <link rel="stylesheet" href="/cn/css/public.css">
  <link rel="stylesheet/less" href="/cn/css/classes-detail.css">
  <script src="/cn/js/less.js"></script>
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
  <section>
    <div class="s-w1200">
      <ol class="breadcrumb">
        <li><a href="#">首页</a></li>
        <li><a href="#">课程</a></li>
        <li class="active"><?php echo$data['cate']?></li>
      </ol>
      <div class="s-course-details clearfix">
        <img class="pull-left" src="/cn/images/cou-details01.png" alt="">
        <div>
          <h2>SAT<?php echo $data['major'].$data['cate']?>课程</h2>
          <span class="s-now">￥<?php echo$data['price']?></span>
          <span class="s-before">￥<?php echo $data['price']*1.2 ?></span>
          <p><?php echo$data['duration']?>课时</p>
          <p class="s-object">课程对象：<span><?php echo$data['student']?></span></p>
          <a href="#">立即预约</a>
        </div>
      </div>
      <div class="s-introduce">
        <ul class="nav nav-pills" role="tablist">
          <li role="presentation" class="active"><a href="#course" aria-controls="course" role="tab" data-toggle="tab">课程介绍</a></li>
          <li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">授课老师</a></li>
          <li role="presentation"><a href="#plan" aria-controls="plan" role="tab" data-toggle="tab">学习计划</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="course">
            <h2><?php echo $data['major'].$data['cate']?>课程</h2>
            <p><?php echo $data['major'].$data['introduction']?>
            </p>
          </div>
          <div role="tabpanel" class="tab-pane clearfix" id="teacher">
            <div class="s-introduce-font pull-left">
              <img src="/cn/images/cou-details01.png" alt="">
              <h2>Kevin</h2>
              <p>Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet scelerisque justo. Proin in bland
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet</p>
            </div>
            <div class="s-introduce-img">
              <img class="s-big-img" src="/cn/images/course-basis01.png" alt="">
              <div>
                <img src="/cn/images/course-basis02.png" alt="">
                <img src="/cn/images/course-basis03.png" alt="">
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="plan">
            <div>
              <h2>Day 1</h2>
              <p>Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet</p>
            </div>
            <div>
              <h2>Day 2</h2>
              <p>Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet
                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet</p>
            </div>
          </div>
        </div>
      </div>
      <div class="s-policy clearfix">
        <h2>报前必读</h2>
        <img class="pull-left" src="/cn/images/qr-code01.png" alt="">
        <ul>
          <li>1、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
          <li>2、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
          <li>3、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
          <li>4、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
        </ul>
      </div>
    </div>
  </section>
  <!--底部-->
  <?php use app\commands\front\FootWidget;?>
  <?php FootWidget::begin();?>
  <?php FootWidget::end();?>
</body>
</html>