<link rel="stylesheet" href="/cn/css/person.css">
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
      <dl class="per-type">
        <dt>模考类型</dt>
        <dd class="on" data-val="whole">全部</dd>
        <dd data-val="all">全套模考</dd>
        <dd data-val="Reading">Reading</dd>
        <dd data-val="Writing">Writing</dd>
        <dd data-val="Math">Math</dd>
      </dl>
      <ul class="person-mock"></ul>
      <!--分页-->
      <div class="s-page">
        <ul class="pagination clearfix"></ul>
      </div>
    </div>
  </div>
</section>