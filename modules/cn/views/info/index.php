<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <title>资讯</title>
  <link rel="stylesheet" href="/cn/css/reset.css">
  <link rel="stylesheet" href="/cn/css/bootstrap.css">
  <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
  <link rel="stylesheet" href="/cn/css/public.css">
  <link rel="stylesheet" href="/cn/css/information.css">

<!--  <script src="/cn/js/less.js"></script>-->
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
  <section class="s-w1200 s-information">
    <a class="s-adv" href="#">
      <img src="/cn/images/teacher-detail01.png" alt="背景图片">
    </a>
    <div class="s-cnt clearfix">
      <div class="s-left pull-left">
        <div class="s-headline clearfix">
          <div id="myCarousel" class="pull-left carousel slide">
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
            </div>
            <!-- 轮播（Carousel）导航 -->
            <a class="carousel-control left" href="#myCarousel"
               data-slide="prev">&lt;
            </a>
            <a class="carousel-control right" href="#myCarousel"
               data-slide="next">&gt;
            </a>
          </div>
          <dl>
            <dt>今日头条</dt>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
            <dd><a href="#">国外求职全解析，美国导师带你玩转国外就业市场</a></dd>
          </dl>
        </div>
        <h1><strong>IN</strong>FORMATION</h1>
        <ul class="s-toggle">
          <li class="active"><a href="#active" data-toggle="tab">新闻资讯</a></li>
          <li><a href="#exam" data-toggle="tab">备考资讯</a></li>
        </ul>
        <div>
          <div class="tab-content">
            <ul class="tab-pane active" id="active">
              <?php foreach($infoNews as $v){?>
              <li class="s-article clearfix">
                <a class="pull-left" href="/info_details/<?php echo $v['id']?>.html">
                  <img class="img-thumbnail" src="<?php echo $v['pic']?>" alt="">
                </a>
                <div>
                  <h3><a href="/info_details/<?php echo $v['id']?>.html"> <?php echo $v['title']?></a></h3>
                  <ul>
                    <li><a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['cate']?></a></li>
                    <li><a href="#">SAT资料</a></li>
                    <li class="pull-right"><?php echo date("Y-m-d",$v['publishTime'])?></li>
                  </ul>
                  <p><?php echo $v['summary']?>
                  </p>
                </div>
              </li>
              <?php }?>
              <?php echo $strNews?>
            </ul>
            <ul class="tab-pane" id="exam">
              <?php foreach($infoTest as $v){?>
              <li class="s-article clearfix">
                <a class="pull-left" href=/info_details/<?php echo $v['id']?>.html">
                  <img class="img-thumbnail" src="<?php echo $v['pic']?>" alt="">
                </a>
                <div>
                  <h3><a href=""/info_details/<?php echo $v['id']?>.html""> <?php echo $v['title']?></a></h3>
                  <ul>
                    <li><a href=""/info_details/<?php echo $v['id']?>.html""><?php echo $v['cate']?></a></li>
                    <li><a href="#">SAT资料</a></li>
                    <li class="pull-right"><?php echo date("Y-m-d",$v['publishTime'])?></li>
                  </ul>
                  <p>
                    <?php echo $v['summary']?>
                  </p>
                </div>
              </li>
              <?php }?>
              <?php echo $strTest?>
            </ul>
          </div>
        </div>
      </div>
      <div class="s-right pull-right">
        <div class="s-read">
          <h2>阅读排行</h2>
          <ul>
            <?php foreach($info as $v){?>
            <li>
              <a href="/info_details/<?php echo $v['id']?>.html">
                <img src="<?php echo$v['pic']?>" alt="">
              </a>
              <div>
                <h3><a href="#"><?php echo$v['title']?></a></h3>
                <ul class="clearfix">
                  <li class="pull-left"><a href="#"><?php echo$v['cate']?></a></li>
                  <li class="pull-right"><?php echo date("Y-m-d",$v['publishTime'])?></li>
                </ul>
              </div>
            </li>
            <?php }?>
          </ul>
        </div>
        <a class="s-middle-adv" href="#">
          <img src="/cn/images/pubClass-dea_11.png" alt="">
        </a>
        <div class="s-case">
          <h2>学员案例</h2>
          <ul>
            <?php foreach($student as $v){?>
            <li class="s-case-cnt">
              <a href="#">
                <img src="<?php echo $v['pic']?>" alt="">
              </a>
              <div>
                <ul>
                  <li><?php echo $v['name']?></li>
                  <li>申请专业：<?php echo $v['direction']?></li>
                  <li>录取学校：<?php echo $v['matriculate']?></li>
                </ul>
              </div>
            </li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!--底部-->
  <?php use app\commands\front\FootWidget;?>
  <?php FootWidget::begin();?>
  <?php FootWidget::end();?>
</body>
<script>
  $('.s-toggle a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
</script>
</html>