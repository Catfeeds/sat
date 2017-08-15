$(function () {
  //导航栏下拉菜单
  $('.s-nav-work').on({
    mouseover: function () {
      $('.s-nav-showing').show();
    },mouseout: function () {
      $('.s-nav-showing').hide();
    }
  })
  $('.s-nav-showing li').mouseover(function () {
    $('.s-nav-showing').show();
  })
  //APP下载
  $('.appDownload').on({
    mouseenter: function () {
      var _this=  $(this);
      _this.css({'backgroundColor':'#f3f7f7'});
      _this.children('span').css('color','#000');
      $('.app-down').show();
    },
    mouseleave: function() {
      var _this = $(this);
      $('.app-down').hide();
      $('.app-box').hide();
      _this.css({'backgroundColor':'#3d3d3d'});
      _this.children('span').css('color','#f0f0f0');
    }
  })
  $('.app-down').on('mouseover','li', function () {
    var _this = $(this);
    $('.app-box').hide();
    $('.app-down li').removeClass('on');
    _this.addClass('on');
    _this.children('.app-box').show();
  })
//  个人中心下拉菜单
  $('.login-after-show').bind({
    mouseover: function () {
      $('.login-after-list').show();
    },mouseout: function () {
      $('.login-after-list').hide();
    }
  })
  $('.login-after-list').bind({
    mouseover: function () {
      $(this).show();
    },mouseout: function () {
      $(this).hide();
    }
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
  $(".btn-type").bind("click", confirmBtnEvent);
  $(".math-table").find("a").bind("click", numBtnEvent);
  //  侧边栏
  $('.side-bar li').mousemove(function () {
    $('.side-bar li').children('div').hide();
    $(this).children('div').show();
  })
  $('.side-bar li').mouseout(function () {
    $(this).children('div').hide();
  })
  //小火箭置顶
  $('.side-arrow').click(function () {
    $('html,body').animate({scrollTop:0},'slow');
  })
  //SAT课程报名提交用户信息
  $('.apply-submit').click(function () {
    var name = $('.apply-name').val(),
      country = $('.apply-country').val(),
      score = $('.apply-score').val(),
      time = $('.apply-time').val(),
      email = $('.apply-email').val(),
      tel = $('.apply-tel').val(),
      code = $('.apply-cde').val();
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
    }else {
      $.ajax({
        type: 'post',
        url: '/cn/message/index',
        data: {
          'name':name,
          'country':country,
          'score':score,
          'time':time,
          'email':email,
          'tel':tel,
          'code':code
        },
        dataType: 'json',
        success: function (data) {
          alert(data.message);
        },
        error: function(XMLHttpRequest){
          alert( "Error:" + XMLHttpRequest.responseText);
        }
      })
    }
  })
  $('.apply-close').click(function () {
    $('.apply-fix').hide();
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
      type: 'post',
      url: '/cn/collection/collection',
      data: {
        uid: uId,
        subId: subjectId,
        val:  val
      },
      dataType: 'json',
      success: function(data) {
        if (data.code == 1) {//收藏成功
          _this.addClass('active');
          _this.find('i').removeClass('fa-star-o');
          _this.find('i').addClass('fa-star');
          _this.data('value',1);
          _this.children('span').html('已收藏');
        } else if(data.code == 2){//取消收藏
          _this.removeClass('active');
          _this.find('i').removeClass('fa-star');
          _this.find('i').addClass('fa-star-o');
          _this.data('value',0);
          _this.children('span').html('收藏');
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

//  邮箱验证
function ckEmail(obj) {
  var objValue = $(obj).val(),
    rules = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+\.){1,63}[a-z0-9]+$/;
  if (objValue.match(rules) == null) {
    alert('请输入正确的邮箱！')
  }
}
// 发送手机验证码
function leftCode(){
  var tel = $('.apply-tel').val();
  $.post('/user/api/phone-code',{type:12,phoneNum:tel},function(re){
    alert(re.message);
  },"json")
}

//数学填空按钮事件
function confirmBtnEvent() {
  var btnName = $(this).attr("name");
  var parent = $(this).parent().parent().parent();
  var queNo = $(parent).data("id");
  if(btnName == "delBtn"){
    $(parent).find("a").removeClass("cut");
    $(parent).find(".math-value").eq(0).text("");
    $(parent).find(".btn-type").each(function(){$(this).addClass("btn-invalid");});
    $(parent).find(".btn-type").each(function(){$(this).unbind();});

    //恢复a标签的事件
    $(parent).find("a").bind("click", numBtnEvent);
    //恢复a标签的样式
    $(parent).find("a").each(function(){
      if($(this).hasClass("btn-invalcut")) {
        $(this).removeClass("btn-invalcut");
      } else {
        $(this).removeClass("btn-invalcur");
      }
    });
  }
  if(btnName == "sureBtn") {
    var ans = $(parent).find(".math-value").eq(0).text();
    $(parent).find(".btn-type").eq(1).addClass("btn-invalid");
    $(parent).find("a").each(function(){
      if($(this).hasClass("cut")) {
        $(this).addClass("btn-invalcut");
      } else {
        $(this).addClass("btn-invalcur");
      }
    });
    $(parent).find("a").unbind();
    $(parent).find(".btn-type").eq(1).unbind();
    //$.ajax({
    //  url: basePath + "/web/wk/quesolve/chooseAns.ajax",
    //  type: "POST",
    //  dataType: "json",
    //  data: {workId: $("#workId").val(), queId: queId, ans: ans, wkType: $("#wkType").val()},
    //  success: function(data) {
    //    if(data == 1) {
    //      $("#a"+queNo).addClass("done");
    //      requestExplain2(queNo, queId, parent, "click");
    //      processBar();
    //    }
    //  },
    //  error: function(data) {
    //    console.log("操作失败，请重试！");
    //  }
    //});
  }
}

//数学填空事件
function numBtnEvent() {
  var parent = $(this).parent().parent().parent();
  if($(parent).find(".btn-type").eq(1).hasClass("btn-invalid")) {
    $(parent).find(".btn-type").each(function() {
      $(this).removeClass("btn-invalid");
    });
    //恢复确认键的事件
    $(parent).find(".btn-type").bind("click", confirmBtnEvent);
  }
  var queNo = $(parent).data("id");
  var className = $(this).attr("class");
  $(parent).find("."+className).removeClass("cut");
  $(this).addClass("cut");
  $(parent).find(".math-value").eq(0).text($(parent).find(".col1.cut").text()+$(parent).find(".col2.cut").text()+$(parent).find(".col3.cut").text()+$(parent).find(".col4.cut").text());
}
//禁止复制以及右键
document.oncopy = function(){
  return false;
}
 document.oncontextmenu = function () {
   return false;
 };
