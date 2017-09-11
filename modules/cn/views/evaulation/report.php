<link rel="stylesheet" href="/cn/css/eval-report.css">
<script src="/cn/js/eval-report.js"></script>
<section class="s-w1200">
<!--  广告图-->
  <div class="eval-bnr">
    <div><a href="#">历史测评报告&nbsp;<i>&gt;</i></a></div>
  </div>
<!--测评报告成绩-->
  <div class="score">
    <div class="title">
      <h1>成绩分析</h1>
    </div>
    <!--内容-->
    <div class="wrap">
      <ul class="score-top clearfix">
        <li class="total">测评总分：<span>100</span>分</li>
        <li>总正确率<span>60</span>%</li>
        <li>你击败了<span><?php echo $data['win']?></span>人</li>
      </ul>
      <div class="score-cnt clearfix">
        <div class="score-img fl">
          <img src="/cn/images/eval-report02.png" alt="图片">
        </div>
        <div class="score-table fl">
          <table>
            <tr>
              <th>分数</th>
              <th>语言分析能力</th>
              <th>词汇量预估</th>
              <th>理解能力</th>
            </tr>
            <tr>
              <td>0-60分</td>
              <td>不及格</td>
              <td>0-4000</td>
              <td>较弱</td>
            </tr>
            <tr>
              <td>60-90分</td>
              <td>良好</td>
              <td>4000-7000</td>
              <td>良好</td>
            </tr>
            <tr>
              <td>90-120分</td>
              <td>优秀</td>
              <td>7000-15000</td>
              <td>优秀</td>
            </tr>
          </table>
          <p class="score-time fr">你离SAT 1600分还需复习<span>5</span>周</p>
        </div>
      </div>
    </div>
  </div>
<!--  单项结果分析-->
  <div class="single">
    <div class="title">
      <h1>单项结果分析</h1>
      <p>（友情提示：红色是错误答案，绿色是正确答案，点击你的答案可查看具体题目）</p>
    </div>
    <div class="single-cnt">
<!--      词汇-->
      <div class="box clearfix">
        <div class="box-left fl">
          <div class="single-score clearfix">
            <p class="fl"><span><?php echo $data['score']['Vocabulary']?></span>/10分</p>
            <p class="fl"><i class="fa fa-star"></i>词汇</p>
          </div>
          <ul class="single-num">
            <?php foreach($data['que'][1] as $k=>$v){?>
            <li class="<?php echo $v[0]==1?'green':'red'?>"><a href="/exercise_details/<?php echo $v[1]?>.html"><?php echo $k+1?></a></li>
            <?php }?>
<!--            <li class="green"><a href="#">2</a></li>-->
<!--            <li class="red"><a href="#">3</a></li>-->
<!--            <li class="green"><a href="#">4</a></li>-->
<!--            <li class="red"><a href="#">5</a></li>-->
<!--            <li class="green"><a href="#">6</a></li>-->
<!--            <li class="green"><a href="#">7</a></li>-->
<!--            <li class="red"><a href="#">8</a></li>-->
<!--            <li class="green"><a href="#">9</a></li>-->
<!--            <li class="green"><a href="#">10</a></li>-->
          </ul>
        </div>
        <div class="box-right fr">
          <p class="headline"><i class="fa fa-star"></i>你的词汇能力</p>
          <div class="advice-wrap clearfix">
            <div class="circle-wrap fr">
              <?php if($data['score']['Vocabulary']<5){?>
              <p class="circle">0-4分</p>
                <p>一般</p>
              <?php }elseif($data['score']['Vocabulary']>=5&&$data['score']['Vocabulary']<9){?>
              <p class="circle">5-8分</p>
              <p>良好</p>
              <?php }else{?>
              <p class="circle">9-10分</p>
              <p>优秀</p>
              <?php }?>
            </div>
            <div class="advice-cnt">
              <?php echo $data['suggest']['Vocabulary']!=false?$data['suggest']['Vocabulary']:'无'?>
            </div>
          </div>
        </div>
      </div>
<!--      文法-->
      <div class="box clearfix">
        <div class="box-left fl">
          <div class="single-score clearfix">
            <p class="fl"><span><?php echo $data['score']['Writing']?></span>/20分</p>
            <p class="fl"><i class="fa fa-star"></i>语法</p>
          </div>
          <ul class="single-num">
            <?php foreach($data['que'][2] as $k=>$v){?>
              <li class="<?php echo $v[0]==1?'green':'red'?>"><a href="/exercise_details/<?php echo $v[1]?>.html"><?php echo $k+1?></a></li>
            <?php }?>
          </ul>
        </div>
        <div class="box-right fr">
          <p class="headline"><i class="fa fa-star"></i>你的文法能力</p>
          <div class="advice-wrap clearfix">
            <div class="circle-wrap fr">
              <?php if($data['score']['Writing']<10){?>
                <p class="circle">0-9分</p>
                <p>一般</p>
              <?php }elseif($data['score']['Writing']>=10&&$data['score']['Writing']<16){?>
                <p class="circle">10-15分</p>
                <p>良好</p>
              <?php }else{?>
                <p class="circle">16-20分</p>
                <p>优秀</p>
              <?php }?>
            </div>
            <div class="advice-cnt">
              <?php echo $data['suggest']['Writing']!=false?$data['suggest']['Writing']:'无'?>
            </div>
          </div>
        </div>
      </div>
<!--      句子翻译-->
      <div class="box clearfix">
        <div class="box-left fl">
          <div class="single-score clearfix">
            <p class="fl"><span><?php echo $data['score']['Translation']?></span>/30分</p>
            <p class="fl"><i class="fa fa-star"></i>句子翻译</p>
          </div>
          <ul class="single-num">
            <?php foreach($data['que'][3] as $k=>$v){?>
              <li class="<?php echo $v[0]==1?'green':'red'?>"><a href="/exercise_details/<?php echo $v[1]?>.html"><?php echo $k+1?></a></li>
            <?php }?>
          </ul>
        </div>
        <div class="box-right fr">
          <p class="headline"><i class="fa fa-star"></i>你的句子翻译能力</p>
          <div class="advice-wrap clearfix">
            <div class="circle-wrap fr">
              <?php if($data['score']['Translation']<11){?>
                <p class="circle">0-10分</p>
                <p>一般</p>
              <?php }elseif($data['score']['Translation']>=10&&$data['score']['Translation']<21){?>
                <p class="circle">10-20分</p>
                <p>良好</p>
              <?php }else{?>
                <p class="circle">21-30分</p>
                <p>优秀</p>
              <?php }?>
            </div>
            <div class="advice-cnt">
              <?php echo $data['suggest']['Translation']!=false?$data['suggest']['Translation']:'无'?>
            </div>
          </div>
        </div>
      </div>
<!--      阅读-->
      <div class="box clearfix">
        <div class="box-left fl">
          <div class="single-score clearfix">
            <p class="fl"><span><?php echo $data['score']['Reading']?></span>/30分</p>
            <p class="fl"><i class="fa fa-star"></i>阅读</p>
          </div>
          <ul class="single-num">
            <?php foreach($data['que'][4] as $k=>$v){?>
              <li class="<?php echo $v[0]==1?'green':'red'?>"><a href="/exercise_details/<?php echo $v[1]?>.html"><?php echo $k+1?></a></li>
            <?php }?>

          </ul>
        </div>
        <div class="box-right fr">
          <p class="headline"><i class="fa fa-star"></i>你的理解能力</p>
          <div class="advice-wrap clearfix">
            <div class="circle-wrap fr">
              <?php if($data['score']['Reading']<11){?>
                <p class="circle">0-10分</p>
                <p>一般</p>
              <?php }elseif($data['score']['Reading']>=10&&$data['score']['Reading']<21){?>
                <p class="circle">10-20分</p>
                <p>良好</p>
              <?php }else{?>
                <p class="circle">21-30分</p>
                <p>优秀</p>
              <?php }?>
            </div>
            <div class="advice-cnt">
              <?php echo $data['suggest']['Reading']!=false?$data['suggest']['Reading']:'无'?>
            </div>
          </div>
        </div>
      </div>
<!--      数学-->
      <div class="box clearfix">
        <div class="box-left fl">
          <div class="single-score clearfix">
            <p class="fl"><span><?php echo $data['score']['Math']?></span>/30分</p>
            <p class="fl"><i class="fa fa-star"></i>数学</p>
          </div>
          <ul class="single-num">
            <?php foreach($data['que'][5] as $k=>$v){?>
              <li class="<?php echo $v[0]==1?'green':'red'?>"><a href="/exercise_details/<?php echo $v[1]?>.html"><?php echo $k+1?></a></li>
            <?php }?>
          </ul>
        </div>
        <div class="box-right fr">
          <p class="headline"><i class="fa fa-star"></i>你的数学能力</p>
          <div class="advice-wrap clearfix">
            <div class="circle-wrap fr">
              <?php if($data['score']['Math']<11){?>
                <p class="circle">0-10分</p>
                <p>一般</p>
              <?php }elseif($data['score']['Math']>=10&&$data['score']['Math']<21){?>
                <p class="circle">10-20分</p>
                <p>良好</p>
              <?php }else{?>
                <p class="circle">21-30分</p>
                <p>优秀</p>
              <?php }?>
            </div>
            <div class="advice-cnt">
              <?php echo $data['suggest']['Math']!=false?$data['suggest']['Math']:'无'?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--  整体语言情况分析-->
  <div class="language">
    <div class="title">
      <h1>你的整体语言情况分析</h1>
    </div>
    <div class="language-wrap clearfix">
      <div class="lang-img fl"></div>
      <div class="lang-font fl">
        <?php echo $data['score']['score']?>：<?php echo $data['suggest']['All']!=false?$data['suggest']['All']:'无'?>
      </div>
    </div>
  </div>
<!--  SAT报班建议-->
  <div class="classes">
    <div class="title">
      <h1>SAT报班建议</h1>
    </div>
    <ul class="clearfix">
      <?php if($data['score']['score']<61) {?>
      <li>
        <div class="classes-top">
          <i class="fa fa-star"></i>
          <p>0~60分</p>
        </div>
        <div class="classes-font">
          <a href="#">雷哥SAT1V1 VIP</a>
          <a href="#">雷哥SAT1V2 VIP</a>
          <a href="#">雷哥SAT全能小班</a>
        </div>
      </li>
      <?php }elseif($data['score']['score']>60&&$data['score']['score']<91){?>
      <li>
        <div class="classes-top">
          <i class="fa fa-star"></i>
          <p>60~90分</p>
        </div>
        <div class="classes-font">
          <a href="#">雷哥SAT1V1 VIP</a>
          <a href="#">雷哥SAT1V2 VIP</a>
          <a href="#">雷哥SAT全能小班</a>
        </div>
      </li>
      <?php }else{?>
      <li>
        <div class="classes-top">
          <i class="fa fa-star"></i>
          <p>90~120分</p>
        </div>
        <div class="classes-font">
          <a href="#">雷哥SAT1V1 VIP</a>
          <a href="#">雷哥SAT1V2 VIP</a>
          <a href="#">雷哥SAT全能小班</a>
        </div>
      </li>
      <?php }?>
    </ul>
  </div>
</section>