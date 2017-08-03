<title>做题详情页</title>
  <link rel="stylesheet" href="/cn/css/mock-details.css">
  <link rel="stylesheet" href="/cn/css/doExercise.css">
  <script src="/cn/js/exercise.js"></script>
  <section class="s-exercise">
    <div class="s-w1200">
      <!--路径导航-->
      <ol class="breadcrumb">
        <li><a href="/index.html">首页</a></li>
        <li><a href="/exercise.html?m=Math"><?php echo $data['major']?></a></li>
        <li class="active"><?php echo $data['name'].'-'.$data['time']?></li>
      </ol>
      <div class="s-top-img">
        <img src="/cn/images/pubClass-dea_03.png" alt="">
      </div>
      <div class="clearfix">
        <!--题目-->
        <div class="s-exam pull-left">
        <!-- 数学-->
          <div class="math-exam work-question-part"  <?php if($data['major']!='Math1'&&$data['major']!='Math2'){echo 'style="display:none;"';}?>>
            <div class="math-title">
              <h3><?php echo $data['name'].'-'.$data['time'].'-'.$data['major']?></h3>
            </div>
            <h2 class="s-num pull-left"><?php echo $data['qid']?>.</h2>
            <div class="s-title" id="subjectId" data-id="<?php echo $data['qid']?>">
              <?php echo $data['content']?>
            </div>
            <!-- 数学选择-->
            <ul class="work-que-list" <?php if($data['isFilling']==1){echo 'style="display:none;"';}?>>
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
            <!--数学填空-->
            <table class="math-table">
              <tr>
                <th colspan="2" class="math-value"></th>
                <th colspan="2">
                  <button value="X"></button>
                  <button value="确定"></button>
                </th>
              </tr>
              <tr class="head">
                <td>
                  <br>
                  <a class="col1" href="javascript:void(0)">.</a>
                </td>
                <td>
                  <a class="col2" href="javascript:void(0)">/</a>
                  <a class="col2" href="javascript:void(0)">.</a>
                </td>
                <td>
                  <a class="col3" href="javascript:void(0)">/</a>
                  <a class="col3" href="javascript:void(0)">.</a>
                </td>
                <td>
                  <br>
                  <a class="col4" href="javascript:void(0)">.</a>
                </td>
              </tr>
              <tr>
                <td class="zero"><br></td>
                <td class="zero"><a class="col2" href="javascript:void(0)">0</a></td>
                <td class="zero"><a class="col3" href="javascript:void(0)">0</a></td>
                <td class="zero"><a class="col4" href="javascript:void(0)">0</a></td>
              </tr>
              <tr>
                <td><a class="col1" href="javascript:void(0)">1</a></td>
                <td><a class="col2" href="javascript:void(0)">1</a></td>
                <td><a class="col3" href="javascript:void(0)">1</a></td>
                <td><a class="col4" href="javascript:void(0)">1</a></td>
              </tr>
              <tr>
                <td><a class="col1" href="javascript:void(0)">2</a></td>
                <td><a class="col2" href="javascript:void(0)">2</a></td>
                <td><a class="col3" href="javascript:void(0)">2</a></td>
                <td><a class="col4" href="javascript:void(0)">2</a></td>
              </tr>
              <tr>
                <td><a class="col1" href="javascript:void(0)">3</a></td>
                <td><a class="col2" href="javascript:void(0)">3</a></td>
                <td><a class="col3" href="javascript:void(0)">3</a></td>
                <td><a class="col4" href="javascript:void(0)">3</a></td>
              </tr>
              <tr>
                <td><a class="col1" href="javascript:void(0)">4</a></td>
                <td><a class="col2" href="javascript:void(0)">4</a></td>
                <td><a class="col3" href="javascript:void(0)">4</a></td>
                <td><a class="col4" href="javascript:void(0)">4</a></td>
              </tr>
              <tr>
                <td><a class="col4" href="javascript:void(0)">5</a></td>
                <td><a class="col2" href="javascript:void(0)">5</a></td>
                <td><a class="col3" href="javascript:void(0)">5</a></td>
                <td><a class="col4" href="javascript:void(0)">5</a></td>
              </tr>
              <tr>
                <td><a class="col1" href="javascript:void(0)">6</a></td>
                <td><a class="col2" href="javascript:void(0)">6</a></td>
                <td><a class="col3" href="javascript:void(0)">6</a></td>
                <td><a class="col4" href="javascript:void(0)">6</a></td>
              </tr>
              <tr>
                <td><a class="col6" href="javascript:void(0)">7</a></td>
                <td><a class="col2" href="javascript:void(0)">7</a></td>
                <td><a class="col3" href="javascript:void(0)">7</a></td>
                <td><a class="col4" href="javascript:void(0)">7</a></td>
              </tr>
              <tr>
                <td><a class="col7" href="javascript:void(0)">8</a></td>
                <td><a class="col2" href="javascript:void(0)">8</a></td>
                <td><a class="col3" href="javascript:void(0)">8</a></td>
                <td><a class="col4" href="javascript:void(0)">8</a></td>
              </tr>
              <tr>
                <td><a class="col8" href="javascript:void(0)">9</a></td>
                <td><a class="col2" href="javascript:void(0)">9</a></td>
                <td><a class="col3" href="javascript:void(0)">9</a></td>
                <td><a class="col4" href="javascript:void(0)">9</a></td>
              </tr>
            </table>
<!--            <table class="math-gap-table" border="1" align="center" --><?php //if($data['isFilling']==0){echo 'style="display:none;"';}?><!-->-->
<!--              <tr>-->
<!--                <td class="math-gap-result" colspan="4"><input type="text"></td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td class="math-btn">7</td>-->
<!--                <td class="math-btn">8</td>-->
<!--                <td class="math-btn">9</td>-->
<!--                <td class="math-sure" rowspan="2">确定</td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td class="math-btn">4</td>-->
<!--                <td class="math-btn">5</td>-->
<!--                <td class="math-btn">6</td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td class="math-btn">1</td>-->
<!--                <td class="math-btn">2</td>-->
<!--                <td class="math-btn">3</td>-->
<!--                <td class="math-clear" rowspan="2">清空</td>-->
<!--              </tr>-->
<!--              <tr>-->
<!--                <td class="math-btn">0</td>-->
<!--                <td class="math-btn">.</td>-->
<!--                <td class="math-btn">/</td>-->
<!--              </tr>-->
<!--            </table>-->
          </div>
        <!-- 阅读-->
          <div class="read-exam clearfix" <?php if($data['major']=='Math1'||$data['major']=='Math2'){echo 'style="display:none;"';}?>>
            <div class="read-title">
              <p class="pull-right"><?php echo $n?></p>
              <h3><?php echo $data['name'].'-'.$data['time'].'-'.$data['major']?></h3>
            </div>
            <div class="work-wrap-left pull-left">
              <h3><?php echo isset($data['topic'])?$data['topic']:''?></h3>
              <h5><?php echo isset($data['details'])?$data['details']:''?></h5>
              <div class="work-box">
                <div class="read-text">
                  <p>
                    <?php echo isset($data['essay'])?$data['essay']:''?>
                  </p>
                </div>
              </div>
            </div>
            <div class="work-wrap-right pull-right">
              <div class="work-question" id="1">
                <div class="work-question-part clearfix">
                  <div class="clearfix">
                    <h1 class="pull-left"><?php echo $data['number']?>.</h1>
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
          <div class="s-btn-list clearfix">
            <div class="s-collect work-collect pull-left" data-value="<?php echo isset($data['collection'])?$data['collection']:'0'?>">
              <i class="fa fa-star-o"></i>
              <span>收藏</span>
            </div>
            <ul class="s-answer pull-right">
              <li>查看解析</li>
              <li class="last-que" onclick="ajaxEvent(this,'last')" data-id="<?php echo $upid?>">上一题</li>
             <li class="next-que" onclick="ajaxEvent(this,'next')" data-id="<?php echo $nextid?>">下一题</li>
            </ul>
          </div>
          <!--答案解析-->
          <div class="s-answer-show">
            <h3>网友解析:</h3>
            <div class="s-answer-cnt">
              <p>正确答案:<span class="correct-answer"><?php echo $data['answer']?></span></p>
              <p>解析：<?php echo isset($data['analysis'])?$data['analysis']:'无'?></p>
            </div>
          </div>
          <!--讨论区-->
          <div class="discuss-wrap">
            <h3>题目讨论</h3>
            <div class="dis-usr-list">
              <ul>
                <?php static $n=0;foreach($dis as $v){ if($v['pid']==0){$n+=1;?>
                <li>
                  <div class="dis-usr-avatar pull-left"><img src="/cn/images/login.png" alt="用户头像"></div>
                  <div class="dis-usr-cnt pull-left" data-id="<?php echo $v['id']?>">
                    <p>用户<span><?php echo $v['nickname']!=false ? $v['nickname']:$v['username']?></span>发表于<span><?php echo date('Y-m-d H:i:s',$v['createTime'])?></span></p>
                    <p><?php echo $v['detail']?></p>
                  </div>
                  <div class="dis-usr-reply pull-right">
                    <span><?php echo $n?>楼</span>
                    <span class="dis-reply-btn">回复</span>
                  </div>
                  <div style="clear: both;"></div>
                  <div class="reply-wrap clearfix">
                    <ul>
                      <?php foreach ($dis as $val ){if($val['pid']==$v['id']){?>
                      <li class="clearfix">
                        <img src="/cn/images/login.png" alt="用户头像">
                        <span><?php echo $val['nickname']!=false ? $val['nickname']:$val['username']?>:</span>
                        <p class="reply-wrap-cnt"><?php echo $val['detail']?></p>
                        <p class="pull-right"><span><?php echo date('Y-m-d H:i:s',$val['createTime'])?></span><span class="reply-wrap-btn">回复</span></p>
                      </li>
                      <?php }}?>
<!--                      <li class="clearfix">-->
<!--                        <img src="/cn/images/login.png" alt="用户头像">-->
<!--                        <span>lsls:</span>-->
<!--                        <p class="reply-wrap-cnt">fnkdnkmkdmaldl;g;</p>-->
<!--                        <p class="pull-right"><span>2017-10-22 08:30:20</span><span class="reply-wrap-btn">回复</span></p>-->
<!--                      </li>-->
                    </ul>
                    <textarea cols="80" rows="4"></textarea>
                    <input class="pull-right" type="button" value="发表">
                  </div>
                </li>
                <?php }}?>
<!--                <li>-->
<!--                  <div class="dis-usr-avatar pull-left"><img src="/cn/images/login.png" alt="用户头像"></div>-->
<!--                  <div class="dis-usr-cnt pull-left">-->
<!--                    <p>用户<span>jajj</span>发表于<span>2017-08-12 10:22:03</span></p>-->
<!--                    <p>take shape的主语应该是principles，rallies不能做take shape的主语，A错 a practice做rallies的同位语，不合适，B错 C选项应该是as once WAS prohitibed by Communist Chinese leaders, 选项里漏掉了was，C错 D里面最后的“they are”中的they指代不明，到底是中共的领导们呢，还是rallies？</p>-->
<!--                  </div>-->
<!--                  <div class="dis-usr-reply pull-right">-->
<!--                    <span>1楼</span>-->
<!--                    <span class="dis-reply-btn">回复</span>-->
<!--                  </div>-->
<!--                  <div style="clear: both;"></div>-->
<!--                  <div class="reply-wrap clearfix">-->
<!--                    <ul>-->
<!--                      <li class="clearfix">-->
<!--                        <img src="/cn/images/login.png" alt="用户头像">-->
<!--                        <span>lsls:</span>-->
<!--                        <p class="reply-wrap-cnt">fnkdnkmkdmaldl;g;</p>-->
<!--                        <p class="pull-right"><span>2017-10-22 08:30:20</span><span class="reply-wrap-btn">回复</span></p>-->
<!--                      </li>-->
<!--                    </ul>-->
<!--                    <textarea cols="80" rows="4"></textarea>-->
<!--                    <input class="pull-right" type="button" value="发表">-->
<!--                    <div style="clear: both;"></div>-->
<!--                  </div>-->
<!--                </li>-->
              </ul>
            </div>
            <div class="dis-input">
              <textarea name="" id="dis-input-cnt" cols="89" rows="6" placeholder="我来说两句……"></textarea>
            </div>
            <div class="dis-commit clearfix">
              <div class="pull-right"><i class="fa fa-upload"></i>提交</div>
            </div>
          </div>
        </div>
        <!--右侧栏-->
        <div class="exer-side">
          <!-- 相关知识点-->
          <div class="side-know">
            <h3>相关知识点</h3>
              <ul>
                <?php foreach($knowledge as $k=>$v){?>
                  <li><a href="/knowledge_details/<?php echo $v['id']?>.html"><?php echo $v['name']?></a></li>
                <?php }?>
            </ul>
          </div>
          <!-- 最新题目-->
          <div class="side-new">
            <h3>最新题目</h3>
            <ul>
              <?php foreach($question as $k=>$v){?>
                <li><a href="/exercise_details/<?php echo $v['qid']?>.html"><?php echo $v['content']?></a></li>
              <?php }?>
            </ul>
          </div>
          <!-- 模考试题-->
          <div class="side-mock">
            <h3>模考试题</h3>
            <ul>
              <?php foreach($mock as $k=>$v){?>
                <li><a href="/mock_details?<?php echo "tid=".$v['id'];?>"><?php echo $v['name'].$v['time']?></a></li>
              <?php }?>
            </ul>
          </div>
        </div>
    </div>
    <!--遮罩-->
    <div class="work-shade">
      <div class="shade-wrap">
        <h3>答案忘写咯</h3>
        <p class="now-do">这就去做！</p>
      </div>
    </div>
  </section>
</html>