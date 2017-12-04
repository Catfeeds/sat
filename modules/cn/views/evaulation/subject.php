
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
        <li data-pid="<?php echo $v['qid']?>">
          <span class="num pull-left"><?php echo $v['number']?>.</span>
          <div class="question">
            <?php echo $v['content']?>
          </div>
          <input class='article-input work-question-input' type='text'>
        </li>
        <?PHP }}?>
      </ul>
    </div>
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
