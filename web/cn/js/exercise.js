$(function() {
  //console.log();
  $('.work-shade').height($(document).outerHeight())
  upTime();
  $('.now-do').click(function () {
    $('.work-shade').hide();
  })
  //查看答案
  $('.s-exam .s-answer li').click(function () {
    if ($('.work-select.active').data('id') == undefined) {
      $('.work-shade').fadeIn();
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
      $('.correct-ans-hide').show();
    }
  })
  $('.math-sure').click(function () {
    var v = eval($('.math-gap-result input').val());
    v = Math.floor(v*1000)/1000;
    var r = eval($('.correct-answer').html());
    r = Math.floor(r*1000)/1000;
    if (v != r) {
      $('.correct-ans-hide').fadeIn();
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

function ajaxEvent(obj,u) {
  console.log('aaa');
  var _this = $(obj),
    ans = $('.work-select.active').data('id');
  if (ans == undefined) {
    $('.work-shade').fadeIn();
  }else {
    $.ajax({
      url: '/cn/exercise/',
      type: 'get',
      data: {
        'time': upTime(),
        'ans': $('.work-select.active').data('id'),
        'uid': $('#subjectId').data('id'),
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