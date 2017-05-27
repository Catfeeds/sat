
    <title>sat首页</title>
    <link rel="stylesheet" href="/cn/css/sat.css">
    <script src="/cn/js/carousel.js"></script>
<section>
    <div class="s-w1200 s-sat">
        <!--轮播图-->
        <div class="bnr-wrap clearfix s-banner">
                <?php use app\commands\front\BannerWidget;?>
                <?php BannerWidget::begin();?>
                <?php BannerWidget::end();?>
            <div class="s-person clearfix">
                <div class="s-person-logo border-radius pull-left"></div>
                <div class="s-hi">
                    <h3>hi</h3>
                    <p>欢迎来到申友</p>
                </div>
                <?php if($user){
                    echo '<div class="s-btn">
                    <button >欢迎您</button>
                    <button onclick="Out()" >退出</button>
                    </div>';
                }else{
                    echo '<div class="s-btn">
                    <button class="s-login-in">登录</button>
                    <button class="s-sign-up">注册</button>
                    </div>';
                }?>

<!--                <div class="s-btn">-->
<!--                    <button class="s-login-in">登录</button>-->
<!--                    <button class="s-sign-up">注册</button>-->
<!--                </div>-->
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
                    <?php foreach($info1 as $v){?>
                    <li class="s-cnt">
                        <img src="<?php echo $v['content']?>" alt="">
                        <a href="/info_details/<?php echo $v['id']?>.html">查看详情</a>
                    </li>
                    <?php }?>
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
<!--                --><?php //foreach($info3 as $k=>$v){
//                    if($k=='0'){
//                        echo '<ul class="s-detail">
//                                <li class="s-img"><img src="/cn/images/sat-course01.png" alt=""></li>
//                    <li class="s-font">';
//                    }else{
//                        echo '<ul class="s-detail">';
//                        if($k=1){
//                            echo '<li class="s-font">';
//                        }else{}
//                    }
//                }?>
                <ul class="s-detail">
                    <li class="s-img"><img src="/cn/images/sat-course01.png" alt=""></li>
                    <li class="s-font">
                        <h2><?php echo $classes[0]['cate']?></h2>
                        <p><?php echo $classes[0]['introduction']?></p>
                        <a href="/class_details/<?php echo $classes[0]['id']?>.html">查看更多</a>
                    </li>
                    <li class="s-img"><img src="/cn/images/sat-course02.png" alt=""></li>
                </ul>
                <ul class="s-detail">
                    <li class="s-font">
                        <h2><?php echo $classes[1]['cate']?></h2>
                        <p><?php echo $classes[1]['introduction']?></p>
                        <a href="/class_details/<?php echo $classes[1]['id']?>.html">查看更多</a>
                    </li>
                    <li class="s-img"><img src="/cn/images/sat-course03.png" alt=""></li>
                    <li class="s-font">
                        <h2><?php echo $classes[2]['cate']?></h2>
                        <p><?php echo $classes[2]['introduction']?></p>
                        <a href="/class_details/<?php echo $classes[2]['id']?>.html">查看更多</a>
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
                <div class="s-information s-news">
                    <div class="s-title-wrapper clearfix">
                        <span class="s-title pull-left"><i class="s-logo fa fa-lightbulb-o"></i>新闻资讯</span>
                        <a class="s-more pull-right" href="#"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <ul>
                        <li>
                            <a class="s-article-img" href="#">
                                <img src="/cn/images/sat-article01.png" alt="">
                            </a>
                            <div class="s-article-title">
                                <h3><a href="/info_details/<?php echo  $infoNews[0]['id']?>.html"><?php echo $infoNews[0]['title']?></a></h3>
                                <p><?php echo $infoNews[0]['summary']?></p>
                            </div>
                        </li>
                        <?php foreach($infoNews as $k=>$v){if($k>=1){?>
                        <li class="s-more-title">
                            <a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                        </li>
                        <?php }}?>
                    </ul>
                </div>
                <div class="s-information s-exam">
                    <div class="s-title-wrapper clearfix">
                        <span class="s-title pull-left"><i class="s-logo fa fa-tasks"></i>备考资讯</span>
                        <a class="s-more pull-right" href="#"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <ul>
                        <li>
                            <a class="s-article-img" href="#">
                                <img src="/cn/images/sat-article02.png" alt="">
                            </a>
                            <div class="s-article-title">
                                <h3><a href="/info_details/<?php echo  $infoTest[0]['id']?>.html"><?php echo $infoTest[0]['title']?></a></h3>
                                <p><?php echo $infoTest[0]['summary']?></p>
                            </div>
                        </li>
                        <?php foreach($infoTest as $k=>$v){if($k>=1){?>
                            <li class="s-more-title">
                                <a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                            </li>
                        <?php }}?>
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰新西兰纳新新服安徽库尔德丽兰新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
                    </ul>
                </div>
                <div class="s-information s-exam">
                    <div class="s-title-wrapper clearfix">
                        <span class="s-title pull-left"><i class="s-logo fa fa-leaf"></i>高分经验</span>
                        <a class="s-more pull-right" href="#"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <ul>
                        <li>
                            <a class="s-article-img" href="#">
                                <img src="/cn/images/sat-article03.png" alt="">
                            </a>
                            <div class="s-article-title">
                                <h3><a href="#"><?php echo $info3[0]['title']?></a></h3>
                                <p><?php echo $info3[0]['summary']?></p>
                            </div>
                        </li>
                        <?php foreach($info3 as $k=>$v){if($k>=1){?>
                            <li class="s-more-title">
                                <a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                            </li>
                        <?php }}?>
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰新西兰纳新新服安徽库尔德丽兰新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
<!--                        <li class="s-more-title">-->
<!--                            <a href="#">新西兰纳新新服安徽库尔德丽兰</a>-->
<!--                        </li>-->
                    </ul>
                </div>
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
                        <?php foreach($teachers as $v){?>
                        <li>
                            <img src="<?php echo $v['pic']?>" alt="">
                            <div>
                                <h2><?php echo $v['name']?></h2>
                                <h4>主讲：<?php echo $v['subject']?></h4>
                                <p><?php echo $v['introduction']?></p>
                            </div>
                            <a href="#">立即预约</a>
                        </li>
                        <?php }?>
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
