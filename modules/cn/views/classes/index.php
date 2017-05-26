
  <title>课程</title>
  <link rel="stylesheet" href="cn/css/course-new.css">
<section>
  <div class="s-course s-w1200">
    <ul class="s-title-list">
          <li class="active s-title"><a href="#allAround" data-toggle="tab">暑期全能小班</a></li>
          <li class="s-title"><a href="#sprint" data-toggle="tab">暑期冲刺小班</a></li>
          <li class="s-title"><a href="#weekend" data-toggle="tab">全能周末班</a></li>
    </ul>
    <div class="tab-content">
      <?php foreach($data as $v){
      if($v['cate']=='全能小班'){
        echo '<div class="tab-pane fade in active" id="allAround">';
      }elseif($v['cate']=='冲刺小班') {
        echo '<div class="tab-pane fade" id="sprint">';
      }else {
      echo '<div class="tab-pane fade" id="weekend">';}
      ?>
        <p class="s-desc"><?php echo $v['student']?></p>
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <p class="s-font"><?php echo $v['introduction']?></p>
            <ul>
              <li>模块</li>
              <li>阅读</li>
              <li>文法</li>
              <li>词汇</li>
              <li>数学</li>
              <li>写作</li>
              <li>模考点评</li>
            </ul>
            <ul>
              <li>课时</li>
              <li><?php echo $v['read']?></li>
              <li><?php echo $v['grammar']?></li>
              <li><?php echo $v['vocabulary']?></li>
              <li><?php echo $v['math']?></li>
              <li><?php echo $v['write']?></li>
              <li><?php echo $v['comments']?></li>
            </ul>
            <a class="s-consult" href="/class_details/<?php echo $v['id']?>.html">查看详情</a>
          </div>
          <div class="s-img">
            <div class="s-img-bg01">
              <img src="cn/images/course.png" alt="">
            </div>
            <div class="s-img-bg s-img-bg02"></div>
            <div class="s-img-bg s-img-bg03"></div>
          </div>
        </div>
      </div>
    <?php }?>
    </div>
  </div>
</section>

<script>
  $(function () {
    var height = document.documentElement.clientHeight;
    console.log(height);
    $('.s-course').css('height', height)
    $('.s-course .s-title-list').css('paddingTop', 0.05*height)
    $('.s-course .s-desc').css('marginBottom', 0.1*height)
  })
</script>
