$(function () {
  //导航栏
  function nav() {
    $('.s-nav-cnt li a').on("click",function () {
      $('.s-nav-cnt li a').removeClass('on');
      if (!$(this).parent().hasClass('s-nav-work')){
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
    });
  }
  nav();

  //登录
  function loginOut() {
    $('.s-login').hide();
    $('.s-sign-cnt').css('top',0);
    $('.s-login-cnt').css('top',0);
  };
  function login(login,sign,time) {
    $(login).show();
    $(sign).hide();
    $('.s-login').fadeIn();
    $(login).animate({
      top: '50%'
    },time)
  };

  $('.s-login-in').click(function () {
    login('.s-login-cnt','.s-sign-cnt',500);
  });
  $('.s-go-sign').click(function () {
    loginOut();
    login('.s-sign-cnt','.s-login-cnt',500);
  });
  $('.icon-remove').click(function () {
    $('.s-login').fadeOut(1000);
    $('.s-login-cnt').animate({top: 0},500);
    $('.s-sign-cnt').animate({top: 0},500)
  });
  //注册
  $('.s-sign-up').click(function () {
    login('.s-sign-cnt','.s-login-cnt',500);
  });
  $('.s-login-back').click(function () {
    loginOut();
    login('.s-login-cnt','.s-sign-cnt',500);
  });

  //表单聚焦隐藏提示
  $('.s-login .form-control').focus(function () {
    hideTips($(this).attr('id'));
  })

  //点击注册
  $('.s-register').click(function () {
    if ($('#sPhone').hasClass('active')) {
      regTel('signTel','signPwd1','signCode');
    }else {
      regEmail('signEmail','signPwd2')
    }
  })

})
//正则email匹配
function isEmail(value) {
  if((/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/).test(value))
    return true;
  else
    return false;
};
//正则手机匹配
function isTel(value) {
  if ((/^1[34578]\d{9}/).test(value)) {
    return true;
  }else {
    return false;
  }
};

function showTips(msgId,msg) {
  if(msgId == ''){return}
  if(msg==''){msg == 'ERROR'}
  $('#'+msgId).before("<div class='s-tooltip'><div style='display: inline-block;'>"+msg+"</div></div>");
  $('#'+msgId).parent().children('.s-tooltip').children().fadeIn('slow').animate({
    top: '-23px'
  },1000)
}
function hideTips(msgId) {
  try {
    $('#'+msgId).parent().find('.s-tooltip').fadeOut('slow');
    $('#'+msgId).parent().find('.s-tooltip').remove();
  }catch (e){}
}
function hideAllTips() {
  try {
    $('.s-tooltip div').fadeOut('slow');
    $('.s-tooltip').remove();
  }catch (e){}
}

//登录手机号/邮箱检测
function checkUser(user) {
  var loginName = $('#' + user).val();
  if ((/^.+@.+$/).test(loginName)) {
    if (!isEmail(loginName)) {
      showTips('loginName','请输入正确的email!')
      return
    }
  }else {
    if (!isTel(loginName)) {
      showTips('loginName','请输入正确的手机号!')
      return
    }
  }
}

function signTel(tel) {
  if (!isTel(tel)) {
    showTips('signTel','请输入正确的手机号!');
    return
  }else {
    hideTips('signTel')
  }
}
function signPwd1(pwd1) {
  if (!(/^.{6,20}$/).test(pwd1)) {
    showTips('signPwd1','密码长度不少于六位');
    return
  }else {
    hideTips('signPwd1');
  }
}
function signEmail(email) {
  if (!isEmail(email)) {
    showTips('signEmail','请输入正确的email');
    return
  }else {
    hideTips('signEmail');
  }
}
function signPwd2(pwd2) {
  if (!(/^.{6,20}$/).test(pwd2)) {
    showTips('signPwd2','密码长度不少于六位');
    return
  }else {
    hideTips('signPwd2');
  }
}

function check() {
  hideAllTips();
  var cResult = true;
  if ($('#loginName').val() == '') {
    showTips('loginName','请填写手机号或邮箱');
    cResult = false;
  }
  if ($('#signTel').val() == '') {
    showTips('signTel', '手机号不能为空');
    cResult = false;
  }
  if ($('#signPwd1').val() == '') {
    showTips('signPwd1','密码不能为空');
    cResult = false;
  }
  if ($('#signEmail').val() == '') {
    showTips('signEmail','邮箱不能为空');
    cResult = false;
  }
  if ($('#signPwd2').val() == '') {
    showTips('signPwd2','密码不能为空');
    cResult = false;
  }
  if ($('#signCode').val() == '') {
    showTips('signCode','请输入验证码');
    cResult = false;
  }
  return cResult;
}

function regTel() {

  var signTel = $('#signTel').val(),
      signPwd1 = $('#signPwd1').val(),
      signCode = $('#signCode').val(),
      type=1;
  $.post('/user/api/register',{userName: signTel,passWord: signPwd1,type: type,
    code: signCode},function(re){
    var obj = eval('(' + re + ')');
    alert(obj.message);

  },"text");
}
function regEmail() {
  var signEmail = $('#signEmail').val(),
      signPwd2 = $('#signPwd2').val(),
      type=2;
  //alert (111);
  $.post('/user/api/register',{userName: signEmail,passWord: signPwd2,type: type},function(data){
    if (data) {
    alert(data.message);
      //alert (data);
      //loginOut();
  //    login('.s-sign-cnt','.s-login-cnt',1000);
    }else{
      alert("发送邮件失败，请到个人中心，重新进行验证");
    }
  },'json')
}


function login() {
  if (window.localStorage) {
    var userName = $('#loginName').val(),
        loginPwd = $('#loginPass').val();
    if ($('#loginBtn').attr('checked')) {
      localStorage.setItem('userName',userName);
      localStorage.setItem('password',loginPwd);
    }else {
      localStorage.setItem('userName',userName);
    }
    $.post('/user/api/check-login', {userName: userName, userPass: loginPwd}, function(data){
      alert(data.message);
    },'json')
  }else {
    alert('当前浏览器不支持HTML5存储')
  }
}

//禁止右键
// function stop(){
//   return false;
// }
// document.oncontextmenu = stop;