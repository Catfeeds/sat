<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>模考-测评详情页</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/eval-details.css">

    <script src="../js/jquery-2.1.3.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.SuperSlide.2.1.js"></script>
    <script src="../js/eval-details.js"></script>
</head>
<body>
<div class="work-mk">
    <div class="work-mk-top container">
        <div class="work-top-cnt row">
            <p class="work-title-pos col-lg-3 col-md-3">第(1/5)题</p>
            <h1 class="work-main-title col-lg-6 col-md-6">Master the new SAT 6<i>--</i><span class="work-subhead">SAT Reading Section1</span></h1>
            <p class="work-collect col-lg-3 col-md-3"><i class="icon-star-empty">&nbsp;</i>收藏</p>
        </div>
    </div>
    <!--数学-->
    <!--<div class="work-mk-cnt work-mk-math">-->
    <!--<div class="work-question-part">-->
    <!--<h3>1.Over the course of the passage, the narrator’s attitude shifts from</h3>-->
    <!--<ul class="work-que-list" data-id="2358636904440836">-->
    <!--<li class="work-que-wrap clearfix">-->
    <!--<div class="work-select" data-id="A">A</div>-->
    <!--<div class="work-que">describe a boy's reactions to his irresponsible parents. </div>-->
    <!--</li>-->
    <!--<li class="work-que-wrap clearfix">-->
    <!--<div class="work-select" data-id="B">B</div>-->
    <!--<div class="work-que">describe a boy's reactions to his irresponsible parents. describe a boy's reactions to his irresponsible parents.</div>-->
    <!--</li>-->
    <!--<li class="work-que-wrap clearfix">-->
    <!--<div class="work-select" data-id="C">C</div>-->
    <!--<div class="work-que">describe a boy's reactions to his irresponsible parents. </div>-->
    <!--</li>-->
    <!--<li class="work-que-wrap clearfix">-->
    <!--<div class="work-select" data-id="D">D</div>-->
    <!--<div class="work-que">describe a boy's reactions to his irresponsible parents. </div>-->
    <!--</li>-->
    <!--</ul>-->
    <!--</div>-->
    <!--</div>-->

    <!--数学填空-->
    <!--<div class="work-mk-cnt work-math-gap">
      <div class="work-question-part">
        <h3>1.Over the course of the passage, the narrator’s attitude shifts from</h3>
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
        </table>
      </div>
    </div>-->

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
                本section进度:<span>3</span>/<span>55</span>
            </div>
            <div class="work-all-process col-lg-3 col-md-3">
                做题总进度:<span>30</span>/<span>155</span>
            </div>
            <div class="work-btm-next col-lg-1 col-md-1">
                <a href="#">
                    <i class="work-next-icon icon-caret-right"></i>NEXT</a>
            </div>
        </div>
    </div>
    <!--遮罩层-->
    <div class="work-shade">
        <div class="quit-wrap shade-wrap">
            <h3>小主,你忍心弃我而去吗?</h3>
            <div class="shade-select clearfix">
                <span class="exit-out shade-out pull-left">忍心而去</span>
                <span class="shade-in pull-right">逗你玩呢!</span>
            </div>
        </div>
        <div class="next-wrap shade-wrap">
            <h3>答案都木有</h3>
            <h4>(根据SAT考试规定,按照答对题目数得分)</h4>
            <div class="shade-select clearfix">
                <span class="shade-out pull-left">我就是不做</span>
                <span class="shade-in pull-right">这么简单,我来答</span>
            </div>
        </div>
        <div class="auto-wrap shade-wrap">
            <h3>答题时间到,点击确定进入到下一小节</h3>
            <div class="shade-select">
                <span class="make-sure shade-in">确定</span>
            </div>
        </div>
    </div>
    <!--隐藏数据-->
    <div class="worl-btm-hidden">
        <!--本section总时间-->
        <input type="hidden" id="sectionTime" value="1">
        <!--本section总题目-->
        <input type="hidden" id="sectionNum" value="67">
    </div>
</div>
</body>
</html>