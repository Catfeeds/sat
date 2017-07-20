<link rel="stylesheet" href="/cn/css/person.css">
<script src="/cn/js/person.js"></script>
<section class="s-w1200 s-information">
  <div class="person-wrap clearfix">
    <div class="person-side pull-left">
      <ul>
        <li class="person-title">
          <div class="person-name">
            <img src="/cn/images/login.png" alt="头像">
            <p>
              <span>lallal</span>
              <span>(初出茅庐)</span>
            </p>
          </div>
          <ul>
            <li>做题数:<span>34</span></li>
            <li>正确率:<span>23%</span></li>
          </ul>
        </li>
        <li>
          <a href="/person_collect.html">
            <i class="fa fa-bookmark"></i>收藏题目
          </a>
        </li>
        <li class="on">
          <i class="fa fa-clipboard"></i>模考记录
        </li>
        <li>
          <a href="/person_exercise.html">
            <i class="fa fa-file-text-o"></i>做题记录
          </a>
        </li>
      </ul>
    </div>
    <div class="person-cnt pull-left">
      <dl class="per-src">
        <dt>题目来源</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="og">OG2017</dd>
        <dd data-val="pr">princeton2016</dd>
        <dd data-val="ka">kaplan2017</dd>
        <dd data-val="ba">barron2017</dd>
      </dl>
      <dl class="per-classify">
        <dt>科目分类</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="read">Reading</dd>
        <dd data-val="write">Writing</dd>
        <dd data-val="math1">Math1</dd>
        <dd data-val="math2">Math2</dd>
      </dl>
      <dl class="per-type">
        <dt>模考类型</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="whole">全套模考</dd>
        <dd data-val="read">Reading</dd>
        <dd data-val="write">Writing</dd>
        <dd data-val="math">Math</dd>
      </dl>
      <ul class="person-mock">
        <?php foreach($arr as $k=>$v){?>
        <li class="clearfix">
          <div class="mock-look pull-right">
            <a href="mock_details?<?php if($v['part']=='all'){echo "tid=".$v['tpId'];}else{echo "m=".$v['part']."&"."tid=".$v['tpId'];}?>" class="mock-again">重新模考</a>
            <a href="report/<?php echo $v['id']?>.html" class="mock-record">查看报告</a>
          </div>
          <h3><i class="mock-delete fa fa-trash"></i><?php echo $v['name'].$v['time']?></h3>
          <div class="mock-details">
            <p>耗时：<span><?php echo sprintf("%.2f",($v['rtime']/60))?>min</span></p>
            <p>正确率: <span><?php echo sprintf("%.2f",($v['mathnum']+$v['readnum']+$v['writenum'])/154*100)?>%</span></p>
            <p>完成时间: <span><?php echo date('Y-m-d H:i:s',$v['date'])?></span></p>
          </div>
        </li>
        <?php }?>
<!--        <li class="clearfix">-->
<!--          <div class="mock-look pull-right">-->
<!--            <a href="#" class="mock-again">重新模考</a>-->
<!--            <a href="#" class="mock-record">查看报告</a>-->
<!--          </div>-->
<!--          <h3><i class="mock-delete fa fa-trash"></i>OG-2017模考试题</h3>-->
<!--          <div class="mock-details">-->
<!--            <p>耗时：<span>01h22m33s</span></p>-->
<!--            <p>正确率: <span>47%</span></p>-->
<!--            <p>完成时间: <span>2017-5-8 20:08:24</span></p>-->
<!--          </div>-->
<!--        </li>-->
<!--        <li class="clearfix">-->
<!--          <div class="mock-look pull-right">-->
<!--            <a href="#" class="mock-again">重新模考</a>-->
<!--            <a href="#" class="mock-record">查看报告</a>-->
<!--          </div>-->
<!--          <h3><i class="mock-delete fa fa-trash"></i>OG-2017模考试题</h3>-->
<!--          <div class="mock-details">-->
<!--            <p>耗时：<span>01h22m33s</span></p>-->
<!--            <p>正确率: <span>47%</span></p>-->
<!--            <p>完成时间: <span>2017-5-8 20:08:24</span></p>-->
<!--          </div>-->
<!--        </li>-->
      </ul>
    </div>
  </div>
</section>