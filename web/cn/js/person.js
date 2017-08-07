$(function () {
  var pos = location.href.split('_')[1].split('.')[0];
  var src = $('.per-src dd').filter('.on').data('val'),
    classify = $('.per-classify dd').filter('.on').data('val');
  if (pos == 'exercise') {
    var cas = $('.per-case dd').filter('.on').data('val');
    exer('all','all','all',1);
  } else if(pos == 'mock') {
    var type = $('.per-type dd').filter('.on').data('val');
    mock('all','all',1);
  } else if(pos == 'collect') {
    collect('all','all',1);
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
      exer(src,classify,cas,1);
    } else if(pos == 'mock') {
      mock(src,type,1);
    } else if (pos == 'collect') {
      collect(src,classify,1);
    }
  })

})

//练习
function exer(src,classify,cas,p){
  $.ajax({
    url: '/cn/person/exer',
    type: 'post',
    data: {
      'src': src,
      'classify': classify,
      'case': cas,
      'p': p
    },
    dataType: 'json',
    beforeSend: function () {
      //$('.person-cnt ul').html("<i class='fa fa-spinner' aria-hidden='true'></i>");
    },
    success: function (data) {
      var li = '';
      tp = data.totalPage;
      if (data.list == undefined) {
        data.list = 0;
        tp = 1;
      }
      $.each(data.list,function (i,array) {
        li+="<li class='clearfix'>"+
          "<div class='collect-del pull-right'>"+
          "<div>"+
          "耗时: <span>"+array[1]+"</span>秒"+
          "</div>"+
          "<a href='/exercise_details/"+array['qid']+".html' target='_blank'>重新做</a>"+
          "</div>"+
          "<div class='collect-sub'>"+
          "<h4><i class='exer-delete fa fa-times-circle' onclick='exerDel(this)' data-id='"+array['time']+"'></i>"+array['name']+"-"+array['major']+"-"+array['number']+"<span>"+new Date(parseInt(array[2])*1000).toLocaleString()+"</span></h4>"+
          "<p>"+
          "<a href='/exercise_details/"+array['qid']+".html' target='_blank'>"+array['content']+"</a>"+
          "</p>"+
          "</div>"+
          "</li>"
      })
      $('.person-cnt ul').html(li);
    },
    complete: function () {
      $.jqPaginator('.pagination', {
        totalPages: tp,
        visiblePages: 6,
        currentPage: p,
        onPageChange: function (num,type) {
          if(type == 'change'){
            exer(src,classify,cas,num);
          }
        }
      });
    }
  })
}
//模考
function mock(src,t,p){
  $.ajax({
    url: '/cn/person/mo',
    type: 'POST',
    data: {
      'src': src,
      'type': t,
      'p': p
    },
    dataType: 'json',
    success: function (data) {
      var li = '';
      tp = data.totalPage;
      if (data.list == undefined) {
        data.list = 0;
        tp = 1;
      }
      $.each(data.list, function (i,array) {
        li+="<li class='clearfix'>"+
          "<div class='mock-look pull-right'>";
        if (array['part'] == 'all'){
          li+="<a href='/mock_details?tid="+array['tpId']+"' class='mock-again'>重新模考</a>";
        }else {
          li+="<a href='/mock_details?m="+array['part']+"&tid="+array['tpId']+"' class='mock-again'>重新模考</a>";
        }
        li+="<a href='/report/"+array['id']+".html' target='_blank' class='mock-record'>查看报告</a>"+
          "</div>"+
          "<h3><i class='mock-delete fa fa-trash' onclick='mockDel(this)' data-id='"+array['id']+"'></i>"+array['name']+"</h3>"+
          "<div class='mock-details'>"+
          "<p>耗时：<span>"+array['rtime']+"s</span></p>"+
          "<p>正确率: <span>"+Math.round((Number(array['mathnum'])+Number(array['readnum'])+Number(array['writenum']))/154*10000)/100+"%</span></p>"+
          "<p>完成时间: <span>"+new Date(parseInt(array['date'])*1000).toLocaleString()+"</span></p>"+
          "</div>"+
          "</li>"
      })
      $('.person-mock').html(li);
    },
    complete: function () {
      $.jqPaginator('.pagination', {
        totalPages: tp,
        visiblePages: 6,
        currentPage: p,
        onPageChange: function (num,type) {
          if(type == 'change'){
            mock(src,t,num);
          }
        }
      });
    }
  })
}
//收藏
function collect(src,classify,p){
  $.ajax({
    url: '/cn/person/coll',
    type: 'post',
    data: {
      'src': src,
      'classify': classify,
      'p': p
    },
    dataType: 'json',
    success: function (data) {
      var li = '';
      tp = data.totalPage;
      if (data.list == undefined) {
        data.list = 0;
        tp = 1;
      }
      $.each(data.list, function (i,array) {
        li+="<li class='clearfix'>"+
          "<div class='collect-del pull-right' onclick='collDel(this)' data-id='"+array['qid']+"'>"+
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
    },
    complete: function () {
      $.jqPaginator('.pagination', {
        totalPages: tp,
        visiblePages: 6,
        currentPage: p,
        onPageChange: function (num,type) {
          if(type == 'change'){
            collect(src,classify,num);
          }
        }
      });
    }
  })
}

//删除事件
function mockDel(a) {
  var _this = $(a);
  $.post('/cn/person/del',{id:_this.data('id')},function(data){
    if (data.code == 1) {
      _this.parent().parent().remove();
      alert(data.message);
    }
  },'json')
}
function exerDel(a) {
  var _this = $(a);
  $.post('/cn/person/removed',{id:_this.data('id')},function(data){
    if (data.code == 1) {
      _this.parent().parent().parent().remove();
      alert(data.message);
    }
  },'json')
}
function collDel(a){
  var _this = $(a);
  $.post('/cn/collection/collection',{subId:_this.data('id'),val:1, uid:444
  },function(data){
    if (data.code == 2) {
      _this.parent().remove();
      alert(data.message);
    }
  },'json')
}