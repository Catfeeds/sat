<nav class="s-nav navbar-fixed-top">
<div class="container clearfix">
    <a class="s-nav-logo pull-left" href="#">
        <img src="/cn/images/logo.png" alt="企业logo">
    </a>
    <ul class="s-nav-cnt pull-left">
        <li><a class="on" href="/index.html">首页</a></li>
<!--        <li class="s-nav-work">-->
<!--            <a href="#">做题<i class=" icon-caret-down"></i></a>-->
<!--            <ul class="s-nav-showing">-->
<!--                <li><a href="#">练习</a></li>-->
<!--                <li><a href="#">知识库</a></li>-->
<!--                <li><a href="#">测评</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li><a href="#">模考</a></li>-->
<!--        <li><a href="#">报告</a></li>-->
        <li><a href="/class.html">课程</a></li>
        <li><a href="/teachers.html">名师团队</a></li>
<!--        <li><a href="#">学员案例</a></li>-->
        <li><a href="/pubclass.html">公开课</a></li>
        <li><a href="/info.html">资讯</a></li>
    </ul>
    <form action="">
        <i class="icon-search"></i>
        <input type="text">
    </form>
    <ul class="s-nav-login pull-right">
        <li><a class="s-login-in" href="#">登录</a></li>
        <li><a class="s-sign-up" href="#">注册</a></li>
    </ul>
</div>
</nav>
<!--登录、注册框-->
<div class="s-login">
    <div class="s-login-cnt">
        <h2>会员登录</h2>
        <form action="" onsubmit="return check()">
            <div>
                <input type="text" class="form-control" id="loginName" onblur="checkUser('loginName')" placeholder="请输入手机号/邮箱">
            </div>
            <div>
                <input type="password" class="form-control" id="loginPass" placeholder="请输入密码">
            </div>
            <button type="submit" class="btn btn-info s-btn" onclick="login()" id="loginBtn">登录</button>
            <div>
                <label>记住密码</label>
                <input class="s-rember-pwd" type="checkbox" checked="checked">
                <a href="#" class="pull-right">忘记密码?</a>
            </div>
        </form>
        <div class="s-login-bottom">
            <a class="s-go-sign" href="#">免费注册</a>
<!--            <div>-->
<!--                <span>第三方登录:</span>-->
<!--                <a href="#">-->
<!--                    <img src="/cn/images/weChat.png" alt="微信图标">-->
<!--                </a>-->
<!--                <a href="#">-->
<!--                    <img src="/cn/images/QQ.png" alt="qq图标">-->
<!--                </a>-->
<!--            </div>-->
        </div>
        <i class="icon-remove"></i>
    </div>
    <!--注册-->
    <div class="s-sign-cnt">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#sPhone" aria-controls="sPhone" role="tab" data-toggle="tab">手机注册</a></li>
            <li role="presentation"><a href="#sEmail" aria-controls="sEmail" role="tab" data-toggle="tab">邮箱注册</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="sPhone">
                <div>
                    <input type="email" class="form-control" id="signTel" onblur="signTel(this.value)" placeholder="请输入手机号">
                </div>
                <div>
                    <input type="password" class="form-control" id="signPwd1" onblur="signPwd1(this.value)" placeholder="请输入密码">
                </div>
                <div>
                    <input type="text" class="form-control s-sign-code" id="signCode" placeholder="请输入验证码">
                    <button onclick="leftCode()">点击获取验证码</button>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="sEmail">
                <div>
                    <input type="email" class="form-control" id="signEmail" onblur="signEmail(this.value)" placeholder="请输入邮箱">
                </div>
                <div>
                    <input type="password" class="form-control" id="signPwd2" onblur="signPwd2(this.value)" placeholder="请输入密码">
                </div>
<!--                <button onclick="Code()">点击验证邮箱</button>-->
            </div>
        </div>
        <form action="" onsubmit="return check()">
            <button type="submit" class="btn btn-info s-btn s-register">注册</button>
        </form>
        <div class="s-sign-bottom">
            <a class="s-login-back" href="#">返回登录</a>
<!--            <div>-->
<!--                <span>第三方登录:</span>-->
<!--                <a href="#">-->
<!--                    <img src="/cn/images/weChat.png" alt="微信图标">-->
<!--                </a>-->
<!--                <a href="#">-->
<!--                    <img src="/cn/images/QQ.png" alt="qq图标">-->
<!--                </a>-->
<!--            </div>-->
            <i class="icon-remove"></i>
        </div>
    </div>
</div>
<script>
    function leftCode(){
        var phone = $('#signTel').val();
        $.post('/user/api/phone-code',{type:10,phoneNum:phone},function(re){
            alert(re.message);
        },"json")
    }
//    function Code(){
//        var email = $('#signEmail').val();
//        $.post('/user/api/sendmail',{email:email},function(re){
//            alert(re);
//        },"text")
//    }
</script>