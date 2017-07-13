$(function () {
  //导航栏下拉菜单
  $(document).click(function (e) {
    e.stopPropagation();
    var $t = $(e.target);
    if (($t.attr('id') == 'showA') || ($t.attr('class') == 'fa fa-sort-desc')) {
      $('.s-nav-showing').show();
    } else {
      $('.s-nav-showing').hide();
    }
  })
  //APP下载
  $('.appDownload').on({
    mouseenter: function () {
    var _this=  $(this);
    _this.css({'backgroundColor':'#f3f7f7'});
    _this.children('span').css('color','#000');
    $('.app-down').show();
  },
    mouseleave: function() {
    var _this = $(this);
    $('.app-down').hide();
    $('.app-box').hide();
    _this.css({'backgroundColor':'#3d3d3d'});
    _this.children('span').css('color','#f0f0f0');
  }
  })
  $('.app-down li').mouseenter(function () {
    var _this = $(this);
    $('.app-box').hide();
    $('.app-down li').removeClass('on');
    _this.addClass('on');
    _this.children('.app-box').show();
  })
//  模考收藏点击事件
  $('.work-collect').click(function () {
    collectEvent(this);
  });
//  练习、模考选择题点击事件
  $('.work-que-wrap').click(function () {
    $('.work-select').removeClass('active');
    $(this).find('.work-select').addClass('active');
  })
//  练习、模考数学填空点击事件
  var result = $('.math-gap-result input');
  $('.math-btn').click(function () {
    if ($('.math-gap-table').hasClass('sure')) {
      return false;
    }else {
      result.get(0).value += $(this).html();
    }
  })
  $('.math-clear').click(function () {
    if ($('.math-gap-table').hasClass('sure')) {
      return false;
    }else {
      result.val('');
    }
  })
  $('.math-sure').click(function () {
    $('.math-gap-table tr').addClass('sure');
    $('.math-gap-table').addClass('sure');
    $('.math-gap-table td').hover(function () {
      $('.math-gap-table td').css({
        'color': '#ccc',
        'backgroundColor': '#f1f1f1'
      })
    });
  })
  //  侧边栏
  $('.side-bar li').mousemove(function () {
    $('.side-bar li').children('div').hide();
    $(this).children('div').show();
  })
  $('.side-bar li').mouseout(function () {
    $(this).children('div').hide();
  })
  //小火箭
  $('.side-arrow').click(function () {
   $('html,body').animate({scrollTop:0},'slow');
  })
  //  底部课程报名
  $('.apply-submit').click(function () {
    var name = $('.apply-name').val(),
        country = $('.apply-country').val(),
        score = $('.apply-score').val(),
        time = $('.apply-time').val(),
        email = $('.apply-email').val(),
        tel = $('.apply-tel').val(),
        code = $('.apply-code').val();
    if (name == '') {
      alert('请填写姓名哦！')
    } else if(time == '') {
      alert('请输入考试时间！')
    } else if (email == '') {
      alert('请输入邮箱')
    } else if(tel == '') {
      alert('请输入手机号')
    } else if(code == '') {
      alert('验证码怎么能为空呢！')
    }
  })
  $('.apply-close').click(function () {
    $('.apply-fix').hide();
  })
})
//获取uid
var uId = $.cookie('uid');
var uId = 444;
//收藏函数
function collectEvent(obj) {
  if (uId == '') {
    alert('登陆后才可以收藏哦！')
  }else {
    var _this = $(obj),
        subjectId = $('#subjectId').data('id'),
        val = $('.work-collect').data('value');
    $.ajax({
      type: 'get',
      url: '/cn/collection/collection',
      data: {
        uid: uId,
        subID: subjectId,
        val:  val
      },
      dataType: 'json',
      success: function(data) {
        if (data.code == 1) {//收藏成功
          _this.addClass('active');
          _this.find('i').removeClass('fa-star-o');
          _this.find('i').addClass('fa-star');
          _this.data('value',1);
          alert(data.message);
        } else if(data.code == 2){//取消收藏
          _this.removeClass('active');
          _this.find('i').removeClass('fa-star');
          _this.find('i').addClass('fa-star-o');
          _this.data('value',0);
          alert(data.message);
        } else {
          alert(data.message);
        }
      },
      error: function (data) {
        alert('操作失败！');
      }
    })
  }
}

//禁止右键
// function stop(){
//   return false;
// }
// document.oncontextmenu = stop;