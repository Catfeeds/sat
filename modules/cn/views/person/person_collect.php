<link rel="stylesheet" href="/cn/css/person.css">
<script src="/cn/js/jqPage.js"></script>
<script src="/cn/js/jqPaginator.js"></script>
<script src="/cn/js/person.js"></script>
<section class="s-w1200 s-information">
  <div class="person-wrap clearfix">
    <?php use app\commands\front\PersonWidget;?>
    <?php PersonWidget::begin();?>
    <?php PersonWidget::end();?>
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
<!--        --><?php //foreach($data as $k=>$v){?>
<!--        <li class="clearfix">-->
<!--          <div class="collect-del pull-right" data-id="--><?php //echo $v['qid']?><!--">-->
<!--            <div>-->
<!--              <i class="fa fa-star"></i>-->
<!--            </div>-->
<!--            <p>取消收藏</p>-->
<!--          </div>-->
<!--          <div class="collect-sub">-->
<!--            <h4><i class="icon-bookmark"></i>--><?php //echo $v['name'].$v['time']?><!-----><?php //echo $v['major']?><!-----><?php //echo $v['number']?><!--</h4>-->
<!--            <div>-->
<!--              <a href="/exercise_details/--><?php //echo $v['qid']?><!--.html" target="_blank">--><?php //echo $v['content']?><!--</a>-->
<!--            </div>-->
<!--          </div>-->
<!--        </li>-->
<!--        --><?php //}?>
      </ul>
      <!--分页-->
      <ol class="pagination clearfix"></ol>
    </div>
  </div>
</section>
