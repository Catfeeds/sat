 <link rel="stylesheet" href="/cn/css/test.css">
 <script src="/cn/js/jqPaginator.js"></script>
 <script src="/cn/js/exer-index.js"></script>
<section>
  <div class="s-test s-w1200">
    <div class="s-top-adv">
      <img src="/cn/images/exer01.png" alt="背景图片">
    </div>
    <div class="s-cnt clearfix">
      <div class="s-left pull-left">
        <ul class="s-label-list">
          <li class="active" data-src="Reading">阅读</li>
          <li data-src="Writing">文法</li>
          <li data-src="Math"> 数学</li>
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
          </dl>
        </div>
        <div class="s-subject-cnt">
          <ul>
          </ul>
        </div>
        <div class="s-page">
          <ul class="pagination clearfix"></ul>
        </div>
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
                  <?php echo $v['content']!=false?$v['content']:'Title hidden, click to view'; ?>
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
  })
</script>
