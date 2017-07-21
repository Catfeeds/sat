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
            <li>做题数:<span><?php echo count($crr);?></span></li>
            <li>正确率:<span><?php echo ($n!=false)?$n/count($crr)*100:'0'?>%</span></li>
          </ul>
        </li>
        <li>
          <a href="/person_collect.html">
            <i class="fa fa-bookmark"></i>收藏题目
          </a>
        </li>
        <li>
          <a href="/person_mock.html">
            <i class="fa fa-clipboard"></i>模考记录
          </a>
        </li>
        <li class="on">
          <i class="fa fa-file-text-o"></i>做题记录
        </li>
      </ul>
    </div>
    <div class="person-cnt pull-left">
      <dl class="per-src">
        <dt>题目来源</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="OG">OG</dd>
        <dd data-val="princeton">princeton</dd>
        <dd data-val="kaplan">kaplan</dd>
        <dd data-val="BARRON">barron</dd>
      </dl>
      <dl class="per-classify">
        <dt>科目分类</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="Reading">Reading</dd>
        <dd data-val="Writing">Writing</dd>
        <dd data-val="Math1">Math1</dd>
        <dd data-val="Math2">Math2</dd>
      </dl>
      <dl class="per-case">
        <dt>做题情况</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="wrong">错误</dd>
      </dl>
      <ul>
        <?php foreach ($data as $k=>$v){?>
        <li class="clearfix">
          <div class="collect-del pull-right">
            <div>
              耗时: <span><?php echo $crr[$v['qid']][0]?></span>秒
            </div>
            <a href="/exercise_details/<?php echo $v['qid']?>.html">重新做</a>
          </div>
          <div class="collect-sub">
            <h4><i class="exer-delete fa fa-times-circle" data-id="<?php echo $v['qid']?>"></i><?php echo $v['name'].$v['time']?>-<?php echo $v['major']?>-<?php echo $v['number']?><span><?php echo date('Y-m-d H:i:s',$crr[$v['qid']][3])?></span></h4>
            <p>
              <a href="#"><?php echo $v['content']?></a>
            </p>
          </div>
        </li>
      <?php }?>

      </ul>
    </div>
  </div>
</section>
<!--底部-->