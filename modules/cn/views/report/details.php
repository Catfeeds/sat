<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>报告</title>
    <link rel="stylesheet" href="/cn/css/reset.css">
    <link rel="stylesheet" href="/cn/css/bootstrap.css">
    <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
    <link rel="stylesheet" href="/cn/css/public.css">
    <link rel="stylesheet" href="/cn/css/report-details.css">

    <script src="/cn/js/jquery-2.1.3.js"></script>
    <script src="/cn/js/bootstrap.js"></script>
    <script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
    <script src="/cn/js/public.js"></script>
    <script src="/cn/js/highcharts.js"></script>
    <script src="/cn/js/report-details.js"></script>
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
<!--            <li><a href="#">学员案例</a></li>-->
            <li><a href="#">公开课</a></li>
            <li><a href="#">资讯</a></li>
        </ul>
        <form action="">
            <i class="icon-search"></i>
            <input type="text">
        </form>
        <ul class="s-nav-login pull-right">
            <li><a href="#">登录</a></li>
            <li><a href="#">注册</a></li>
        </ul>
    </div>
</nav>
<!--内容区域-->
<section class="s-w1200">
    <!--头部banner区-->
    <div class="report-banner">
        <div class="report-bnr-cnt">
            <span>lala</span>
            同学你好,以下是你的考试分析报告
        </div>
    </div>
    <div class="report-cnt">
        <!--总成绩、时间-->
        <div class="report-total-score container-fluid">
            <h3 class="report-title">成绩</h3>
            <div class="report-score-wrap report-wrap row">
                <div class="col-md-6 col-sm-6">
                    <table class="report-score-table">
                        <tr>
                            <th>阅读</th>
                            <th>文法</th>
                            <th>数学</th>
                            <th>总题数</th>
                            <th>总成绩</th>
                        </tr>
                        <tr>
                            <td>400</td>
                            <td>300</td>
                            <td>600</td>
                            <td>155</td>
                            <td>1300</td>
                        </tr>
                    </table>
                    <ul class="report-score-other">
                        <li>
                            <span class="other-title">SubScores</span>
                            <span class="other-score">40</span>
                        </li>
                        <li>
                            <span class="other-title">Cross-Test Scores</span>
                            <span class="other-score">50</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="report-time" id="reportTime"></div>
                </div>
            </div>
        </div>
        <!--各学科正确率分析-->
        <div class="report-subject container-fluid">
            <h3 class="report-title">正确率分析</h3>
            <div class="report-wrap row">
                <!--阅读-->
                <div class="report-reading col-md-4 col-sm-4">
                    <h4 class="report-sub-title">阅读</h4>
                    <div class="report-sub-chart" id="repReading"></div>
                    <ul class="report-sub-list">
                        <li>
                            <span></span>
                            <i>正确</i>
                        </li>
                        <li>
                            <span class="sub-red"></span>
                            <i>错误</i>
                        </li>
                        <li>
                            <span class="sub-blue"></span>
                            <i>放弃</i>
                        </li>
                    </ul>
                </div>
                <!--文法-->
                <div class="report-writing col-md-4 col-sm-4">
                    <h4 class="report-sub-title">文法</h4>
                    <div class="report-sub-chart" id="repWriting"></div>
                    <ul class="report-sub-list">
                        <li>
                            <span></span>
                            <i>正确</i>
                        </li>
                        <li>
                            <span class="sub-red"></span>
                            <i>错误</i>
                        </li>
                        <li>
                            <span class="sub-blue"></span>
                            <i>放弃</i>
                        </li>
                    </ul>
                </div>
                <!--数学-->
                <div class="report-math col-md-4 col-sm-4">
                    <h4 class="report-sub-title">数学</h4>
                    <div class="report-sub-chart" id="repMath"></div>
                    <ul class="report-sub-list">
                        <li>
                            <span></span>
                            <i>正确</i>
                        </li>
                        <li>
                            <span class="sub-red"></span>
                            <i>错误</i>
                        </li>
                        <li>
                            <span class="sub-blue"></span>
                            <i>放弃</i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--历史成绩曲线图-->
        <div class="report-history">
            <h3 class="report-title">历史成绩</h3>
            <div class="report-wrap" id="reportHistory"></div>
        </div>
        <!--复习策略建议-->
        <div class="report-advice">
            <h3 class="report-title">复习策略</h3>
            <div class="report-wrap">
                <ul class="advice-list">
                    <li class="advice-cnt">
                        <div class="advice-title">阅读</div>
                        <p>追求速度，做完题就了事，不求甚解，这样即使做很多遍也不会有成效，相反的，
                            沉下心来。踏踏实实分析题目和文章，我相信不出几次就会有显著的提高。</p>
                    </li>
                    <li class="advice-cnt advice-cnt2">
                        <div class="advice-title">文法</div>
                        <p>追求速度，做完题就了事，不求甚解，这样即使做很多遍也不会有成效，相反的，
                            沉下心来。踏踏实实分析题目和文章，我相信不出几次就会有显著的提高。</p>
                    </li>
                    <li class="advice-cnt">
                        <div class="advice-title">数学</div>
                        <p>追求速度，做完题就了事，不求甚解，这样即使做很多遍也不会有成效，相反的，
                            沉下心来。踏踏实实分析题目和文章，我相信不出几次就会有显著的提高。</p>
                    </li>
                </ul>
                <img class="advice-img" src="/cn/images/report01.png" alt="">
            </div>
        </div>
        <!--答题情况详解-->
        <div class="report-details">
            <h3 class="report-title">答题情况</h3>
            <div class="report-wrap">

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
    $(function () {
        barChart('reportTime',[[100,230]],["你的时间","标准时间"],["做题时间"],{xAxisColor:'#002D71', xRotation:0, title: "做题时间", subtitle:'', yAxisUnit: '(min)', color: ['#36B2FB'], min: 0, max: 230, tooltipUnit: 'min', showValue: true})
        pieChart('repReading',[parseInt('9'),parseInt('20'),parseInt('126')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        pieChart('repWriting',[parseInt('130'),parseInt('10'),parseInt('15')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        pieChart('repMath',[parseInt('106'),parseInt('30'),parseInt('9')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        lineChart('reportHistory',[[1200,1350,1400,1500]],['OG第一套','BARRON第二套','开普兰第一套','OG第四套'],['分数'],{title: '历史成绩曲线图',min: 0,max: 1600,tooltipUnit: '分',showValue: true});
    })
</script>
</html>