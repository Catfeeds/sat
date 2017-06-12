
  <title>练习</title>
  <link rel="stylesheet" href="/cn/css/test.css">

<section>
  <div class="s-test s-w1200">
    <div class="s-top-adv">
      <img src="/cn/images/teacher-detail01.png" alt="">
    </div>
    <div class="s-cnt clearfix">
      <div class="s-left pull-left">
        <ul class="s-label-list">
          <li class="active"><a href="/exercise.html?path=math"> 数学</a></li>
          <li><a href="/exercise.html?path=reading">阅读</a></li>
          <li><a href="/exercise.html?path=writing">写作</a></li>
        </ul>
        <dl class="s-subject-src">
          <dt>题目来源:</dt>
          <dd class="active">全部</dd>
          <dd><span onclick="getCate('OG')" >OG</span></dd>
          <dd><span onclick="getCate('princeton')" >普林斯顿</span></dd>
          <dd><span onclick="getCate('kaplan')">开普兰</span></dd>
          <dd><span onclick="getCate('BARRON')">BARRON</span></dd>
        </dl>
        <div class="s-subject-cnt">
          <ul>
            <li>
              <h3>题目标题</h3>
              <p>fuif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jnsan njak fjoaeg lnda fiaiuwe asbv  nask</p>
              <a href="#">做题</a>
            </li>
            <li>
              <h3>题目标题</h3>
              <p>fuif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jnsan njak fjoaeg lnda fiaiuwe asbv  nask</p>
              <a href="#">做题</a>
            </li>
            <li>
              <h3>题目标题</h3>
              <p>fuif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jnsan njak fjoaeg lnda fiaiuwe asbv  nask</p>
              <a href="#">做题</a>
            </li>
            <li>
              <h3>题目标题</h3>
              <p>fuif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jnsan njak fjoaeg lnda fiaiuwe asbv  nask</p>
              <a href="#">做题</a>
            </li>
            <li>
              <h3>题目标题</h3>
              <p>fuif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jnsan njak fjoaeg lnda fiaiuwe asbv  nask</p>
              <a href="#">做题</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="s-right pull-right">
        <div class="s-right-adv">
          <img src="/cn/images/pubClass-dea_11.png" alt="">
        </div>
        <ul class="s-right-subject">
          <h2>最新题目</h2>
          <li>
            <h3>SAT-1005</h3>
            <a href="#">uif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jn</a>
          </li>
          <li>
            <h3>SAT-1005</h3>
            <a href="#">uif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jn</a>
          </li>
          <li>
            <h3>SAT-1005</h3>
            <a href="#">uif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jn</a>
          </li>
          <li>
            <h3>SAT-1005</h3>
            <a href="#">uif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jn</a>
          </li>
          <li>
            <h3>SAT-1005</h3>
            <a href="#">uif jan fk anf naf uifn husafhui nfsj dbahfba fdmaof bdhasvhj maoi jds ak afa; sai  sn vak aifia wehuifaiu jn</a>
          </li>
        </ul>
        <div class="s-right-code">
          <img src="/cn/images/qr-code01.png" alt="">
          <p>扫码关注</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--底部-->
<script>
  $(function () {
    $('.s-label-list li').click(function () {
      $('.s-label-list li').removeClass('active');
      $(this).addClass('active');
    })
  })
  function getCate(cate){
    var url=window.location.href;
    var re=url.indexOf('c=');
    if(re==-1){
      window.location = url+"&c="+cate;
    }else{
      var port=window.location.search;
      url=port.substring(port.lastIndexOf('&c='),port.length-re)+"&c="+cate;
      window.location.href=url;

    }
  }
</script>
