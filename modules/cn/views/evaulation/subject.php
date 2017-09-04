
<link rel="stylesheet" href="/cn/css/mock-details.css">
<link rel="stylesheet" href="/cn/css/eval-subject.css">
<script src="/cn/js/eval-subject.js"></script>

<div class="work-mk">
  <!-- 头部-->
  <div class="work-mk-top container">
    <div class="work-top-cnt row">
      <p class="work-title-pos col-lg-2 col-md-2"></p>
      <h1 class="work-main-title col-lg-8 col-md-8">初级测评--
        <span id="secNum" data-id="<?php echo isset($data[0])&&$data[0]!=false?$data[0]['tid']:''?>" data-sec="<?php echo isset($data[0])&&$data[0]!=false?$data[0]['section']:''?>">Section<?php echo isset($data[0])&&$data[0]!=false?$data[0]['section']:''?></span><b>:</b><span id="secName"><?php echo isset($data[0])&&$data[0]!=false?$data[0]['major']:''?></span>
      </h1>
<!--      <h1 class="work-main-title col-lg-8 col-md-8">--><?php //echo isset($data[0])&&$data[0]!=false?$data[0]['name'].$data[0]['time']:''?><!------>
<!--        <span id="secNum" data-id="--><?php //echo isset($data[0])&&$data[0]!=false?$data[0]['tid']:''?><!--" data-sec="--><?php //echo isset($data[0])&&$data[0]!=false?$data[0]['section']:''?><!--">Section--><?php //echo isset($data[0])&&$data[0]!=false?$data[0]['section']:''?><!--</span><b>:</b><span id="secName">--><?php //echo isset($data[0])&&$data[0]!=false?$data[0]['major']:''?><!--</span>-->
<!--      </h1>-->
    </div>
  </div>
  <!-- 内容区域-->
  <div class="work-mk-cnt clearfix">
    <!--  词汇-->
    <div class="work-wrap-left pull-left">
      <ul class="words-ul">
        <?php foreach($data as $k=>$v){if($k<5){?>
        <li class="work-question-part">
          <span class="num pull-left"><?php echo $v['number']?>.</span>
          <div class="question">
            <?php echo $v['content']?>
          </div>
          <ul class="work-que-list" data-pid="<?php echo $v['qid']?>">
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="A">A</div>
              <div class="work-que"><?php echo $v['keyA']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="B">B</div>
              <div class="work-que"><?php echo $v['keyB']?> </div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="C">C</div>
              <div class="work-que"><?php echo $v['keyC']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="D">D</div>
              <div class="work-que"><?php echo $v['keyD']?> </div>
            </li>
          </ul>
        </li>
        <?PHP }}?>
      </ul>
    </div>
    <div class="work-wrap-right pull-right" >
      <ul class="words-ul">
        <?php foreach($data as $k=>$v){if($k>4){?>
        <li class="work-question-part">
          <span class="num pull-left"><?php echo $v['number']?>.</span>
          <div class="question">
            <?php echo $v['content']?>
          </div>
          <ul class="work-que-list" data-pid="<?php echo $v['qid']?>">
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="A">A</div>
              <div class="work-que"><?php echo $v['keyA']?> </div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="B">B</div>
              <div class="work-que"><?php echo $v['keyB']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="C">C</div>
              <div class="work-que"><?php echo $v['keyC']?></div>
            </li>
            <li class="work-que-wrap clearfix">
              <div class="work-select" data-id="D">D</div>
              <div class="work-que"><?php echo $v['keyD']?></div>
            </li>
          </ul>
        </li>
        <?PHP }}?>
      </ul>
    </div>
    <!-- 语法-->
<!--    <div class="work-wrap-left pull-left" style="display: none;">-->
<!--      <div class="grammer">-->
<!--        <div class="article">-->
<!--          I hunted for 30 years for various reasons, mostly because my grandfather and-->
<!--          my father did. We ate what we killed. I began _1_(look) at hunting differently-->
<!--          in November 1989.That day I happened _2_ (walk) in the forest when a deer hunter-->
<!--          shot me in the leg. The irresponsible hunter left me for death. Loading me in a truck,-->
<!--          my twelve-year-old son drove me 40 miles to a hospital. That did give me a solid taste-->
<!--          of what the animals endured. I started _3_ (understand) that the animal was not just-->
<!--          a target, but a living thing, a thing that suffered when shot, a thing that I had no-->
<!--          right _4_ (kill). I was sorry _5_ (kill) so many animals. To help animals, rather than-->
<!--          kill them, is of great importance to me.-->
<!--        </div>-->
<!--        <ul class="article-list">-->
<!--          <li>-->
<!--            <label>1.</label>-->
<!--            <input class="article-input" type="text">-->
<!--          </li>-->
<!--          <li>-->
<!--            <label>2.</label>-->
<!--            <input class="article-input" type="text">-->
<!--          </li>-->
<!--          <li>-->
<!--            <label>3.</label>-->
<!--            <input class="article-input" type="text">-->
<!--          </li>-->
<!--          <li>-->
<!--            <label>4.</label>-->
<!--            <input class="article-input" type="text">-->
<!--          </li>-->
<!--          <li>-->
<!--            <label>5.</label>-->
<!--            <input class="article-input" type="text">-->
<!--          </li>-->
<!--        </ul>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right" style="display: none;">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <span class="num pull-left">1.</span>-->
<!--          <div class="question">-->
<!--            Remember _______ the newspaper when you have finished it.-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">putting back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que"> put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">to put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">be put back </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <span class="num pull-left">2.</span>-->
<!--          <div class="question">-->
<!--            Remember _______ the newspaper when you have finished it.-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">putting back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que"> put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">to put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">be put back </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <span class="num pull-left">3.</span>-->
<!--          <div class="question">-->
<!--            Remember _______ the newspaper when you have finished it.-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">putting back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que"> put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">to put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">be put back </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <span class="num pull-left">4.</span>-->
<!--          <div class="question">-->
<!--            Remember _______ the newspaper when you have finished it.-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">putting back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que"> put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">to put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">be put back </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <span class="num pull-left">5.</span>-->
<!--          <div class="question">-->
<!--            Remember _______ the newspaper when you have finished it.-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">putting back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que"> put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">to put back </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">be put back </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
    <!--句子翻译-->
<!--    <div class="work-wrap-left pull-left" style="display: none;" >-->
<!--      <ul class="translate">-->
<!--        <li>-->
<!--          <span class="pull-left">1.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="12" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">2.</span>-->
<!--          <div class="e-sentence">-->
<!--            New techniques for determining the molecular sequence of the RNA of-->
<!--            organisms have produced evolutionary information about the degree to-->
<!--            which organisms are related, the time since they diverged from a common-->
<!--            ancestor, and the reconstruction of ancestral versions of genes.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="13" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">3.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="14" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">4.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="15" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">5.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="16" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right" style="display: none;">-->
<!--      <ul class="translate">-->
<!--        <li>-->
<!--          <span class="pull-left">1.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="17" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">2.</span>-->
<!--          <div class="e-sentence">-->
<!--            New techniques for determining the molecular sequence of the RNA of-->
<!--            organisms have produced evolutionary information about the degree to-->
<!--            which organisms are related, the time since they diverged from a common-->
<!--            ancestor, and the reconstruction of ancestral versions of genes.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="18" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">3.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="19" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">4.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="20" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--        <li>-->
<!--          <span class="pull-left">5.</span>-->
<!--          <div class="e-sentence">-->
<!--            In order for the far-ranging benefits of individual ownership to be achieved by owners, companies, and countries, employees and other individuals must make their own decisions to buy, and they must commit some of their own resources to the choice.-->
<!--          </div>-->
<!--          <textarea class="translate-ans" data-pid="21" cols="70" rows="5"></textarea>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
    <!--阅读理解-->
<!--    <div class="work-wrap-left pull-left">-->
<!--      <div class="work-box">-->
<!--        <div class="read-text">-->
<!--          A few common misconceptions. Beauty is only skin deep. One’s physical assets and liabilities don’t count all that much in a managerial career. A woman should always try to look her best.-->
<!--          Over the last 30 years, social scientists have conducted more than 1,000 studies of how we react to beautiful and not so beautiful people. The virtually unanimous conclusion: Looks do matter, more than most of us realize. The data suggest, for example, that physically attractive individuals are more likely to be treated well by their parents, sought out as friends, and pursued romantically. With the possible exception of women seeking managerial jobs, they are also more likely to be hired, paid well, and promoted.-->
<!--          Un American, you say, unfair and extremely unbelievable? Once again, the scientists have caught us mouthing pieties while acting just the contrary. Their typical experiment works something like this. They give each member of a group-college students, or teachers or corporate personnel mangers-a piece of paper relating an individual’s accomplishments. Attached to the paper is a photograph. While the papers all say exactly the same thing the pictures are different. Some show a strikingly attractive person, some an average looking character, and some an unusually unattractive human being. Group members are asked to rate the individual on certain attributes, anything from personal warmth to the likelihood that he or she will be promoted.-->
<!--          Almost invariably, the better looking the person in the picture, the higher the person is rated. In the phrase, borrowed from Sappho, that the social scientists use to sum up the common perception, what is beautiful is good.-->
<!--          In business, however, good looks cut both ways for women, and deeper than for men. A Utah State University professor, who is an authority on the subject, explains: In terms of their careers, the impact of physical attractiveness on males is only modest. But its potential impact on females can be tremendous, making it easier, for example, for the more attractive to get jobs where they are in the public eye. On another note, though, there is enough literature now for us to conclude that attractive women who aspire to managerial positions do not get on as well as women who may be less attractive.-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              Experiments by scientists have shown that when people evaluate individuals on certain attributes ________.-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">2.</span>-->
<!--            <div class="question pull-left">-->
<!--              The figure above shows the dimensions of a semicircular cross section of a one-way tunnel. The single traffic lane is 12 feet wide and is equidistant from the sides of the tunnel. If vehicles must clear the top of the tunnel by at least ½ foot when they are inside the traffic lane, what should be the limit on the height of vehicles that are allowed to use the tunnel?-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">答案一 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">答案问 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">答案三 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">答案四 </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">3.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">答案一 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">答案问 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">答案三 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">答案四 </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">答案一 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">答案问 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">答案三 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">答案四 </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">答案一 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">答案问 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">答案三 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">答案四 </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
    <!--数学-->
<!--    <div class="work-wrap-left pull-left" style="display: none;">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">2.</span>-->
<!--            <div class="question pull-left">-->
<!--              The figure above shows the dimensions of a semicircular cross section of a one-way tunnel. The single traffic lane is 12 feet wide and is equidistant from the sides of the tunnel. If vehicles must clear the top of the tunnel by at least ½ foot when they are inside the traffic lane, what should be the limit on the height of vehicles that are allowed to use the tunnel?-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">3.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
<!--    <div class="work-wrap-right pull-right" style="display: none;">-->
<!--      <ul class="words-ul">-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list common-id" id="subjectId" data-id="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">答案一 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">答案问 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">答案三 </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">答案四 </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--        <li class="work-question-part">-->
<!--          <div class="clearfix">-->
<!--            <span class="num pull-left">1.</span>-->
<!--            <div class="question pull-left">-->
<!--              The sides of a square region, measured to the nearest centimeter, are 6 centimeters long. The least possible value of the actual area of the square region is-->
<!--            </div>-->
<!--          </div>-->
<!--          <ul class="work-que-list" data-pid="0000">-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="A">A</div>-->
<!--              <div class="work-que">32.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="B">B</div>-->
<!--              <div class="work-que">34.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="C">C</div>-->
<!--              <div class="work-que">35.00 sq cm </div>-->
<!--            </li>-->
<!--            <li class="work-que-wrap clearfix">-->
<!--              <div class="work-select" data-id="D">D</div>-->
<!--              <div class="work-que">36.00 sq cm </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </div>-->
  </div>
  <!-- 底部-->
  <div class="work-mk-btm container">
    <div class="work-btm-cnt row">
      <div class="work-out col-lg-4 col-md-4">
        <i class="work-out-off fa fa-sign-out"></i>
        <span>离开</span>
      </div>
      <div class="work-time col-lg-4 col-md-4">
        <i class="work-time-icon icon-time"></i>
        <span class="work-time-cnt">测评剩余时间:</span>
        <span>1:54:33</span>
      </div>
      <div class="work-btm-next col-lg-4 col-md-4">
        <a href="#" class='work-next-icon'><i class="fa fa-hand-o-right"></i>NEXT</a>
        <a href='#' class="work-submit"><i class="work-submit fa fa-upload"></i>提交</a>
      </div>
    </div>
  </div>
  <!--遮罩层-->
  <div class="work-shade">
    <!--离开弹窗-->
    <div class="quit-wrap shade-wrap">
      <h3>小主,你忍心弃我而去吗?</h3>
      <div class="shade-select clearfix">
        <span class="exit-out shade-out pull-left">忍心而去</span>
        <span class="shade-in pull-right">逗你玩呢!</span>
      </div>
    </div>
    <!--选择答案弹窗-->
    <div class="next-wrap shade-wrap">
      <h3>答案都木有</h3>
      <h4>(根据SAT考试规定,按照答对题目数得分)</h4>
      <div class="shade-select clearfix">
        <span class="do-next shade-out pull-left">我就是不做</span>
        <span class="shade-in pull-right">这么简单,我来答</span>
      </div>
    </div>
    <!--自动提交弹窗-->
    <div class="auto-wrap shade-wrap">
      <h3>答题时间到,将在5秒后自动提交</h3>
      <h4>点击确定按钮提交</h4>
      <div class="shade-select">
        <p class="auto-time">5</p>
        <span class="make-sure shade-in">确定</span>
      </div>
    </div>
    <!-- 休息弹窗-->
    <div class="relax-wrap shade-wrap">
      <h3>根据规定，您将有五分钟休息时间，休息时间到自动进入到下一小节</h3>
      <h4>(当然您可以点击继续按钮进入到下一小节)</h4>
      <div class="shade-select clearfix">
        <span class="skip-relax shade-in pull-left">继续</span>
        <p class="five-count">
          <i class="fa fa-hourglass-start"></i>
          <span>05:00</span>
        </p>
      </div>
    </div>
  </div>
</div>
