
<link rel="stylesheet" href="/cn/css/classes-detail.css">
  <section>
    <div class="s-w1200">
      <ol class="breadcrumb">
        <li><a href="/index.html">首页</a></li>
        <li><a href="/class.html">课程</a></li>
        <li class="active"><?php echo $data['cate']?></li>
      </ol>
      <div class="s-course-details clearfix">
        <img class="pull-left" src="<?php if($data['pic']!=false){echo $data['pic'];}else{echo '/cn/images/cou-details01.png';}?>" alt="">
        <div>
          <h2>SAT<?php echo $data['cate']?>课程</h2>
          <p>课时:<?php echo  $data['duration']?></p>
          <div class="s-object">课程对象：<?php echo $data['student']?></div>
          <a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=" target="_blank">立即预约</a>
        </div>
      </div>
      <div class="s-introduce">
        <ul class="nav nav-pills" role="tablist">
          <li role="presentation" class="active"><a href="#course" aria-controls="course" role="tab" data-toggle="tab">课程介绍</a></li>
          <li role="presentation"><a href="#teacher" aria-controls="teacher" role="tab" data-toggle="tab">授课老师</a></li>
          <li role="presentation"><a href="#plan" aria-controls="plan" role="tab" data-toggle="tab">学习计划</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="course">
            <h2><?php echo $data['cate']?>课程</h2>
            <div><?php echo $data['introduction']?></div>
          </div>
          <div role="tabpanel" class="tab-pane" id="teacher">
            <ul class="s-int-img">
              <li class="on">
                <img src="<?php echo isset($teacher[0]['pic'])?$teacher[0]['pic']:''?>" alt="">
                <div>
                  <p><?php echo isset($teacher[0]['name'])?$teacher[0]['name']:''?><br>
                    <?php echo isset($teacher[0]['honorary'])?$teacher[0]['honorary']:''?>
                  </p>
                </div>
              </li>
              <?php if(isset($teacher[1])){?>
              <li>
                <img src="<?php echo isset($teacher[1]['pic'])?$teacher[1]['pic']:''?>" alt="">
                <div>
                  <p><?php echo isset($teacher[1]['name'])?$teacher[1]['name']:''?><br>
                    <?php echo isset($teacher[1]['honorary'])?$teacher[1]['honorary']:''?>
                  </p>
                </div>
              </li>
              <?php }?>
              <?php if(isset($teacher[2])){?>
              <li>
                <img src="<?php echo isset($teacher[2]['pic'])?$teacher[2]['pic']:''?>" alt="">
                <div>
                  <p><?php echo isset($teacher[2]['name'])?$teacher[2]['name']:''?><br>
                    <?php echo isset($teacher[2]['honorary'])?$teacher[2]['honorary']:''?>
                  </p>
                </div>
              </li>
              <?php }?>
            </ul>
            <div class="s-introduce-font on">
              <h2><?php echo isset($teacher[0]['name'])?$teacher[0]['name']:''?></h2>
              <p><?php echo isset($teacher[0]['introduction'])?$teacher[0]['introduction']:''?></p>
              <a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=" target="_blank">预约名师</a>
            </div>
            <?php if(isset($teacher[1])){?>
            <div class="s-introduce-font">
              <h2><?php echo isset($teacher[1]['name'])?$teacher[1]['name']:''?></h2>
              <p><?php echo isset($teacher[1]['introduction'])?$teacher[1]['introduction']:''?></p>
              <a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=" target="_blank">预约名师</a>
            </div>
            <?php }?>
            <?php if(isset($teacher[2])){?>
            <div class="s-introduce-font">
              <h2><?php echo isset($teacher[2]['name'])?$teacher[2]['name']:''?></h2>
              <p><?php echo isset($teacher[2]['introduction'])?$teacher[2]['introduction']:''?></p>
              <a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=" target="_blank">预约名师</a>
            </div>
            <?php }?>
          </div>
          <div role="tabpanel" class="tab-pane" id="plan">
            <div>
              <h2></h2>
              <p>
                <?php echo $data['plan']?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="s-policy clearfix">
        <h2 class="s-policy-title">雷哥网SAT课程特色</h2>
        <h4>雷哥网SAT名师小班授课模式，SAT培训课程是一个完整的F-inspire”服务体系，包含课前-课中-课后三个阶段的超值服务体系，全程陪伴式高效指导学员的SAT备考。</h4>
        <div class="s-policy-feature clearfix">
          <div class="s-feature-before">
            <div class="s-feature-text">
              <h3>课前</h3>
              <p>入学专业评测，评测结果解析，
                制定专属预习方案，赠送SAT上课教材。
              </p>
            </div>
          </div>
          <div class="s-feature-middle">
            <div class="s-feature-text">
              <h3>课中</h3>
              <p>名师小班面授，阶段性作业评估，
                备考资料共享，结课复习方案个性化定制。
              </p>
            </div>
          </div>
          <div class="s-feature-after">
            <div class="s-feature-text">
              <h3>课后</h3>
              <p>管理师专业复习跟踪指导，
                在线语音答疑，
                线上题库+模考平台；
                词汇打卡群和长难句训练营；
                在线仿真模考+真题训练，
                考前专题辅导，考试报名指导，
                临考心理辅导，留学规划指导。
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="s-seven">
        <ul class="clearfix">
          <li>
            <div class="s-seven-img"></div>
            <p>SAT海外名师团队授课</p>
          </li>
          <li>
            <div class="s-seven-img"></div>
            <p>全方位SAT增值服务课程</p>
          </li>
          <li>
            <div class="s-seven-img"></div>
            <p>研发SAT系列高分备考教材</p>
          </li>
          <li>
            <div class="s-seven-img"></div>
            <p>SAT一站式在线学习平台系统</p>
          </li>
          <li>
            <div class="s-seven-img"></div>
            <p>科学的课前-课中-课后培训系统</p>
          </li>
          <li>
            <div class="s-seven-img"></div>
            <p>全国SAT高分基地，学员口碑推荐</p>
          </li>
          <li>
            <div class="s-seven-img"></div>
            <p>GMAT/TOEFL/SAT十年培训经验</p>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <script>
    $('.s-int-img>li').mouseover(function () {
      var index = $(this).index();
      $('.s-int-img>li').removeClass('on');
      $(this).addClass('on');
      $('.s-introduce-font').removeClass('on');
      $('.s-introduce-font').eq(index).addClass('on');
    })
  </script>
