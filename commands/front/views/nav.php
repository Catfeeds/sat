
<nav class="s-nav navbar-fixed-top">
    <div class="container clearfix">
    <a class="s-nav-logo pull-left" href="http://sat.thinkuedu.com/index.html">
        <img src="/cn/images/logo.png" alt="企业logo">
    </a>
    <ul class="s-nav-cnt pull-left">
        <li><a <?php if($path=='index.html'||$path==''){echo 'class="on"';}?> href="/index.html">首页</a></li>
        <li class="s-nav-work">
            <a id="showA" href="#">做题<i class="fa fa-sort-desc"></i></a>
            <ul class="s-nav-showing">
                <li><a href="/exercise.html" <?php if(strpos($path,'exercise')!==false) echo 'class="on"';?>>练习</a></li>
                <li><a href="/knowledge.html" <?php if($path=='knowledge.html') echo 'class="on"';?>>知识库</a></li>
                <li><a href="#">测评</a></li>
            </ul>
        </li>
        <li><a href="/mock.html" <?php if($path=='mock.html') echo 'class="on"';?>>模考</a></li>
        <li><a href="#">报告</a></li>
        <li><a <?php if(strpos($path,'class')!==false && $path!='pubclass.html'){echo 'class="on"';}?> href="/class.html">课程</a></li>
        <li><a <?php if(strpos($path,'teachers')!==false){echo 'class="on"';}?> href="/teachers.html">名师团队</a></li>
<!--        <li><a href="#">学员案例</a></li>-->
        <li><a <?php if($path=='pubclass.html'){echo 'class="on"';}?> href="/pubclass.html">公开课</a></li>
        <li><a  <?php if(strpos($path,'info')!==false){echo 'class="on"';}?> href="/info.html">资讯</a></li>
    </ul>
    <form action="">
        <i class="fa fa-search"></i>
        <input type="text">
    </form>
        <ul class="s-nav-login pull-right" id="outul" <?php if(!$user)echo 'style="display:none"';?>>
             <li id="welcome"><a  href="#"><?php if($user){echo "欢迎用户".$user['username'];}else{echo '欢迎您';}?></a></li>
             <li id="out"><a><span onclick="Out()">退出登录</span></a></li>
        </ul>
       <ul class="s-nav-login pull-right" id="loginul" <?php if($user)echo 'style="display:none"';?>>
            <li id="login"><a class="s-login-in" href="http://login.gmatonline.cn/cn/index?source=20&url=<?php echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?>">登录</a></li>
            <li id="register"><a class="s-sign-up" href="http://login.gmatonline.cn/cn/index/register?source=20&url=<?php echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?>">注册</a></li>
        </ul>
</div>
</nav>
<script>
    var sess ='<?php if(isset($uid)){echo $uid;}?>' ;
    sessionStorage.uid = sess;
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