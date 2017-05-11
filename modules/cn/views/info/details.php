<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>公开课详情页</title>
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/public.css">
    <link rel="stylesheet" href="/cn/css/bootstrap.css">
    <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
    <link rel="stylesheet" href="/cn/css/pubClass-detail.css">
    <script src="/cn/js/less.js"></script>
    <script src="/cn/js/jquery-2.1.3.js"></script>
    <script src="/cn/js/bootstrap.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
</head>
<body>
  <!--导航-->
  <?php use app\commands\front\NavWidget;?>
  <?php NavWidget::begin();?>
  <?php NavWidget::end();?>
  <section>
    <div class="s-w1200">
      <!--路径导航-->
      <ol class="breadcrumb">
        <li><a href="#">首页</a></li>
        <li><a href="#"><?php echo $data['cate']?></a></li>
        <li class="active">正文</li>
      </ol>
      <!--背景图片-->
      <a href="#" class="s-pd-bg">
        <img src="/cn/images/pubClass-dea_03.png" alt="背景图片">
      </a>
      <!--文章标题图片-->
      <div class="s-pd-title-bg">
        <img src="/cn/images/pubClass-dea_07.png" alt="">
      </div>
      <div class="s-pd-cnt clearfix">
        <div class="s-pd-left pull-left">
          <h2 class="s-pd-title"><?php echo $data['title']?></h2>
          <div class="clearfix">
            <p class="s-pd-time pull-right"><span><?php echo date('Y-m-d',$data['publishTime'])?></span><span>阅读<i><?php echo $data['hits']?></i></span></p>
          </div>
          <h3>摘要：<?php echo $data['summary']?></h3>
          <div class="s-pd-font"><?php echo $data['content']?></div>
          <!-- 分享插件 -->
          <div class="jiathis_style_24x24">
            <strong>分享到:</strong>
            <a class="jiathis_button_qzone"></a>
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_cqq"></a>
            <a class="jiathis_button_douban"></a>
            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
          </div>
          <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
          <!-- 分享插件 END -->
          <a href="#" class="s-ad-bottom s-adver">
            <img src="/cn/images/pubClass-dea_14.png" alt="">
            <p></p>
          </a>
          <div class="s-left-about clearfix">
            <div class="clearfix">
              <img class="pull-left" src="/cn/images/pubClass-dea_19.png" alt="">
              <h2>相关文章</h2>
            </div>
            <ul>
              <?php foreach($arr as $k=> $v){if($k<5){?>
              <li><a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a></li>
              <?php }}?>
            </ul>
            <ul>
              <?php foreach($arr as $k=> $v){if($k>=5&&$k<10){?>
              <li><a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a></li>
              <?php }}?>
            </ul>
          </div>
        </div>
        <div class="s-pd-right pull-right">
          <a class="s-pd-ad s-adver">
            <img src="/cn/images/pubClass-dea_11.png" alt="广告位">
            <p></p>
          </a>
          <div class="s-pd-list">
            <h2>为你推荐</h2>
            <ul>
              <?php foreach ($brr as $k=>$v){?>
              <li class="clearfix">
                <h4><span><?php echo $k+1;?></span><?php echo $v['title']?></h4>
                <img class="pull-left" src="/cn/images/pubClass-dea_15.png" alt="">
                <a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['summary']?></a>
              </li>
              <?php }?>
            </ul>
            <div class="s-pd-qr">
              <img src="/cn/images/qr-code01.png" alt="二维码">
              <p>扫一扫添加关注</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!--底部-->
  <?php use app\commands\front\FootWidget;?>
  <?php FootWidget::begin();?>
  <?php FootWidget::end();?>
</body>
</html>