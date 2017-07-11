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
    //$.post('',{
    //  'name':name,
    //  'country':country,
    //  'score':score,
    //  'time':time,
    //  'email':email,
    //  'tel':tel,
    //  'code':code
    //}, function (data) {
    //  alert(data);
    //})
  })
  $('.apply-close').click(function () {
    $('.apply-fix').hide();
  })
})
//禁止右键
// function stop(){
//   return false;
// }
// document.oncontextmenu = stop;