
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
          <li class="active"><a href="/exercise.html?m=Math"> 数学</a></li>
          <li><a href="/exercise.html?m=Reading">阅读</a></li>
          <li><a href="/exercise.html?m=Writing">文法</a></li>
        </ul>
        <dl class="s-subject-src">
          <dt>题目来源:</dt>
          <dd class="active"><span data-id="All" onclick="getCate('')">全部</span></dd>
          <dd><span onclick="getCate('OG')" >OG</span></dd>
          <dd><span onclick="getCate('princeton')" >普林斯顿</span></dd>
          <dd><span onclick="getCate('kaplan')">开普兰</span></dd>
          <dd><span onclick="getCate('BARRON')">BARRON</span></dd>
        </dl>
        <div class="s-subject-cnt">
          <ul>
            <?php foreach($data as $k=>$v){?>
            <li>
              <h3><?php echo $v['name'].'-'.$v['time'].'-'.$v['major'].'-'.$v['number']?></h3>
              <div><?php
//                if($v['essay']!=false && ($v['major']!='Math1'||$v['major']!='Math2')){
//                  echo $v['essay'];
//                }else{
                  echo $v['content'];
//                }
                  ?>
              </div>
              <a href="/exercise_details/<?php echo $v['qid']?>.html">做题</a>
            </li>
            <?php }?>
          </ul>
        </div>
        <?php echo $page?>
      </div>
      <div class="s-right pull-right">
        <div class="s-right-adv">
          <img src="/cn/images/pubClass-dea_11.png" alt="">
        </div>
        <ul class="s-right-subject">
          <h2>最新题目</h2>
          <?php foreach($arr as $k=>$v){?>
          <li>
            <h3><?php echo $v['qid']?></h3>
            <a href="/exercise_details/<?php echo $v['qid']?>.html">
              <?php
//              if($v['essay']!=false && ($v['major']!='Math1'||$v['major']!='Math2')){
//                echo $v['essay'];
//              }else{
                echo $v['content'];
//              }
              ?>
            </a>
          <li>
          <?php }?>
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
    //  选项卡切换效果
    var search = location.search.split('m='),
        m = search[1];
    if (location.search.split('&').length==2 && location.search.indexOf('p=') != -1) {
      m = m.split('&')[0];
    }
    $('.s-label-list li').removeClass('active');
    switch (m) {
      case 'Reading':
        $('.s-label-list li').eq(1).addClass('active');
        break;
      case 'Writing':
        $('.s-label-list li').eq(2).addClass('active');
        break;
      default:
        $('.s-label-list li').eq(0).addClass('active');
        break;
    }
    if (location.search.indexOf('c=') != -1) {
      var search1 = location.search.split('m=')[1].split('&c=')[0];
      search = location.search.split('c=');
      var c = search[1];
      if (location.search.split('&').length==3 && location.search.indexOf('p=') != -1) {
        c = c.split('&')[0];
      }
      $('.s-label-list li').removeClass('active');
      $('.s-subject-src dd').removeClass('active');
      if (search1 == 'Writing') {
        $('.s-label-list li').eq(2).addClass('active');
      } else if (search1 == 'Reading') {
        $('.s-label-list li').eq(1).addClass('active');
      } else {
        $('.s-label-list li').eq(0).addClass('active');
      }
      switch (c) {
        case 'OG':
          $('.s-subject-src dd').eq(1).addClass('active');
          break;
        case 'princeton':
          $('.s-subject-src dd').eq(2).addClass('active');
          break;
        case 'kaplan':
          $('.s-subject-src dd').eq(3).addClass('active');
          break;
        case 'BARRON':
          $('.s-subject-src dd').eq(4).addClass('active');
          break;
        default:
          $('.s-subject-src dd').eq(0).addClass('active');
          break;
      }
    }
  })
  function getCate(cate) {
    var url = window.location.href,
        rec = url.indexOf('c='),
        rep = url.indexOf('m=');
    if (rep != -1) {
      if (rec == -1) {
        window.location.href = url + "&c=" + cate;
      } else {
        var port = window.location.search;
        url = port.substring(port.lastIndexOf('&c='), port.length - rec) + "&c=" + cate;
        window.location.href = url;
      }
    } else {
      console.log(url+'/exercise.html?path=math'+'&c='+cate);
//      window.location.href = url+'/exercise.html?path=math'+'&c='+cate;
    }

  }
</script>
