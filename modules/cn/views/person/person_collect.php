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
        <li class="on">
            <i class="fa fa-bookmark"></i>收藏题目
        </li>
        <li>
          <a href="/person_mock.html">
            <i class="fa fa-clipboard"></i>模考记录
          </a>
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
      <ul>
        <?php foreach($data as $k=>$v){?>
        <li class="clearfix">
          <div class="collect-del pull-right">
            <div>
              <i class="fa fa-star"></i>
            </div>
            <p>取消收藏</p>
          </div>
          <div class="collect-sub">
            <h4><i class="icon-bookmark"></i><?php echo $v['name'].$v['time']?>-<?php echo $v['major']?>-<?php echo $v['number']?></h4>
            <div>
              <a href="/exercise_details/<?php echo $v['qid']?>.html" target="_blank"><?php echo $v['content']?></a>
            </div>
          </div>
        </li>
<!--        <li class="clearfix">-->
<!--          <div class="collect-del pull-right">-->
<!--            <div>-->
<!--              <i class="fa fa-star"></i>-->
<!--            </div>-->
<!--            <p>取消收藏</p>-->
<!--          </div>-->
<!--          <div class="collect-sub">-->
<!--            <h4><i class="icon-bookmark"></i>OG2017-阅读-12</h4>-->
<!--            <p>-->
<!--              <a href="#">ajhkfaio faui fnai fnaj najl anfjk fndai fnak faj naj fjak jak fjak fajk fanjk nfajk nafjk jak nask fnjsa fnsjak fankj?</a>-->
<!--            </p>-->
<!--          </div>-->
<!--        </li>-->
        <?php }?>
      </ul>
    </div>
  </div>
</section>
<!--底部-->
