
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
                <ul class="s-detail">
                    <li class="s-img"><img src="/cn/images/sat-course01.png" alt=""></li>
                    <li class="s-font">
                        <h2><?php echo isset($classes[0]['cate'])?$classes[0]['cate']:''?></h2>
                        <div class="s-font-cnt"><?php echo isset($classes[0]['introduction'])?$classes[0]['introduction']:''?></div>
                        <a href="/class_details/<?php echo isset($classes[0]['id'])?$classes[0]['id']:''?>.html">查看更多</a>
                    </li>
                    <li class="s-img"><img src="/cn/images/sat-course02.png" alt=""></li>
                </ul>
                <ul class="s-detail">
                    <li class="s-font">
                        <h2><?php echo isset($classes[1]['cate'])?$classes[1]['cate']:''?></h2>
                        <div class="s-font-cnt"><?php echo isset($classes[1]['introduction'])?$classes[1]['introduction']:''?></div>
                        <a href="/class_details/<?php echo isset($classes[1]['id'])?$classes[1]['id']:''?>.html">查看更多</a>
                    </li>
                    <li class="s-img"><img src="/cn/images/sat-course03.png" alt=""></li>
                    <li class="s-font">
                        <h2><?php echo isset($classes[2]['cate'])?$classes[2]['cate']:''?></h2>
                        <div class="s-font-cnt"><?php echo isset($classes[2]['introduction'])?$classes[2]['introduction']:''?></div>
                        <a href="/class_details/<?php echo isset($classes[2]['id'])?$classes[2]['id']:''?>.html">查看更多</a>
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
                        <span style="color: rgb(54,178,251);">rticle</span>
                        <span style="color: #000;font-weight: bold;">资讯</span>
                    </p>
                </div>
            </div>
            <div class="s-cnt clearfix">
                <div class="s-information s-news">
                    <div class="s-title-wrapper clearfix">
                        <span class="s-title pull-left"><i class="s-logo fa fa-lightbulb-o"></i>新闻资讯</span>
                        <a class="s-more pull-right" href="/info.html"><i class="fa fa-angle-right"></i></a>
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
                        <a class="s-more pull-right" href="/info.html"><i class="fa fa-angle-right"></i></a>
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
                        <a class="s-more pull-right" href="/info.html"><i class="fa fa-angle-right"></i></a>
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
                            <a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">立即预约</a>
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
