 <link rel="stylesheet" href="/cn/css/test.css">
<section>
  <div class="s-test s-w1200">
    <div class="s-top-adv">
      <img src="/cn/images/exer01.png" alt="背景图片">
    </div>
    <div class="s-cnt clearfix">
      <div class="s-left pull-left">
        <ul class="s-label-list">
          <li class="active" data-src="reading">阅读</li>
          <li data-src="writing">文法</li>
          <li data-src="math"> 数学</li>
        </ul>
        <div class="s-subject-src">
          <dl class="s-src">
            <dt>题目来源：</dt>
            <dd class="active" data-src="all">全部</dd>
            <dd data-src="og">OG</dd>
            <dd data-src="princeton">普林斯顿</dd>
            <dd data-src="kaplan">开普兰</dd>
            <dd data-src="barron">BARRON</dd>
          </dl>
          <dl class="s-sub">
            <dt>试卷来源：</dt>
            <dd class="active" data-src="all">全部</dd>
            <dd data-src="og1">OG1</dd>
            <dd data-src="og2">OG2</dd>
            <dd data-src="og1">OG1</dd>
            <dd data-src="og2">OG2</dd>
            <dd data-src="og1">OG1</dd>
            <dd data-src="og2">OG2</dd>
            <dd data-src="og1">OG1</dd>
            <dd data-src="og2">OG2</dd>
            <dd data-src="og1">OG1</dd>
            <dd data-src="og2">OG2</dd>
          </dl>
        </div>
        <div class="s-subject-cnt">
          <ul>
            <?php foreach($data as $k=>$v){?>
            <li>
              <h3><?php echo $v['name'].'-'.$v['time'].'-'.$v['major'].'-'.$v['number']?></h3>
              <div><?php
                  echo $v['content'];
                  ?>
              </div>
              <a href="/exercise_details/<?php echo $v['qid']?>.html">做题</a>
            </li>
            <?php }?>
          </ul>
        </div>
        <?php echo $page?>
      </div>
      <div class="s-right pull-right">
        <div class="s-right-subject s-right1">
          <h2>做题排行榜</h2>
          <?php foreach ($rank as $k=>$v){if($k<3){?>
          <div class="s-rank-list">
            <div class="s-rank-img"></div>
            <div class="s-rank-name">
              <h4><?php echo $v['nickname']!=false?$v['nickname']:$v['username']?></h4>
              <p><span><?php echo $v['count']?>题</span><span><?php echo sprintf("%.2f",$v['correctRate'])?>%正确率</span></p>
            </div>
          </div>
          <?php }}?>
          <ul>
            <?php foreach ($rank as $k=>$v){if($k>=3){?>
            <li class="s-rank-box">
              <p><?php echo $v['nickname']!=false?$v['nickname']:$v['username']?></p>
              <p><span><?php echo $v['count']?>题</span><span><?php echo sprintf("%.2f",$v['correctRate'])?>%正确率</span></p>
            </li>
            <?php }}?>
          </ul>
        </div>
        <div class="s-right-subject s-right2">
          <h2>最新题目</h2>
          <ul>
            <?php foreach($arr as $k=>$v){?>
              <li>
                <h3><?php echo $v['qid']?>.</h3>
                <a href="/exercise_details/<?php echo $v['qid']?>.html">
                  <?php echo $v['content']; ?>
                </a>
              </li>
            <?php }?>
          </ul>
        </div>
        <div class="s-right-code">
          <img src="/cn/images/qr-code01.png" alt="">
          <p>扫码关注</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--底部-->
<script>
  $(function () {
    jQuery(".s-right").slide({mainCell: ".s-right1 ul", autoPlay: true, effect: "topMarquee", vis: 4, interTime: 100});
    jQuery(".s-right").slide({mainCell: ".s-right2 ul", autoPlay: true, effect: "topMarquee", vis: 4, interTime: 100});

    subject.init();
  })
  var subject = {
    init: function () {
      this.bindEvent();
    },
    bindEvent: function() {
      var _this = this;
      $('.s-label-list>li').click(function(){
        var name = $(this).attr('data-src');
        _this.effectEvent(this);
        _this.ajaxEvent(name,'all','all',1);
      });
      $('.s-subject-src dd').click(function(){
        var par = $(this).parent().attr('class');
        var name = $('.s-label-list li.active').attr('data-src');
        if (par == "s-src") {
          var src = $(this).attr('data-src');
          var sub = 'all';
        }else if (par == "s-sub") {
          var src = $('.s-src dd.active').attr('data-src');
          var sub = $(this).attr('data-src');
        }
        _this.effectEvent(this);
        _this.ajaxEvent(name,src,sub,1);
      })
    },
    //  点击效果
    effectEvent: function (obj) {
      $(obj).parent().children().removeClass('active');
      $(obj).addClass('active');
    },
    // ajax数据交互
    ajaxEvent: function (name,src,sub,p) {
      $.ajax({
        url: '',
        type: 'post',
        data: {
          name: name,
          src: src,
          subject: sub,
          p: p
        },
        dataType: 'json',
        beforeSend: function () {
          $('.s-subject-cnt>ul').html('加载中');
        },
        success: function (res) {
          console.log(res);
        }
      })
    }
  }
</script>
