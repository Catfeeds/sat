$(function () {
  //导航栏下拉菜单
  $(document).click( function (e) {
    e.stopPropagation();
    var $t = $(e.target);
    if (($t.attr('id') == 'showA')||($t.attr('class') == 'fa fa-sort-desc')) {
      $('.s-nav-showing').show();
    } else {
      $('.s-nav-showing').hide();
    }
  })

//  模考收藏点击事件
  $('.work-collect').click(function () {
    console.log(this);
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
    var _this = $(obj);
    //if (_this.find('i').hasClass('fa-star-o')) {
    //  _this.addClass('active');
    //  _this.find('i').removeClass('fa-star-o');
    //  _this.find('i').addClass('fa-star');
    //  _this.data('value',1);
    //} else {
    //  _this.removeClass('active');
    //  _this.find('i').removeClass('fa-star');
    //  _this.find('i').addClass('fa-star-o');
    //  _this.data('value',0);
    //}
    var subjectId = $('#subjectId').data('id'),
        val = $('.work-collect').data('value')!=undefined? $('.work-collect').data('value'):'';
    $.ajax({
      type: 'POST',
      url: '',
      data: {
        uid: uId,
        subID: subjectId,
        val:  val
      },
      dataType: 'json',
      success: function(data) {
        _this.addClass('active');
        _this.find('i').removeClass('fa-star-o');
        _this.find('i').addClass('fa-star');
        _this.data('value',1);
        alert(data);
      },
      error: function (data) {
        _this.removeClass('active');
        _this.find('i').removeClass('fa-star');
        _this.find('i').addClass('fa-star-o');
        _this.data('value',0);
        alert(data);
      }
    })
  }
}
//禁止右键
// function stop(){
//   return false;
// }
// document.oncontextmenu = stop;