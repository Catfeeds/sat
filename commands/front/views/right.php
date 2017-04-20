<div class="contentRight">
    <?php
        if($type ==2) {
            ?>
            <div class="searchDiv">
                <input type="text" value="热门搜索美国留学" onfocus="this.value=''" onblur="shiqu(this)"/>

                <div>
                    <span></span>
                    <img src="/cn/images/frame_serachIcon.png" alt="搜索小图标"/>
                </div>
            </div>
        <?php
        }
    ?>
    <?php
    if($type != 1) {
        ?>
        <img src="/cn/images/quesAnswer_special.jpg" alt="右边顶部图"/>
    <?php
    }
    ?>
    <div class="dissRight conR-eiji">
        <div class="newActive newActive-erji">
            <b>最新活动</b>
        </div>
        <div class="calendar">
            <div class="calendarHd calendarHd-erji">
                <ul>
                    <li><?php echo date('Y年m月')?></li>
                </ul>
                <a href="javascript:;" class="prev"><i class="fa fa-caret-left"></i></a>
                <a href="javascript:;" class="next"><i class="fa fa-caret-right "></i></a>
            </div>
            <div style="clear: both"></div>
            <div class="calendarBd">
                <?php
                $week = date("N",strtotime(date("Y-m-01")));
                    ?>
                    <ul class="calUl01">
                        <li>
                            <ul>
                                <li>Sun.</li>
                                <li>Mon.</li>
                                <li>Tues.</li>
                                <li>Wed.</li>
                                <li>Thur.</li>
                                <li>Fri.</li>
                                <li>Sat.</li>
                                <?php
                                    for($a=1;$a<=$week;$a++) {
                                        ?>
                                        <li></li>
                                    <?php
                                    }
                                ?>
                                <?php
                                $StartMonth   = date("Y-m-01"); //开始日期
                                $EndMonth     = date("Y-m-d",strtotime("$StartMonth +1 month -1 day")); //结束日期
                                $ToStartMonth = strtotime( $StartMonth ); //转换一下
                                $ToEndMonth   = strtotime( $EndMonth ); //一样转换一下
                                $i            = false; //开始标示
                                while( $ToStartMonth < $ToEndMonth ) {
                                $NewMonth = !$i ? date('Y-m-d', strtotime('+0 Month', $ToStartMonth)) : date('Y-m-d', strtotime('+1 day', $ToStartMonth));
                                $ToStartMonth = strtotime($NewMonth);
                                $i = true;
                                ?>
                                <li>
                                    <?php
                                    if (in_array($NewMonth, $activityDate)){
                                    ?>
                                    <a href="/public-class/<?php echo $activity[$NewMonth]['id']?>.html" class="on on-erji"><?php echo date("d", strtotime($NewMonth)) ?></a>

                                    <div class="classOn classOn-erji">
                                        <?php echo $activity[$NewMonth]['name']?>
                                    </div>
                                    <?php
                                    }else {
                                        ?>
                                        <?php echo date("d", strtotime($NewMonth)) ?>
                                    <?php
                                    }
                                    ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                <?php
                $StartMonth   = date("Y-m-01");
                $week = date("N",strtotime(date("Y-m-01",strtotime("$StartMonth +1 month"))));
                ?>
                <ul class="calUl02">
                    <li>
                        <ul>
                            <li>Sun.</li>
                            <li>Mon.</li>
                            <li>Tues.</li>
                            <li>Wed.</li>
                            <li>Thur.</li>
                            <li>Fri.</li>
                            <li>Sat.</li>
                            <?php
                            for($a=1;$a<=$week;$a++) {
                                ?>
                                <li></li>
                            <?php
                            }
                            ?>
                            <?php
                            $StartMonth   = date("Y-m-01",strtotime("$StartMonth +1 month")); //开始日期
                            $EndMonth     = date("Y-m-d",strtotime("$StartMonth +1 month -1 day")); //结束日期
                            $ToStartMonth = strtotime( $StartMonth ); //转换一下
                            $ToEndMonth   = strtotime( $EndMonth ); //一样转换一下
                            $i            = false; //开始标示
                            while( $ToStartMonth < $ToEndMonth ) {
                                $NewMonth = !$i ? date('Y-m-d', strtotime('+0 Month', $ToStartMonth)) : date('Y-m-d', strtotime('+1 day', $ToStartMonth));
                                $ToStartMonth = strtotime($NewMonth);
                                $i = true;
                                ?>
                                <li>
                                    <?php
                                    if (in_array($NewMonth, $activityDate)){
                                        ?>
                                        <a href="/public-class/<?php echo $activity[$NewMonth]['id']?>.html" class="on on-erji"><?php echo date("d", strtotime($NewMonth)) ?></a>

                                        <div class="classOn classOn-erji">
                                            <?php echo $activity[$NewMonth]['name']?>
                                        </div>
                                    <?php
                                    }else {
                                        ?>
                                        <?php echo date("d", strtotime($NewMonth)) ?>
                                    <?php
                                    }
                                    ?>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(".calendar").slide({titleCell:".calendarHd ul",mainCell:".calendarBd",trigger:"click",autoPage:"autoPage"});
        </script>
    </div>
    <div style="clear: both"></div>
    <?php
    if($type != 1) {
        ?>
        <div class="speech">
            <div class="speechHd hd">
                <ul>
                    <li>留学感言</li>
                    <li>培训感言</li>
                </ul>
            </div>
            <div class="speechBd">
                <ul>
                    <?php
                    if (isset($studyInSpeech[0])) {
                        ?>
                        <li>
                            <div class="speechBd-left">
                                <img src="<?php echo $studyInSpeech[0]['smallPhoto'] ?>" alt="介绍图"/>
                            </div>
                            <div class="speechBd-right">
                                <span>"<?php echo $studyInSpeech[0]['title'] ?>"</span>

                                <!--<p>
                                    <?php //echo $studyInSpeech[0]['abstract'] ?>
                                </p>-->
                            </div>
                            <div style="clear: both"></div>
                            <div>
                                <ul>
                                    <?php
                                    foreach ($studyInSpeech as $k => $v) {
                                        if ($k == 0) {
                                            continue;
                                        }
                                        ?>
                                        <li><img src="/cn/images/quesAnswer_dianIcon.png" alt="点图标"/><a
                                                href="/word-details/<?php echo $v['id'] ?>/<?php echo $v['catId'] ?>.html"><?php echo $v['title'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <ul>
                    <?php
                    if (isset($trainingSpeech[0])) {
                        ?>
                        <li>
                            <div class="speechBd-left">
                                <img src="<?php echo $trainingSpeech[0]['smallPhoto'] ?>" alt="介绍图"/>
                            </div>
                            <div class="speechBd-right">
                                <span>"<?php echo $trainingSpeech[0]['title'] ?>"</span>

                                <!--<p>
                                    <?php //echo $trainingSpeech[0]['abstract'] ?>
                                </p>-->
                            </div>
                            <div style="clear: both"></div>
                            <div>
                                <ul>
                                    <?php
                                    foreach ($trainingSpeech as $k => $v) {
                                        if ($k == 0) {
                                            continue;
                                        }
                                        ?>
                                        <li><img src="/cn/images/quesAnswer_dianIcon.png" alt="点图标"/><a
                                                href="/word-details/<?php echo $v['id'] ?>/<?php echo $v['catId'] ?>.html"><?php echo $v['title'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(".speech").slide({mainCell: ".speechBd", trigger: "mouseover"});
        </script>
    <?php
    }
    ?>
    <div class="microblog"><h1>微博</h1></div>
    <div class="attention">
        <iframe width="100%" height="290" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=2&ptype=0&speed=300&skin=1&isTitle=1&noborder=0&isWeibo=1&isFans=0&uid=2592925901&verifier=782d4b01&dpc=1"></iframe>
    </div>
    <div class="fourBtn">
        <ul>
            <li class="liBG01">
                <a href="/evaluation.html" target="_blank">
                    <b></b>
                    <img src="/cn/images/quesAnswer_smallIcon01.png" alt="小图标"/>
                    <span>留学评估</span>
                </a>
            </li>
            <li class="liBG02"><a href="http://www.gmatonline.cn/" target="_blank">
                <b></b>
                <img src="/cn/images/quesAnswer_smallIcon02.png" alt="小图标"/>
                <span>GMAT测试</span>
                </a>
            </li>
            <li class="liBG03">
                <b></b>
                <img src="/cn/images/quesAnswer_smallIcon03.png" alt="小图标"/>
                <span>留学社区</span>
            </li>
            <li class="liBG04">
                <a href="/question.html">
                <b></b>
                <img src="/cn/images/quesAnswer_smallIcon04.png" alt="小图标"/>
                <span>留学问答</span>
                </a>
            </li>
        </ul>
    </div>
    <?php
    if($type != 1) {
        ?>
        <img src="/cn/images/quesAnswer_phone02.png" alt="联系电话"/>
    <?php
    }
    ?>
</div>
<script type="text/javascript">
    moth(".calUl02",".calendarHd ul li",'<?php echo date("Y年m月")?>','<?php $firstday=date("Y-m"); echo date("Y年m月",strtotime("$firstday +1 month"))?>');
    moth(".evecalUl02",".everyCahd ul li",'<?php echo date("Y年m月")?>','<?php $firstday=date("Y-m"); echo date("Y年m月",strtotime("$firstday +1 month"))?>');
</script>