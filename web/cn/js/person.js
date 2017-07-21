$(function () {
  var pos = location.href.split('_')[1].split('.')[0];
  var src = $('.per-src dd').filter('.on').data('val'),
    classify = $('.per-classify dd').filter('.on').data('val');
  if (pos == 'exercise') {
    var cas = $('.per-case dd').filter('.on').data('val');
  } else if(pos == 'mock') {
    var type = $('.per-type dd').filter('.on').data('val');
  }
  //console.log('位置'+pos);
  //console.log('来源'+src);
  //console.log('分类'+classify);
  //console.log('情况'+cas);

  console.log($('.per-src dd').filter('.on').data('val'));
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
            "耗时: <span>"+array['0']+"</span>秒"+
            "</div>"+
            "<a href="+array['1']+">重新做</a>"+
            "</div>"+
            "<div class='collect-sub'>"+
            "<h4><i class='exer-delete fa fa-times-circle'></i>"+array[2]+"<span>"+array['time']+"</span></h4>"+
            "<p>"+
            "<a href="+array[3]+">"+array[4]+"</a>"+
            "</p>"+
            "</div>"+
            "</li>"
          })
          $('.per-src ul').html(li);
        }
      })
    } else if(pos == 'mock') {
      $.ajax({
        url: '',
        type: 'post',
        data: {
          'src': src,
          'classify': classify,
          'type': type
        },
        dataType: 'json',
        success: function (data) {
          var li = '';
          $.each(data, function (i,array) {
            li+="<li class='clearfix'>"+
              "<div class='mock-look pull-right'>"+
            "<a href="+array[0]+" class='mock-again'>重新模考</a>"+
            "<a href="+array[1]+" class='mock-record'>查看报告</a>"+
            "</div>"+
            "<h3><i class='mock-delete fa fa-trash'></i>"+array[2]+"</h3>"+
            "<div class='mock-details'>"+
            "<p>耗时：<span>"+array['time']+"</span></p>"+
            "<p>正确率: <span>"+array[3]+"</span></p>"+
            "<p>完成时间: <span>"+array[4]+"</span></p>"+
            "</div>"+
            "</li>"
          })
          $('.person-mock').html(li);
        }
      })
    } else if (pos == 'collect') {
      $.ajax({
        url: '',
        type: 'post',
        data: {
          'src': src,
          'classify': classify
        },
        dataType: 'json',
        success: function (data) {
          var li = '';
          $.each(data, function (i,array) {
            li+="<li class='clearfix'>"+
            "<div class='collect-del pull-right'>"+
            "<div>"+
            "<i class='fa fa-star'></i>"+
            "</div>"+
            "<p>取消收藏</p>"+
            "</div>"+
            "<div class='collect-sub'>"+
            "<h4><i class='icon-bookmark'></i>"+array[3]+"</h4>"+
            "<p>"+
            "<a href="+array[0]+">"+array[1]+"</a>"+
            "</p>"+
            "</div>"+
            "</li>"
          })
          $('.person-cnt ul').html(li);
        }
      })
    }
  })
})

