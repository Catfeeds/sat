
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
        <li><a href="#sStatement">使用声明</a></li>
      </ul>
      <div class="s-about-cnt">
        <div id="sAboutUs" class="clearfix">
          <h3>关于我们</h3>
          <div class="pull-left">
            <h2>我们是谁<em>?</em></h2>
            <span>雷哥SAT，预见你想象的1400＋</span>
            <p>
              雷哥SAT网站，一站式SAT新生态学习服务平台，提供包含SAT在线做题、 在线模考、在线测评、在线答疑、在线学习计划定制、面授课程、在线直播课程、录播视频课程、免费公开课等一系列SAT学习服务。
              雷哥SAT是教育科技领域里提供“在线做题+在线模考+在线测评+在线答疑＋面授课+视频课＋直播课+公开课”一站式SAT新生态的学习系统。集结了SAT行业教学专家以及来自哈佛、耶鲁、哥大、MIT 、LSE等海外名师团队任教， 为用户提供“名师专家课程”与“课后练习模考”的新生态SAT学习系统。
            </p>
          </div>
          <img src="/cn/images/about02.png" alt="">
        </div>
        <div id="sRelation" class="clearfix">
          <h3>联系我们</h3>
          <dl class="s-relation-nav clearfix">
            <dt class="pull-left">
              全国免费咨询热线：400-1816-180
              <br/>
              官方微信公众号：雷哥SAT备考（LG_SAT）
              <br/>
              官方个人微信号：sat0704
            </dt>
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
        <div id="sStatement">
          <h3>使用声明</h3>
          <div>
            <p>一、用户账号 用户注册成功后，便成为雷哥SAT的合法用户，会得到一个密码和帐号。用户需采取合理措施维护其密码和帐号的安全。用户对利用该密码和帐号所进行的一切活动负全部责任；由该等活动所导致的任何损失或损害由用户承担，雷哥SAT不承担任何责任。</p>
            <p>二、用户承诺 用户同意遵守《中华人民共和国保守国家秘密法》、《中华人民共和国著作权法》、 《互联网电子公告服务管理规定》、《信息网络传播权保护条例》、《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》等有关的法律、法规以及政府部门的规定。在任何情况下，如有他人投诉用户违反上述规定的，雷哥SAT如果认为用户的行为可能违反上述法律、法规，雷哥SAT可以在任何时候，有权不经事先通知终止向该用户提供服务。 雷哥SAT欢迎用户举报任何违反上述法律或侵犯他人权利的上传内容，一经发现违法或侵权的上传内容，雷哥SAT将根据相关的法律规定进行删除。 用户承诺使用雷哥SAT的过程中，尊重原创作者知识产权等合法权益，不得采取下列行为： 1、未经权利人许可，将不具有著作权的作品上传致雷哥SAT； 2、未经雷哥SAT书面许可，将使用雷哥SAT站所载作品进行复制及进行信息网络传播； 3、上传侵犯他人人身权的作品； 4、上传泄漏他人商业机密、个人隐私、国家机密作品或者言论的。</p>
            <p>三、处罚措施 1、如果雷哥SAT发现用户违背本协议禁止性规定，有权利注销用户账户。用户发布或传送任何信息、通讯资料和其它内容，如被删除或未予储存，雷哥SAT毋须承担任何责任。 2、如果用户的违规行为侵犯他人权益或者违反国家法律禁止性规定，雷哥SAT有权利向权利人以及国家主管机关公开用户注册信息，该行为不视为侵犯用户隐私权。 3、用户在注册账户时填写的电子邮件地址号码视为用户联系地址，就使用过程中出现的事宜，雷哥SAT将通过该邮箱地址号码与用户进行联系。</p>
          </div>
          <h3>版权声明</h3>
          <div>
            <p>雷哥SAT为非赢利性网站，所提供的资料仅供学习之用，下载后请及时删除，不得用于任何形式的商业性用途，否则由此产生的法律后果与本站无关。</p>
            <p>雷哥SAT网站及其注册用户本网站内的资料提供者拥有此网站内所有资料的版权。未经雷哥SAT的明确书面许可，任何人不得复制或仿造本网站内容。</p>
            <p>雷哥SAT多站所有页面的版式、图片版权均为本站所有，未得到书面许可之前，不得用于除雷哥SAT网站之外的任何其它站点。</p>
            <p>雷哥SAT在建设中引用了互联网上的一些资源并对有明确来源的注明了出处，版权归原作者及网站所有，如果您对本站文章及资料的版权归属存有异议，请您致电400-1816-180。</p>
            <p>网友在雷哥SAT网站的原创作品，由雷哥SAT网站与作者共同享有版权，其他网站或传统媒体如需使用，须与本站联系400-1816-180，经过本站授权，方可转载，并在转载时注明原创作者及雷哥SAT网站链接。</p>
            <p>雷哥SAT对发表在网站内的文章有编辑整理的权利。</p>
            <p>雷哥SAT论坛网友所发表的言论仅代表网友自己，与本站观点无关。</p>
            <p>阅读本文即表明您已经阅读并接受上述条款。</p>
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
