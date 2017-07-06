
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
        <div class="s-desc"><?php echo $data[0]['student']?></div>
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt"><?php echo $data[0]['introduction']?></div>
            <ul>
              <li>模块</li>
              <?php foreach($brr[0] as $v){
                echo '<li>'.$v[0].'</li>';
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php foreach($brr[0] as $v){
                echo '<li>'.$v[1].'</li>';
              }?>
            </ul>
            <a class="s-consult" href="/class_details/<?php echo $data[0]['id']?>.html">查看详情</a>
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
        <div class="s-desc"><?php echo $data[1]['student']?></div>
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt"><?php echo $data[1]['introduction']?></div>
            <ul>
              <li>模块</li>
              <?php foreach($brr[1] as $v){
                echo '<li>'.$v[0].'</li>';
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php foreach($brr[1] as $v){
                echo '<li>'.$v[1].'</li>';
              }?>
            </ul>
            <a class="s-consult" href="/class_details/<?php echo $data[1]['id']?>.html">查看详情</a>
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
      <div class="tab-pane fade" id="weekend">
        <div class="s-desc"><?php echo $data[2]['student']?></div>
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt"><?php echo $data[2]['introduction']?></div>
            <ul>
              <li>模块</li>
              <?php foreach($brr[2] as $v){
                echo '<li>'.$v[0].'</li>';
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php foreach($brr[2] as $v){
                echo '<li>'.$v[1].'</li>';
              }?>
            </ul>
            <a class="s-consult" href="/class_details/<?php echo $data[2]['id']?>.html">查看详情</a>
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
        <div class="s-desc">
          <p>1.有一定的语言能力且自控能力强的学员，需全科系统加强的学员;
            2.没有考过新SAT考试，经雷哥团队内部标准测试符合以上标准。
          </p>
        </div>
        <div class="s-detail clearfix">
          <div class="s-text pull-left">
            <h2>课程简介</h2>
            <div class="s-text-cnt">
              <p>足不出户，在家有网就可以高效备考SAT！雷哥SAT名师团队依据新SAT官方指南，讲解各种文章类型的阅读技巧，解题思路和常见词汇偏僻意义，帮助学员快速提高阅读速度和逻辑思维能力；通过系统讲解，让学员语法知识结构准确且系统化；依据官方指南整理考点和词汇术语，提高学员快速掌握数学专业词汇的能力和技巧；讲授写作的论证策略，帮助学员短期内积累大量的写作高分单词，熟练并精确运用单词和句型，拿到写作高分。
              </p>
            </div>
            <ul>
              <li>模块</li>
              <?php foreach($brr[2] as $v){
                echo '<li>'.$v[0].'</li>';
              }?>
            </ul>
            <ul>
              <li>课时</li>
              <?php foreach($brr[2] as $v){
                echo '<li>'.$v[1].'</li>';
              }?>
            </ul>
            <a class="s-consult" href="/class_details/<?php echo $data[2]['id']?>.html">查看详情</a>
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
