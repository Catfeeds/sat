<div class="greyNav">
  <div class="inGrey clearfix">
    <div class="leftNav pull-left">
      <ul>
        <li><a href="http://www.viplgw.cn" target="_blank">
            <img src="/cn/images/logo-icon.png" alt="logo图标">
          </a>
        </li>
        <li><a href="http://www.smartapply.cn/" target="_blank">留学</a></li>
        <li><a href="http://www.gmatonline.cn/" target="_blank">GMAT</a></li>
        <li><a href="http://www.greonline.cn/" target="_blank">GRE</a></li>
        <li><a class="on" href="http://sat.viplgw.cn/" target="_blank">SAT</a></li>
        <li><a href="http://www.toeflonline.cn/" target="_blank">托福</a></li>
        <li><a href="http://ielts.viplgw.cn/" target="_blank">雅思</a></li>
        <li class="xian">|</li>
        <li><a href="http://open.viplgw.cn" target="_blank">公开课</a></li>
        <li><a href="http://class.viplgw.cn/" target="_blank">网校</a></li>
        <li><a href="http://class.viplgw.cn/studyGroup.html" target="_blank">小组</a></li>
        <li><a href="http://class.viplgw.cn/vip.html" target="_blank">会员</a></li>
        <li class="phone"><span>400-6021-727</span></li>
        <li><a href="http://wpa.qq.com/msgrd?v=3&uin=1746295647&site=qq&menu=yes" target="_blank">在线咨询</a></li>
      </ul>
    </div>
    <div class="right-login pull-right">
      <ul class="s-nav-login pull-right" id="loginul" <?php if (isset($user)) {
        echo 'style="display:none"';
      } else {
        echo 'style="display:block"';
      } ?>>
        <li id="login"><a class="s-login-in"
                          href="http://login.gmatonline.cn/cn/index?source=20&url=<?php echo Yii::$app->request->hostInfo . Yii::$app->request->getUrl() ?>">登录</a>
        </li>
        <li id="register"><a class="s-sign-up"
                             href="http://login.gmatonline.cn/cn/index/register?source=20&url=<?php echo Yii::$app->request->hostInfo . Yii::$app->request->getUrl() ?>">注册</a>
        </li>
      </ul>
      <div class="login-after pull-right" <?php if (isset($user)) {
        echo 'style="display:block"';
      } else {
        echo 'style="display:none"';
      } ?>>
        <div class="login-after-show">
          <img src="/cn/images/login.png" alt="头像">
          <p>
            <span><?php echo isset($user) ? ($user['nickname'] != false ? $user['nickname'] : $user['username']) : '' ?></span>
            <span>(<?php echo isset($_SESSION['level']) && $_SESSION['level'] != false ? $_SESSION['level'] : '初出茅庐' ?>
              )</span>
            <i class="fa fa-angle-down"></i>
          </p>
        </div>
        <div class="login-after-list">
          <ul>
            <li><a href="/person_collect.html">收藏题目</a></li>
            <li><a href="/person_exercise.html">做题记录</a></li>
            <li><a href="/person_mock.html">模考记录</a></li>
            <li><a href="/person_eval.html">测评记录</a></li>
            <li><a href="/person_beans.html">雷豆管理</a></li>
            <li id="out"><a href="#"><span onclick="Out()">退出登录</span></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="appDownload pull-right">
            <span class="app-tit">APP
                <i class="fa fa-caret-down"></i>
            </span>
      <div class="app-down">
        <ul>
          <li>
            <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥GMAT苹果版</a>
            <div class="app-box">
              <img src="/cn/images/gmat-ios.png" alt="app二维码">
            </div>
          </li>
          <li>
            <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥GMAT安卓版</a>
            <div class="app-box">
              <img src="/cn/images/gmat-android.png" alt="app二维码">
            </div>
          </li>
          <li>
            <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥托福苹果版</a>
            <div class="app-box">
              <img src="/cn/images/toefl-ios.png" alt="app二维码">
            </div>
          </li>
          <li>
            <a href="http://www.gmatonline.cn/DownloadApp.html" target="_blank">雷哥托福安卓版</a>
            <div class="app-box">
              <img src="/cn/images/toefl-android.png" alt="app二维码">
            </div>
          </li>
          <li>
            <a href="http://www.smartapply.cn/app.html" target="_blank">雷哥选校苹果版</a>
            <div class="app-box">
              <img src="http://www.smartapply.cn/cn/images/smart-erweima.png" alt="app二维码">
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="outjs" style="display: none;">
</div>
<nav class="s-nav">
  <div class="contain clearfix">
    <a class="s-nav-logo pull-left" href="http://www.thinkusat.com">
      <img src="/cn/images/logo.png" alt="企业logo">
    </a>
    <ul class="s-nav-cnt pull-left">
      <li><a <?php if ($path == '') {
          echo 'class="on"';
        } ?> href="/">首页</a></li>
      <li class="s-nav-work">
        <a id="showA"
           href="#" <?php if (strpos($path, 'exercise') !== false || $path == 'knowledge.html') echo 'class="on"'; ?>>做题<i
              class="fa fa-sort-desc"></i></a>
        <div class="s-nav-showing">
          <ul>
            <li><a href="/exercise.html?m=Reading" <?php if (strpos($path, 'exercise') !== false) echo 'class="on"'; ?>>练习</a>
            </li>
            <!--                    <li><a href="/knowledge.html" -->
            <?php //if($path=='knowledge.html') echo 'class="on"';?><!-->知识库</a></li>-->
            <li><a href="/evaulation.html">测评</a></li>
          </ul>
        </div>
      </li>
      <li><a href="/mock.html" <?php if ($path == 'mock.html') echo 'class="on"'; ?>>模考</a></li>
      <li><a href="/re.html" <?php if ($path == 're.html' || $path == 're_single.html') echo 'class="on"'; ?>>报告</a>
      </li>
      <li><a <?php if (strpos($path, 'class') !== false && $path != 'pubclass.html') {
          echo 'class="on"';
        } ?> href="/class.html">SAT课程</a></li>
      <!--        <li><a href="#">学员案例</a></li>-->
      <li><a <?php if ($path == 'pubclass.html') {
          echo 'class="on"';
        } ?> href="/pubclass.html">公开课</a></li>
      <li><a <?php if (strpos($path, 'info') !== false) {
          echo 'class="on"';
        } ?> href="/info.html">SAT资讯</a></li>
      <li><a <?php if ($path == 'act.html') {
          echo 'class="on"';
        } ?> href="/act.html">ACT</a></li>
      <li><a href="/US_abroad.html" <?php if (strpos($path, 'syabroad') !== false) {
          echo 'class="on"';
        } ?> target="_blank">美国留学</a></li>
      <li><a <?php if (strpos($path, 'teachers') !== false) {
          echo 'class="on"';
        } ?> href="/teachers.html">名师团队</a></li>
    </ul>
    <form class="search-form" action="">
      <div class="search-select">
        <p>题目</p>
        <i class="search-icon fa fa-angle-down"></i>
        <ul>
          <li>题目</li>
          <li>资讯</li>
        </ul>
      </div>
      <input type="button" class="search-btn pull-right" value="搜索" onclick="keySearch(this)">
      <input class="search-text text1" name="keyword" onkeyup="javascript:enterKey(event,this)" type="value">

    </form>
  </div>
</nav>
<script>
  $(function () {
    $('.search-select p').click(function () {
      $('.search-select ul').toggle();
    });
    $('.search-select i').click(function () {
      $('.search-select ul').toggle();
    })
    $('.search-select ul li').click(function () {
      $('.search-select p').html($(this).html());
      $('.search-select ul').hide();
    })
  })
  //    存储uid
  var userId = '<?php if (isset($uid)) {
    echo $uid;
  }?>';
  $.cookie('uid', userId, {path: '/'});
  //退出登录
  function Out() {
    $.post('/user/api/login-out', function (re) {
      $('#outjs').html(re);
      alert('退出成功');
      $.cookie('uid', null);
      history.go(0);
    }, "text")
  }
  //搜索框事件
  function enterKey(event, obj) {
    if ($(obj).prop('className').indexOf('text1') != -1) {
      $('.text2').val($('.text1').val());
    } else if ($(obj).prop('className').indexOf('text2') != -1) {
      $('.text1').val($('.text2').val());
    }
    if (event.keyCode == 13) {
      keySearch();
    }
  }
  function keySearch() {
    if ($('.search-select p').html() == '题目') {
      var cate = 'q';
    } else {
      var cate = 'i';
    }
    var k = $('.search-text').val();
    location.href = "/search.html?c=" + cate + "&keyword=" + encodeURIComponent(k);
  }

</script>