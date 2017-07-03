
<link rel="stylesheet" href="/cn/css/about.css">
  <section class="s-w1200">
    <div class="s-about-bg">
      <img src="/cn/images/about01.png" alt="">
    </div>
    <div class="s-about clearfix">
      <ul class="s-about-nav pull-left">
        <h3>网站说明</h3>
        <li><a href="#sAboutUs">关于我们</a></li>
        <li><a href="#sRelation">联系我们</a></li>
        <li><a href="#sJoin">加入我们</a></li>
        <li><a href="#sAdvice">您的建议</a></li>
      </ul>
      <div class="s-about-cnt">
        <div id="sAboutUs" class="clearfix">
          <h3>关于我们</h3>
          <div class="pull-left">
            <h2>我们是谁<em>?</em></h2>
            <span>高端留学与GT培训品牌</span>
            <p>申友国际教育源于2007年的雷哥创业团队。2012年在北京注册，目前在上海、成都、杭州、武汉、广州、深圳、美国加州等多个城市拥有分支机构，致力于以科技改变教育，专注于高端留学咨询和出国考试培训。其中，申友名校留学咨询，SAT培训GMAT培训、托福培训、雅思培训、在规模上目前处于国内实力地位。</p>
          </div>
          <img src="/cn/images/about02.png" alt="">
        </div>
        <div id="sRelation">
          <h3>联系我们</h3>
          <dl class="s-relation-nav clearfix">
            <dt class="pull-left">全国免费咨询热线：400-1816-180</dt>
            <?php foreach($contact as $k=>$v){?>
              <dd <?php if($k==0) echo 'class="co-black"'?>><?php echo $v['city']?></dd>
            <?php }?>
          </dl>
          <ul class="s-relation-cnt">
            <?php foreach($contact as $k=>$v){?>
              <li <?php if($k==0)echo 'class="s-active"'?>>
                <img src="<?php if($v['pic']){echo $v['pic'];}else{echo '/cn/images/about07.png';}?>" alt="">
                <dl>
                  <dt><?php echo $v['name']?></dt>
                  <dd>电话:
                    <span><?php echo $v['telephone']?></span>
                  </dd>
                  <dd>地址：<?php echo $v['address']?></dd>
                  <dd>公交路线：<?php if($v['bus']){echo  $v['bus'];}else{echo '请咨询工作人员';}?></dd>
                  <dd>地铁路线：<?php if($v['subWay']){echo  $v['subWay'];}else{echo '请咨询工作人员';}?></dd>
                </dl>
              </li>
            <?php }?>
          </ul>
        </div>
        <div id="sJoin">
          <h3>加入我们</h3>
          <h4>人力资源部邮箱:<strong>hr@thinkwithu.cn</strong></h4>
          <ul class="s-join-nav">
            <li><p>教育类</p></li>
            <li><p>营销/市场类</p></li>
            <li><p>留学顾问类</p></li>
            <li><p>综合类</p></li>
          </ul>
          <ul class="s-join-cnt">
            <li class="s-active">
              <dl>
                <dt>招聘职位:</dt>
                <?php foreach($join as $k=>$v){if($v['cate']=='教育类'){?>
                <dd><strong><?php echo $v['job']?>:</strong><?php echo $v['demand']?></dd>
                <?php }}?>
              </dl>
            </li>

            <li>
              <dl>
                <dt>招聘职位:</dt>
                <?php foreach($join as $k=>$v){if($v['cate']=='营销/市场类'){?>
                  <dd><strong><?php echo $v['job']?>:</strong><?php echo $v['demand']?></dd>
                <?php }}?>
              </dl>
            </li>
            <li>
              <dl>
                <dt>招聘职位:</dt>
                <?php foreach($join as $k=>$v){if($v['cate']=='留学顾问类'){?>
                  <dd><strong><?php echo $v['job']?>:</strong><?php echo $v['demand']?></dd>
                <?php }}?>
              </dl>
            </li>
            <li>
              <dl>
                <dt>招聘职位:</dt>
                <?php foreach($join as $k=>$v){if($v['cate']=='综合类'){?>
                  <dd><strong><?php echo $v['job']?>:</strong><?php echo $v['demand']?></dd>
                <?php }}?>
              </dl>
            </li>
          </ul>
        </div>
        <div id="sAdvice">
          <h3>您的建议</h3>
          <div>
            <form name="form" method="post" action="/cn/about/suggest" onsubmit="return dosubmit()">
              <textarea name="suggest"  placeholder="请写出对我们的建议和意见"><?php if(!isset($user)){echo "请先登录";}?></textarea>
              <?php if(isset($user)) echo '<button type="submit" class="btn btn-info btn-lg">提交</button>'?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<script>
  $(function () {
    $('.s-join-nav li').mouseenter(function () {
      $('.s-join-cnt li').removeClass('s-active');
      var index = $(this).index();
      $('.s-join-cnt li').eq(index).addClass('s-active');
    })
    $('#sRelation .s-relation-nav dd').mouseenter(function () {
      $('#sRelation .s-relation-nav dd').removeClass('co-black');
      $(this).addClass('co-black');
      $('#sRelation li').removeClass('s-active');
      var index = $(this).index();
      $('#sRelation li').eq(index-1).addClass('s-active');
    })
  })
  var isCommitted = false;//表单是否已经提交标识，默认为false
           function dosubmit(){
                 if(isCommitted==false){
                       isCommitted = true;//提交表单后，将表单是否已经提交标识设置为true
                       return true;//返回true让表单正常提交
                   }else{
                       return false;//返回false那么表单将不提交
                 }
           }
</script>
