<script src="/cn/js/highcharts.js"></script>
<script src="/cn/js/report-details.js"></script>

<section>
  <div class="report-bnr-cnt">
    <span>lala</span>
    同学你好,以下是你的考试分析报告
  </div>
  <div class="report-wrap clearfix">
    <div class="report-cnt pull-left">
      <!-- 成绩与正确率-->
      <div class="report-score">
        <h3>成绩</h3>
        <div class="score">
          <p>本次得分<span></span>分</p>
          <p>答对<span></span>题</p>
          <p>答题所用时间<span></span>min</p>
        </div>
        <div class="accuracy">
          <h5>正确率</h5>
          <div class="accuracy-chart" id="accuChart"></div>
          <ul class="accuracy-list">
            <li>
              <span></span>
              <i>正确</i>
            </li>
            <li>
              <span class="sub-red"></span>
              <i>错误</i>
            </li>
            <li>
              <span class="sub-blue"></span>
              <i>放弃</i>
            </li>
          </ul>
        </div>
      </div>
      <!--复习策略 -->
      <div class="report-review">
        <h3>复习策略</h3>
      </div>
      <!--做题详情-->
      <div class="report-details">
        <h3>做题详情</h3>
      </div>
    </div>
    <div class="report-side pull-right"></div>
  </div>
</section>