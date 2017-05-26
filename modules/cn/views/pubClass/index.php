
  <title>公开课</title>
  <link rel="stylesheet" href="/cn/css/pubClass.css">
  <script src="/cn/js/page2.js"></script>

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
    <div id="pageCount"></div>
  </section>
<script>

  var curPage = 1; //当前页码

  function getData(page) {
    $.ajax({
      type: 'GET',
      url: "/cn/pubclass/page",
      data: {
        'p': page
      },
      dataType: 'json',
      success: function (data) {
        $('.s-history-cnt').empty();
        var li ='';
        total = data.total;//总记录数
        totalPage = data.totalPage;//总页数
        curPage = page;
        console.log(data);
        $.each(data.list,function(index,array){
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
        getPage({
          id: 'pageCount',
          nowNum: curPage,
          allNum: totalPage
        });
      }
    })
  }

  function getPage(opt) {
    if(!opt.id) {return false};

    var obj = $('#'+opt.id),
        pageStr = '',
        nowNum = opt.nowNum || 1,//当前页数
        allNum = opt.allNum || 5;//总页数
    //var callBack = opt.callBack || function () {};//回调函数
    //当前页数大于等于4或者总页数大于等于6时显示首页
    if (nowNum >= 4 && allNum >= 6){
      pageStr+="<a href='#1' class='grey'>首页</a>";
    };
    //当前页数大于等于2时显示上一页
    if (nowNum>=2) {
      pageStr+="<a href='#"+(nowNum-1)+"' class='grey'>上一页</a>";
    };
    //总页数小于等于5时
    if (allNum<=5) {
      for (var i=1;i<=allNum;i++) {
        if (nowNum == i){
          pageStr+="<a href='#"+i+"' class='blue'>"+i+"</a>"
        }else {
          pageStr+="<a href='#"+i+"' class='grey'>"+i+"</a>"
        }
      }
    }
    else {
      for (var i=1;i<=5;i++) {
        if (nowNum == 1 || nowNum == 2) {
          if (nowNum == i) {
            pageStr+="<a href='#"+i+"' class='blue'>"+i+"</a>"
          } else {
            pageStr+="<a href='#"+i+"' class='grey'>"+i+"</a>"
          }
        }else if((allNum == nowNum) || (nowNum == allNum-1)) {
          if ((allNum == nowNum) && i==5) {
            pageStr+="<a href='#"+(allNum-5+i)+"' class='blue'>"+(allNum-5+i)+"</a>"
          }else if ((nowNum == allNum-1) && i == 4) {
            pageStr+="<a href='#"+(allNum-5+i)+"' class='blue'>"+(allNum-5+i)+"</a>"
          } else {
            pageStr+="<a href='#"+(allNum-5+i)+"' class='grey'>"+(allNum-5+i)+"</a>"
          }
        } else {
          if (i == 3) {
            pageStr+="<a href='#"+(nowNum-3+i)+"' class='blue'>"+(nowNum-3+i)+"</a>"
          } else {
            pageStr+="<a href='#"+(nowNum-3+i)+"' class='grey'>"+(nowNum-3+i)+"</a>"
          }
        }
      }
    };
    if ((allNum - nowNum) >= 1) {
      pageStr+="<a href='#"+(nowNum+1)+"' class='grey'>下一页</a>"
    };
    if ((allNum - nowNum) >= 3 && allNum >= 6) {
      pageStr+="<a href='#"+allNum+"' disabled='true' class='grey forbid'>尾页</a>"
    };
    obj.append(pageStr);
    $("#pageCount a").on('click',function(){
      var rel = parseInt($(this).attr("href").substring(1));
      obj.empty();
      if(rel){
        getData(rel);
      }
    });
  }

  $(function(){
    getData(1);
  });

</script>