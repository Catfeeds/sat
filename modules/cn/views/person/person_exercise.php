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
      <dl class="per-case">
        <dt>做题情况</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="wrong">错误</dd>
      </dl>
      <ul>
<!--        --><?php //foreach ($data as $k=>$v){?>
<!--        <li class="clearfix">-->
<!--          <div class="collect-del pull-right">-->
<!--            <div>-->
<!--              耗时: <span>--><?php //echo $crr[$v['qid']][0]?><!--</span>秒-->
<!--            </div>-->
<!--            <a href="/exercise_details/--><?php //echo $v['qid']?><!--.html">重新做</a>-->
<!--          </div>-->
<!--          <div class="collect-sub">-->
<!--            <h4><i class="exer-delete fa fa-times-circle" data-id="--><?php //echo $v['qid']?><!--"></i>--><?php //echo $v['name'].$v['time']?><!-----><?php //echo $v['major']?><!-----><?php //echo $v['number']?><!--<span>--><?php //echo date('Y-m-d H:i:s',$crr[$v['qid']][3])?><!--</span></h4>-->
<!--            <p>-->
<!--              <a href="#">--><?php //echo $v['content']?><!--</a>-->
<!--            </p>-->
<!--          </div>-->
<!--        </li>-->
<!--      --><?php //}?>
      </ul>
      <!--分页-->
      <ol class="pagination clearfix"></ol>
    </div>
  </div>
</section>
<!--底部-->