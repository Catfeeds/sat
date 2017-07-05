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
    //APP下载
    $('.appDownload').mouseenter(function () {
      var _this=  $(this);
      _this.css({'backgroundColor':'#f3f7f7'});
      _this.children('span').css('color','#000');
      $('.app-down').show();
    })
    $('.app-down li').mouseenter(function () {
      var _this = $(this);
      $('.app-box').hide();
      $('.app-down li').removeClass('on');
      _this.addClass('on');
      _this.children('.app-box').show();
    })
    $('.appDownload').mouseleave(function () {
      var _this = $(this);
      $('.app-down').hide();
      $('.app-box').hide();
      _this.css({'backgroundColor':'#3d3d3d'});
      _this.children('span').css('color','#f0f0f0');
    })
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
    result.get(0).value += $(this).html();
  })
  $('.math-clear').click(function () {
    result.val('');
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
    $('.math-btn').removeClass('math-btn');
  })
})
//获取uid
var uId = $.cookie('uid');
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