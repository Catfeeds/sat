/**
 * Created by Administrator on 2017/9/14.
 */
$(function () {
  subject.init();
});
var subject = {
  init: function () {
    this.onLoad();
    this.bindEvent();
  },
  onLoad: function () {
    this.ajaxEvent('Reading','all','all',1);
  },
  bindEvent: function() {
    var _this = this;
    $('.s-label-list>li').click(function(){
      var name = $(this).attr('data-src');
      _this.effectEvent(this);
      _this.ajaxEvent(name,'all','all',1);
    });
    $('.s-subject-src dl').on('click','dd',function(){
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
    var tp = '';
    $.ajax({
      url: '/cn/exercise/topic',
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
        $('.s-sub').html('');
        $('.s-subject-cnt').html('');
        var dd = '',
          li = '';
        tp = res.pagecount;
        if (!res.count){
          res.data = 0;
          tp = 1;
        }
        if (res.paper) {
          dd+="<dt>试卷来源：</dt>";
          if (res['tid'] == 'all') {
            dd+="<dd data-src='all' class='active'>全部</dd>";
          }else {
            dd+="<dd data-src='all'>全部</dd>";
          }
          $.each(res.paper, function (i,data) {
            if (data[1] == res['tid']) {
              dd+="<dd data-src='"+ data[1] +"' class='active'>"+ data[0] +"</dd>";
            } else {
              dd+="<dd data-src='"+ data[1] +"'>"+ data[0] +"</dd>";
            }

          });
        };
        $.each(res.data, function (i,data) {
          li+="<h3>"+data['name']+"-"+data['time']+"-"+data['major']+"-"+data['number']+"</h3>"+
            "<div>"+data['content']+"</div>"+
            "<a href='/exercise_details/"+data['qid']+".html'>做题</a>";
        })
        $('.s-sub').html(dd);
        $('.s-subject-cnt').html(li);
      },
      complete: function () {
        $.jqPaginator('.pagination', {
          totalPages: tp,
          visiblePages: 6,
          currentPage: p,
          onPageChange: function (num,type) {
            if(type == 'change'){
              subject.ajaxEvent(name,src,sub,num);
            }
          }
        });
      }
    })
  }
}