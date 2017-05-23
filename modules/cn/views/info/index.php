
  <title>资讯</title>
  <link rel="stylesheet" href="/cn/css/information.css">

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
            <dt>最新资讯</dt>
            <?php foreach($newinfo as $v){?>
            <dd><a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a></dd>
           <?php }?>
          </dl>
        </div>
        <h1><strong>IN</strong>FORMATION</h1>
        <ul class="s-toggle">
          <li>
            <a href="/info.html?c=n" >新闻资讯</a></li>
          </li >
          <li>
            <a href="/info.html?c=t" >备考资讯</a></li>
          </li>
        </ul>
        <div>
          <div class="tab-content">
            <ul class="tab-pane active" id="active">
              <?php foreach($info as $v){?>
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
              <?php echo $str?>
            </ul>
          </div>
        </div>
      </div>
      <div class="s-right pull-right">
        <div class="s-read">
          <h2>阅读排行</h2>
          <ul>
            <?php foreach($hot as $v){?>
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
<!--        <div class="s-case">-->
<!--          <h2>学员案例</h2>-->
<!--          <ul>-->
<!--            --><?php //foreach($student as $v){?>
<!--            <li class="s-case-cnt">-->
<!--              <a href="#">-->
<!--                <img src="--><?php //echo $v['pic']?><!--" alt="">-->
<!--              </a>-->
<!--              <div>-->
<!--                <ul>-->
<!--                  <li>--><?php //echo $v['name']?><!--</li>-->
<!--                  <li>申请专业：--><?php //echo $v['direction']?><!--</li>-->
<!--                  <li>录取学校：--><?php //echo $v['matriculate']?><!--</li>-->
<!--                </ul>-->
<!--              </div>-->
<!--            </li>-->
<!--            --><?php //}?>
<!--          </ul>-->
<!--        </div>-->
      </div>
    </div>
  </section>


<script>
 $(function() {
   var toggle = window.location.href.split('?')[1];
   if (!toggle){
     $('.s-toggle li').eq(0).addClass('active')
   }else {
     if (toggle.indexOf('n') == -1) {
       $('.s-toggle li').eq(1).addClass('active')
     }else {
       $('.s-toggle li').eq(0).addClass('active')
     }
   }
 })
</script>
