
  <link rel="stylesheet" href="/cn/css/pubClass.css">
  <script src="/cn/js/jqPaginator.js"></script>
  <script src="/cn/js/pubClass.js"></script>
  <section>
    <!--轮播图-->
    <div class="bnr-wrap center-block clearfix">
      <?php use app\commands\front\BannerWidget;?>
      <?php BannerWidget::begin();?>
      <?php BannerWidget::end();?>
    </div>
    <div class="s-w1200">
      <div class="s-new-title">
        <h2>最新公开课</h2>
      </div>
      <ul class="s-new-cnt">
        <?php foreach($data as $v){?>
        <li class="s-new-list">
          <img src="<?php if($v['pic']!=false){echo $v['pic'];}else{echo '/cn/images/class_img01.png';}?>" alt="">
          <div>
            <h2><?php echo $v['title']?></h2>
            <ul>
              <li class="pull-left">
                <span>授课老师:</span>
                <span><?php echo $v['name']?></span>
              </li>
              <li class="pull-left">
                <span>报名人数：</span>
                <span class="s-apply-num"><?php echo $v['hits']?></span>
              </li>
              <li class="pull-right">
                <span><?php echo $v['activeTime']?></span>
              </li>
            </ul>
            <p><?php echo $v['summary']?></p>
            <button class="s-apply on">报名</button>
            <a href="/info_details/<?php echo $v['id']?>.html">详情</a>
          </div>
        </li>
        <?php }?>
      </ul>
      <div class="s-history-title">
        <img src="/cn/images/class_bg02.png" alt="">
        <h2>往期公开课</h2>
      </div>
      <ul class="s-history-cnt clearfix">
<!--        <li>-->
<!--          <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>-->
<!--          <div class="s-cnt">-->
<!--            <h2 class="center-block">公开课名称</h2>-->
<!--            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>-->
<!--            <p><span>2017-4-20</span><span>16:00-17:00</span></p>-->
<!--          </div>-->
<!--        </li>-->
      </ul>
      <!--<img class="oImag" src="" data-src="http://kingofwallpapers.com/picture/picture-007.jpg" alt="">-->
    </div>
    <div class="s-page">
      <ul class="pagination clearfix"></ul>
    </div>
  </section>
