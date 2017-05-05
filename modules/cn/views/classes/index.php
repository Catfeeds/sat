<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <title>课程</title>
  <link rel="stylesheet" href="/cn/css/reset.css">
  <link rel="stylesheet" href="/cn/css/bootstrap.css">
  <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
  <link rel="stylesheet/less" href="/cn/css/course.less">
  <script src="/cn/js/less.js"></script>
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
  <section class="s-section">
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
          <?php foreach ($banner as $k=>$v){ if($k==0) {echo "<div class='item active'>";} else{echo "<div class='item'>";}?>
            <a href="<?php echo $v['url']?>"><img src="<?php echo $v['pic']?>" alt="<?php echo $v['alt']?>"></a>
          </div>
         <?php }?>
        </div>
        <!-- 轮播（Carousel）导航 -->
        <a class="carousel-control s-left" href="#myCarousel"
           data-slide="prev">&lt;</a>
        <a class="carousel-control s-right" href="#myCarousel"
           data-slide="next">&gt;</a>
      </div>
    </div>
    <!--热门课程-->
    <div class="s-course">
      <div class="s-w1200">
        <div class="sc-title center-block">
          <h1>SAT热门课程</h1>
        </div>
        <div class="s-course-cnt clearfix">
          <div class="s-course-left pull-left">
            <ul>
              <li>
                <p class="on">基础班</p>
              </li>
              <li>
                <p>强化班</p>
              </li>
              <li>
                <p>精英班</p>
              </li>
            </ul>
          </div>
          <div class="s-course-right">
            <div class="s-course-pub on s-course-basis">
              <ul class="clearfix">
                <?php foreach($data as $v){ if($v['cate']=="基础班"){?>
                <li>
                  <span><?php echo $v['major']?></span>
                  <a href="/class_details/<?php echo $v['id']?>.html"><p><?php echo $v['introduction']?></p></a>
                </li>
                <?php  }}?>
              </ul>
            </div>
            <div class="s-course-pub s-course-intensify">
              <ul class="clearfix">
                <?php  foreach($data as $v) {if($v['cate']=="强化班"){?>
                  <li>
                    <span><?php echo $v['major']?></span>
                    <a href="/class_details/<?php echo $v['id']?>.html"><p><?php echo $v['introduction']?></p></a>
                  </li>
                <?php } }?>
              </ul>
            </div>
            <div class="s-course-pub s-course-elite">
              <ul class="clearfix">
                <?php  foreach($data as $v){if($v['cate']=="精英班"){?>
                  <li>
                    <span><?php echo $v['major']?></span>
                    <a href="/class_details/<?php echo $v['id']?>.html"><p><?php echo $v['introduction']?></p></a>
                  </li>
                <?php  }}?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--专项课程-->
    <div class="s-special">
      <div class="s-w1200">
        <div class="sc-title center-block">
          <h1>SAT专项课程</h1>
        </div>
        <div class="s-special-cnt clearfix">
          <div class="s-special-pub s-special-left">
          <?php  foreach($data as $v){if($v['cate']=="词汇班"){?>
            <a href="/class_details/<?php echo$v['id']?>.html" class="s-img-container">
              <img src="/cn/images/course-basis01.png" alt="">
            </a>
            <div class="s-font-container">

              <h2><?php echo $v['major']?></h2>
              <p><?php echo $v['introduction']?></p>
            </div>
          <?php }}?>
          </div>
          <div class="s-special-pub s-special-right">
          <?php  foreach($data as $v){if($v['cate']=="冲刺班"){?>
            <a href="/class_details/<?php echo $v['id']?>.html" class="s-img-container">
              <img src="/cn/images/course-basis02.png" alt="">
            </a>
            <div class="s-font-container">
              <h2><?php echo $v['major']?></h2>
              <p><?php echo $v['introduction']?></p>
            </div>
          <?php }}?>
          </div>
        </div>
      </div>
    </div>
    <!--开班信息-->
    <div class="s-classes">
      <div class="s-w1200">
        <div class="sc-title center-block">
          <h1>开班信息</h1>
        </div>
        <div class="s-classes-cnt" id="Index_Box">
          <pre class="prev">&lt;</pre>
          <pre class="next">&gt;</pre>
          <ul>
            <li class="s-cnt">
              <h2>4月1日SAT强化班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
            <li class="s-cnt">
              <h2>4月2日SAT基础班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
            <li class="s-cnt">
              <h2>4月3日SAT数学班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
            <li class="s-cnt">
              <h2>4月4日SAT精英班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
            <li class="s-cnt">
              <h2>4月5日SAT强化班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
            <li class="s-cnt">
              <h2>4月6日SAT基础班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
            <li class="s-cnt">
              <h2>4月7日SAT数学班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
            <li class="s-cnt">
              <h2>4月8日SAT精英班</h2>
              <p>寒暑假开班时间 周末精品班、住宿班、全日制连授班端午国庆强化班GMAT700+高分强化班联系申友全国免费咨询热线400</p>
              <a href="#">查看详情</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--名师团队-->
    <div class="s-teacher">
      <div class="s-w1200">
        <div class="sc-title center-block">
          <h1>名师团队</h1>
        </div>
        <div class="s-teacher-cnt">
          <div class="s-arrow prev">&lt;</div>
          <div class="s-arrow next">&gt;</div>
          <ul class="s-teacher-int clearfix">
            <li>
              <img src="/cn/images/course-basis01.png" alt="">
              <div>
                <h2>Kevin</h2>
                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
              </div>
              <a href="#">立即预约</a>
            </li>
            <li>
              <img src="/cn/images/course-basis01.png" alt="">
              <div>
                <h2>Kevin</h2>
                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
              </div>
              <a href="#">立即预约</a>
            </li>
            <li>
              <img src="/cn/images/course-basis01.png" alt="">
              <div>
                <h2>Kevin</h2>
                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
              </div>
              <a href="#">立即预约</a>
            </li>
            <li>
              <img src="/cn/images/course-basis01.png" alt="">
              <div>
                <h2>Kevin</h2>
                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
              </div>
              <a href="#">立即预约</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <script>
//      jQuery('.s-teacher-cnt').slide({mainCell:".s-teacher-int", effect:"leftLoop",vis:4, autoPlay:false});
    </script>
  </section>
  <!--底部-->
  <?php use app\commands\front\FootWidget;?>
  <?php FootWidget::begin();?>
  <?php FootWidget::end();?>
</body>
<script>
  $(function () {
    //    热门课程
    $('.s-course-left li').click(function () {
      $('.s-course-left li p').each(function () {
        $(this).removeClass('on');
      });
      $(this).children().addClass('on');
      var _index = $(this).index();
      $('.s-course-pub').removeClass('on');
      $('.s-course-pub').eq(_index).addClass('on');
      $('.s-course-pub li').css({width:'33%'});
    });
    $('.s-course-pub li').click(function () {
      $('.s-course-pub li').not(this).animate({width:'200px'},100);
      $(this).animate({width:'320px'},100);
      $('.s-course-pub li').not($(this)).children('a').hide();
      $(this).children('a').delay(300).fadeIn();
    })
  });
</script>
</html>