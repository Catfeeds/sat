<title>做题详情页</title>
  <link rel="stylesheet" href="/cn/css/doExercise.css">
  <section class="s-exercise">
    <div class="s-w1200">
      <!--路径导航-->
      <ol class="breadcrumb">
        <li><a href="#">首页</a></li>
        <li><a href="#">数学</a></li>
        <li class="active">SAT-1904</li>
      </ol>
      <div class="s-top-img">
        <img src="/cn/images/pubClass-dea_03.png" alt="">
      </div>
      <div class="clearfix">
        <!--题目-->
        <div class="s-exam pull-left">

          <h2 class="s-num"><?php echo $data['id']?></h2>
          <p class="s-title">
            <?php echo $data['topic']?>
          </p>
          <ul class="s-que-list">
            <li>
              <div class="s-select" data-id="A">A</div>
              <div class="s-que"> <?php echo $data['keyA']?> </div>
            </li>
            <li>
              <div class="s-select" data-id="B">B</div>
              <div class="s-que"> <?php echo $data['keyB']?></div>
            </li>
            <li>
              <div class="s-select" data-id="C">C</div>
              <div class="s-que"> <?php echo $data['keyC']?></div>
            </li>
            <li>
              <div class="s-select" data-id="D">D</div>
              <div class="s-que"> <?php echo $data['keyD']?></div>
            </li>
          </ul>

          <div class="s-btn-list clearfix">
            <div class="s-collect pull-left">
              <i class="fa fa-star-o"></i>
              收藏
            </div>
            <ul class="s-answer pull-right">
              <li>查看答案</li>
              <li><a href="">上一题</a></li>
              <li><a href="">下一题</a></li>
            </ul>
          </div>
          <!--答案解析-->
          <div class="s-answer-show">
            <h3>题目解析:</h3>
            <div class="s-answer-cnt">
              <p>正确答案:D</p>
              <p>In virtually any industry, technological improvements increase labor productivity, which is the output of goods and services per person-hour worked. In Parland's industries, labor productivity is significantly higher than it is in Vergia's industries. Clearly, therefore, Parland's industries must, on the whole, be further advanced technologically than Vergia's are.
                The argument is most vulnerable to which of the following criticisms?</p>
            </div>
          </div>
        </div>
        <!--右侧栏-->
        <div class="s-adv pull-right">
          <a href="#">
            <img class="s-adv-img" src="/cn/images/pubClass-dea_11.png" alt="">
          </a>
          <div class="s-code">
            <img src="/cn/images/qr-code01.png" alt="">
            <p>扫描关注</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<script>
  $('.s-exam .s-que-list li').click(function () {
    $('.s-exam .s-que-list li').find('.s-select').removeClass('active');
    $(this).find('.s-select').addClass('active')
  })
  $('.s-exam .s-answer li').click(function () {
    if ($(this).index() == 0) {
      $('.s-exam .s-answer-show').fadeIn(1000)
    }
//    $('.s-exam .s-answer li').removeClass('active');
    $(this).addClass('active');
  })
//  收藏
  $('.s-exam .s-collect').click(function () {
    var _this = $(this);
    if (_this.find('i').hasClass('fa-star-o')) {
      _this.addClass('active');
      _this.find('i').removeClass('fa-star-o');
      _this.find('i').addClass('fa-star');
    } else {
      _this.removeClass('active');
      _this.find('i').removeClass('fa-star');
      _this.find('i').addClass('fa-star-o');
    }
  })
</script>
</html>