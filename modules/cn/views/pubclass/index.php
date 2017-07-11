
  <link rel="stylesheet" href="/cn/css/pubClass.css">
  <script src="/cn/js/jqPaginator.js"></script>

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
    <ul class="pagination clearfix"></ul>
  </section>
<script>
  function applyNum(ele) {
    var _this = ele;
    var num =  _this.parent().find('.s-apply-num').html();
    var userTel = $('#loginName').val();
    var classId = _this.next().attr('href').split('/')[2].split('.')[0];
    var userId = $.cookie('uid');
    if (userId != '') {
      $.post('/cn/pubclass/apply',{userTel: userTel,num: num,classId: classId},function(data) {
        _this.parent().find('.s-apply-num').html(data.hits);
        _this.attr({
          'disabled': 'disabled'
        });
        _this.removeClass('on');
        _this.css({
          'cursor':'not-allowed',
          'backgroundColor': 'rgb(250,250,250)',
          'borderColor': '#ccc',
          'color': '#ccc'
        });
        alert (data.message);
      },'json')
    } else {
      alert ('请登录后报名');
      return false;
    }
  };
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
          li+="<li><embed src='"+array['pic']+"'type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque'></embed>"+
              "<div class='s-cnt'>"+
              "<h2 class='center-block'>"+array['title']+"</h2>"+
              "<p>"+array['summary']+"</p>"+
              "<p><span>"+array['activeDate']+"</span><span>"+array['activeTime']+"</span></p>"+
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
    $('.s-apply').click(function() {
      applyNum($(this));
    });
    getData(1);
  });

</script>