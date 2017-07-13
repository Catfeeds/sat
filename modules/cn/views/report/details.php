
    <link rel="stylesheet" href="/cn/css/report-details.css">
    <script src="/cn/js/highcharts.js"></script>
    <script src="/cn/js/report-details.js"></script>

<!--导航-->

<!--内容区域-->
<section class="s-w1200">
    <!--头部banner区-->
    <div class="report-banner">
        <div class="report-bnr-cnt">
            <span><?php echo ($user['nickname']!=false)?$user['nickname']:''?></span>
            同学你好,以下是你的考试分析报告
        </div>
    </div>
    <div class="report-cnt">
        <!--总成绩、时间-->
        <div class="report-total-score container-fluid">
            <h3 class="report-title">成绩</h3>
            <div class="report-score-wrap report-wrap row">
                <div class="col-md-6 col-sm-6">
                    <table class="report-score-table">
                        <tr>
                            <th>阅读</th>
                            <th>文法</th>
                            <th>数学</th>
                            <th>总题数</th>
                            <th>总成绩</th>
                        </tr>
                        <tr>
                            <td><?php echo $report['Reading']?></td>
                            <td><?php echo $report['Writing']?></td>
                            <td><?php echo $report['Math']?></td>
                            <td>154</td>
                            <td><?php echo $report['total']?></td>
                        </tr>
                    </table>
                    <ul class="report-score-other">
                        <li>
                            <span class="other-title">SubScores</span>
                            <span class="other-score"><?php echo $report['subScore']?></span>
                        </li>
                        <li>
                            <span class="other-title">Cross-Test Scores</span>
                            <span class="other-score"><?php echo $report['crossScore']?></span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="report-time" id="reportTime"></div>
                </div>
            </div>
        </div>
        <!--各学科正确率分析-->
        <div class="report-subject container-fluid">
            <h3 class="report-title">正确率分析</h3>
            <div class="report-wrap row">
                <!--阅读-->
                <div class="report-reading col-md-4 col-sm-4">
                    <h4 class="report-sub-title">阅读</h4>
                    <div class="report-sub-chart" id="repReading"></div>
                    <ul class="report-sub-list">
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
                <!--文法-->
                <div class="report-writing col-md-4 col-sm-4">
                    <h4 class="report-sub-title">文法</h4>
                    <div class="report-sub-chart" id="repWriting"></div>
                    <ul class="report-sub-list">
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
                <!--数学-->
                <div class="report-math col-md-4 col-sm-4">
                    <h4 class="report-sub-title">数学</h4>
                    <div class="report-sub-chart" id="repMath"></div>
                    <ul class="report-sub-list">
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
        </div>
        <!--历史成绩曲线图-->
        <div class="report-history">
            <h3 class="report-title">历史成绩</h3>
            <div class="report-wrap" id="reportHistory"></div>
        </div>
        <!--复习策略建议-->
        <div class="report-advice">
            <h3 class="report-title">复习策略</h3>
            <div class="report-wrap">
                <ul class="advice-list">
                    <li class="advice-cnt">
                        <div class="advice-title">阅读</div>
                        <p><?php echo ($suggest['Reading']!=false) ? $suggest['Reading']['suggestion'] : '无'?></p>
                    </li>
                    <li class="advice-cnt advice-cnt2">
                        <div class="advice-title">文法</div>
                        <p><?php echo ($suggest['Writing']!=false) ? $suggest['Writing']['suggestion'] : '无'?></p>
                    </li>
                    <li class="advice-cnt">
                        <div class="advice-title">数学</div>
                        <p><?php echo ($suggest['Math']!=false) ? $suggest['Math']['suggestion'] : '无'?></p>
                    </li>
                </ul>
                <img class="advice-img" src="/cn/images/report01.png" alt="">
            </div>
        </div>
        <!--答题情况详解-->
        <div class="report-details">
            <h3 class="report-title">答题情况</h3>
            <div class="report-wrap">
                <ul class="rep-subject">
                    <li>阅读section1</li>
                    <li>文法sesction2</li>
                    <li>数学section3</li>
                    <li>数学section4</li>
                </ul>
                <div class="ans-cnt">
                    <ul>
                        <li>全部题目</li>
                        <li>查看错题</li>
                        <li>耗时较长题目</li>
                    </ul>
                    <ol>
                        <li>
                            
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--底部-->
<script>
    $(function () {
        barChart('reportTime',[[parseInt(<?php echo Yii::$app->session->get('time')/60?>),230]],["你的时间","标准时间"],["做题时间"],{xAxisColor:'#002D71', xRotation:0, title: "做题时间", subtitle:'', yAxisUnit: '(min)', color: ['#36B2FB'], min: 0, max: 230, tooltipUnit: 'min', showValue: true})
        // 阅读
        pieChart('repReading',[parseInt('<?php echo $report['readnum']/52*100?>'),parseInt('<?php echo $report['readerror']/52*100?>'),parseInt('<?php echo (52-$report['readnum']-$report['readerror'])/52*100?>')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        pieChart('repWriting',[parseInt('<?php echo $report['writenum']/44*100?>'),parseInt('<?php echo $report['writeerror']/44*100?>'),parseInt('<?php echo (44-$report['writenum']-$report['writeerror'])/44*100?>')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        pieChart('repMath',[parseInt('<?php echo $report['mathnum']/58*100?>'),parseInt('<?php echo $report['matherror']/58*100?>'),parseInt('<?php echo ((58-$report['mathnum']-$report['matherror'])/58)*100?>')],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        lineChart('reportHistory',[[1200,1350,1400,1500]],['OG第一套','BARRON第二套','开普兰第一套','OG第四套'],['分数'],{title: '历史成绩曲线图',min: 0,max: 1600,tooltipUnit: '分',showValue: true});
    })
</script>
