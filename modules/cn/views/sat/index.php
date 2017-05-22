<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <title>sat首页</title>
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/bootstrap.css">
    <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
    <link rel="stylesheet" href="/cn/css/public.css">
    <link rel="stylesheet" href="/cn/css/sat.css">

    <script src="/cn/js/jquery-2.1.3.js"></script>
    <script src="/cn/js/bootstrap.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
    <script src="/cn/js/public.js"></script>
    <script src="/cn/js/carousel.js"></script>
</head>
<body>
<!--导航-->
<nav class="s-nav navbar-fixed-top">
    <div class="container clearfix">
        <a class="s-nav-logo pull-left" href="#">
            <img src="/cn/images/logo.png" alt="企业logo">
        </a>
        <ul class="s-nav-cnt pull-left">
            <li><a class="on" href="#">首页</a></li>
            <li class="s-nav-work">
                <a href="#">做题<i class=" icon-caret-down"></i></a>
                <ul class="s-nav-showing">
                    <li><a href="#">练习</a></li>
                    <li><a href="#">知识库</a></li>
                    <li><a href="#">测评</a></li>
                </ul>
            </li>
            <li><a href="#">模考</a></li>
            <li><a href="details.html">报告</a></li>
            <li><a href="course.html">课程</a></li>
            <li><a href="#">名师团队</a></li>
            <li><a href="#">学员案例</a></li>
            <li><a href="#">公开课</a></li>
            <li><a href="#">资讯</a></li>
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
            <input type="text" class="form-control" id="loginName" onblur="checkUser('loginName')" placeholder="请输入手机号/邮箱">
            <input type="password" class="form-control" id="loginPass" placeholder="请输入密码">
            <button type="submit" class="btn btn-info s-btn" onclick="login()" id="loginBtn">登录</button>
            <div>
                <label>记住密码</label>
                <input class="s-rember-pwd" type="checkbox" checked="checked">
                <a href="#" class="pull-right">忘记密码?</a>
            </div>
        </form>
        <div class="s-login-bottom">
            <a class="s-go-sign" href="#">免费注册</a>
            <div>
                <span>第三方登录:</span>
                <a href="#">
                    <img src="/cn/images/weChat.png" alt="微信图标">
                </a>
                <a href="#">
                    <img src="/cn/images/QQ.png" alt="qq图标">
                </a>
            </div>
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
                <input type="email" class="form-control" id="signTel" onblur="signTel(this.value)" placeholder="请输入手机号">
                <input type="password" class="form-control" id="signPwd1" onblur="signPwd1(this.value)" placeholder="请输入密码">
                <input type="text" class="form-control s-sign-code" id="signCode" placeholder="请输入验证码"><button>点击获取验证码</button>
            </div>
            <div role="tabpanel" class="tab-pane" id="sEmail">
                <input type="email" class="form-control" id="signEmail" onblur="signEmail(this.value)" placeholder="请输入邮箱">
                <input type="password" class="form-control" id="signPwd2" onblur="signPwd2(this.value)" placeholder="请输入密码">
            </div>
        </div>
        <form action="" onsubmit="return check()">
            <button type="submit" class="btn btn-info s-btn s-register">注册</button>
        </form>
        <from class="s-sign-agree">
            <input type="checkbox"><span>我已阅读并同意<a href="#">申友协议</a></span>
        </from>
        <div class="s-sign-bottom">
            <a class="s-login-back" href="#">返回登录</a>
            <div>
                <span>第三方登录:</span>
                <a href="#">
                    <img src="/cn/images/weChat.png" alt="微信图标">
                </a>
                <a href="#">
                    <img src="/cn/images/QQ.png" alt="qq图标">
                </a>
            </div>
            <i class="icon-remove"></i>
        </div>
    </div>
</div>
<section>
    <div class="s-w1200 s-sat">
        <!--轮播图-->
        <div class="bnr-wrap clearfix s-banner">
            <div id="myCarousel" class="carousel pull-left slide">
                <!-- 轮播（Carousel）指标 -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <!-- 轮播（Carousel）项目 -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="/cn/images/course-bg01.png" alt="First slide">
                    </div>
                    <div class="item">
                        <img src="/cn/images/course-bg01.png" alt="Second slide">
                    </div>
                    <div class="item">
                        <img src="/cn/images/course-bg01.png" alt="Third slide">
                    </div>
                </div>
                <!-- 轮播（Carousel）导航 -->
                <a class="carousel-control s-left" href="#myCarousel"
                   data-slide="prev">&lt;</a>
                <a class="carousel-control s-right" href="#myCarousel"
                   data-slide="next">&gt;</a>
            </div>
            <div class="s-person clearfix">
                <div class="s-person-logo border-radius pull-left"></div>
                <div class="s-hi">
                    <h3>hi</h3>
                    <p>欢迎来到申友</p>
                </div>
                <div class="s-btn">
                    <button class="s-login-in">登录</button>
                    <button class="s-sign-up">注册</button>
                </div>
                <h3 class="s-adv">公告:</h3>
                <ul>
                    <li><a href="#">kevin老师5.16号公开课</a></li>
                    <li><a href="#">SAT强化班限时优惠</a></li>
                    <li><a href="#">SAT强化班限时优惠SAT强化班限时优惠SAT强化班限时优惠</a></li>
                    <li><a href="#">SAT强化班限时优惠</a></li>
                    <li><a href="#">SAT强化班限时优惠</a></li>
                    <li><a href="#">SAT强化班限时优惠</a></li>
                    <li><a href="#">SAT强化班限时优惠</a></li>
                    <li><a href="#">SAT强化班限时优惠</a></li>
                </ul>

            </div>
        </div>
        <!--免费公开课-->
        <div class="s-pubclass">
            <div class="s-sat-title clearfix">
                <p class="pull-left">F</p>
                <div>
                    <p>
                        <span style="color: #000;font-weight: bold;">免费</span>
                        <span style="color: rgb(229,104,215)">class</span>
                    </p>
                    <p>
                        <span style="color: rgb(54,178,251);">ree open</span>
                        <span style="color: #000;font-weight: bold;">公开课</span>
                    </p>
                </div>
            </div>
            <div class="s-pubcnt-cnt" id="Index_Box">
                <pre class="prev">&lt;</pre>
                <pre class="next">&gt;</pre>
                <ul>
                    <li class="s-cnt">
                        <img src="/cn/images/sat03.png" alt="">
                        <a href="#">查看详情</a>
                    </li>
                    <li class="s-cnt">
                        <img src="/cn/images/sat03.png" alt="">
                        <a href="#">查看详情</a>
                    </li>
                    <li class="s-cnt">
                        <img src="/cn/images/sat03.png" alt="">
                        <a href="#">查看详情</a>
                    </li>
                    <li class="s-cnt">
                        <img src="/cn/images/sat03.png" alt="">
                        <a href="#">查看详情</a>
                    </li>
                    <li class="s-cnt">
                        <img src="/cn/images/sat03.png" alt="">
                        <a href="#">查看详情</a>
                    </li>
                    <li class="s-cnt">
                        <img src="/cn/images/sat03.png" alt="">
                        <a href="#">查看详情</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--SAT课程-->
        <div class="s-course">
            <div class="s-sat-title clearfix" style="width: 180px;">
                <p class="pull-left">SAT</p>
                <div style="margin-left: 80px;">
                    <p>
                        <span style="color: rgb(229,104,215)">course</span>
                    </p>
                    <p>
                        <span style="color: #000;font-weight: bold;">暑期班</span>
                    </p>
                </div>
            </div>
            <div class="s-cnt">
                <ul class="s-detail">
                    <li class="s-img"><img src="/cn/images/sat-course01.png" alt=""></li>
                    <li class="s-font">
                        <h2>全能小班</h2>
                        <p>考生掌握的SAT考试词汇量的大小对于其取得的SAT成绩是有直接影响的，所以大部分考生都需要在备考SAT考试的时候留出一段时间来专门记忆SAT词汇。</p>
                        <a href="#">查看更多</a>
                    </li>
                    <li class="s-img"><img src="/cn/images/sat-course02.png" alt=""></li>
                </ul>
                <ul class="s-detail">
                    <li class="s-font">
                        <h2>全能小班</h2>
                        <p>全能小班全能小班全能小班全能小班全能小班全能小班全能小班</p>
                        <a href="#">查看更多</a>
                    </li>
                    <li class="s-img"><img src="/cn/images/sat-course03.png" alt=""></li>
                    <li class="s-font">
                        <h2>全能小班</h2>
                        <p>全能小班全能小班全能小班全能小班全能小班全能小班全能小班</p>
                        <a href="#">查看更多</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--文章资讯-->
        <div class="s-article">
            <div class="s-sat-title clearfix">
                <p class="pull-left">A</p>
                <div>
                    <p>
                        <span style="color: #000;font-weight: bold;">文章</span>
                        <span style="color: rgb(229,104,215)">information</span>
                    </p>
                    <p>
                        <span style="color: rgb(54,178,251);">ticle</span>
                        <span style="color: #000;font-weight: bold;">资讯</span>
                    </p>
                </div>
            </div>
            <div class="s-cnt clearfix">
                <div class="s-text s-text1">
                    <img src="/cn/images/sat-course01.png" alt="">
                    <ul>
                        <li>
                            <h2><a href="#">美国大学申请必备考试之一 SAT须达到多少词汇量才能过关？</a></h2>
                            <p>考生掌握的SAT考试词汇量的大小对于其取得的SAT成绩是有直接影响的，所以大部分考生都需要在备考SAT考试的时候留出一段时间来专门记忆SAT词汇。</p>
                        </li>
                        <li>
                            <h2><a href="#">美国大学申请必备考试之一 SAT须达到多少词汇量才能过关？</a></h2>
                            <p>考生掌握的SAT考试词汇量的大小对于其取得的SAT成绩是有直接影响的，所以大部分考生都需要在备考SAT考试的时候留出一段时间来专门记忆SAT词汇。</p>
                        </li>
                        <li>
                            <h2><a href="#">美国大学申请必备考试之一 SAT须达到多少词汇量才能过关？</a></h2>
                            <p>考生掌握的SAT考试词汇量的大小对于其取得的SAT成绩是有直接影响的，所以大部分考生都需要在备考SAT考试的时候留出一段时间来专门记忆SAT词汇。</p>
                        </li>
                        <li>
                            <h2><a href="#">美国大学申请必备考试之一 SAT须达到多少词汇量才能过关？</a></h2>
                            <p>考生掌握的SAT考试词汇量的大小对于其取得的SAT成绩是有直接影响的，所以大部分考生都需要在备考SAT考试的时候留出一段时间来专门记忆SAT词汇。</p>
                        </li>
                        <li>
                            <h2><a href="#">美国大学申请必备考试之一 SAT须达到多少词汇量才能过关？</a></h2>
                            <p>考生掌握的SAT考试词汇量的大小对于其取得的SAT成绩是有直接影响的，所以大部分考生都需要在备考SAT考试的时候留出一段时间来专门记忆SAT词汇。</p>
                        </li>
                    </ul>
                </div>
                <!--<div class="s-text2"></div>-->
                <!--<div class="s-text s-text3"></div>-->
            </div>
        </div>
        <!--名师团队-->
        <div class="s-teacher">
            <div class="s-w1200">
                <div class="s-sat-title clearfix">
                    <p class="pull-left">T</p>
                    <div>
                        <p>
                            <span style="color: #000;font-weight: bold;">名师</span>
                            <span style="color: rgb(229,104,215)">team</span>
                        </p>
                        <p>
                            <span style="color: rgb(54,178,251);">eacher</span>
                            <span style="color: #000;font-weight: bold;">团队</span>
                        </p>
                    </div>
                </div>
                <div class="s-teacher-cnt">
                    <div class="s-arrow prev">&lt;</div>
                    <div class="s-arrow next">&gt;</div>
                    <ul class="s-teacher-int clearfix">
                        <li>
                            <img src="/cn/images/course-basis01.png" alt="">
                            <div>
                                <h2>Kevin</h2>
                                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
                            </div>
                            <a href="#">立即预约</a>
                        </li>
                        <li>
                            <img src="/cn/images/course-basis01.png" alt="">
                            <div>
                                <h2>Kevin</h2>
                                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
                            </div>
                            <a href="#">立即预约</a>
                        </li>
                        <li>
                            <img src="/cn/images/course-basis01.png" alt="">
                            <div>
                                <h2>Kevin</h2>
                                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
                            </div>
                            <a href="#">立即预约</a>
                        </li>
                        <li>
                            <img src="/cn/images/course-basis01.png" alt="">
                            <div>
                                <h2>Kevin</h2>
                                <h4>主讲：SAT语法、数学、写作、数学、写作</h4>
                                <p>申友SAT教学研发总监，英国兰卡斯特大学硕士，国内重本英语专业毕业；国外的几年深造，使她对西方人的思维方式和表达习惯有着深刻的了解；上课内容深入浅出，上课风格诙谐活泼，深受学生的喜欢。</p>
                            </div>
                            <a href="#">立即预约</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--底部-->
<footer class="s-footer">
    <div class="s-footer-top">
        <div class="s-w1200 clearfix">
            <dl class="pull-left">
                <dt>快速入口</dt>
                <dd><a href="#">SAT</a></dd>
                <dd><a href="#">GMAT</a></dd>
                <dd><a href="#">TOEFL</a></dd>
                <dd><a href="#">IELTS</a></dd>
                <dd><a href="#">ACT</a></dd>
            </dl>
            <dl class="pull-left">
                <dt>网站说明</dt>
                <dd><a href="#">关于我们</a></dd>
                <dd><a href="#">联系我们</a></dd>
                <dd><a href="#">加入我们</a></dd>
                <dd><a href="#">您的建议</a></dd>
            </dl>
            <div class="s-qr">
                <img src="/cn/images/qr-code01.png" alt="">
                <p>SAT公众号</p>
            </div>
            <div class="s-qr">
                <img src="/cn/images/qr-code01.png" alt="">
                <p>SAT公众号</p>
            </div>
            <div class="s-tel">
                <img src="/cn/images/tel_icon.png" alt="">
                <p>400-600-1123</p>
            </div>
        </div>
    </div>
    <div class="s-footer-bottom">
        <div class="s-w1200">
            <dl>
                <dt>友情链接:</dt>
                <dd>
                <dd><a href="#">申友网</a></dd>
                <dd><a href="#">申友网</a></dd>
                <dd><a href="#">雷哥网</a></dd>
                <dd><a href="#">雷哥网</a></dd>
                <dd><a href="#">申友网</a></dd>
                </dd>
            </dl>
            <p>Copyright © 2015 All Right Reserved 申友教育 版权所有 京ICP备16000003号 京公网安备 11010802018491 免责声明
            </p>
        </div>
    </div>
</footer>
</body>
<script>
    <!--高分榜-->
    jQuery(".s-banner").slide({mainCell:".s-person ul",autoPlay:true,effect:"topMarquee",vis:5,interTime:50});
    //  名师团队
    jQuery('.s-teacher-cnt').slide({mainCell:".s-teacher-int", effect:"leftLoop",vis:4, autoPlay:false});
    jQuery(".s-article").slide({mainCell:".s-text1 ul",autoPlay:true,effect:"topMarquee",vis:5,interTime:100});

    $(function () {
        $('.s-article .s-text ul').parent().css({
            'margin-left': '300px',
            'height': '400px',
            'top': '-400px',
            'left': '100px'
        });
        $('.s-article .s-text ul li').css({
            'margin-bottom-width': '1px',
            'margin-bottom-color': '#000',
            'margin-bottom-type': 'solid'
        })
    })
</script>
</html>