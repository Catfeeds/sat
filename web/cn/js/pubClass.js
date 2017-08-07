//  报名功能
function applyNum(ele) {
  var _this = ele;
  var num =  _this.parent().find('.s-apply-num').html();
  var userTel = $('#loginName').val();
  var classId = _this.next().attr('href').split('/')[2].split('.')[0];
  var userId = $.cookie('uid');
  if (userId != '') {
    $.post('/cn/pubclass/apply',{userTel: userTel,num: num,classId: classId},function(data) {
      _this.parent().find('.s-apply-num').html(data.hits);
      _this.attr({
        'disabled': 'disabled'
      });
      _this.removeClass('on');
      _this.css({
        'cursor':'not-allowed',
        'backgroundColor': 'rgb(250,250,250)',
        'borderColor': '#ccc',
        'color': '#ccc'
      });
      alert (data.message);
    },'json')
  } else {
    alert ('请登录后报名');
    return false;
  }
};
//加载往期公开课及分页
var curPage = 1; //当前页码
function getData(p) {
  $.ajax({
    type: 'post',
    url: "/cn/pubclass/page",
    data: {
      'p': p
    },
    dataType: 'json',
    beforeSend: function () {
      var li = "<li><i class='fa fa-spinner fa-spin'></i></li>"
    },
    success: function (data) {
      $('.s-history-cnt').empty();
      var li ='';
      total = data.total;//总记录数
      totalPage = data.totalPage;//总页数
      curPage = p;
      $.each(data.list,function(index,array){
        li+="<li><embed src='"+array['pic']+"'type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' wmode='opaque'></embed>"+
          "<div class='s-cnt'>"+
          "<h2 class='center-block'>"+array['title']+"</h2>"+
          "<p>"+array['summary']+"</p>"+
          "<p><span>"+array['activeDate']+"</span><span>"+array['activeTime']+"</span></p>"+
          "</div></li>"
      });
      $('.s-history-cnt').append(li);
    },
    complete: function() {
      $.jqPaginator('.pagination', {
        totalPages: totalPage,
        visiblePages: 5,
        currentPage: curPage,
        onPageChange: function () {
          $(".pagination li a").on('click',function(){
            var rel = parseInt($(this).parent().attr("jp-data"));
            if(rel){
              getData(rel)
            }
          });
        }
      });
    }
  })
}

$(function(){
//    报名点击事件
  $('.s-apply').click(function() {
    applyNum($(this));
  });
//    初始化加载往期公开课
  getData(1);
});