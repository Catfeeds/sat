
<link rel="stylesheet" href="/cn/css/mock-details.css">
<link rel="stylesheet" href="/cn/css/eval-subject.css">
<script src="/cn/js/eval-subject.js"></script>

<div class="work-mk">
  <!-- 头部-->
  <div class="work-mk-top container">
    <div class="work-top-cnt row">
      <p class="work-title-pos col-lg-2 col-md-2"></p>
      <h1 class="work-main-title col-lg-8 col-md-8"><strong><?php echo isset($data[0])&&$data[0]!=false?$data[0]['name'].$data[0]['time']:''?></strong><b> --</b>
        <span id="secNum" data-id="<?php echo isset($data[0])&&$data[0]!=false?$data[0]['tid']:''?>" data-sec="<?php echo isset($data[0])&&$data[0]!=false?$data[0]['section']:''?>">Section<?php echo isset($data[0])&&$data[0]!=false?$data[0]['section']:''?></span><b>:</b><span id="secName"><?php echo isset($data[0])&&$data[0]!=false?$data[0]['major']:''?></span>
      </h1>
    </div>
  </div>
  <!-- 内容区域-->
  <div class="work-mk-cnt clearfix">
    <!--  词汇-->
    <div class="work-wrap-left pull-left">
      <ul class="words-ul">
        <?php foreach($data as $k=>$v){if($k<5){?>
        <li class="work-question-part">
          <span class="num pull-left"><?php echo $v['number']?>.</span>
          <div class="question">
            <?php echo $v['content']?>
          </div>
          <ul class="work-que-list" data-pid="<?php echo $v['qid']?>">
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="A">A</div>
              <div class="work-que"><?php echo $v['keyA']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="B">B</div>
              <div class="work-que"><?php echo $v['keyB']?> </div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="C">C</div>
              <div class="work-que"><?php echo $v['keyC']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="D">D</div>
              <div class="work-que"><?php echo $v['keyD']?> </div>
            </li>
          </ul>
        </li>
        <?PHP }}?>
      </ul>
    </div>
    <div class="work-wrap-right pull-right" >
      <ul class="words-ul">
        <?php foreach($data as $k=>$v){if($k>4){?>
        <li class="work-question-part">
          <span class="num pull-left"><?php echo $v['number']?>.</span>
          <div class="question">
            <?php echo $v['content']?>
          </div>
          <ul class="work-que-list" data-pid="<?php echo $v['qid']?>">
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="A">A</div>
              <div class="work-que"><?php echo $v['keyA']?> </div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="B">B</div>
              <div class="work-que"><?php echo $v['keyB']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="C">C</div>
              <div class="work-que"><?php echo $v['keyC']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="D">D</div>
              <div class="work-que"><?php echo $v['keyD']?></div>
            </li>
          </ul>
        </li>
        <?PHP }}?>
      </ul>
    </div>
    <!-- 语法-->
<!--    <div class="work-wrap-left pull-left" style="display: none;">-->
<!--      <div class="grammer">-->
<!--        <div class="article">-->
<!--          I hunted for 30 years for various reasons, -->
<!--        </div>-->
<!--        <ul class="article-list">-->
<!--          <li>-->
<!--            <label>1.</label>-->
<!--            <input class="article-input" type="text">-->
<!--          </li>-->
<!--        </ul>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right" style="display: none;">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <span class="num pull-left">1.</span>-->
<!--          <div class="question">-->
<!--            Remember _______ the newspaper when you have finished it.-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">putting back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que"> put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">to put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">be put back </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
    <!--句子翻译-->
<!--    <div class="work-wrap-left pull-left" style="display: none;" >-->
<!--      <ul class="translate">-->
<!--        <li>-->
<!--          <span class="pull-left">1.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="12" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right" style="display: none;">-->
<!--      <ul class="translate">-->
<!--        <li>-->
<!--          <span class="pull-left">1.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="17" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
    <!--阅读理解-->
<!--    <div class="work-wrap-left pull-left">-->
<!--      <div class="work-box">-->
<!--        <div class="read-text">-->
<!--          A few commonrity on ms of their careers, the impact of physical attractiveness on males is only modest. But its potential impact on females can be tremendous, making it easier, for example, for the more attractive to get jobs where they are in the public eye. On another note, though, there is enough literature now for us to conclude that attractive women who aspire to managerial positions do not get on as well as women who may be less attractive.-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              Experiments by scientists attributes ________.-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
    <!--数学-->
<!--    <div class="work-wrap-left pull-left" style="display: none;">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right" style="display: none;">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
  </div>
  <!-- 底部-->
  <div class="work-mk-btm container">
    <div class="work-btm-cnt row">
      <div class="work-out col-lg-4 col-md-4">
        <i class="work-out-off fa fa-sign-out"></i>
        <span>离开</span>
      </div>
      <div class="work-time col-lg-4 col-md-4">
        <i class="work-time-icon icon-time"></i>
        <span class="work-time-cnt">测评剩余时间:</span>
        <span>1:54:33</span>
      </div>
      <div class="work-btm-next col-lg-4 col-md-4">
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
  </div>
</div>
