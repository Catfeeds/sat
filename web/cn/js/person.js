$(function () {
  var pos = location.href.split('_')[1].split('.')[0];
  var src = $('.per-src dd').filter('.on').data('val'),
    classify = $('.per-classify dd').filter('.on').data('val');
  if (pos == 'exercise') {
    var cas = $('.per-case dd').filter('.on').data('val');
  } else if(pos == 'mock') {
    var type = $('.per-type dd').filter('.on').data('val');
  }

  var pos = location.href.split('_')[1].split('.')[0];
  var src = $('.per-src dd').filter('.on').data('val'),
      classify = $('.per-classify dd').filter('.on').data('val');
  if (pos == 'exercise') {
    var cas = $('.per-case dd').filter('.on').data('val');
  } else if(pos == 'mock') {
    var type = $('.per-type dd').filter('.on').data('val');
  }
  //条件筛选
  $('.person-cnt dl').on('click','dd',function() {
    $('.person-cnt ul').html('');
    var _this=  $(this);
    _this.siblings().removeClass('on');
    _this.addClass('on');
    var cls = _this.parent().attr('class'),
      val = _this.data('val');
    if (cls == 'per-src') {
      src = val;
    } else if(cls == 'per-classify') {
      classify = val;
    } else if(cls == 'per-type') {
      type = val;
    } else if(cls == 'per-case'){
      cas = val;
    }
    if (pos == 'exercise') {
      $.ajax({
        url: '/cn/person/exer',
        type: 'get',
        data: {
          'src': src,
          'classify': classify,
          'case': cas
        },
        dataType: 'json',
        success: function (data) {
          var li = '';
          $.each(data,function (i,array) {
            li+="<li class='clearfix'>"+
              "<div class='collect-del pull-right'>"+
            "<div>"+
            "耗时: <span>"+array[1]+"</span>秒"+
            "</div>"+
            "<a href='/exercise_details/"+array['time']+".html' target='_blank'>重新做</a>"+
            "</div>"+
            "<div class='collect-sub'>"+
            "<h4><i class='exer-delete fa fa-times-circle' data-id='"+array['time']+"'></i>"+array['name']+"-"+array['major']+"-"+array['number']+"<span>"+new Date(parseInt(array[2])*1000).toLocaleString()+"</span></h4>"+
            "<p>"+
            "<a href='/exercise_details/"+array['time']+".html' target='_blank'>"+array['content']+"</a>"+
            "</p>"+
            "</div>"+
            "</li>"
          })
          $('.person-cnt ul').html(li);
        }
      })
    } else if(pos == 'mock') {
      $.ajax({
        url: '/cn/person/mo',
        type: 'get',
        data: {
          'src': src,
          'type': type
        },
        dataType: 'json',
        success: function (data) {
          var li = '';
          $.each(data, function (i,array) {
            li+="<li class='clearfix'>"+
              "<div class='mock-look pull-right'>";
            if (array['part'] == 'all'){
              li+="<a href='/mock_details?tid="+array['tpId']+"' class='mock-again'>重新模考</a>";
            }else {
              li+="<a href='/mock_details?m="+array['part']+"&tid="+array['tpId']+"' class='mock-again'>重新模考</a>";
            }
            li+="<a href='/report/"+array['id']+".html' target='_blank' class='mock-record'>查看报告</a>"+
            "</div>"+
            "<h3><i class='mock-delete fa fa-trash' data-id='"+array['id']+"'></i>"+array['name']+"</h3>"+
            "<div class='mock-details'>"+
            "<p>耗时：<span>"+array['rtime']+"s</span></p>"+
            "<p>正确率: <span>"+Math.round((Number(array['mathnum'])+Number(array['readnum'])+Number(array['writenum']))/154*10000)/100+"%</span></p>"+
            "<p>完成时间: <span>"+new Date(parseInt(array['date'])*1000).toLocaleString()+"</span></p>"+
            "</div>"+
            "</li>"
          })
          $('.person-mock').html(li);
        }
      })
    } else if (pos == 'collect') {
      $.ajax({
        url: '/cn/person/coll',
        type: 'get',
        data: {
          'src': src,
          'classify': classify
        },
        dataType: 'json',
        success: function (data) {
          var li = '';
          $.each(data, function (i,array) {
            li+="<li class='clearfix'>"+
            "<div class='collect-del pull-right' data-id='"+array['qid']+"'>"+
            "<div>"+
            "<i class='fa fa-star'></i>"+
            "</div>"+
            "<p>取消收藏</p>"+
            "</div>"+
            "<div class='collect-sub'>"+
            "<h4><i class='icon-bookmark'></i>"+array['name']+"-"+array['major']+"-"+array['number']+"</h4>"+
            "<p>"+
            "<a href='/exercise_details/"+array['qid']+".html' target='_blank'>"+array['content']+"</a>"+
            "</p>"+
            "</div>"+
            "</li>"
          })
          $('.person-cnt ul').html(li);
        }
      })
    }
  })
//  删除事件
  $('.mock-delete').click(function(){
    $.get('',{id:$(this).data('id')},function(data){
      if (data == 1) {
        $(this).parent().parent().remove();
        alert('删除成功');
      }
    },'json')
  })
  $('.exer-delete').click(function () {
    $.get('',{id:$(this).data('id')},function(data){
      if (data == 1) {
        $(this).parent().parent().parent().remove();
        alert('删除成功');
      }
    },'json')
  })
  $('.collect-del').click(function () {
    $.get('',{subId:$(this).data('id'),val:1,uid: $.cppkie('uid')},function(data){
      if (data == 1) {
        $(this).parent().remove();
        alert('删除成功');
      }
    },'json')
  })
})
