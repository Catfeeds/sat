<link rel="stylesheet" href="/cn/css/single-report.css">
<script src="/cn/js/highcharts.js"></script>
<script src="/cn/js/report-details.js"></script>

<section class="s-w1200">
  <div class="report-banner">
    <div class="report-bnr-cnt">
      <span>lala</span>
      同学你好,以下是你的考试分析报告
    </div>
  </div>
  <div class="report-wrap clearfix">
    <div class="report-cnt pull-left">
      <!-- 成绩与正确率-->
      <h3 class="report-title">成绩</h3>
      <div class="report-score clearfix">
        <div class="score pull-left">
          <h5>成绩</h5>
          <p>本次得分<span>222</span>分</p>
          <p>答对<span>14</span>题</p>
          <p>答题所用时间<span>12.5</span>min</p>
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
          RC 的正确率达到 60% ，并不是说就万事大吉了，一定多去关注自己错题有没有集合在同一篇文章下，对于这种文章，要多注意总结 分析结构。一般来说，只要阅读可以保证每篇错不超过一半，就可以保证不掉库。每天的练习量需要以文章类型或者题型为主。如果是文 章类型的问题，那么要多注意分析文章结构；如果是题型问题，则需要多总结相关的题型技巧。资料的话：自己的错题库 +prep （建议 08- 12-07 ）
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
            <img src="/cn/images/sat-course01.png" alt="First slide">
          </div>
          <div class="item">
            <img src="/cn/images/sat-course02.png" alt="Second slide">
          </div>
          <div class="item">
            <img src="/cn/images/sat-course03.png" alt="Third slide">
          </div>
        </div>
        <!-- 轮播（Carousel）导航 -->
        <a class="carousel-control left" href="#myCarousel"
           data-slide="prev">&lsaquo;
        </a>
        <a class="carousel-control right" href="#myCarousel"
           data-slide="next">&rsaquo;
        </a>
      </div>
    </div>
  </div>

  <input class="class-hid" type="hidden" data-class="Reading">
</section>
<script>
  $(function() {
    pieChart('accuChart',[parseInt(12),parseInt(30),parseInt(58)],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
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
      url: '',
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