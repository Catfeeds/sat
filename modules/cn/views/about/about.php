
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
        <li><a href="#sCopyRight">版权声明</a></li>
        <li><a href="#sStatement">免责声明</a></li>
      </ul>
      <div class="s-about-cnt">
        <div id="sAboutUs" class="clearfix">
          <h3>关于我们</h3>
          <div class="pull-left">
            <h2>我们是谁<em>?</em></h2>
            <span>雷哥SAT，预见你想象的1400＋</span>
            <p style="margin-top: 10px;">雷哥SAT归属于上海申雷友管理咨询有限公司。</p>
            <p style="margin-top: 10px;">
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
<!--            --><?php //foreach($contact as $k=>$v){?>
<!--              <dd --><?php //if($k==0) echo 'class="co-black"'?><!--><?php //echo $v['city']?><!--</dd>-->
<!--            --><?php //}?>
            <dd>上海</dd>
          </dl>
          <ul class="s-relation-cnt">
            <li class="s-active">
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>上海</dt>
                <dd>电话:
                  <span>021-55271219</span>&nbsp;<span>021-52986736</span>
                </dd>
                <dd>地址：杨浦区政学路51号瑞力创新中心2号楼305室（近大学路）</dd>
                <dd>公交路线：请咨询工作人员</dd>
                <dd>地铁路线：乘坐10号线江湾体育场站下车1号口出，步行约630米即可到达</dd>
              </dl>
            </li>
<!--            --><?php //foreach($contact as $k=>$v){?>
<!--              <li --><?php //if($k==0)echo 'class="s-active"'?><!-->
<!--                <img src="--><?php //if($v['pic']){echo $v['pic'];}else{echo '/cn/images/about07.png';}?><!--" alt="">-->
<!--                <dl>-->
<!--                  <dt>--><?php //echo $v['name']?><!--</dt>-->
<!--                  <dd>电话:-->
<!--                    <span>--><?php //echo $v['telephone']?><!--</span>-->
<!--                  </dd>-->
<!--                  <dd>地址：--><?php //echo $v['address']?><!--</dd>-->
<!--                  <dd>公交路线：--><?php //if($v['bus']){echo  $v['bus'];}else{echo '请咨询工作人员';}?><!--</dd>-->
<!--                  <dd>地铁路线：--><?php //if($v['subWay']){echo  $v['subWay'];}else{echo '请咨询工作人员';}?><!--</dd>-->
<!--                </dl>-->
<!--              </li>-->
<!--            --><?php //}?>
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
        <div id="sCopyRight">
          <h3>版权声明</h3>
          <div>
            <p>本网站提供的OG内容，版权归College Board所有；Princeton 2017 & 500+ Questions内容，版权归Princeton Review所有；KAPLAN2017内容，版权归Kaplan Publishing所有；Barron’s tests & Reading, 版权归Barron’s Educational Series所有。</p>
            <p>本网站所提供的知识库内容，部分来源于雷哥SAT整理发布，版权归雷哥网所有，仅供学习者交流免费使用；部分来源于互联网，版权归原作者所有，仅供学习者交流免费使用。</p>
            <p>本网站保留在法律允许的范围内对本声明的解释权，并有权随时修改本声明，请注意随时关注本声明的内容。</p>
          </div>
        </div>
        <div id="sStatement">
          <h3>免责声明</h3>
          <div>
            <p>雷哥SAT为非赢利性网站，所提供的资料仅供学习之用，下载后请及时删除，不得用于任何形式的商业性用途，否则由此产生的法律后果与本站无关。</p>
            <p>雷哥SAT作为网络服务提供者，对剽窃、抄袭等侵权行为的发生不具备充分的监控能力，对他人在本网站上实施的此类侵权行为不承担法律责任，侵权的法律责任概由剽窃、抄袭者自行承担。</p>
            <p>雷哥SAT在建设中引用了互联网上的一些资源并对有明确来源的注明了出处，版权归原作者及网站所有，如果您对本站文章及资料的版权归属存有异议，请您致电400-1816-180，我们会及时处理。</p>
            <p>网友在雷哥SAT的原创作品，由雷哥SAT与作者共同享有版权，其他网站或传统媒体如需使用，须与本站联系，经过本站授权，方可转载，并在转载时注明原创作者及雷哥SAT网站链接。</p>
            <p>雷哥SAT网友所发表的言论仅代表网友自己，与本站观点无关。</p>
            <p>雷哥教育网站对发表在网站内的文章有编辑整理的权利。</p>
            <p>雷哥SAT致力于提供合理、准确、完整的资讯信息，但无法保证信息的完全合理、准确和完整性，不对因信息的不合理、不准确或遗漏导致的任何损失或损害承担责任。</p>
            <p>任何由于黑客攻击、计算机病毒侵入或发作等影响网络正常经营的不可抗力因素而造成的损失，本网站均得免责。因和本网站链接的其他网站所造成的个人资料泄露及由此而导致的任何法律争议和后果，本网站均得免责。</p>
            <p>本网站如因系统维护或升级而需暂停服务时，将事先公告。若因线路及非本公司控制范围外的硬件故障或其他不可抗力因素而导致暂停服务，于暂停服务期间造成的一切不便于损失，本网站概不负责。</p>
            <p>本声明未涉及的问题参见国家有关法律法规，当本声明与国家法律法规冲突时，以国家法律法规为准。</p>
            <p>凡以任何方式登录本网站或直接、间接使用本网站资料，即表明您已经阅读并接受上述条款。</p>
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
