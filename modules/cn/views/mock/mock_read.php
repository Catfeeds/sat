
    <link rel="stylesheet" href="/cn/css/mock-details.css">
    <script src="/cn/js/mock-details.js"></script>

<div class="work-mk">
    <!-- 头部-->
    <div class="work-mk-top container">
        <div class="work-top-cnt row">
            <p class="work-title-pos col-lg-2 col-md-2"></p>
            <h1 class="work-main-title col-lg-8 col-md-8">Master the new SAT<i>  </i><span class="work-subhead"> <?php echo $data['name'].'-'.$data['time']?> <span id="subName"><?php echo $data['major']?></span> Section <?php echo $data['section']?></span></h1>
            <p class="work-collect col-lg-2 col-md-2" data-value=""><i class="fa fa-star-o">&nbsp;</i>收藏</p>
        </div>
    </div>
    <!-- 内容区域-->
    <div class="work-mk-cnt clearfix">
        <div class="work-wrap-left pull-left">
            <h3><?php echo $data['topic']?></h3>
            <h5><?php echo $data['details']?></h5>
            <div class="work-box">
                <div class="pull-left text-line">
<!--                    <br>-->
<!--                    <br>-->
<!--                    <br>-->
<!--                    <br>-->
<!--                    <p>5</p>-->
                </div>
                <div class="read-text">
                    <?php echo $data['essay']?>
                </div>
            </div>
        </div>
        <div class="work-wrap-right pull-right">
            <div class="work-question" id="1">
                <div class="work-question-part clearfix">
                    <div class="clearfix">
                        <h1 class="pull-left"><?php echo $data['number']?>.</h1>
                        <?php echo $data['content']?>
                    </div>
                    <ul class="work-que-list common-id" id="subjectId" data-id="<?php echo $data['qid']?>">
                        <li class="work-que-wrap clearfix">
                            <div class="work-select" data-id="A">A</div>
                            <div class="work-que"><?php echo $data['keyA']?> </div>
                        </li>
                        <li class="work-que-wrap clearfix">
                            <div class="work-select" data-id="B">B</div>
                            <div class="work-que"><?php echo $data['keyB']?> </div>
                        </li>
                        <li class="work-que-wrap clearfix">
                            <div class="work-select" data-id="C">C</div>
                            <div class="work-que"><?php echo $data['keyC']?> </div>
                        </li>
                        <li class="work-que-wrap clearfix">
                            <div class="work-select" data-id="D">D</div>
                            <div class="work-que"><?php echo $data['keyD']?> </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="work-warn">
            <h3>友情提示：</h3>
            <p>右方向键(->)也可以进入下一题哦！</p>
        </div>
    </div>
    <!-- 底部-->
    <div class="work-mk-btm container">
        <div class="work-btm-cnt row">
            <div class="work-out col-lg-1 col-md-1">
                <i class="work-out-off fa fa-sign-out"></i>
                <span>离开</span>
            </div>
            <div class="work-time col-lg-3 col-md-3">
                <i class="work-time-icon icon-time"></i>
                <span class="work-time-cnt">本section剩余时间:</span>
            </div>
            <div class="work-sec-process col-lg-4 col-md-4">
                本section进度:<span class="sec-position">0</span>/<span class="sec-all-num"><?php echo $amount?></span>
            </div>
            <div class="work-all-process col-lg-2 col-md-2">
                做题总进度:<span class="all-position">0</span>/<span class="all-num"><?php
                    if(strpos($_SERVER["QUERY_STRING"],'Math')){echo 58;}
                    if(strpos($_SERVER["QUERY_STRING"],'Reading')){echo 52;}
                    if(strpos($_SERVER["QUERY_STRING"],'Writing')){echo 44;}
                    if(strpos($_SERVER["QUERY_STRING"],'m')===false){echo 154;}?></span>
            </div>
            <div class="work-btm-next col-lg-2 col-md-2">
                <a href="#" class='work-next-icon'><i class="fa fa-hand-o-right"></i>NEXT</a>
                <a href='#' class="work-submit"><i class="work-submit fa fa-upload"></i>提交</a>
            </div>
        </div>
    </div>
    <!--遮罩层-->
    <div class="work-shade">
        <!--离开弹窗-->
        <div class="quit-wrap shade-wrap">
            <h3>小主,你忍心弃我而去吗?</h3>
            <div class="shade-select clearfix">
                <span class="exit-out shade-out pull-left">忍心而去</span>
                <span class="shade-in pull-right">逗你玩呢!</span>
            </div>
        </div>
        <!--选择答案弹窗-->
        <div class="next-wrap shade-wrap">
            <h3>答案都木有</h3>
            <h4>(根据SAT考试规定,按照答对题目数得分)</h4>
            <div class="shade-select clearfix">
                <span class="do-next shade-out pull-left">我就是不做</span>
                <span class="shade-in pull-right">这么简单,我来答</span>
            </div>
        </div>
        <!--自动提交弹窗-->
        <div class="auto-wrap shade-wrap">
            <h3>答题时间到,将在5秒后自动提交</h3>
            <h4>点击确定按钮提交</h4>
            <div class="shade-select">
                <p class="auto-time">5</p>
                <span class="make-sure shade-in">确定</span>
            </div>
        </div>
        <!-- 休息弹窗-->
        <div class="relax-wrap shade-wrap">
            <h3>根据规定，您将有五分钟休息时间，休息时间到自动进入到下一小节</h3>
            <h4>(当然您可以点击继续按钮进入到下一小节)</h4>
            <div class="shade-select clearfix">
                <span class="skip-relax shade-in pull-left">继续</span>
                <p class="five-count">
                    <i class="fa fa-hourglass-start"></i>
                    <span>05:00</span>
                </p>
            </div>
        </div>
    </div>
    <!--隐藏数据-->
    <div class="worl-btm-hidden">
        <!--试卷ID-->
        <input type="hidden" id="testId" value="<?php echo $data['tpId']?>">
        <!-- 科目-->
        <input type="hidden" id="subject" value="<?php echo $data['major']?>">
        <!-- 小节-->
        <input type="hidden" id="section" value="<?php echo $data['section']?>">
        <!--题目类型-->
        <input type="hidden" id="classify" value="<?php echo $data['subScores']?>">
        <!--题目号-->
        <input type="hidden" id="number" value="<?php echo $data['number']?>">
        <!--本section总时间-->
        <input type="hidden" id="sectionTime" value="<?php echo $time?>">
        <!--本section当前题目-->
<!--        <input type="hidden" id="sectionNum" value="20">-->
        <!--模考总题目数-->
<!--        <input type="hidden" id="mkAllNum" value="155">-->
        <!--当前模考题目号-->
<!--        <input type="hidden" id="mkNum" value="55">-->
    </div>
</div>
