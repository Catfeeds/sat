$(function () {
  var userName = localStorage.getItem('userName');
  var passWord = localStorage.getItem('passWord');
  if ($('.s-rember-pwd').prop('checked')) {
    $('#loginName').val(userName);
    $('#loginPass').val(passWord);
  }
  //导航栏下拉菜单
  $(document).click( function (e) {
    e.stopPropagation();
    var $t = $(e.target);
    if (($t.attr('id') == 'showA')||($t.attr('class') == 'fa fa-sort-desc')) {
      $('.s-nav-showing').show();
    } else {
      $('.s-nav-showing').hide();
    }
  })

  //进入登录
  $('.s-login-in').click(function () {
    loginOut();
    login('.s-login-cnt','.s-sign-cnt','.s-forget-cnt',500);
  });
  //进入注册
  $('.s-sign-up').click(function () {
    loginOut();
    login('.s-sign-cnt','.s-login-cnt','.s-forget-cnt',500);
  });
  //进入重置密码
  $('.s-forget-up').click(function(){
    loginOut();
    login('.s-forget-cnt','.s-login-cnt','.s-sign-cnt',500);
  })
  //关闭
  $('.icon-remove').click(function () {
    loginOut();
  });
  //表单聚焦隐藏提示
  $('.s-login .form-control').focus(function () {
    hideTips($(this).attr('id'));
  })
  $(document).on('keydown',function(){
    if ($('.s-login-cnt').css('display') == 'block') {
      keyLogin();
    }
    if ($('.s-sign-cnt').css('display') == 'block') {
      keySign();
    }
    if ($('.s-forget-cnt').css('display') == 'block') {
      keyFind();
    }
  })
})
//登录注册框隐藏
function loginOut() {
  $('.s-login').hide();
  $('.s-sign-cnt').css('top',0);
  $('.s-login-cnt').css('top',0);
  $('.s-forget-cnt').css('top',0)
};
//显示登录、注册、忘记密码遮罩
function login(login,sign,forget,time) {
  $(login).show();
  $(sign).hide();
  $(forget).hide();
  $('.s-login').fadeIn();
  $(login).animate({
    top: '50%'
  },time)
};
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
//显示提示
function showTips(msgId,msg) {
  if(msgId == ''){return}
  if(msg==''){msg == 'ERROR'}
  $('#'+msgId).before("<div class='s-tooltip'><div style='display: inline-block;'>"+msg+"</div></div>");
  $('#'+msgId).parent().children('.s-tooltip').children().fadeIn('slow').animate({
    top: '-23px'
  },1000)
}
//隐藏提示
function hideTips(msgId) {
  try {
    $('#'+msgId).parent().find('.s-tooltip').fadeOut('slow');
    $('#'+msgId).parent().find('.s-tooltip').remove();
  }catch (e){}
}
//隐藏全部提示
function hideAllTips() {
  try {
    $('.s-tooltip div').fadeOut('slow');
    $('.s-tooltip').remove();
  }catch (e){}
}

//登录手机号检测
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
function signTel(tel,idtel) {
  if (!isTel(tel)) {
    showTips(idtel,'请输入正确的手机号!');
    return
  }else {
    hideTips(idtel)
  }
}
function signPwd(val,idpwd) {
  if (!(/^.{6,20}$/).test(val)) {
    showTips(idpwd,'密码长度不少于六位');
    return
  }else {
    hideTips(idpwd);
  }
}
//检测表单是否为空
function check() {
  hideAllTips();
  var cResult = true;
  if ($('#loginName').val() == '') {
    showTips('loginName','请填写手机号');
    cResult = false;
  }
  if ($('#signTel').val() == '') {
    showTips('signTel', '手机号不能为空');
    cResult = false;
  }
  if ($('#signPwd').val() == '') {
    showTips('signPwd','密码不能为空');
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
    showTips('signCode','验证码不能为空');
    cResult = false;
  }
  if ($('#forgetName').val() == '') {
    showTips('forgetName','手机号不能为空');
    cResult = false;
  }
  if ($('#forgetPass').val() == '') {
    showTips('forgetPass','密码不能为空');
    cResult = false;
  }
  if ($('#forgetCode').val() == '') {
    showTips('forgetCode','验证码不能为空');
    cResult = false;
  }
  return cResult;
}
//登录
function loginIn() {
  if (window.localStorage) {
    var userName = $('#loginName').val(),
        loginPwd = $('#loginPass').val();
    if ($('.s-rember-pwd').prop('checked')) {
      localStorage.setItem('userName',userName);
      localStorage.setItem('passWord',loginPwd);
    }else {
      localStorage.setItem('userName',userName);
    }
    $.post('/user/api/check-login', {userName: userName, userPass: loginPwd}, function(data){
      alert(data.message);
      if (data.code) {
       loginOut();
        sessionStorage.setItem('userId',data.uid);
        window.history.go(0);
      } else {
        window.history.go(-1);
      }
    },'json');
  }else {
    alert('当前浏览器不支持HTML5存储')
  }
}
//手机注册
function regTel() {
  var signTel = $('#signTel').val(),
      signPwd = $('#signPwd').val(),
      signCode = $('#signCode').val(),
      type=1;
  $.post('/user/api/register',{userName: signTel,passWord: signPwd,type: type,
    code: signCode},function(data){
    alert(data.message);
    if (data.code) {
      loginOut();
      login('.s-login-cnt','.s-sign-cnt','.s-forget-cnt',500);
    }
  },"json");
}
//找回密码
function findPwd() {
  var findTel = $('#forgetName').val(),
      findCode = $('#forgetCode').val(),
      findPass = $('#forgetPass').val();
  $.post('/user/api/find-pass',{
    userName: findTel,
    passWord: findPass,
    code: findCode
  },function(data) {
    alert(data.message);
    if (data.code) {
      loginOut();
      login('.s-login-cnt','.s-sign-cnt','.s-forget-cnt',500);
    }
  },'json');
}

//回车登录、注册、找回密码
function keyLogin() {
  if (event.keyCode == 13) {
    event.preventDefault();
    loginIn();
  }
}
function keySign() {
  if (event.keyCode == 13) {
    event.preventDefault();
    regTel();
  }
}
function keyFind() {
  if (event.keyCode == 13) {
    event.preventDefault();
    findPwd();
  }
}

//邮箱注册
//function regEmail() {
//  var signEmail = $('#signEmail').val(),
//      signPwd2 = $('#signPwd2').val(),
//      type=2;
//  $.post('/user/api/register',{userName: signEmail,passWord: signPwd2,type: type},function(data){
//    if (data) {
//    alert(data.message);
//    }else{
//      alert("发送邮件失败，请到个人中心，重新进行验证");
//    }
//  },'json')
//}

//禁止右键
// function stop(){
//   return false;
// }
// document.oncontextmenu = stop;