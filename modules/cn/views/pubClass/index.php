
  <title>公开课</title>
  <link rel="stylesheet" href="/cn/css/pubClass.css">
  <link rel="stylesheet" href="/cn/css/page.css">
  <script src="/cn/js/page.js"></script>

  <section>
    <!--轮播图-->
    <div class="bnr-wrap center-block clearfix">
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
            <img src="/cn/images/course-bg01.png" alt="First slide">
          </div>
          <div class="item">
            <img src="/cn/images/course-bg01.png" alt="Second slide">
          </div>
          <div class="item">
            <img src="/cn/images/course-bg01.png" alt="Third slide">
          </div>
        </div>
      </div>
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
<!--        --><?php //foreach($arr as $k=>$v){?>
<!--          <li>-->
<!--            <embed  --><?php //if($k<6 && isset($k)){echo "src=".$v['pic'];}else{echo "data-src=".$v['pic'];}?><!-- type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>-->
<!--            <div class="s-cnt">-->
<!--              <h2 class="center-block">--><?php //echo $v['title']?><!--</h2>-->
<!--              <p>--><?php //echo $v['summary']?><!--</p>-->
<!--              <p><span>--><?php //echo $v['activeTime']?><!--</span></p>-->
<!--            </div>-->
<!--          </li>-->
<!--        --><?php //}?>
      </ul>
      <!--<img class="oImag" src="" data-src="http://kingofwallpapers.com/picture/picture-007.jpg" alt="">-->
    </div>
    <div id="pager"></div>
  </section>
<script>
//  $(function(){
//    $('#pager').sjAjaxPager({
//      url: "/cn/pubclass/page",
//      beforeSend: function () {
//
//      },
//      success: function (data) {
//        $('.s-history-cnt').empty();
//        var li ='';
//        console.log(data.list)
//        $.each(data.list,function(index,array){
//          li+="<li><embed src='"+array['pic']+"'type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque'></embed>"+
//              "<div class='s-cnt'>"+
//          "<h2 class='center-block'>"+array['title']+"</h2>"+
//              "<p>"+array['summary']+"</p>"+
//          "<p><span>"+array['publishTime']+"</span><span>16:00-17:00</span></p>"+
//          "</div></li>"
//        })
//        $('.s-history-cnt').append(li);
//      }
//    })
//  })


 /* $(function () {
    var sCnt = $('.s-history-cnt'),
        slideHeight = 1125,
        defHeight = $('.s-history-cnt').height();
    if (defHeight>slideHeight) {
      sCnt.css('height',slideHeight+'px');
    }
    $('.s-more').click(function () {
      var curHeight=  sCnt.height();
      if (curHeight == slideHeight) {
        sCnt.animate({
          height: defHeight
        },1000);
        $('.s-more').html('点击隐藏');
      }else {
        sCnt.animate({
          height: slideHeight
        },'normal');
        $('.s-more').html('查看更多');
      }
      $('.s-history-cnt li embed').each(function () {
        if ($(this).attr('data-src')) {
          this.src = $(this).attr('data-src');
        }
      })
    })
  })
  function apply(id){
    $.get("/cn/pubclass/apply",{id: id},
        function (msg) {
          if (msg) {
            alert('报名成功');
          }
        }, 'text'
    );
  }*/
</script>