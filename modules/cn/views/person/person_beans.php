<link rel="stylesheet" href="/cn/css/person.css">
<script src="/cn/js/jqPaginator.js"></script>
<script src="/cn/js/person.js"></script>
<section class="s-w1200 s-information">
  <div class="person-wrap clearfix">
    <?php use app\commands\front\PersonWidget;?>
    <?php PersonWidget::begin();?>
    <?php PersonWidget::end();?>
    <div class="person-cnt pull-left">
      <div class="balanceTop">
        <div class="balance-left">
          <span>雷豆账户余额</span>
          <h1 class="integral orangeColor"></h1>
        </div>
        <div class="balance-right">
          <input type="button" value="显示明细" onclick="showTable(this)"/>
          <a href="http://order.gmatonline.cn/pay/order/integral?url=http://www.toeflonline.cn/user/integral.html"><input type="button" value="立即充值"/></a>
        </div>
        <div style="clear: both"></div>
        <div>
          <table class="integral_table">
            <tr>
              <th>雷豆行为</th>
              <th>行为时间</th>
              <th>获得/扣除雷豆</th>
              <th>备注</th>
            </tr>
          </table>
        </div>
      </div>
      <div class="balanceBottom">
        <h1><span></span>雷豆说明</h1>
        <ul>
          <li>
            <p class="orangeColor">1、雷豆规则</p>
            <span>每位雷哥托福会员用户都会有属于自己的雷豆，注册成为www.toeflonline.cn会员获得10个雷豆，每练习一道题目获取2个雷豆，做题数量越多，正确率越高，得到的雷豆越多~</span>
          </li>
          <li>
            <p class="orangeColor">2、如何获得雷豆</p>
                        <span>会员注册成功获得10雷豆 <br>
                          <!--                        每邀请1个好友注册会员成功，奖励50分 <br>-->
                        每练习一道题将获得2雷豆</span>
          </li>
          <li>
            <p class="orangeColor">3、雷豆怎么用（每100雷豆=1元）</p>
            <span>雷豆可用于购买课程，邀请名师点评口语</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
