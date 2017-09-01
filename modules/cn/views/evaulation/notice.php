 <link rel="stylesheet" href="/cn/css/mock-notice.css">
<section class="s-evaluation">
    <div class="s-top container">
        <div class="s-top-cnt row">
            <div class="s-top-logo col-lg-4 col-md-4">
                <img src="/cn/images/logo1.png" alt="">
            </div>
            <h1 class="col-lg-4 col-md-4">SAT评测</h1>
            <p class="s-top-out col-lg-4 col-md-4">
                <i class="work-out-off fa fa-sign-out"></i>
                <span class="get-out">离开</span>
            </p>
        </div>
    </div>
    <div class="s-cnt">
        <div class="s-notice">
            <h1>测评注意事项</h1>
            <div class="s-wrap">
                <div class="s-tag">
                    <div class="s-line"></div>
                    <h3>01</h3>
                    <p>测评内容</p>
                </div>
                <div class="s-list">
                    <ul>
                        <li>测评内容: 词汇、语法填空、句子翻译、阅读理解、数学</li>
                        <li>测评时间: 120mins.各部分时间自行分配。</li>
                        <li>测评总分: 120分</li>
                    </ul>
                </div>
            </div>
            <div class="s-wrap">
                <div class="s-tag">
                    <div class="s-line"></div>
                    <h3>02</h3>
                    <p>测评要求</p>
                </div>
                <div class="s-list">
                    <ul>
                        <li>关闭QQ等其他可能骚扰你的软件</li>
                        <li>禁止使用网络工具查询答案</li>
                        <li>请一次性将测评题目完成,建议不要中断</li>
                        <li>若超过测评限时,将直接跳转至测评结果页面</li>
                    </ul>
                </div>
            </div>
            <div class="s-wrap s-third">
                <div class="s-tag">
                    <div class="s-line"></div>
                    <h3>03</h3>
                    <p>测评结果</p>
                </div>
                <div class="s-list">
                    <ul>
                        <li>测评完成后,点击提交,将显示此次测评分数报告及针对这次测试结果的复习指南</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="s-start">
            <button class="do-subject">开始做题</button>
        </div>
        <!--遮罩层-->
        <div class="s-shade">
            <div class="shade-wrap">
                <h3>小主,你忍心弃我而去吗?</h3>
                <div class="shade-select clearfix">
                    <span class="shade-out pull-left">忍心而去</span>
                    <span class="shade-in do-subject pull-right">逗你玩呢!</span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        sessionStorage.clear();
//        var u = location.search.substr(1);
        $('.do-subject').click(function () {
            window.location.href = '/evaulation_test/<?php echo $tid = Yii::$app->request->get('tid')?>'+'.html';
        })
        $('.get-out').click(function () {
            $('.s-shade').show();
        })
        $('.shade-out').click(function () {
            window.location.href = '/mock.html';
        })
        var h = $(window).height()-80;
        $('.s-evaluation .s-cnt').height(h);
        $('.s-notice .s-wrap ').css('marginBottom',0.05*h);
        $('.s-notice .s-list li').css('marginBottom',0.03*h);
    })
</script>
