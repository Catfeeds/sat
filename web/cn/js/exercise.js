$(function() {
  $(window).scrollTop(350);
  $('.work-shade').height($(document).outerHeight());
  upTime();
  $('.now-do').click(function () {
    $('.shade-cmn').hide();
  })
  //查看解析
  $('.s-exam .s-answer li').eq(0).click(function () {
    if($('.read-exam').css('display') == 'none') {
      if($('.math-exam .work-que-list').css('display') == 'none') {
        var ans = $('.math-gap-result input').val();
      } else {
        ans = $('.math-exam .work-select.active').data('id');
      }
    }else {
      ans = $('.read-exam .work-select.active').data('id');
    }
    if (ans == undefined || ans == '') {
      $('.shade-cmn').fadeIn();
    }else {
      if ($(this).index() == 0) {
        if ($('.s-answer-show').css('display') == 'none') {
          $(this).addClass('active');
          $('.s-exam .s-answer-show').fadeIn(1000)
        } else {
          $(this).removeClass('active');
          $('.s-exam .s-answer-show').fadeOut(300)
        }
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
      //$('.correct-ans-hide').show();
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
  })
  //题目讨论回复
  //回复/收回回复切换
  $('.dis-usr-list>ul').on('click','.dis-reply-btn', function () {
    var _this = $(this);
    if(_this.html() == '回复'){
      _this.html('收起回复');
      _this.css({
        'backgroundColor':'#CDE4EE'
      })
      _this.parent().siblings('.reply-wrap').show('slow');
    } else {
      _this.html('回复');
      _this.css({
        'backgroundColor':'#fff'
      })
      _this.parent().siblings('.reply-wrap').hide('slow');
    }
  })
  //最下面提交按钮
  $('.dis-commit>div').click(function () {
    comment(this,0);
  })
  //中间发表按钮
  $('.dis-usr-list>ul').on('click','.reply-wrap input', function () {
    comment(this,1);
  })
  //中间回复按钮
  $('.dis-usr-list>ul').on('click','.reply-wrap .reply-wrap-btn', function () {
    var _this = $(this);
    var name = _this.parent().siblings('span').html();
    _this.parent().parent().parent().siblings('textarea').val('回复'+name);
  })
  //讨论查看更多
  $('.dis-more-show').click(function () {
    $('.dis-usr-list>ul>li').eq(2).nextAll().show(500);
    $(this).hide();
    $('.dis-more-hide').show();
  })
  $('.dis-more-hide').click(function () {
    $('.dis-usr-list>ul>li').eq(2).nextAll().hide(500);
    $(this).hide();
    $('.dis-more-show').show();
  })
  if ($('.dis-usr-list>ul>li').length>=3){
    $('.dis-usr-list>ul>li').eq(2).nextAll().hide();
  }else {
    $('.dis-more').hide();
  }
  var sub = $(".breadcrumb li").eq(1).children('a').text();
  if((sub == 'Reading') || (sub == 'Writing')){
    $('.s-exer-wrap').css('minHeight',1350);
    $(".exer-side").css({
      'position': 'absolute',
      'width': 400,
      'top': 655,
      'right': 2
    })
    $('.s-exam .s-btn-list').css('paddingRight',0);
  }
})

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
//正计时
function upTime() {
  var usedTime = 0;
  return setInterval(function(){
    usedTime+=1;
  },1000);
}
//提交题目
function ajaxEvent(obj,u) {
  var _this = $(obj),
    ans = '';
  if($('.read-exam').css('display') == 'none') {
    if($('.math-exam .work-que-list').css('display') == 'none') {
      ans = $('.math-table .math-value').text();
    } else {
      ans = $('.math-exam .work-select.active').data('id');
    }
  }else {
    ans = $('.read-exam .work-select.active').data('id');
  }
  if (ans == undefined || ans == '') {
    $('.shade-cmn').fadeIn();
  }else {
    $.ajax({
      url: '/cn/exercise/notes',
      type: 'POST',
      data: {
        'time': upTime(),
        'ans': ans,
        'qid': $('#subjectId').data('id'),
        'up': u
      },
      dataType: 'json',
      success: function (data) {
        if (data == '') {
          _this.get(0).href = 'javascript:void(0)';
          alert('你真棒，已经把题做完了');
        } else {
          location.href = '/exercise_details/' + data.id + '.html';
        }
      }
    })
  }
}
//讨论回复
function comment(obj,flag){
  var tId = $('#subjectId').data('id'),
      _this = $(obj),
  //uId = $.cookie('uid');
    uId = 32;
  if(flag == 0){
    var cnt = $('#dis-input-cnt').val(),
      pId = 0;
  } else {
    var cnt = _this.siblings('textarea').val(),
        pId = _this.parent().siblings('.dis-usr-cnt').data('id');

  }
  if (uId == ''){
    var pos = location.href;
    location.href = 'http://login.gmatonline.cn/cn/index?source=20&url='+location.href;
  }else{
      $.ajax({
        url: '/cn/exercise/discuss',
        type: 'post',
        data: {
          qId: tId,
          uId: uId,
          cnt: cnt,
          pId: pId
        },
        dataType: 'json',
        success: function (data) {
          console.log(data);
          if (data.num == 3){
            alert('请输入内容');
          }
          if (data.code == 0){
            alert('回复失败，请重试！');
          }
          if ((data.num == 1)&&(data.code == 1)){
            var liObj = '';
            liObj+="<li><div class='dis-usr-avatar pull-left'><img src='/cn/images/login.png' alt='用户头像'></div>"+
              "<div class='dis-usr-cnt pull-left' data-id="+data.id+">"+
              "<p>用户<span>jajj</span>发表于<span>"+data.time+"</span></p>"+
              "<p>"+$('#dis-input-cnt').val()+"</p>"+
              "</div>"+
              "<div class='dis-usr-reply pull-right'>"+
              "<span>"+data.floor+"楼</span>"+
              "<span class='dis-reply-btn'>回复</span>"+
              "</div>"+
              "<div style='clear: both;'></div>"+
              "<div class='reply-wrap clearfix'>"+
              "<ul>"+
              //"<li class='clearfix'>"+
              //"<img src='/cn/images/login.png' alt='用户头像'>"+
              //"<span>lsls:</span>"+
              //"<p class='reply-wrap-cnt'>fnkdnkmkdmaldl;g;</p>"+
              //"<p class='pull-right'><span>2017-10-22 08:30:20</span><span class='reply-wrap-btn'>回复</span></p>"+
              //"</li>"+
              "</ul>"+
              "<textarea name='' id='reply-input-cnt' cols='80' rows='4'></textarea>"+
              "<input class='pull-right'' type='button' value='发表'>"+
              "</div></li>";
            $('.dis-usr-list>ul').append(liObj);
          } else if((data.num == 2)&&(data.code == 1)){
            console.log(_this.parent().children('ul').children());
              var liObj = '';
              liObj+="<li class='clearfix'>"+
                "<img src='/cn/images/login.png' alt='用户头像'>"+
                "<span>lsls:</span>"+
                "<p class='reply-wrap-cnt'>"+_this.siblings('textarea').val()+"</p>"+
                "<p class='pull-right'><span>"+data.time+"</span><span class='reply-wrap-btn'>回复</span></p>"+
                "</li>";
              _this.parent().children('ul').append(liObj);
          }
        },
        complete: function () {
          $('#dis-input-cnt').val('');
          $('.reply-wrap textarea').val('');
        }
      })
  }
}