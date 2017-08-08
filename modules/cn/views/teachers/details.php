
  <link rel="stylesheet" href="/cn/css/teacher-detail.css">
  <section class="s-teacher-detail s-w1200">
    <a href="#" class="s-adv">
      <img src="/cn/images/teacher-bc.jpg" alt="">
    </a>
    <div class="s-introduce clearfix">
      <div class="s-head-img pull-left">
        <img class="img-circle border-blue" src="<?php echo $data['pic']?>" alt="">
      </div>
      <div class="s-cnt">
        <h2><?php echo $data['name']?> SAT主讲名师</h2>
        <a class="border-blue" href="http://p.qiao.baidu.com/im/index?siteid=7905926&ucid=18329536&cp=&cr=&cw=" target="_blank">点我聊聊</a>
        <p class="s-cnt-introduce"><?php echo $data['introduction']?></p>
        <div class="s-title">
          <img src="/cn/images/teacher-detail02.png" alt="成功案例">
          <h3>成功案例</h3>
        </div>
        <ul>
          <?php foreach($brr as $v){?>
          <li>
            <p><?php echo $v['str1']?></p>
            <p><?php echo $v['str2']?></p>
          </li>
          <?php }?>
        </ul>
        <img class="s-foot-img" src="/cn/images/teacher-detail03.png" alt="图片">
      </div>
    </div>
  </section>
