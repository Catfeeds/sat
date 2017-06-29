
  <link rel="stylesheet" href="/cn/css/mock.css">
  <section class="s-w1200 clearfix">
    <div class="s-mock-cnt pull-left">
      <!--全套模考-->
      <div class="s-all-mock">
        <h2 class="s-title">全套模考</h2>
        <ul class="s-tag" role="tablist">
          <li role="presentation" class="active"><a href="#mockAll" aria-controls="mockAll" role="tab" data-toggle="tab">全部</a></li>
          <li role="presentation"><a href="#OG" aria-controls="OG" role="tab" data-toggle="tab">OG</a></li>
          <li role="presentation"><a href="#Princeton" aria-controls="Princeton" role="tab" data-toggle="tab">普林斯顿</a></li>
          <li role="presentation"><a href="#Kaplan" aria-controls="Kaplan" role="tab" data-toggle="tab">开普兰</a></li>
          <li role="presentation"><a href="#Barron" aria-controls="Barron" role="tab" data-toggle="tab">BARRON</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="mockAll">
            <ul class="s-subject">
              <?php foreach($data as $k=>$v){
                if($k==0){
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">'.$v['name'].$v['time'].'</a></li>';
                }else{
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="OG">
            <ul class="s-subject">
              <?php foreach($og as $k=>$v){
                if($k==0) {
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">' . $v['name'] . $v['time'] . '</a></li>';
                }else{
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>

            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="Princeton">
            <ul class="s-subject">
              <?php foreach($princeton as $k=>$v){
                if($k==0) {
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">'.$v['name'] . $v['time'] . '</a></li>';
                }else{
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>

            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="Kaplan">
            <ul class="s-subject">
              <?php foreach($kaplan as $k=>$v){
                if($k==0) {
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">' . $v['name'] . $v['time'] . '</a></li>';
                }else{
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="Barron">
            <ul class="s-subject">
              <?php foreach($barron as $k=>$v){
                if($k==0) {
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">' . $v['name'] . $v['time'] . '</a></li>';
                }else{
                  echo ' <li><a href="mock_details?tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>
            </ul>
          </div>
        </div>
      </div>
      <!--单科模考-->
      <div class="s-single-mock">
        <h2 class="s-title">单科模考</h2>
        <ul class="s-tag" role="tablist">
          <li role="presentation" class="active"><a href="#Read" aria-controls="Read" role="tab" data-toggle="tab">阅读</a></li>
          <li role="presentation"><a href="#Math" aria-controls="Math" role="tab" data-toggle="tab">数学</a></li>
          <li role="presentation"><a href="#Write" aria-controls="Write" role="tab" data-toggle="tab">文法</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="Read">
            <ul class="s-subject">
              <?php foreach($data as $k=>$v){
                if($k==0){
                  echo ' <li><a href="mock_details?m=Reading&tid='.$v["id"].'">'.$v['name'].$v['time'].'</a></li>';
                }else{
                  echo ' <li><a href="mock_details?m=Reading&tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="Math">
            <ul class="s-subject">
              <?php foreach($data as $k=>$v){
                if($k==0){
                  echo ' <li><a href="mock_details?m=Math&tid='.$v["id"].'">'.$v['name'].$v['time'].'</a></li>';
                }else{
                  echo ' <li><a href="mock_details?m=Math&tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="Write">
            <ul class="s-subject">
              <?php foreach($data as $k=>$v){
                if($k==0){
                  echo ' <li><a href="mock_details?m=Writing&tid='.$v["id"].'">'.$v['name'].$v['time'].'</a></li>';
                }else{
                  echo ' <li><a href="mock_details?m=Writing&tid='.$v["id"].'">'.$v['name'].$v['time'].'</a><i class="fa fa-lock"></i></li>';
                }
              }?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--侧边栏-->
    <div class="s-mock-side pull-right">
      <!--高分榜-->
      <div class="s-score">
        <h2>全套模考</h2>
        <ul>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
          <li><span>这是名字,显示名字</span><span>这是做的第几套考试题</span><span>1340分</span></li>
        </ul>
      </div>
    </div>
  </section>
  <!--底部-->

<script>
  jQuery(".s-mock-side").slide({mainCell:".s-score ul",autoPlay:true,effect:"topMarquee",vis:8,interTime:100});
  $(function () {
    $('.s-mock-cnt .s-subject li a').click(function () {
      if ($(this).next().hasClass('fa-lock')) {
        if (!sessionStorage.getItem('userId')) {
          alert('请登录');
          return false;
        }
      }
    })
  })
</script>