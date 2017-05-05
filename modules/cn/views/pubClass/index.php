<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>公开课</title>
  <link rel="stylesheet" href="/cn/css/reset.css">
  <link rel="stylesheet" href="/cn/css/bootstrap.css">
  <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
  <link rel="stylesheet/less" href="/cn/css/public.less">
  <link rel="stylesheet" href="/cn/css/class.css">
  <script src="/cn/js/less.js"></script>
  <link rel="stylesheet" href="/cn/css/public.css">
  <link rel="stylesheet" href="/cn/css/pubClass.css">
<!--  <script src="/cn/js/less.js"></script>-->
  <script src="/cn/js/jquery-2.1.3.js"></script>
  <script src="/cn/js/bootstrap.js"></script>
  <script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
  <script src="/cn/js/public.js"></script>
  <!--<script src="/cn/js/class.js"></script>-->
</head>
<body>
  <!--导航-->
  <?php use app\commands\front\NavWidget;?>
  <?php NavWidget::begin();?>
  <?php NavWidget::end();?>
  <section>
    <!--轮播图-->
    <div class="bnr-wrap center-block clearfix">
      <div id="myCarousel" class="carousel slide">
        <!-- 轮播（Carousel）指标 -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- 轮播（Carousel）项目 -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="/cn/images/course-bg01.png" alt="First slide">
          </div>
          <div class="item">
            <img src="/cn/images/course-bg01.png" alt="Second slide">
          </div>
          <div class="item">
            <img src="/cn/images/course-bg01.png" alt="Third slide">
          </div>
    <div class="s-w1200">
      <div class="s-new-title">
        <h2>最新公开课</h2>
      </div>
      <ul class="s-new-cnt">
        <?php foreach($data as $v){?>
        <li>
          <img src="/cn/images/class_img01.png" alt="">
          <div>
            <h2><?php echo $v['title']?></h2>
            <ul>
              <li class="pull-left">
                <span>授课老师:</span>
                <span><?php echo $v['name']?></span>
              </li>
              <li class="pull-right">
                <span><?php echo $v['activeTime']?></span>
              </li>
            </ul>
            <?php echo $v['content']?>
            <a href="#">报名</a>
            <a href="#">详情</a>
          </div>
        </li>
        <?php }?>
      </ul>
      <div class="s-history-title">
        <img src="/cn/images/class_bg02.png" alt="">
        <h2>往期公开课</h2>
      </div>
      <ul class="s-history-cnt clearfix">
        <li>
          <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <?php foreach($arr as $v){?>
        <li>
          <embed src="<?php echo $v['pic']?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block"><?php echo $v['title']?></h2>
            <p><?php echo $v['content']?></p>
            <p><span><?php echo $v['activeTime']?></span></p>
          </div>
        </li>
        <?php }?>
        <li>
          <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
        <li>
          <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
      </ul>
      <button class="s-more center-block">查看更多</button>
      <!--<img class="oImag" src="" data-src="http://kingofwallpapers.com/picture/picture-007.jpg" alt="">-->
    </div>
  </section>
  <!--底部-->
  <?php use app\commands\front\FootWidget;?>
  <?php FootWidget::begin();?>
  <?php FootWidget::end();?>
=======
  </div>
  <div class="s-w1200">
    <div class="s-new-title">
      <h2>最新公开课</h2>
    </div>
    <ul class="s-new-cnt">
      <li>
        <img src="/cn/images/class_img01.png" alt="">
        <!--<embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="480" height="400"></embed>-->
        <div>
          <h2>公开课名称</h2>
          <ul>
            <li class="pull-left">
              <i class="icon-heart"></i>
              <span>100</span>
              <span>授课老师:</span>
              <span>某某某</span>
            </li>
            <li class="pull-right">
              <span>2017-5-7</span>
              <span>16:00-17:00</span>
            </li>
          </ul>
          <p>多年的海外留学经历，使得其深谙美国文化。丰富的托福考场实践经验，托福听力多次取得近满分的成绩。对于托福的听力与GMAT阅读的把控有着深刻与独到的见解。教学风格幽默诙谐，思路慎密，深受广大学生的喜爱。</p>
          <a href="#">报名</a>
          <a href="#">详情</a>
        </div>
      </li>
      <li>
        <img src="/cn/images/class_img01.png" alt="">
        <div>
          <h2>公开课名称</h2>
          <ul>
            <li class="pull-left">
              <i class="icon-heart"></i>
              <span>100</span>
              <span>授课老师:</span>
              <span>某某某</span>
            </li>
            <li class="pull-right">
              <span>2017-5-7</span>
              <span>16:00-17:00</span>
            </li>
          </ul>
          <p>多年的海外留学经历，使得其深谙美国文化。丰富的托福考场实践经验，托福听力多次取得近满分的成绩。对于托福的听力与GMAT阅读的把控有着深刻与独到的见解。教学风格幽默诙谐，思路慎密，深受广大学生的喜爱。</p>
          <a href="#">报名</a>
          <a href="#">详情</a>
        </div>
      </li>
      <li>
        <img src="/cn/images/class_img01.png" alt="">
        <div>
          <h2>公开课名称</h2>
          <ul>
            <li class="pull-left">
              <i class="icon-heart"></i>
              <span>100</span>
              <span>授课老师:</span>
              <span>某某某</span>
            </li>
            <li class="pull-right">
              <span>2017-5-7</span>
              <span>16:00-17:00</span>
            </li>
          </ul>
          <p>多年的海外留学经历，使得其深谙美国文化。丰富的托福考场实践经验，托福听力多次取得近满分的成绩。对于托福的听力与GMAT阅读的把控有着深刻与独到的见解。教学风格幽默诙谐，思路慎密，深受广大学生的喜爱。</p>
          <a href="#">报名</a>
          <a href="#">详情</a>
        </div>
      </li>
      <li>
        <img src="/cn/images/class_img01.png" alt="">
        <div>
          <h2>公开课名称</h2>
          <ul>
            <li class="pull-left">
              <i class="icon-heart"></i>
              <span>100</span>
              <span>授课老师:</span>
              <span>某某某</span>
            </li>
            <li class="pull-right">
              <span>2017-5-7</span>
              <span>16:00-17:00</span>
            </li>
          </ul>
          <p>多年的海外留学经历，使得其深谙美国文化。丰富的托福考场实践经验，托福听力多次取得近满分的成绩。对于托福的听力与GMAT阅读的把控有着深刻与独到的见解。教学风格幽默诙谐，思路慎密，深受广大学生的喜爱。</p>
          <a href="#">报名</a>
          <a href="#">详情</a>
        </div>
      </li>
    </ul>
    <div class="s-history-title">
      <img src="/cn/images/class_bg02.png" alt="">
      <h2>往期公开课</h2>
    </div>
    <ul class="s-history-cnt clearfix">
      <li>
        <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
      <li>
        <embed src="" data-src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
        <div class="s-cnt">
          <h2 class="center-block">公开课名称</h2>
          <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
          <p><span>2017-4-20</span><span>16:00-17:00</span></p>
        </div>
      </li>
    </ul>
    <button class="s-more center-block">查看更多</button>
    <!--<img class="oImag" src="" data-src="http://kingofwallpapers.com/picture/picture-007.jpg" alt="">-->
  </div>
</section>
<!--底部-->
<footer class="s-footer">
  <div class="s-footer-top">
    <div class="s-w1200 clearfix">
      <dl class="pull-left">
        <dt>快速入口</dt>
        <dd><a href="#">SAT</a></dd>
        <dd><a href="#">GMAT</a></dd>
        <dd><a href="#">TOEFL</a></dd>
        <dd><a href="#">IELTS</a></dd>
        <dd><a href="#">ACT</a></dd>
      </dl>
      <dl class="pull-left">
        <dt>网站说明</dt>
        <dd><a href="#">关于我们</a></dd>
        <dd><a href="#">联系我们</a></dd>
        <dd><a href="#">加入我们</a></dd>
        <dd><a href="#">您的建议</a></dd>
      </dl>
      <div class="s-qr">
        <img src="/cn/images/qr-code01.png" alt="">
        <p>SAT公众号</p>
      </div>
      <div class="s-qr">
        <img src="/cn/images/qr-code01.png" alt="">
        <p>SAT公众号</p>
      </div>
      <div class="s-tel">
        <img src="/cn/images/tel_icon.png" alt="">
        <p>400-600-1123</p>
      </div>
    </div>
  </div>
  <div class="s-footer-bottom">
    <div class="s-w1200">
      <dl>
        <dt>友情链接:</dt>
        <dd>
        <dd><a href="#">申友网</a></dd>
        <dd><a href="#">申友网</a></dd>
        <dd><a href="#">雷哥网</a></dd>
        <dd><a href="#">雷哥网</a></dd>
        <dd><a href="#">申友网</a></dd>
        </dd>
      </dl>
      <p>Copyright © 2015 All Right Reserved 申友教育 版权所有 京ICP备16000003号 京公网安备 11010802018491 免责声明
      </p>
    </div>
  </div>
</footer>
</body>
<script>
  $(function () {
    var sCnt = $('.s-history-cnt'),
        slideHeight = 1125,
        defHeight = $('.s-history-cnt').height();
    if (defHeight>slideHeight) {
      sCnt.css('height',slideHeight+'px');
    }
    $('.s-more').click(function () {
      var curHeight=  sCnt.height();
      console.log(curHeight);
      console.log(defHeight);
      if (curHeight == slideHeight) {
        sCnt.animate({
          height: defHeight
        },1000);
        $('.s-more').html('点击隐藏');
      }else {
        sCnt.animate({
          height: slideHeight
        },'normal');
        $('.s-more').html('查看更多');
      }
      $('.s-history-cnt li embed').each(function () {
        console.log($(this).attr('1'));
        if ($(this).attr('data-src')) {
          this.src = $(this).attr('data-src');
          console.log('1');
        }
      })
    })
  })
</script>
</html>