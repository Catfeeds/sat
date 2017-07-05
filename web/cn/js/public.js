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
})
//禁止右键
// function stop(){
//   return false;
// }
// document.oncontextmenu = stop;