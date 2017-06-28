<title>做题详情页</title>
  <link rel="stylesheet" href="/cn/css/doExercise.css">
  <section class="s-exercise">
    <div class="s-w1200">
      <!--路径导航-->
      <ol class="breadcrumb">
        <li><a href="/index.html">首页</a></li>
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
            <?php echo $data['content']?>
          </p>
          <ul class="s-que-list" id="subjectId" data-id="<?php echo $data['qid']?>">
            <li class="work-que-wrap">
              <div class="s-select work-select" data-id="A">A</div>
              <div class="s-que"> <?php echo $data['keyA']?> </div>
            </li>
            <li class="work-que-wrap">
              <div class="s-select work-select" data-id="B">B</div>
              <div class="s-que"> <?php echo $data['keyB']?></div>
            </li>
            <li class="work-que-wrap">
              <div class="s-select work-select" data-id="C">C</div>
              <div class="s-que"> <?php echo $data['keyC']?></div>
            </li>
            <li class="work-que-wrap">
              <div class="s-select work-select" data-id="D">D</div>
              <div class="s-que"> <?php echo $data['keyD']?></div>
            </li>
          </ul>

          <div class="s-btn-list clearfix">
            <div class="s-collect work-collect pull-left" data-value="1">
              <i class="fa fa-star-o"></i>
              收藏
            </div>
            <ul class="s-answer pull-right">
              <li>查看答案</li>
              <li><a href="/exercise_details/<?php echo $upid?>.html">上一题</a></li>
              <li><a href="/exercise_details/<?php echo $nextid?>.html">下一题</a></li>
            </ul>
          </div>
          <!--答案解析-->
          <div class="s-answer-show">
            <h3>题目解析:</h3>
            <div class="s-answer-cnt">
              <p>正确答案:<?php echo $data['answer']?></p>
              <p>解析：<?php echo isset($data['analysis'])?$data['analysis']:'无'?></p>
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
  $(function () {
    var uId = $.cookie('uid');
    // 加载页面时判断是否收藏
    if (($('.s-collect').data('value') == 1) && (uId != '')) {
      var sCollect = $('.s-collect');
      sCollect.addClass('active');
      sCollect.find('i').removeClass('fa-star-o');
      sCollect.find('i').addClass('fa-star');
    }
    //查看答案
    $('.s-exam .s-answer li').click(function () {
      if ($(this).index() == 0) {
        if ($('.s-answer-show').css('display') == 'none') {
          $(this).addClass('active');
          $('.s-exam .s-answer-show').fadeIn(1000)
        } else {
          $(this).removeClass('active');
          $('.s-exam .s-answer-show').fadeOut(300)
        }
      }
    })
  })
</script>
</html>