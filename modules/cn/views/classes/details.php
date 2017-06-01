<link rel="stylesheet" href="/cn/css/classes-detail.css">
<title>课程详情页</title>
  <section>
    <div class="s-w1200">
      <ol class="breadcrumb">
        <li><a href="#">首页</a></li>
        <li><a href="#">课程</a></li>
        <li class="active"><?php echo$data['cate']?></li>
      </ol>
      <div class="s-course-details clearfix">
        <img class="pull-left" src="/cn/images/cou-details01.png" alt="">
        <div>
          <h2>SAT<?php echo $data['cate']?>课程</h2>
<!--          <span class="s-now">￥--><?php //echo$data['price']?><!--</span>-->
<!--          <span class="s-before">￥--><?php //echo $data['price']*1.2 ?><!--</span>-->
          <p>课时:<?php echo  $data['duration']?></p>
          <p class="s-object">课程对象：<span><?php echo $data['student']?></span></p>
          <a href="#">立即预约</a>
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
            <p><?php echo $data['introduction']?>
            </p>
          </div>
          <div role="tabpanel" class="tab-pane" id="teacher">
            <div class="s-introduce-img">
              <span class="s-top-left"></span>
              <img class="s-big-img" src="<?php if(isset($teacher['pic'])){echo $teacher['pic'];}else{echo '/cn/images/course-basis01.png';}?>" alt="">
              <span class="s-bottom-right"></span>
<!--              <div class="s-down-img">-->
<!--                <img src="/cn/images/course-basis02.png" alt="">-->
<!--                <img src="/cn/images/course-basis03.png" alt="">-->
<!--              </div>-->
            </div>
            <div class="s-introduce-font">
              <h2><?php echo $teacher['name']?></h2>
              <p><?php echo $teacher['introduction']?>
              </p>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="plan">
            <div>
              <h2></h2>
              <p>1.全程线上题库、模考平台</br>
                2.学管跟进</br>
                3.词汇打卡群</br>
                4.长难句训练营</br>
                5.每月模考真题课</p>
            </div>
<!--            <div>-->
<!--              <h2>Day 2</h2>-->
<!--              <p>Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet-->
<!--                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet-->
<!--                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet-->
<!--                Nam id semper purus, sit amet scelerisque justo. Proin in blandNam id semper purus, sit amet</p>-->
<!--            </div>-->
          </div>
        </div>
      </div>
      <div class="s-policy clearfix">
        <h2>报前必读</h2>
        <img class="pull-left" src="/cn/images/qr-code01.png" alt="">
        <ul>
          <li>1、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
          <li>2、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
          <li>3、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
          <li>4、本课程为定制课程，报名前请咨询官方客服（扫描左边二维码）</li>
        </ul>
      </div>
    </div>
  </section>
