
    <link rel="stylesheet" href="/cn/css/mock-details.css">
    <script src="/cn/js/mock-details.js"></script>

<div class="work-mk">
    <!-- 头部-->
    <div class="work-mk-top container">
        <div class="work-top-cnt row">
            <p class="work-title-pos col-lg-3 col-md-3"></p>
            <h1 class="work-main-title col-lg-6 col-md-6">Master the new SAT 6<i>--</i><span class="work-subhead">SAT <?php echo $data['major']?> Section<?php echo $data['section']?></span></h1>
            <p class="work-collect col-lg-3 col-md-3" data-value=""><i class="fa fa-star-o">&nbsp;</i>收藏</p>
        </div>
    </div>
    <!-- 内容区域-->
    <div class="work-mk-cnt clearfix">
        <div class="work-wrap-left pull-left">
            <h3><?php echo $data['topic']?></h3>
            <h5><?php echo $data['details']?></h5>
            <div class="work-box">
                <div class="read-text">
                    <p>
                      <?php echo $data['essay']?>
                    </p>
                </div>
            </div>
        </div>
        <div class="work-wrap-right pull-right">
            <div class="work-question" id="1">
                <div class="work-question-part clearfix">
                    <h3><?php echo $data['number']?>.<?php echo $data['content']?></h3>
                    <ul class="work-que-list" id="subjectId" data-id="2358636904440836">
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
                <span class="work-time-cnt"></span>
            </div>
            <div class="work-sec-process col-lg-4 col-md-4">
                本section进度:<span>3</span>/<span>55</span>
            </div>
            <div class="work-all-process col-lg-2 col-md-2">
                做题总进度:<span>30</span>/<span>155</span>
            </div>
            <div class="work-btm-next col-lg-2 col-md-2">
                <a href="#">
                    <i class="work-next-icon fa fa-hand-o-right"></i>NEXT</a>
            </div>
        </div>
    </div>
    <!--遮罩层-->
    <div class="work-shade">
        <!--注意事项弹窗-->
        <div class="notice-wrap">
            <div class="notice-cnt">
                <h1>测评注意事项</h1>
                <div class="s-wrap">
                    <div class="s-tag">
                        <div class="s-line"></div>
                        <h3>01</h3>
                        <p>测评内容</p>
                    </div>
                    <div class="s-list">
                        <ul>
                            <li>阅读部分: 共52题,65分钟</li>
                            <li>文法部分: 共44题,35分钟</li>
                            <li>数学部分: 共58题,80分钟;其中20道题无计算器,25分钟;38道题可使用计算器,55分钟</li>
                            <li>测试题共计154题,阅读+文法=200~800分,数学=200~800分,限时180分钟</li>
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
            <div class="notice-next clearfix">
                <button class="work-out pull-left">离开</button>
                <button class="notice-next-start pull-right">开始做题</button>
            </div>
        </div>
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
                <span class="shade-out pull-left">我就是不做</span>
                <span class="shade-in pull-right">这么简单,我来答</span>
            </div>
        </div>
        <!--自动提交弹窗-->
        <div class="auto-wrap shade-wrap">
            <h3>答题时间到,点击确定进入到下一小节</h3>
            <div class="shade-select">
                <span class="make-sure shade-in">确定</span>
            </div>
        </div>
    </div>
    <!--隐藏数据-->
    <div class="worl-btm-hidden">
        <!--试卷ID-->
        <input type="hidden" id="testId" value="<?php echo $data['tpId']?>">
        <!-- 正确答案-->
        <input type="hidden" id="correctAns" value="<?php echo $data['answer']?>">
        <!-- 科目-->
        <input type="hidden" id="subject" value="<?php echo $data['major']?>">
        <!--题目类型-->
        <input type="hidden" id="classify" value="jhi">
        <!--本section总时间-->
        <input type="hidden" id="sectionTime" value="1">
        <!--本section总题目-->
        <input type="hidden" id="sectionAllNum" value="67">
        <!--本section当前题目-->
        <input type="hidden" id="sectionNum" value="20">
        <!--模考总题目数-->
        <input type="hidden" id="mkAllNum" value="155">
        <!--当前模考题目号-->
        <input type="hidden" id="mkNum" value="55">
    </div>
</div>
