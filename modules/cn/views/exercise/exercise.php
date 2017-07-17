<title>做题详情页</title>
  <link rel="stylesheet" href="/cn/css/mock-details.css">
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
        <!-- 数学-->
          <div class="math-exam work-question-part"  <?php if($data['major']!='Math1'&&$data['major']!='Math2'){echo 'style="display:none;"';}?>>
            <h2 class="s-num"><?php echo $data['qid']?></h2>
            <p class="s-title">
              <?php echo $data['content']?>
            </p>
            <!-- 数学选择-->
            <ul class="work-que-list" id="subjectId" data-id="<?php echo $data['qid']?>" <?php if($data['isFilling']==1){echo 'style="display:none;"';}?>>
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="A">A</div>
                <div class="work-que"> <?php echo $data['keyA']?> </div>
              </li>
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="B">B</div>
                <div class="work-que"> <?php echo $data['keyB']?></div>
              </li>
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="C">C</div>
                <div class="work-que"> <?php echo $data['keyC']?></div>
              </li>
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="D">D</div>
                <div class="work-que"> <?php echo $data['keyD']?></div>
              </li>
            </ul>
            <!--数学填空-->
            <table class="math-gap-table" border="1" align="center" <?php if($data['isFilling']==0){echo 'style="display:none;"';}?>>
              <tr>
                <td class="math-gap-result" colspan="4"><input type="text"></td>
              </tr>
              <tr>
                <td class="math-btn">7</td>
                <td class="math-btn">8</td>
                <td class="math-btn">9</td>
                <td class="math-sure" rowspan="2">确定</td>
              </tr>
              <tr>
                <td class="math-btn">4</td>
                <td class="math-btn">5</td>
                <td class="math-btn">6</td>
              </tr>
              <tr>
                <td class="math-btn">1</td>
                <td class="math-btn">2</td>
                <td class="math-btn">3</td>
                <td class="math-clear" rowspan="2">清空</td>
              </tr>
              <tr>
                <td class="math-btn">0</td>
                <td class="math-btn">.</td>
                <td class="math-btn">/</td>
              </tr>
            </table>
          </div>
        <!-- 阅读-->
          <div class="read-exam clearfix" <?php if($data['major']=='Math1'||$data['major']=='Math2'){echo 'style="display:none;"';}?>>
            <div class="work-wrap-left pull-left">
              <h3><?php echo isset($data['topic'])?$data['topic']:''?></h3>
              <h5><?php echo isset($data['details'])?$data['details']:''?></h5>
              <div class="work-box">
                <div class="read-text">
                  <p>
                    <?php echo isset($data['essay'])?$data['essay']:''?>
                  </p>
                </div>
              </div>
            </div>
            <div class="work-wrap-right pull-right">
              <div class="work-question" id="1">
                <div class="work-question-part clearfix">
                  <div>
                    <h1><?php echo $data['number']?>.</h1>
                    <?php echo $data['content']?>
                  </div>
                  <ul class="work-que-list" id="subjectId" data-id="<?php echo $data['qid']?>">
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="A">A</div>
                      <div class="work-que"><?php echo $data['keyA']?> </div>
                    </li>
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="B">B</div>
                      <div class="work-que"><?php echo $data['keyB']?> </div>
                    </li>
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="C">C</div>
                      <div class="work-que"><?php echo $data['keyC']?> </div>
                    </li>
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="D">D</div>
                      <div class="work-que"><?php echo $data['keyD']?> </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="correct-ans-hide">正确答案：<span><?php echo $data['answer']?></span></div>
          <div class="s-btn-list clearfix">
            <div class="s-collect work-collect pull-left" data-value="<?php echo isset($data['collection'])?$data['collection']:'0'?>">
              <i class="fa fa-star-o"></i>
              <span>收藏</span>
            </div>
            <ul class="s-answer pull-right">
              <li>查看答案</li>
              <li><a class="last-que" onclick="noQuestion(this)" href="/exercise_details/<?php echo $upid?>.html" data-id="<?php echo $upid?>">上一题</a></li><a>
              <li><a class="next-que" onclick="noQuestion(this)" href="/exercise_details/<?php echo $nextid?>.html" data-id="<?php echo $nextid?>">下一题</a></li>
            </ul>
          </div>
          <!--答案解析-->
          <div class="s-answer-show">
            <h3>题目解析:</h3>
            <div class="s-answer-cnt">
              <p>正确答案:<span class="correct-answer"><?php echo $data['answer']?></span></p>
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
    uId = 444;
    // 加载页面时判断是否收藏
    if (($('.s-collect').data('value') == 1) && (uId != '')) {
      var sCollect = $('.s-collect');
      sCollect.addClass('active');
      sCollect.find('i').removeClass('fa-star-o');
      sCollect.find('i').addClass('fa-star');
      sCollect.children('span').html('已收藏');
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
    // 判断是否正确
    $('.work-que-wrap').click(function() {
      var ans = $('.work-select.active').data('id');
      if (ans != $('.correct-answer').html()) {
        $(this).find('.work-select').css({
          backgroundColor: 'red',
          borderColor: 'red',
          color: '#fff'
        })
        $('.correct-ans-hide').fadeIn();
      }
    })
    $('.math-sure').click(function () {
      var v = eval($('.math-gap-result input').val());
      v = Math.floor(v*1000)/1000;
      var r = eval($('.correct-answer').html());
      r = Math.floor(r*1000)/1000;
      if (v != r) {
        $('.correct-ans-hide').fadeIn();
      }
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
    }
  })
//  判断是否最后一道题
  function noQuestion(obj) {
    var _this = $(obj);
    if (_this.data('id') == '') {
      _this.get(0).href = 'javascript:void(0)';
      alert('你真棒，已经把题做完了');
    }
  }
</script>
</html>