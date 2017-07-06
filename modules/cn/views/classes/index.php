
  <link rel="stylesheet" href="cn/css/course-new.css">
<section>
  <div class="s-course s-w1200">
    <ul class="s-title-list">
      <li class="active s-title"><a href="#allAround" data-toggle="tab">暑期全能小班</a></li>
      <li class="s-title"><a href="#sprint" data-toggle="tab">暑期冲刺小班</a></li>
      <li class="s-title"><a href="#weekend" data-toggle="tab">全能周末班</a></li>
      <li class="s-title"><a href="#online" data-toggle="tab">在线强化班</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="allAround">
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt"><?php echo isset($data[0]['introduction'])?$data[0]['introduction']:''?></div>
            <ul>
              <li>模块</li>
              <?php if(isset($brr[0])){foreach($brr[0] as $v){
                echo '<li>'.$v[0].'</li>';}
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php if(isset($brr[0])){foreach($brr[0] as $v){
                echo '<li>'.$v[1].'</li>';}
              }?>
            </ul>
            <a class="s-consult" href="<?php echo isset($data[0]['id'])?'/class_details/'.$data[0]['id'].'.html':'#'?>">查看详情</a>
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
      <div class="tab-pane fade" id="sprint">
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt"><?php echo isset($data[1]['introduction'])?$data[1]['introduction']:''?></div>
            <ul>
              <li>模块</li>
              <?php if(isset($brr[1])){foreach($brr[1] as $v){
                echo '<li>'.$v[0].'</li>';}
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php if(isset($brr[1])){foreach($brr[1] as $v){
                echo '<li>'.$v[1].'</li>';}
              }?>
            </ul>
            <a class="s-consult" href="<?php echo isset($data[1]['id'])?'/class_details/'.$data[1]['id'].'.html':'#'?>">查看详情</a>
          </div>
          <div class="s-img">
            <div class="s-img-bg01">
              <img src="cn/images/course02.png" alt="">
            </div>
            <div class="s-img-bg s-img-bg02"></div>
            <div class="s-img-bg s-img-bg03"></div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="weekend">
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt"><?php echo isset($data[2]['introduction'])?$data[2]['introduction']:''?></div>
            <ul>
              <li>模块</li>
              <?php if(isset($brr[2])){foreach($brr[2] as $v){
                echo '<li>'.$v[0].'</li>';}
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php if(isset($brr[2])){foreach($brr[2] as $v){
                echo '<li>'.$v[1].'</li>';}
              }?>
            </ul>
            <a class="s-consult" href="<?php echo isset($data[2]['id'])?'/class_details/'.$data[2]['id'].'.html':'#'?>">查看详情</a>
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
      <div class="tab-pane fade" id="online">
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt">
              <?php echo isset($data[3]['introduction'])?$data[3]['introduction']:''?>
            </div>
            <ul>
              <li>模块</li>
              <?php if(isset($brr[3])){foreach($brr[3] as $v){
                echo '<li>'.$v[0].'</li>';}
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php if(isset($brr[3])){foreach($brr[3] as $v){
                echo '<li>'.$v[1].'</li>';}
              }?>
            </ul>
            <a class="s-consult" href="<?php echo isset($data[3]['id'])?'/class_details/'.$data[3]['id'].'.html':'#'?>">查看详情</a>
          </div>
          <div class="s-img">
            <div class="s-img-bg01">
              <img src="cn/images/course03.png" alt="">
            </div>
            <div class="s-img-bg s-img-bg02"></div>
            <div class="s-img-bg s-img-bg03"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $(function () {
    var height = document.documentElement.clientHeight;
    $('.s-course').css('height', height)
    $('.s-course .s-title-list').css('paddingTop', 0.05*height)
    $('.s-course .s-desc').css('marginBottom', 0.1*height)
  })
</script>
