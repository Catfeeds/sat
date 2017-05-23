<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <title>课程</title>
  <link rel="stylesheet" href="cn/css/reset.css">
  <link rel="stylesheet" href="cn/css/bootstrap.css">
  <link rel="stylesheet" href="cn/css/font-awesome.min.css">
  <link rel="stylesheet" href="cn/css/public.css">
  <link rel="stylesheet" href="cn/css/course-new.css">

  <script src="cn/js/jquery-2.1.3.js"></script>
  <script src="cn/js/bootstrap.js"></script>
  <script src="cn/js/jquery.SuperSlide.2.1.js"></script>
  <script src="cn/js/public.js"></script>
</head>
<body>
<!--导航-->
<?php use app\commands\front\NavWidget;?>
<?php NavWidget::begin();?>
<?php NavWidget::end();?>
<section>
  <div class="s-course s-w1200">
    <ul class="s-title-list">
          <li class="active s-title"><a href="#allAround" data-toggle="tab">全能小班</a></li>
          <li class="s-title"><a href="#sprint" data-toggle="tab">冲刺小班</a></li>
          <li class="s-title"><a href="#weekend" data-toggle="tab">全能周末班</a></li>
    </ul>
    <div class="tab-content">
      <?php foreach($data as $v){
      if($v['cate']=='全能小班'){
        echo '<div class="tab-pane fade in active" id="allAround">';
      }elseif($v['cate']=='冲刺小班') {
        echo '<div class="tab-pane fade" id="sprint">';
      }else {
      echo '<div class="tab-pane fade" id="weekend">';}
      ?>
        <p class="s-desc"><?php echo $v['student']?></p>
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <p><?php echo $v['introduction']?></p>
            <ul>
              <li>模块</li>
              <li>阅读</li>
              <li>文法</li>
              <li>词汇</li>
              <li>数学</li>
              <li>写作</li>
              <li>模考点评</li>
            </ul>
            <ul>
              <li>课时</li>
              <li><?php echo $v['read']?></li>
              <li><?php echo $v['grammar']?></li>
              <li><?php echo $v['vocabulary']?></li>
              <li><?php echo $v['math']?></li>
              <li><?php echo $v['write']?></li>
              <li><?php echo $v['comments']?></li>
            </ul>
            <a class="s-consult" href="/class_details/<?php echo $v['id']?>.html">查看详情</a>
          </div>
          <div class="s-img">
            <div class="s-img-bg01">
              <img src="cn/images/course.png" alt="">
            </div>
            <div class="s-img-bg s-img-bg02"></div>
            <div class="s-img-bg s-img-bg03"></div>
          </div>
        </div>
      </div>
    <?php }?>
<!--      <div class="tab-pane fade" id="sprint">-->
<!--        <p class="s-desc">这样的开头是中规中矩，但是具有模板特征，很难取得高分。再看考官范文，先一个traditionally副词开头，引出常规的情况，然后用introducing一个动名词短语引出专家的观点。转瞬间，就用了“副词置于句首”，“</p>-->
<!--        <div class="s-detail clearfix">-->
<!--          <div class="s-text pull-left">-->
<!--            <h2>连授24天</h2>-->
<!--            <p>Nowadays, the topic about when children should begin learning a foreign language has been discussed. Some experts say they should begin at primary school. In my opinion, this has more advantages than disadvantages.</p>-->
<!--            <ul>-->
<!--              <li>模块</li>-->
<!--              <li>阅读</li>-->
<!--              <li>文法</li>-->
<!--              <li>词汇</li>-->
<!--              <li>数学</li>-->
<!--              <li>写作</li>-->
<!--              <li>模考点评</li>-->
<!--            </ul>-->
<!--            <ul>-->
<!--              <li>课时</li>-->
<!--              <li>30</li>-->
<!--              <li>30</li>-->
<!--              <li>15</li>-->
<!--              <li>15</li>-->
<!--              <li>15</li>-->
<!--              <li>15</li>-->
<!--            </ul>-->
<!--            <a class="s-consult" href="#">立即咨询</a>-->
<!--          </div>-->
<!--          <div class="s-img">-->
<!--            <div class="s-img-bg01">-->
<!--              <img src="cn/images/course.png" alt="">-->
<!--            </div>-->
<!--            <div class="s-img-bg s-img-bg02"></div>-->
<!--            <div class="s-img-bg s-img-bg03"></div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="tab-pane fade" id="weekend">-->
<!--        <p class="s-desc">这样的开头是中规中矩，但是具有模板特征，很难取得高分。再看考官范文，先一个traditionally副词开头，引出常规的情况，然后用introducing一个动名词短语引出专家的观点。转瞬间，就用了“副词置于句首”，“</p>-->
<!--        <div class="s-detail clearfix">-->
<!--          <div class="s-text pull-left">-->
<!--            <h2>连授24天</h2>-->
<!--            <p>Nowadays, the topic about when children should begin learning a foreign language has been discussed. Some experts say they should begin at primary school. In my opinion, this has more advantages than disadvantages.</p>-->
<!--            <ul>-->
<!--              <li>模块</li>-->
<!--              <li>阅读</li>-->
<!--              <li>文法</li>-->
<!--              <li>词汇</li>-->
<!--              <li>数学</li>-->
<!--              <li>写作</li>-->
<!--              <li>模考点评</li>-->
<!--            </ul>-->
<!--            <ul>-->
<!--              <li>课时</li>-->
<!--              <li>30</li>-->
<!--              <li>30</li>-->
<!--              <li>15</li>-->
<!--              <li>15</li>-->
<!--              <li>15</li>-->
<!--              <li>15</li>-->
<!--            </ul>-->
<!--            <a class="s-consult" href="#">立即咨询</a>-->
<!--          </div>-->
<!--          <div class="s-img">-->
<!--            <div class="s-img-bg01">-->
<!--              <img src="cn/images/course.png" alt="">-->
<!--            </div>-->
<!--            <div class="s-img-bg s-img-bg02"></div>-->
<!--            <div class="s-img-bg s-img-bg03"></div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
    </div>
  </div>
</section>
<!--底部-->
<?php use app\commands\front\FootWidget;?>
<?php FootWidget::begin();?>
<?php FootWidget::end();?>
</body>
<script>
  $(function () {
    var height = document.documentElement.clientHeight;
    console.log(height);
    $('.s-course').css('height', height)
    $('.s-course .s-title-list').css('paddingTop', 0.05*height)
    $('.s-course .s-desc').css('marginBottom', 0.1*height)
  })
</script>
</html>