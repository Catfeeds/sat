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
          <a href="/person_collect.html"></a>
            <i class="fa fa-bookmark"></i>收藏题目
          </a>
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
            <p>
              <a href="/exercise_details/<?php echo $v['qid']?>.html"><?php echo $v['content']?></a>
            </p>
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
