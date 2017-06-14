 <title>知识库</title>
  <link rel="stylesheet" href="/cn/css/respository.css">
 
  <section class="s-respository">
    <div class="s-w1200 clearfix">
      <div class="s-tag-list pull-left">
        <ul role="tablist">
          <li role="presentation" class="active">
            <a class="active" href="#first" aria-controls="first" role="tab" data-toggle="tab">表达</a>
          </li>
          <li role="presentation">
            <a href="#second" aria-controls="second" role="tab" data-toggle="tab">语法</a>
          </li>
          <li role="presentation">
            <a href="#third" aria-controls="third" role="tab" data-toggle="tab">Math</a>
          </li>
        </ul>
      </div>
      <div class="s-tag-cnt tab-content">
        <div role="tabpanel" class="tab-pane active" id="first">
          <ul class="s-development">
            <h3>Development</h3>
            <?php foreach ($data as $v){if($v['cate']=='development'){?>
            <li><a href="#"><?echo $v['name']?></a></li>
            <?php }}?>
          </ul>
          <ul class="s-organization">
          <h3>Organization</h3>
            <?php foreach ($data as $v){if($v['cate']=='organization'){?>
              <li><a href="#"><?echo $v['name']?></a></li>
            <?php }}?>
<!--          <li><a href="#">precision</a></li>-->
<!--          <li><a href="#">concision</a></li>-->
<!--          <li><a href="#">syntax</a></li>-->
<!--          <li><a href="#">style and tone</a></li>-->
        </ul>
          <ul class="s-effective">
            <h3>Effective language use</h3>
            <?php foreach ($data as $v){if($v['cate']=='effective language use'){?>
              <li><a href="#"><?echo $v['name']?></a></li>
            <?php }}?>
<!--            <li><a href="#">proposition</a></li>-->
<!--            <li><a href="#">support</a></li>-->
<!--            <li><a href="#">focus</a></li>-->
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="second">
          <ul class="s-structure">
            <h3>Structure</h3>
            <?php foreach ($data as $v){if($v['cate']=='structure'){?>
              <li><a href="#"><?echo $v['name']?></a></li>
            <?php }}?>
<!--            <li><a href="#">sentence boundaries</a></li>-->
<!--            <li><a href="#">parallet structure</a></li>-->
<!--            <li><a href="#">verb form</a></li>-->
<!--            <li><a href="#">modifier placement</a></li>-->
<!--            <li><a href="#">subordination and coordination</a></li>-->
          </ul>
          <ul class="s-usage">
            <h3>Usage</h3>
            <?php foreach ($data as $v){if($v['cate']=='usage'){?>
              <li><a href="#"><?echo $v['name']?></a></li>
            <?php }}?>
<!--            <li><a href="#">possessive</a></li>-->
<!--            <li><a href="#">pronoun</a></li>-->
<!--            <li><a href="#">agreement</a></li>-->
<!--            <li><a href="#">comparison</a></li>-->
<!--            <li><a href="#">conventional expression</a></li>-->
<!--            <li><a href="#">confused words</a></li>-->
          </ul>
          <ul class="s-punctutation">
            <h3>Punctutation</h3>
            <?php foreach ($data as $v){if($v['cate']=='punctutation'){?>
              <li><a href="#"><?echo $v['name']?></a></li>
            <?php }}?>
<!--            <li><a href="#">end-of-sentence</a></li>-->
<!--            <li><a href="#">within-in</a></li>-->
<!--            <li><a href="#">items in a series</a></li>-->
<!--            <li><a href="#">unnecessary punctuation</a></li>-->
<!--            <li><a href="#">possessive nouns and prononus</a></li>-->
<!--            <li><a href="#">non-restrictive and parenthetical elements</a></li>-->
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="third">3</div>
      </div>
      <div class="s-cnt"></div>
    </div>
  </section>
 