$(function () {
  console.log($('.per-src dd').filter('.on').data('val'));
  $('.per-src dd').click(function () {
    ddEvent();
  })
})
function ddEvent() {
  $(this).siblings().removeClass('on');
  $(this).addClass('on');
}
