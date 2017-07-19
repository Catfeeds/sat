
  <link rel="stylesheet" href="/cn/css/information.css">
  <section class="s-w1200 s-information">
    <a class="s-adv" href="#">
      <img src="/cn/images/info-bc.jpg" alt="背景图片">
    </a>
    <div class="s-cnt clearfix">
      <div class="s-left pull-left">
        <div class="s-headline clearfix">
          <div id="myCarousel" class="pull-left carousel slide">
            <!-- 轮播（Carousel）指标 -->
            <ol class="carousel-indicators">
              <?php foreach ($pic as $k=>$v){
                if($k==0){
                  echo '<li data-target="#myCarousel" data-slide-to="'.$k.'" class="active"></li>';
                }else{
                  echo '<li data-target="#myCarousel" data-slide-to="'.$k.'"></li>';
                }
              }?>

            </ol>
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner">
              <?php foreach($pic as $k=>$v){
                if($k==0){
                  echo '<div class="item active">';
                }else{
                  echo '<div class="item">';
                }
                echo '<a href="'.$v['url'].'"> <img src="'.$v['pic'].'" alt="'.$v['alt'].'"></a>
                    </div>';
              }?>
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
        <ul class="s-toggle" >
          <li>
            <a href="/info.html?c=n" >新闻资讯</a>
          </li >
          <li>
            <a href="/info.html?c=t" >学术报告</a>
          </li>
          <li>
            <a href="/info.html?c=s">高分经验</a>
          </li>
        </ul>
        <div >
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
                    <li><a href="/info.html"><?php echo $v['cate']?></a></li>
<!--                    <li><a href="#">SAT资料</a></li>-->
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
                <img src="<?php echo $v['pic']?>" alt="">
              </a>
              <div>
                <h3><a href="/info_details/<?php echo $v['id']?>.html"><?php echo$v['title']?></a></h3>
                <ul class="clearfix">
                  <li class="pull-left"><a href="#"><?php echo$v['cate']?></a></li>
                  <li class="pull-right"><?php echo date("Y-m-d",$v['publishTime'])?></li>
                </ul>
              </div>
            </li>
            <?php }?>
          </ul>
        </div>
        <a class="s-middle-adv" href="/class.html">
          <img src="/cn/images/information1.png" alt="图片">
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
//   页面刷新跳转到指定高度
  $(window).on('load', function () {
    var location = window.location.href;
    if (location.indexOf('?') != -1) {
      $(window).scrollTop(600);
    }
  })
   var toggle = window.location.href.split('?')[1];
   if (!toggle){
     $('.s-toggle li').eq(0).addClass('active')
   }else {
     if (toggle.indexOf('t') >= 0) {
       $('.s-toggle li').eq(1).addClass('active')
     } else if(toggle.indexOf('s') >= 0) {
       $('.s-toggle li').eq(2).addClass('active');
     }else {
       $('.s-toggle li').eq(0).addClass('active')
     }
   }
//   轮播图
   $('#myCarousel').carousel({
     interval: 3000
   })
 })
</script>
