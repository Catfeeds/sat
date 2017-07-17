<link rel="stylesheet" href="/cn/css/single-report.css">
<script src="/cn/js/highcharts.js"></script>
<script src="/cn/js/report-details.js"></script>

<section class="s-w1200">
  <div class="report-banner">
    <div class="report-bnr-cnt">
      <span>lala</span>
      同学你好,以下是你的<span class="class-hid" data-class="<?php echo $report['part']?>"><?php echo $report['part']?></span>分析报告
    </div>
  </div>
  <div class="report-wrap clearfix">
    <div class="report-cnt pull-left">
      <!-- 成绩与正确率-->
      <h3 class="report-title">成绩</h3>
      <div class="report-score clearfix">
        <div class="score pull-left">
          <h5><?php echo $report['part']?>成绩</h5>
          <p>本次得分<span><?php $major=$report["part"];echo $report["$major"];?></span>分</p>
          <p>答对<span><?php if($report['part']=='Math'){echo $report['mathnum'];}elseif($report['part']=='Reading'){echo $report['readnum'];}else{echo $report['writenum'];}?></span>题</p>
          <p>答题所用时间<span><?php echo sprintf("%.2f",$report['time']/60)?></span>min</p>
        </div>
        <div class="accuracy pull-left">
          <h5>正确率</h5>
          <div class="accuracy-chart" id="accuChart"></div>
          <ul class="accuracy-list">
            <li>
              <span></span>
              <i>正确</i>
            </li>
            <li>
              <span class="sub-red"></span>
              <i>错误</i>
            </li>
            <li>
              <span class="sub-blue"></span>
              <i>放弃</i>
            </li>
          </ul>
        </div>
      </div>
      <!--复习策略 -->
      <h3 class="report-title">复习策略</h3>
      <div class="report-review">
        <img src="/cn/images/report01.png" alt="">
        <div class="review-text">
            <?php echo $suggest["$major"]?>
        </div>
      </div>
      <!--做题详情-->
      <h3 class="report-title">做题详情</h3>
      <div class="report-details">
        <div class="ans-cnt">
          <ul class="ans-classify">
            <li class="on" data-val="all" data-sub="Reading">全部题目</li>
            <li data-val="wrong" data-sub="Reading">查看错题</li>
            <li data-val="long" data-sub="Reading">耗时较长题目</li>
          </ul>
          <ol>
            <li class='clearfix'>
              <div class='lost-time pull-left'>
                <span>耗时</span><p>2.5</p><span>秒</span>
              </div>
              <div class='show-correct-ans pull-right'>
                <strong>C</strong>
                <i>/</i>
                <b>B</b>
              </div>
              <div class='question-stem'>
                <p>
                  <a href=/exercise_details/2.html target='_blank'>fnajfalmflamklgk nvjda gdnafjkn dnakn anjfb amkkvla ang angkna ngfran angfakn gfkalmnlk amgkan gmafkldgfl gfkadgk m</a>
                </p>
              </div>
            </li>
            <li class='clearfix'>
              <div class='lost-time pull-left'>
                <span>耗时</span><p>2.5</p><span>秒</span>
              </div>
              <div class='show-correct-ans pull-right'>
                <strong>C</strong>
                <i>/</i>
                <b>B</b>
              </div>
              <div class='question-stem'>
                <p>
                  <a href=/exercise_details/2.html target='_blank'>fnajfalmflamklgk nvjda gdnafjkn dnakn anjfb amkkvla ang angkna ngfran angfakn gfkalmnlk amgkan gmafkldgfl gfkadgk m</a>
                </p>
              </div>
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="report-side pull-right">
    <!-- 热门课程-->
      <h3 class="report-title">热门课程</h3>
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
            <a href="#" target="_blank"><img src="/cn/images/sat-course01.png" alt="First slide"></a>
          </div>
          <div class="item">
            <a href="#" target="_blank"><img src="/cn/images/sat-course02.png" alt="Second slide"></a>
          </div>
          <div class="item">
            <a href="#" target="_blank"><img src="/cn/images/sat-course03.png" alt="Third slide"></a>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<script>
  $(function() {
    pieChart('accuChart',[parseInt(<?php if($report['readnum']!=0){$a=$report['readnum']/52*100;$b=$report['readerror']/52*100;$c=(52-$report['readnum']-$report['readerror'])/52*100;echo $a;}
    if($report['writenum']!=0){$a=$report['writenum']/44*100;$b=$report['writeerror']/44*100;$c=(44-$report['writenum']-$report['writeerror'])/44*100;echo $a;}
    if($report['mathnum']!=0){$a=$report['mathnum']/58*10;$b=$report['matherror']/58*100;$c=((58-$report['mathnum']-$report['matherror'])/58)*100;echo $a;}
    ?>),parseInt(<?php echo $b?>),parseInt(<?php echo $c?>)],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
//    pieChart('repReading',[parseInt('<?php //echo $report['readnum']/52*100?>//'),parseInt('<?php //echo $report['readerror']/52*100?>//'),parseInt('<?php //echo (52-$report['readnum']-$report['readerror'])/52*100?>//')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
//    pieChart('repWriting',[parseInt('<?php //echo $report['writenum']/44*100?>//'),parseInt('<?php //echo $report['writeerror']/44*100?>//'),parseInt('<?php //echo (44-$report['writenum']-$report['writeerror'])/44*100?>//')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
//    pieChart('repMath',[parseInt('<?php //echo $report['mathnum']/58*100?>//'),parseInt('<?php //echo $report['matherror']/58*100?>//'),parseInt('<?php //echo ((58-$report['mathnum']-$report['matherror'])/58)*100?>//')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});





    $('.ans-classify li').click(function () {
      $('.ans-classify li').removeClass('on');
      $(this).addClass('on');
      var c = $(this).data('val'),
        s = $('.class-hid').data('class');
      reportData(s,c);
    })
  })
  function reportData(s,c) {
    $.ajax({
      url: '/cn/report/que',
      type: 'get',
      data: {
        'sub': s,
        'classify': c
      },
      dataType: 'json',
      success: function (data) {
        $('.ans-cnt ol').empty();
        var li = '';
        $.each(data,function(index,array) {
          li+=" <li class='clearfix'>"+
            "<div class='lost-time pull-left'>"+
            "<span>耗时</span>"+
            "<p>"+array['1']+"</p>"+
            "<span>秒</span>"+
            "</div>"+
            "<div class='show-correct-ans pull-right'>"+
            "<strong>"+array['0']+"</strong>"+
            "<i>/</i>"+
            "<b>"+array['answer']+"</b>"+
            "</div>"+
            " <div class='question-stem'>"+
            "<p>"+
            "<a href=/exercise_details/"+array['id']+".html target='_blank'>"+array['content']+"</a>"+
            "</p>"+
            "</div>"+
            "</li>"
        });
        $('.ans-cnt ol').append(li);
      },
      complete: function () {
        $('.ans-cnt ol li').each(function (i) {
          if ($('.ans-cnt ol li').eq(i).find('.show-correct-ans').find('strong').html() == $('.ans-cnt ol li').eq(i).find('.show-correct-ans').find('b').html()) {
            $('.ans-cnt ol li').eq(i).find('.show-correct-ans').find('strong').css('color','green');
          }
        })
      },
      error: function() {
        console.log('错误');
      }
    })
  }
</script>
