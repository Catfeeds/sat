
  <title>公开课</title>
  <link rel="stylesheet" href="/cn/css/pubClass.css">
  <script src="/cn/js/jqPaginator.js"></script>

  <section>
    <!--轮播图-->
    <div class="bnr-wrap center-block clearfix">
<!--      <div id="myCarousel" class="carousel slide">-->
<!--        <!-- 轮播（Carousel）指标 -->
<!--        <ol class="carousel-indicators">-->
<!--          --><?php //foreach ($pic as $k=>$v){
//            if($k==0){
//              echo '<li data-target="#myCarousel" data-slide-to="'.$k.'" class="active"></li>';
//            }else{
//              echo '<li data-target="#myCarousel" data-slide-to="'.$k.'"></li>';
//            }
//          }?>
<!---->
<!--        </ol>-->
<!--        <!-- 轮播（Carousel）项目 -->
<!--        <div class="carousel-inner">-->
<!--          --><?php //foreach($pic as $k=>$v){
//            if($k==0){
//              echo '<div class="item active">';
//            }else{
//              echo '<div class="item">';
//            }
//            echo '<a href="'.$v['url'].'"> <img src="'.$v['pic'].'" alt="'.$v['alt'].'"></a>
//                    </div>';
//          }?>
<!--        </div>-->
<!--        <!-- 轮播（Carousel）导航 -->
<!--        <a class="carousel-control left" href="#myCarousel"-->
<!--           data-slide="prev">&lt;-->
<!--        </a>-->
<!--        <a class="carousel-control right" href="#myCarousel"-->
<!--           data-slide="next">&gt;-->
<!--        </a>-->
<!--      </div>-->
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
        <li>
          <img src="/cn/images/class_img01.png" alt="">
          <div>
            <h2><?php echo $v['title']?></h2>
            <ul>
              <li class="pull-left">
                <span>授课老师:</span>
                <span><?php echo $v['name']?></span>
              </li>
              <li class="pull-left">
                <span>报名人数：</span>
                <span id="data"><?php echo $v['hits']?></span>
              </li>
              <li class="pull-right">
                <span><?php echo $v['activeTime']?></span>
              </li>
            </ul>
            <p><?php echo $v['summary']?></p>
            <a href=""  onclick="apply(<?php echo $v['id'] ?>)">报名</a>
            <a href="/info_details/<?php echo $v['id']?>.html">详情</a>
<!--            <a href="info_details.html">详情</a>-->
          </div>
        </li>
        <?php }?>
      </ul>
      <div class="s-history-title">
        <img src="/cn/images/class_bg02.png" alt="">
        <h2>往期公开课</h2>
      </div>
      <ul class="s-history-cnt clearfix">
        <li>
          <embed src="http://www.tudou.com/v/WVdpMQ1En8Q/&bid=05&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>
          <div class="s-cnt">
            <h2 class="center-block">公开课名称</h2>
            <p>是否不希望在小屏幕设备上所有列都堆叠在一起？那就使用针对超小屏幕和中等屏幕设备所定义的类吧，即 .col-xs-* 和 .col-md-*。请看下面的实例，研究一下这些是如何工作的。</p>
            <p><span>2017-4-20</span><span>16:00-17:00</span></p>
          </div>
        </li>
      </ul>
      <!--<img class="oImag" src="" data-src="http://kingofwallpapers.com/picture/picture-007.jpg" alt="">-->
    </div>
    <ul class="pagination"></ul>
    <div id="pageCount"></div>
  </section>
<script>
  var curPage = 1; //当前页码

  function getData(p) {
    $.ajax({
      type: 'GET',
      url: "/cn/pubclass/page",
      data: {
        'p': p
      },
      dataType: 'json',
      beforeSend: function () {
        var li = "<li><i class='fa fa-spinner fa-spin'></i></li>"
      },
      success: function (data) {
        $('.s-history-cnt').empty();
        var li ='';
        total = data.total;//总记录数
        totalPage = data.totalPage;//总页数
        curPage = p;
        $.each(data.list,function(index,array){
          console.log(array.publishTime)
          li+="<li><embed src='"+array['pic']+"'type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque'></embed>"+
              "<div class='s-cnt'>"+
              "<h2 class='center-block'>"+array['title']+"</h2>"+
              "<p>"+array['summary']+"</p>"+
              "<p><span>"+array['publishTime']+"</span><span>16:00-17:00</span></p>"+
              "</div></li>"
        });
        $('.s-history-cnt').append(li);
      },
      complete: function() {
        $.jqPaginator('.pagination', {
          totalPages: totalPage,
          visiblePages: 5,
          currentPage: curPage,
          onPageChange: function () {
            $(".pagination li a").on('click',function(){
              var rel = parseInt($(this).parent().attr("jp-data"));
              if(rel){
               getData(rel)
              }
            });
          }
        });
      }
    })
  }

  $(function(){
    getData(1);
  });

</script>