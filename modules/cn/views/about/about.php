<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <title>网站说明</title>
  <link rel="stylesheet" href="/cn/css/reset.css">
  <link rel="stylesheet" href="/cn/css/bootstrap.css">
  <link rel="stylesheet" href="/cn/css/font-awesome.min.css">
  <link rel="stylesheet" href="/cn/css/public.css">
  <link rel="stylesheet" href="/cn/css/about.css">

<!--  <script src="/cn/js/less.js"></script>-->
  <script src="/cn/js/jquery-2.1.3.js"></script>
  <script src="/cn/js/bootstrap.js"></script>
  <script src="/cn/js/jquery.SuperSlide.2.1.js"></script>
  <script src="/cn/js/public.js"></script>
</head>
<body>
  <!--导航-->
  <?php use app\commands\front\NavWidget;?>
  <?php NavWidget::begin();?>
  <?php NavWidget::end();?>
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
            <dt class="pull-left">全国免费咨询热线：400-600-1123</dt>
            <dd>广州</dd>
            <dd>深圳</dd>
            <dd>长沙</dd>
            <dd>武汉</dd>
            <dd>成都</dd>
            <dd>杭州</dd>
            <dd>上海</dd>
            <dd class="co-black">北京</dd>
          </dl>
          <ul class="s-relation-cnt">
            <li>
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>广州服务中心</dt>
                <dd>电话:
                  <span>400-600-1123 </span>
                </dd>
                <dd>地址：广州市天河区体育西路111号建和中心</dd>
              </dl>
            </li>
            <li>
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>深圳服务中心</dt>
                <dd>电话:
                  <span>400-600-1123 </span>
                </dd>
                <dd>地址：深圳福田区深南大道6017号都市阳光名苑</dd>
              </dl>
            </li>
            <li>
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>长沙服务中心</dt>
                <dd>电话:
                  <span>400-600-1123 </span>
                </dd>
                <dd>地址：长沙市万达广场B座</dd>
                <dd>公交路线：112、368、11、临旅2路、旅3路、临123路</dd>
                <dd>地铁路线：五一广场8号口出，步行约1000米到万达国际总部B座</dd>
              </dl>
            </li>
            <li>
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>武汉服务中心</dt>
                <dd>电话:
                  <span>027-87132585 </span>
                </dd>
                <dd>地址：武汉市珞瑜路889号光谷融众国际1501室（光谷国际广场二期）</dd>
                <dd>公交路线：乘坐538路,625路在虎泉街地铁光谷广场站下车</dd>
                <dd>地铁路线：乘坐地铁2号线至光谷广场(轨道交通2号线)E出口，华美达光谷大酒店对面。</dd>
              </dl>
            </li>
            <li>
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>杭州服务中心</dt>
                <dd>电话:
                  <span>0571-87244618 </span>
                </dd>
                <dd>地址：杭州市下城区庆春路118号嘉德广场1703室</dd>
                <dd>公交路线：38, K14路到众安桥公交站(中山北路);</dd>
                <dd>地铁路线：乘坐地铁1号线至凤起路或龙翔桥下，下车步行1.4公里即可达到嘉德广场1703。</dd>
              </dl>
            </li>
            <li>
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>成都服务中心</dt>
                <dd>电话:
                  <span>028-64442708 </span>
                </dd>
                <dd>地址：成都市锦江区总府路2号时代广场A座2807</dd>
                <dd>公交路线：68,21路到红星路广场南；5,55路到春熙路南口</dd>
                <dd>地铁路线：乘坐地铁2号线至春熙路站下，由D出口出站，向总府路方向直走约300米到达时代广场A座2807室。</dd>
              </dl>
            </li>
            <li>
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>上海(五角场)服务中心</dt>
                <dd>电话:
                  <span>021-55271219 </span>
                  <span>021-52986736 </span>
                </dd>
                <dd>地址：杨浦区政学路51号瑞力创新中心2号楼305室（近大学路）</dd>
                <dd>地铁路线：乘坐10号线江湾体育场站下车1号口出，步行约630米即可到达</dd>
              </dl>
            </li>
            <li class="s-active">
              <img src="/cn/images/about07.png" alt="">
              <dl>
                <dt>北京服务中心</dt>
                <dd>电话:
                  <span>010-82194388 </span>
                  <span>010-82194149 </span>
                </dd>
                <dd>地址：北京市海淀区海淀大街38号银科大厦808室</dd>
                <dd>公交路线：302, 641, 718，中关村南下</dd>
                <dd>地铁路线：乘坐地铁10号线至苏州街站下B口出，乘坐地铁4号线至中关村站D口出，直行约5分钟即可到达银科大厦。</dd>
              </dl>
            </li>
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
                <dd><strong>教务：</strong>负责根据教师的上课时间，合理进行课程安排和服务协调</dd>
                <dd><strong>学习管理师：</strong>负责建立学员的复习档案，跟踪学员的备考情况；</dd>
                <dd><strong>教师：</strong>教授“新托福”，“SAT”“GMAT”等国外考试专项课程</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>招聘职位:</dt>
                <dd><strong>SEO：</strong>负责对网站的一些数据进行分析，优化网站搜索引擎展示</dd>
                <dd><strong>市场：</strong>组织策划各类活动，协助市场部负责人做好市场线下推广工作，协助市场经理进行业务拓展和客户关系维护</dd>
                <dd><strong>营销：</strong>运用各种网络营销手段宣传公司品牌及业务产品</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>招聘职位:</dt>
                <dd><strong>留学规划师：</strong>熟悉公司业务专业知识，严格按照公司规定的工作标准及服务流程，为客户提供留学与培训的咨询服务，客户申请的时间规划与背景指导。</dd>
                <dd><strong>留学申请顾问：</strong>负责规划学生整个申请的时间规划及协调和文案的衔接，确保及时了解和掌握客户的个案进程，协助及时解决客户案件处理中遇到的问题，保证客户案件的顺利进行</dd>
                <dd><strong>留学咨询顾问：</strong>了解公司产品专业知识，严格按照公司及项目规定的工作标准及服务流程，为客户提供留学和教育培训规划的初级咨询服务；</dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>招聘职位:</dt>
                <dd><strong>财务：</strong>报销各种与现金有关的费用，及时登记现金日记账及库存现金盘点表，定期与银行对账，并保管公司库存现金及负责到银行处理公司相关部门发生的往来票据，包括支票、汇票等，并协调好与银行的业务关系，负责到银行处理公司相关部门发生的往来票据，包括支票、汇票等，并协调好与银行的业务关系</dd>
                <dd><strong>人力资源：</strong>协助做好招聘与任用的具体事务工作，包括发放招聘启事，搜集和汇总应聘资料，安排面试人员，跟踪落实面试人员的情况等</dd>
                <dd><strong>行政：</strong>公司内勤管理、来客接待 ，收发材料、文件传真等；</dd>
              </dl>
            </li>
          </ul>
        </div>
        <div id="sAdvice">
          <h3>您的建议</h3>
          <div>
            <form name="form" method="post" action="/cn/about/suggest" >
              <textarea name="suggest"
<!--                  --><?php //var_dump( \Yii::$app->session());die;if(!$_SESSION['uid']){echo "readonly='value'";}?>
              >
<!--              --><?php //if(!$_SESSION['uid']){echo "请先登录";}?>
              </textarea>
              <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
              <button type="submit" class="btn btn-info btn-lg">提交</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--底部-->
  <?php use app\commands\front\FootWidget;?>
  <?php FootWidget::begin();?>
  <?php FootWidget::end();?>
  <!--登录、注册框-->
  <div class="s-login">
      <div class="s-login-cnt">
          <h2>会员登录</h2>
          <form action="" onsubmit="return check()">
              <input type="text" class="form-control" id="loginName" onblur="checkUser('loginName')" placeholder="请输入手机号/邮箱">
              <input type="password" class="form-control" id="loginPass" placeholder="请输入密码">
              <button type="submit" class="btn btn-info s-btn" onclick="login()" id="loginBtn">登录</button>
              <div>
                  <label>记住密码</label>
                  <input class="s-rember-pwd" type="checkbox" checked="checked">
                  <a href="#" class="pull-right">忘记密码?</a>
              </div>
          </form>
          <div class="s-login-bottom">
              <a class="s-go-sign" href="#">免费注册</a>
              <div>
                  <span>第三方登录:</span>
                  <a href="#">
                      <img src="/cn/images/weChat.png" alt="微信图标">
                  </a>
                  <a href="#">
                      <img src="/cn/images/QQ.png" alt="qq图标">
                  </a>
              </div>
          </div>
          <i class="icon-remove"></i>
      </div>
      <!--注册-->
      <div class="s-sign-cnt">
          <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#sPhone" aria-controls="sPhone" role="tab" data-toggle="tab">手机注册</a></li>
              <li role="presentation"><a href="#sEmail" aria-controls="sEmail" role="tab" data-toggle="tab">邮箱注册</a></li>
          </ul>
          <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="sPhone">
                  <input type="email" class="form-control" id="signTel" onblur="signTel(this.value)" placeholder="请输入手机号">
                  <input type="password" class="form-control" id="signPwd1" onblur="signPwd1(this.value)" placeholder="请输入密码">
                  <input type="text" class="form-control s-sign-code" id="signCode" placeholder="请输入验证码"><button>点击获取验证码</button>
              </div>
              <div role="tabpanel" class="tab-pane" id="sEmail">
                  <input type="email" class="form-control" id="signEmail" onblur="signEmail(this.value)" placeholder="请输入邮箱">
                  <input type="password" class="form-control" id="signPwd2" onblur="signPwd2(this.value)" placeholder="请输入密码">
              </div>
          </div>
          <form action="" onsubmit="return check()">
              <button type="submit" class="btn btn-info s-btn s-register">注册</button>
          </form>
          <from class="s-sign-agree">
              <input type="checkbox"><span>我已阅读并同意<a href="#">申友协议</a></span>
          </from>
          <div class="s-sign-bottom">
              <a class="s-login-back" href="#">返回登录</a>
              <div>
                  <span>第三方登录:</span>
                  <a href="#">
                      <img src="/cn/images/weChat.png" alt="微信图标">
                  </a>
                  <a href="#">
                      <img src="/cn/images/QQ.png" alt="qq图标">
                  </a>
              </div>
              <i class="icon-remove"></i>
          </div>
      </div>
  </div>
</body>
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
</script>
</html>