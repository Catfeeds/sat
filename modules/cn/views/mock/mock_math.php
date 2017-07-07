
    <link rel="stylesheet" href="/cn/css/mock-details.css">
    <script src="/cn/js/mock-details.js"></script>

<div class="work-mk">
    <!-- 头部-->
    <div class="work-mk-top container">
        <div class="work-top-cnt row">
            <p class="work-title-pos col-lg-3 col-md-3">第(1/5)题</p>
            <h1 class="work-main-title col-lg-6 col-md-6">Master the new SAT 6<i>--</i><span class="work-subhead">SAT <?php echo substr($data['major'],0,4)?> Section<?php echo $data['section']?></span></h1>
            <p class="work-collect col-lg-3 col-md-3"><i class="fa fa-star-o">&nbsp;</i>收藏</p>
        </div>
    </div>
    <!--数学-->
    <div class="work-mk-cnt <?php echo $data['isFilling']=="1"?'work-math-gap':'work-mk-math'?>">
    <div class="work-question-part">
    <h3><?php echo $data['number']?> . <?php echo $data['content']?></h3>
        <?php
        if($data['isFilling']==='0'){
            $ul='<ul class="work-que-list" id="subjectId" data-id="'.$data['qid'].'">
            <li class="work-que-wrap clearfix">
                <div class="work-select" data-id="A">A</div>
                <div class="work-que">'. $data['keyA'].'</div>
            </li>
            <li class="work-que-wrap clearfix">
                <div class="work-select" data-id="B">B</div>
                <div class="work-que">'. $data['keyB'].'</div>
            </li>
            <li class="work-que-wrap clearfix">
                <div class="work-select" data-id="C">C</div>
                <div class="work-que">'. $data['keyC'].'</div>
            </li>
            <li class="work-que-wrap clearfix">
                <div class="work-select" data-id="D">D</div>
                <div class="work-que">'. $data['keyD'].'</div>
            </li>
        </ul>';
            echo $ul;
        }
       if($data['isFilling']==='1'){
        $str='
        <table class="math-gap-table" border="1" align="center">
            <tr>
                <td class="math-gap-result" colspan="4"><input type="text"></td>
            </tr>
            <tr>
                <td class="math-btn">7</td>
                <td class="math-btn">8</td>
                <td class="math-btn">9</td>
                <td class="math-sure" rowspan="2">确定</td>
            </tr>
            <tr>
                <td class="math-btn">4</td>
                <td class="math-btn">5</td>
                <td class="math-btn">6</td>
            </tr>
            <tr>
                <td class="math-btn">1</td>
                <td class="math-btn">2</td>
                <td class="math-btn">3</td>
                <td class="math-clear" rowspan="2">清空</td>
            </tr>
            <tr>
                <td class="math-btn">0</td>
                <td class="math-btn">.</td>
                <td class="math-btn">/</td>
            </tr>
        </table>';
        echo $str;
       }
        ?>
      </div>
    </div>

    <div class="work-mk-btm container">
        <div class="work-btm-cnt row">
            <div class="work-out col-lg-1 col-md-1">
                <i class="work-out-off icon-off"></i>
                <span>离开</span>
            </div>
            <div class="work-time col-lg-3 col-md-3">
                <i class="work-time-icon icon-time"></i>
                <span class="work-time-cnt"></span>
            </div>
            <div class="work-sec-process col-lg-4 col-md-4">
                本section进度:<span>3</span>/<span><?php echo $amount?></span>
            </div>
            <div class="work-all-process col-lg-3 col-md-3">
                做题总进度:<span><?php echo $count?></span>/<span>155</span>
            </div>
            <div class="work-btm-next col-lg-1 col-md-1">
                <a href="#">
                    <i class="work-next-icon icon-caret-right"></i>NEXT</a>
            </div>
        </div>
    </div>
    <!--遮罩层-->
    <div class="work-shade">
        <!--离开弹窗-->
        <div class="quit-wrap shade-wrap">
            <h3>小主,你忍心弃我而去吗?</h3>
            <div class="shade-select clearfix">
                <span class="shade-out pull-left">忍心而去</span>
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
            <input type="hidden" id="classify" value="<?php echo $data['subScores']?>">
            <!-- 小节-->
            <input type="hidden" id="section" value="<?php echo $data['section']?>">
            <!--题目号-->
            <input type="hidden" id="number" value="<?php echo $data['number']?>">
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
</div>
