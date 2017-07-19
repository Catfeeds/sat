<link rel="stylesheet" href="/cn/css/person.css">
<section class="s-w1200 s-information">
  <div class="person-wrap clearfix">
    <div class="person-side pull-left">
      <ul>
        <li class="person-title">
          <div class="person-name">
            <img src="/cn/images/person.png" alt="头像">
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
        <li class="on">
          <i class="icon-info-sign"></i>
          <span>收藏题目</span>
        </li>
        <li>
          <i class="icon-info-sign"></i>
          <span>模考记录</span>
        </li>
        <li>
          <i class="icon-info-sign"></i>
          <span>做题记录</span>
        </li>
      </ul>
    </div>
    <div class="person-cnt pull-left">
      <dl>
        <dt>题目来源</dt>
        <dd class="on">全部</dd>
        <dd>OG2017</dd>
        <dd>princeton2016</dd>
        <dd>kaplan2017</dd>
        <dd>barron2017</dd>
      </dl>
      <dl>
        <dt>科目分类</dt>
        <dd class="on">全部</dd>
        <dd>Reading</dd>
        <dd>Writing</dd>
        <dd>Math1</dd>
        <dd>Math2</dd>
      </dl>
      <dl>
        <dt>做题情况</dt>
        <dd class="on">全部</dd>
        <dd>错误</dd>
      </dl>
      <ul>
        <?php foreach ($data as $k=>$v){?>
        <li class="clearfix">
          <div class="collect-del pull-right">
            <div>
              耗时: <span><?php echo $crr[$v['qid']][0]?></span>秒
            </div>
            <p>重新做</p>
          </div>
          <div class="collect-sub">
            <h4><i class="icon-bookmark"></i><?php echo $v['name'].$v['time']?>-<?php echo $v['major']?>-<?php echo $v['number']?><span><?php echo date('Y-m-d H:i:s',$crr[$v['qid']][3])?></span></h4>
            <p>
              <a href="/exercise_details/<?php echo $v['qid']?>.html"><?php echo $v['content']?></a>
            </p>
          </div>
        </li>
      <?php }?>

      </ul>
    </div>
  </div>
</section>
<!--底部-->