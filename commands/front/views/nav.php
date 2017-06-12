
<nav class="s-nav navbar-fixed-top">
    <div class="container clearfix">
    <a class="s-nav-logo pull-left" href="#">
        <img src="/cn/images/logo.png" alt="企业logo">
    </a>
    <ul class="s-nav-cnt pull-left">
        <li><a <?php if($path=='index.html'||$path==''){echo 'class="on"';}?> href="/index.html">首页</a></li>
        <li class="s-nav-work">
            <a href="#">做题<i class="icon-caret-down"></i></a>
            <ul class="s-nav-showing">
                <li><a href="/exercise.html" <?php if(strpos($path,'exercise')!==false) echo 'class="on"';?>>练习</a></li>
                <li><a href="/knowledge.html" <?php if($path=='knowledge.html') echo 'class="on"';?>>知识库</a></li>
<!--                <li><a href="#">测评</a></li>-->
            </ul>
        </li>
        <li><a href="/mock.html" <?php if($path=='mock.html') echo 'class="on"';?>>模考</a></li>
<!--        <li><a href="#">报告</a></li>-->
        <li><a <?php if(strpos($path,'class')!==false && $path!='pubclass.html'){echo 'class="on"';}?> href="/class.html">课程</a></li>
        <li><a <?php if(strpos($path,'teachers')!==false){echo 'class="on"';}?> href="/teachers.html">名师团队</a></li>
<!--        <li><a href="#">学员案例</a></li>-->
        <li><a <?php if($path=='pubclass.html'){echo 'class="on"';}?> href="/pubclass.html">公开课</a></li>
        <li><a  <?php if(strpos($path,'info')!==false){echo 'class="on"';}?> href="/info.html">资讯</a></li>
    </ul>
<!--    <form action="">-->
<!--        <i class="fa fa-search"></i>-->
<!--        <input type="text">-->
<!--    </form>-->

        <ul class="s-nav-login pull-right" id="outul" <?php if(!$user)echo 'style="display:none"';?>>
             <li id="welcome"><a  href="#"><?php if($user){echo "欢迎用户".$user['userName'];}else{echo '欢迎您';}?></a></li>
             <li id="out"><a><span onclick="Out()">退出登录</span></a></li>
        </ul>

       <ul class="s-nav-login pull-right" id="loginul" <?php if($user)echo 'style="display:none"';?>>
            <li id="login"><a class="s-login-in" href="#">登录</a></li>
            <li id="register"><a class="s-sign-up" href="#">注册</a></li>
        </ul>
</div>
</nav>
<!--登录、注册框-->
<div class="s-login">
    <!--登录-->
    <div class="s-login-cnt">
        <h2 class="s-title">会员登录</h2>
        <form action="" onsubmit="return check()">
            <div>
                <input type="text" class="form-control" id="loginName" onblur="checkUser('loginName')" placeholder="请输入手机号">
            </div>
            <div>
                <input type="password" class="form-control" id="loginPass" placeholder="请输入密码">
            </div>
            <button type="submit" class="btn btn-info s-btn" onclick="loginIn()" id="loginBtn">登录</button>
            <div>
                <label>记住密码</label>
                <input class="s-rember-pwd" type="checkbox" checked="checked">
                <a href="#" class="s-forget-up pull-right">忘记密码?</a>
            </div>
        </form>
        <div class="s-login-bottom">
            <a class="s-sign-up" href="#">免费注册</a>
        </div>
        <i class="fa fa-close icon-remove"></i>
    </div>
    <!--注册-->
    <div class="s-sign-cnt">
<!--        <ul class="nav nav-tabs" role="tablist">-->
<!--            <li role="presentation" class="active"><a href="#sPhone" aria-controls="sPhone" role="tab" data-toggle="tab">手机注册</a></li>-->
<!--            <li role="presentation"><a href="#sEmail" aria-controls="sEmail" role="tab" data-toggle="tab">邮箱注册</a></li>-->
<!--        </ul>-->
        <h2 class="s-title">注册会员</h2>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="sPhone">
                <div>
                    <input type="email" class="form-control" id="signTel" onblur="signTel(this.value,'signTel')" placeholder="请输入手机号">
                </div>
                <div>
                    <input type="password" class="form-control" id="signPwd" onblur="signPwd(this.value,'signPwd')" placeholder="请输入密码">
                </div>
                <div>
                    <input type="text" class="form-control s-sign-code" id="signCode" placeholder="请输入验证码">
                    <button class="s-btn-code" onclick="leftCode('signTel')">点击获取验证码</button>
                </div>
            </div>
<!--            <div role="tabpanel" class="tab-pane" id="sEmail">-->
<!--                <div>-->
<!--                    <input type="email" class="form-control" id="signEmail" onblur="signEmail(this.value)" placeholder="请输入邮箱">-->
<!--                </div>-->
<!--                <div>-->
<!--                    <input type="password" class="form-control" id="signPwd2" onblur="signPwd2(this.value)" placeholder="请输入密码">-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <form action="" onsubmit="return check()">
            <button type="submit" class="btn btn-info s-btn s-register" onclick="regTel()">注册</button>
        </form>
        <div class="s-sign-bottom">
            <a class="s-login-in" href="#">返回登录</a>
            <i class="fa fa-close icon-remove"></i>
        </div>
    </div>
    <!--忘记密码-->
    <div class="s-forget-cnt">
        <h2 class="s-title">找回密码</h2>
        <form action="" onsubmit="return check()">
            <div>
                <input type="text" class="form-control" id="forgetName" onblur="signTel(this.value,'forgetName')" placeholder="请输入手机号">
            </div>
            <div>
                <input type="text" class="form-control s-sign-code" id="forgetCode" placeholder="请输入验证码">
                <button class="s-btn-code" onclick="leftCode('forgetName')">点击获取验证码</button>
            </div>
            <div>
                <input type="password" class="form-control" id="forgetPass" onblur="signPwd(this.value,'forgetPass')" placeholder="请输入密码">
            </div>
            <button type="submit" class="btn btn-info s-btn" id="forgetBtn"  onclick="findPwd()">确定</button>
        </form>
        <div class="s-sign-bottom">
            <a class="s-login-in" href="#">返回登录</a>
        </div>
        <i class="fa fa-close icon-remove"></i>
    </div>
</div>
<script>
    // 获取手机验证码
    function leftCode(code){
        var phone = $('#'+code).val();
        $.post('/user/api/phone-code',{type:10,phoneNum:phone},function(re){
            alert(re.message);
        },"json")
    }
    // 用户登出
    function Out(){
        $.post('/user/api/login-out',function(re){
            alert('退出成功');
            history.go(0);
        },"json")
    }

</script>