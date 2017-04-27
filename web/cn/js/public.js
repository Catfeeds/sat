$(function () {
  $('.s-nav-cnt li a').on("click",function () {
    $('.s-nav-cnt li a').each(function () {
      $(this).removeClass("on");
    });
    if ($(this).parent().hasClass('s-nav-work')){

    }else {
      $('.s-nav-work').children().eq(1).addClass('s-nav-showing');
    }
    $(this).addClass("on");
  });
  $('.s-nav-work>a').on('click',function () {
    $(this).next().toggleClass('s-nav-showing');
  });
  $('.s-nav-work ul li').on('click',function () {
    $('.s-nav-work>a').addClass('on');
    $(this).parent().addClass('s-nav-showing');
  })
})
//禁止右键
// function stop(){
//   return false;
// }
// document.oncontextmenu = stop;