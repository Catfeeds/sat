<link rel="stylesheet" href="/cn/css/person.css">
<script src="/cn/js/jqPaginator.js"></script>
<script src="/cn/js/person.js"></script>
<section class="s-w1200 s-information">
  <div class="person-wrap clearfix">
    <?php use app\commands\front\PersonWidget;?>
    <?php PersonWidget::begin();?>
    <?php PersonWidget::end();?>
    <div class="person-cnt pull-left">
      <dl class="per-type">
        <dt>测评难度</dt>
        <dd class="on" data-val="all">全部</dd>
        <dd data-val="chu">初级卷</dd>
        <dd data-val="zhong">中级卷</dd>
        <dd data-val="gao">高级卷</dd>
      </dl>
      <ul class="person-mock"></ul>
      <!--分页-->
      <div class="s-page">
        <ul class="pagination clearfix"></ul>
      </div>
    </div>
  </div>
</section>