<title>做题详情页</title>
  <link rel="stylesheet" href="/cn/css/mock-details.css">
  <link rel="stylesheet" href="/cn/css/doExercise.css">
  <section class="s-exercise">
    <div class="s-w1200">
      <!--路径导航-->
      <ol class="breadcrumb">
        <li><a href="/index.html">首页</a></li>
        <li><a href="#">数学</a></li>
        <li class="active">SAT-1904</li>
      </ol>
      <div class="s-top-img">
        <img src="/cn/images/pubClass-dea_03.png" alt="">
      </div>
      <div class="clearfix">
        <!--题目-->
        <div class="s-exam pull-left">
        <!-- 数学-->
          <div class="math-exam work-question-part">
            <h2 class="s-num"><?php echo $data['qid']?></h2>
            <p class="s-title">
              <?php echo $data['content']?>
            </p>
            <!-- 数学选择-->
            <ul class="work-que-list" id="subjectId" data-id="<?php echo $data['qid']?>">
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="A">A</div>
                <div class="work-que"> <?php echo $data['keyA']?> </div>
              </li>
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="B">B</div>
                <div class="work-que"> <?php echo $data['keyB']?></div>
              </li>
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="C">C</div>
                <div class="work-que"> <?php echo $data['keyC']?></div>
              </li>
              <li class="work-que-wrap">
                <div class="work-select work-select" data-id="D">D</div>
                <div class="work-que"> <?php echo $data['keyD']?></div>
              </li>
            </ul>
             <!--  数学填空-->
            <table class="math-gap-table" border="1" align="center">
              <tr>
                <td class="math-gap-result" colspan="4"><input type="text"></td>
              </tr>
              <tr>
                <td class="math-btn">7</td>
                <td class="math-btn">8</td>
                <td class="math-btn">9</td>
                <td class="math-sure" rowspan="2">确定</td>
              </tr>
              <tr>
                <td class="math-btn">4</td>
                <td class="math-btn">5</td>
                <td class="math-btn">6</td>
              </tr>
              <tr>
                <td class="math-btn">1</td>
                <td class="math-btn">2</td>
                <td class="math-btn">3</td>
                <td class="math-clear" rowspan="2">清空</td>
              </tr>
              <tr>
                <td class="math-btn">0</td>
                <td class="math-btn">.</td>
                <td class="math-btn">/</td>
              </tr>
            </table>
          </div>
        <!-- 阅读-->
          <div class="read-exam clearfix">
            <div class="work-wrap-left pull-left">
              <h3>Questions l-3 are based on the following passage.</h3>
              <h5>The following passage is an excerpt from Henry James's short story "The Pupil." In this section, Pemberton,the young British tutor, describes some of the hasty trips around Europe during which he came to know his pupil, Morgan Moreen,and Morgan's family. A year after he had come to live with them Mr. and Mrs. Moreen suddenly gave up the villa at Nice. Pemberton had got used to suddenness, having seen it practiced on a considerable scale during two jerky little tours-one in Switzerland the</h5>
              <div class="work-box">
                <div class="read-text">
                  <p>
                    A year after he had come to live with them Mr. and Mrs. Moreen suddenly gave up the villa at Nice. Pemberton had got used to suddenness, having seen it practiced on a considerable scale during two jerky little tours-one in Switzerland the first summer, and the other late in the winter, when they all ran down to Florence and then, at the end of ten days, liking it much less than they had intended, straggled back in mysterious depression. They had returned to Nice "for ever," as they said; but this didn't prevent their squeezing, one rainy muggy May night, into a second-class railway-carriage—you could never tell by which class they would travel-where Pemberton helped them to stow away a wonderful collection of bundles and bags. The explanation of this maneuver was that they had determined to spend the summer "in some bracing place"; but in Paris they dropped into a small furnished apartment-a fourth floor in a third-rate avenue, where there was a smell on the staircase and the portier(1) was hateful— and passed the next four months in blank indigence.
                    The better part of this forced temporary stay belonged to the tutor and his pupil, who, visiting the Invalides(2) and Notre Dame, the Conciergerie and all the museums, took a hundred rewarding rambles. They learned to know their Paris, which was useful, for they came back another year for a longer stay, the
                    general character of which in Pemberton's memory today mixes pitiably and confusedly with that of the first. He sees Morgan's shabby knickerbockers-the everlasting pair that didn't match his blouse and that as he grew longer could only grow faded. He remembers the particular holes in his three or four pairs
                    of colored stockings.
                    Morgan was dear to his mother, but he never was better dressed than was absolutely necessary-partly, no doubt, by his own fault,
                    for he was as indifferent to his appearance as a German philosopher. "My dear fellow, so are you! I don't want to cast you in the shade." Pemberton could have no rejoinder for this—the assertion so closely represented the fact. If however the deficiencies of his own wardrobe were a chapter by themselves
                    he didn't like his little charge to look too poor. Later he used to say "Well, if we're poor, why, after all, shouldn't we look it?" and he consoled himself with thinking there was something rather elderly and gentlemanly in Morgan's disrepair-it differed from the untidiness of the urchin who plays and poils his things. He could trace perfectly the degrees by which, in proportion as her little son confined himself to his tutor for society, Mrs. Moreen shrewdly forbore to renew his garments. She did nothing that didn't show, neglected him because he escaped notice, and then, as he illustrated this clever policy, discouraged at home his public appearances. Her position was logical enough—thosemembers of her family who did show had to be showy.
                    During this period and several others Pemberton was quite aware of how he and his comrade might strike people; wandering
                    languidly through the Jardin des Plantes(3) as if they had nowhere to go, sitting on the winter days in the galleries of the Louvre, so
                    splendidly ironical to the homeless, as if for the advantage of the steam radiators. They joked about it sometimes: it was the sort
                    of joke that was perfectly within the boy's compass. They figured themselves as part of the vast vague hand-to-mouth multitude of
                    the enormous city and pretended they were roud of their position in it-it showed them "such a lot of life" and made them conscious
                    of a democratic brotherhood. If Pemberton couldn't feel a sympathy in destitution with his small companion-for after all Morgan's ond parents would never have let him really suffer-the boy would at least feel it with him, so it came to the same thing. He used sometimes to wonder what people would think they were-to fancy they were looked askance at, as if it might be a suspected case of kidnapping. Morgan wouldn't be taken for a young patrician with a tutor—he wasn't smart enough—though he might pass for his companion's sickly little brother.
                    (1) Hall porter or custodian.
                    (2) Famous Paris monument; site of the tomb of
                    Napoleon.
                    (3) Botanical garden.
                  </p>
                </div>
              </div>
            </div>
            <div class="work-wrap-right pull-right">
              <div class="work-question" id="1">
                <div class="work-question-part clearfix">
                  <div>
                    <h1><?php echo $data['number']?>.</h1>
                    <?php echo $data['content']?>
                  </div>
                  <ul class="work-que-list" id="subjectId" data-id="<?php echo $data['qid']?>">
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="A">A</div>
                      <div class="work-que"><?php echo $data['keyA']?> </div>
                    </li>
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="B">B</div>
                      <div class="work-que"><?php echo $data['keyB']?> </div>
                    </li>
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="C">C</div>
                      <div class="work-que"><?php echo $data['keyC']?> </div>
                    </li>
                    <li class="work-que-wrap clearfix">
                      <div class="work-select" data-id="D">D</div>
                      <div class="work-que"><?php echo $data['keyD']?> </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="correct-ans-hide">正确答案：<span><?php echo $data['answer']?></span></div>
          <div class="s-btn-list clearfix">
            <div class="s-collect work-collect pull-left" data-value="<?php echo isset($data['collection'])?$data['collection']:'0'?>">
              <i class="fa fa-star-o"></i>
              <span>收藏</span>
            </div>
            <ul class="s-answer pull-right">
              <li>查看答案</li>
              <li><a class="last-que" onclick="noQuestion(this)" href="/exercise_details/<?php echo $upid?>.html" data-id="">上一题</a></li><a>
              <li><a class="next-que" onclick="noQuestion(this)" href="/exercise_details/<?php echo $nextid?>.html" data-id="">下一题</a></li>
            </ul>
          </div>
          <!--答案解析-->
          <div class="s-answer-show">
            <h3>题目解析:</h3>
            <div class="s-answer-cnt">
              <p>正确答案:<span class="correct-answer"><?php echo $data['answer']?></span></p>
              <p>解析：<?php echo isset($data['analysis'])?$data['analysis']:'无'?></p>
            </div>
          </div>
        </div>
        <!--右侧栏-->
        <div class="s-adv pull-right">
          <a href="#">
            <img class="s-adv-img" src="/cn/images/pubClass-dea_11.png" alt="">
          </a>
          <div class="s-code">
            <img src="/cn/images/qr-code01.png" alt="">
            <p>扫描关注</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<script>
  $(function () {
    var uId = $.cookie('uid');
    uId = 444;
    // 加载页面时判断是否收藏
    if (($('.s-collect').data('value') == 1) && (uId != '')) {
      var sCollect = $('.s-collect');
      sCollect.addClass('active');
      sCollect.find('i').removeClass('fa-star-o');
      sCollect.find('i').addClass('fa-star');
      sCollect.children('span').html('已收藏');
    }
    //查看答案
    $('.s-exam .s-answer li').click(function () {
      if ($(this).index() == 0) {
        if ($('.s-answer-show').css('display') == 'none') {
          $(this).addClass('active');
          $('.s-exam .s-answer-show').fadeIn(1000)
        } else {
          $(this).removeClass('active');
          $('.s-exam .s-answer-show').fadeOut(300)
        }
      }
    })
    // 判断是否正确
    $('.work-que-wrap').click(function() {
      var ans = $('.work-select.active').data('id');
      if (ans != $('.correct-answer').html()) {
        $(this).find('.work-select').css({
          backgroundColor: 'red',
          borderColor: 'red',
          color: '#fff'
        })
        $('.correct-ans-hide').fadeIn();
      }
    })
//    $('.math-sure').click(function () {
//      var v = eval($('.math-gap-result input').val());
//      v = Math.floor(v*1000)/1000;
//      var r = eval($('.correct-answer').html());
//      r = Math.floor(r*1000)/1000;
//      if (v != r) {
//        $('.correct-ans-hide').fadeIn();
//      }
//    })
  })
//  判断是否最后一道题
  function noQuestion(obj) {
    var _this = $(obj);
    if (_this.data('id') == '') {
      _this.get(0).href = 'javascript:void(0)';
      alert('你真棒，已经把题做完了');
    }
  }
</script>
</html>