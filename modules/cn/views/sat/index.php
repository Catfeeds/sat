
    <link rel="stylesheet" href="/cn/css/sat.css">
    <script src="/cn/js/carousel.js"></script>
<section>
    <div class="s-sat s-w1200">
        <!--轮播图-->
        <div class="bnr-wrap clearfix s-banner">
            <?php use app\commands\front\BannerWidget;?>
            <?php BannerWidget::begin();?>
            <?php BannerWidget::end();?>
<!--            <div class="s-person clearfix">-->
<!--                <div class="s-person-logo border-radius pull-left"></div>-->
<!--                <div class="s-hi">-->
<!--                    <h3>hi</h3>-->
<!--                    <p>欢迎来到雷哥网</p>-->
<!--                </div>-->
<!--                --><?php //if($user){
//                    echo '<div class="s-btn">
//                    <button >欢迎您</button>
//                    <button onclick="Out()" >退出</button>
//                    </div>';
//                }else{
//                    echo '<div class="s-btn">
//                    <button class="s-login-in"><a  href="http://login.gmatonline.cn/cn/index?source=20&url=<?php echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?><!--">登录</a></button>
<!--//                     <button class="s-sign-up"><a class="s-sign-up" href="http://login.gmatonline.cn/cn/index/register?source=20&url=--><?php //echo Yii::$app->request->hostInfo.Yii::$app->request->getUrl()?><!--">注册</a></button>-->
<!--//                    </div>';-->
<!--//                }?>-->
<!--                <h3 class="s-adv">公告:</h3>-->
<!--                <div class="s-adv-wrap">-->
<!--                    <ul>-->
<!--                        --><?php //foreach($infoAd as $v){?>
<!--                        <li><a href="/info_details/--><?php //echo $v['id']?><!--.html">--><?php //echo $v['title']?><!--</a></li>-->
<!--                        --><?php //}?>
<!---->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <!--免费公开课-->
        <div class="s-pubclass">
            <div class="s-sat-title clearfix">
                <p class="pull-left">F</p>
                <div>
                    <p>
                        <span style="color: #000;font-weight: bold;">免费</span>
                        <span style="color: rgb(229,104,215)">courses</span>
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
                        <img src="<?php echo $v['pic']?>" alt="">
                        <a href="/info_details/<?php echo $v['id']?>.html">查看详情</a>
                        <div class="s-pubclass-info">
                            <p>主题：<?php echo $v['title']?></p>
                            <p>时间：<?php echo $v['activeTime']?></p>
                            <p>主讲人：<?php echo $v['name']?></p>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <!-- 答题系统-->
        <div class="s-system">
            <div class="s-w1200">
                <div class="s-sat-title clearfix">
                    <p class="pull-left">A</p>
                    <div>
                        <p>
                            <span style="color: #000;font-weight: bold;">答题</span>
                            <span style="color: rgb(229,104,215)">system</span>
                        </p>
                        <p>
                            <span style="color: rgb(54,178,251);">nswer</span>
                            <span style="color: #000;font-weight: bold;">系统</span>
                        </p>
                    </div>
                </div>
                <div class="s-system-cnt clearfix">
                    <ul class="system-list pull-left">
                        <li class="on">
                            <p>
                                模考<br>
                                MOCK
                            </p>
                        </li>
                        <li>
                            <p>
                                练习<br>
                                EXERCISE
                            </p>
                        </li>
                        <li>
                            <p>
                                知识库<br>
                                REPOSITORY
                            </p>
                        </li>
                    </ul>
                    <div class="system-wrap system-wrap1 clearfix">
                        <div>
                            <a href="/mock.html">全套模考</a>
                        </div>
                        <div><a href="/mock.html">单科模考</a></div>
                    </div>
                    <div class="system-wrap system-wrap2">
                        <div>
                            <a href="/exercise.html?m=Math">题目分类</a>
                        </div>
                        <div><a href="/exercise.html?m=Math">题目来源</a></div>
                    </div>
                    <div class="system-wrap system-wrap3">
                        <div>
                            <a href="/knowledge.html">表达</a>
                        </div>
                        <div><a href="/knowledge.html">语法</a></div>
                        <div><a href="/knowledge.html">数学</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!--SAT课程-->
        <div class="s-course">
            <div class="s-sat-title clearfix" style="width: 180px;">
                <p class="pull-left">SAT</p>
                <div style="margin-left: 80px;">
                    <p>
                        <span style="color: rgb(229,104,215)">courses</span>
                    </p>
                    <p>
                        <span style="color: #000;font-weight: bold;">精品课</span>
                    </p>
                </div>
            </div>
            <div class="s-cnt">
                <ul class="s-detail clearfix">
                    <?php foreach ($classes as $k=>$v){?>
                    <li>
                        <ol class="white-circle">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ol>
                        <div class="course-img">
                            <img src="/cn/images/sat-course0<?php echo $k+1?>.png" alt="">
                        </div>
                        <h2 class="course-title">SAT <?php echo $v['cate']?></h2>
                        <div class="course-text">
                            <?php echo $v['introduction']?>
                        </div>
                        <a class="course-more" href="/class_details/<?php echo $v['id']?>.html">查看更多</a>
                    </li>
                    <?php }?>
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
                        <span style="color: rgb(54,178,251);">rticle</span>
                        <span style="color: #000;font-weight: bold;">资讯</span>
                    </p>
                </div>
            </div>
            <div class="s-cnt clearfix">
                <div class="s-information s-news">
                    <div class="s-title-wrapper clearfix">
                        <span class="s-title pull-left"><i class="s-logo fa fa-lightbulb-o"></i>新闻资讯</span>
                        <a class="s-more pull-right" href="/info.html?c=n"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <ul>
                        <li class="clearfix">
                            <a class="s-article-img pull-left" href="#">
                                <img src="/cn/images/sat-article01.png" alt="">
                            </a>
                            <div class="s-article-title pull-right">
                                <h3><a href="/info_details/<?php echo isset($infoNews[0]['id'])?$infoNews[0]['id']:''?>.html"><?php echo isset($infoNews[0]['title'])?$infoNews[0]['title']:''?></a></h3>
                                <p><?php echo isset($infoNews[0]['summary'])?$infoNews[0]['summary']:''?></p>
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
                        <span class="s-title pull-left"><i class="s-logo fa fa-tasks"></i>学术报告</span>
                        <a class="s-more pull-right" href="/info.html?c=t"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <ul>
                        <li class="clearfix">
                            <a class="s-article-img pull-left" href="#">
                                <img src="/cn/images/sat-article02.png" alt="">
                            </a>
                            <div class="s-article-title pull-right">
                                <h3><a href="/info_details/<?php echo  isset($infoTest[0]['id'])?$infoTest[0]['id']:''?>.html"><?php echo isset($infoTest[0]['title'])?$infoTest[0]['title']:''?></a></h3>
                                <p><?php echo isset($infoTest[0]['summary'])? $infoTest[0]['summary']:''?></p>
                            </div>
                        </li>
                        <?php foreach($infoTest as $k=>$v){if($k>=1){?>
                            <li class="s-more-title">
                                <a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                            </li>
                        <?php }}?>
                    </ul>
                </div>
                <div class="s-information s-exam">
                    <div class="s-title-wrapper clearfix">
                        <span class="s-title pull-left"><i class="s-logo fa fa-leaf"></i>高分经验</span>
                        <a class="s-more pull-right" href="/info.html?c=s"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <ul>
                        <li class="clearfix">
                            <a class="s-article-img pull-left" href="#">
                                <img src="/cn/images/sat-article03.png" alt="">
                            </a>
                            <div class="s-article-title pull-right">
                                <h3><a href="<?php echo isset($info3[0]['id'])?'/info_details/'.$info3[0]['id'].'.html':''?>"><?php echo isset($info3[0]['title'])?$info3[0]['title']:''?></a></h3>
                                <p><?php echo isset($info3[0]['summary'])?$info3[0]['summary']:''?></p>
                            </div>
                        </li>
                        <?php foreach($info3 as $k=>$v){if($k>=1){?>
                            <li class="s-more-title">
                                <a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a>
                            </li>
                        <?php }}?>
                    </ul>
                </div>
            </div>
        </div>
        <!--每日一题-->
        <div class="s-daily">
            <div class="s-w1200">
                <div class="s-sat-title clearfix">
                    <p class="pull-left">D</p>
                    <div>
                        <p>
                            <span style="color: #000;font-weight: bold;">每日</span>
                            <span style="color: rgb(229,104,215)">question</span>
                        </p>
                        <p>
                            <span style="color: rgb(54,178,251);">aily</span>
                            <span style="color: #000;font-weight: bold;">一题</span>
                        </p>
                    </div>
                </div>
                <div class="s-daily-cnt clearfix">
                    <div class="s-daily-title clearfix">
                        <a class="pull-right" href="/exercise.html?m=Math"><h3>MORE<i class="fa fa-angle-right"></i></h3></a>
                    </div>
                    <div class="daily-question daily-question1">
                        <ul>
                            <?php foreach($que as $k=>$v){if($k<10){?>
                                <li>
                                    <h4><?php echo $v['name'].'-'.$v['time']?></h4>
                                    <p><a href="/exercise_details/<?php echo $v['qid']?>.html"><?php echo $v['content']?></a></p>
                                </li>
                            <?php }}?>
                        </ul>
                    </div>
                    <div class="daily-question daily-question2">
                        <ul>
                            <?php foreach($que as $k=>$v){if($k>=10){?>
                                <li>
                                    <h4><?php echo $v['name'].'-'.$v['time']?></h4>
                                    <p><a href="/exercise_details/<?php echo $v['qid']?>.html"><?php echo $v['content']?></a></p>
                                </li>
                            <?php }}?>
                        </ul>
                    </div>
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
                        <li class="s-teacher-list">
                            <img src="<?php echo $v['pic']?>" alt="">
                            <div class="s-teacher-text">
                                <h2><?php echo $v['name']?></h2>
                                <h4>主讲：<?php echo $v['subject']?></h4>
                                <p><?php echo $v['introduction']?></p>
                            </div>
                            <a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=" target="_blank">立即预约</a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--底部-->
<script>
    //   高分榜
    jQuery(".s-person").slide({mainCell:".s-adv-wrap ul",autoPlay:true,effect:"topMarquee",vis:5,interTime:100});
    //  名师团队
    jQuery('.s-teacher-cnt').slide({mainCell:".s-teacher-int", effect:"leftLoop",vis:4, autoPlay:false});
    // 每日一题
    jQuery(".s-daily-cnt").slide({mainCell:".daily-question1 ul",autoPlay:true,effect:"topMarquee",vis:5,interTime:50});
    jQuery(".s-daily-cnt").slide({mainCell:".daily-question2 ul",autoPlay:true,effect:"topMarquee",vis:5,interTime:50});

    $(function () {
        $('.system-list>li').click(function () {
            var index = $(this).index();
            $('.system-list>li').removeClass('on');
            $(this).addClass('on');
            $('.system-wrap').hide();
            $('.system-wrap').eq(index).show();
        })
    })
</script>
