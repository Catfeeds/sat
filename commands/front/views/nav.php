<div class="greyNav">
    <div class="inGrey clearfix">
        <div class="leftNav pull-left">
            <ul>
                <li><a href="http://www.viplgw.cn" target="_blank">
                        <img src="/cn/images/logo-icon.png" alt="logo图标">
                    </a>
                </li>
                <li><a href="http://www.smartapply.cn/" target="_blank">留学</a></li>
                <li><a href="http://www.gmatonline.cn/" target="_blank">GMAT</a></li>
                <li><a class="on" href="http://sat.thinkuedu.com/" target="_blank">SAT</a></li>
                <li><a href="http://www.toeflonline.cn/" target="_blank">托福</a></li>
                <li><a href="http://ielts.viplgw.cn/" target="_blank">雅思</a></li>
                <li class="xian">|</li>
                <li><a href="http://open.viplgw.cn" target="_blank">公开课</a></li>
                <li><a href="http://class.viplgw.cn/" target="_blank">网校</a></li>
                <li><a href="http://class.viplgw.cn/studyGroup.html" target="_blank">小组</a></li>
                <li><a href="http://class.viplgw.cn/vip.html" target="_blank">会员</a></li>
                <li class="phone"><span>400-1816-180</span></li>
                <li><a href="http://wpa.qq.com/msgrd?v=3&uin=1746295647&site=qq&menu=yes" target="_blank">在线咨询</a></li>
            </ul>
        </div>
        <div class="right-login pull-right">
            <ul class="s-nav-login pull-right" id="outul" <?php if(!$user)echo 'style="display:none"';?>>
                <li id="welcome"><a  href="#"><?php if($user){echo "欢迎用户".$user['username'];}else{echo '欢迎您';}?></a></li>
                <li id="out"><a><span onclick="Out()">退出登录</span></a></li>
            </ul>
            <ul class="s-nav-login pull-right" id="loginul" <?php if($user)echo 'style="display:none"';?>>
                <li id="login"><a class="s-login-in" href="http://login.gmatonline.cn/cn/index?source=20&url=<?php echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?>">登录</a></li>
                <li id="register"><a class="s-sign-up" href="http://login.gmatonline.cn/cn/index/register?source=20&url=<?php echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?>">注册</a></li>
            </ul>
        </div>
        <div class="appDownload pull-right">
            <span class="app-tit">APP
                <i class="fa fa-caret-down"></i>
            </span>
            <div class="app-down">
                <ul>
                    <li>
                        <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥GMAT苹果版</a>
                        <div class="app-box">
                            <img src="/cn/images/gmat-ios.png" alt="app二维码">
                        </div>
                    </li>
                    <li>
                        <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥GMAT安卓版</a>
                        <div class="app-box">
                            <img src="/cn/images/gmat-android.png" alt="app二维码">
                        </div>
                    </li>
                    <li>
                        <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥托福苹果版</a>
                        <div class="app-box">
                            <img src="/cn/images/toefl-ios.jpg" alt="app二维码">
                        </div>
                    </li>
                    <li>
                        <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥托福安卓版</a>
                        <div class="app-box">
                            <img src="/cn/images/toefl-android.png" alt="app二维码">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<nav class="s-nav">
    <div class="container clearfix">
    <a class="s-nav-logo pull-left" href="http://sat.thinkuedu.com/index.html">
        <img src="/cn/images/logo.png" alt="企业logo">
    </a>
    <ul class="s-nav-cnt pull-left">
        <li><a <?php if($path=='index.html'||$path==''){echo 'class="on"';}?> href="/index.html">首页</a></li>
        <li><a <?php if(strpos($path,'class')!==false && $path!='pubclass.html'){echo 'class="on"';}?> href="/class.html">SAT课程</a></li>
        <li><a <?php if(strpos($path,'teachers')!==false){echo 'class="on"';}?> href="/teachers.html">名师团队</a></li>
<!--        <li><a href="#">学员案例</a></li>-->
        <li><a <?php if($path=='pubclass.html'){echo 'class="on"';}?> href="/pubclass.html">公开课</a></li>
        <li><a  <?php if(strpos($path,'info')!==false){echo 'class="on"';}?> href="/info.html">SAT资讯</a></li>
    </ul>
</div>
</nav>
<script>
    var uId ='<?php if(isset($uid)){echo $uid;}?>' ;
    $.cookie('uid',uId);
    // 用户登出
    function Out(){
        $.post('/user/api/login-out',function(re){
            alert('退出成功');
            history.go(0);
        },"json")
    }

</script>