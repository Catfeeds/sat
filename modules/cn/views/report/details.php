
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
        <?php if(Yii::$app->session->get('uid')){?><a href="/person_mock.html">历史报告</a><?php }?>
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
                            <td><?php echo $report['Reading']*10?></td>
                            <td><?php echo $report['Writing']*10?></td>
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
                    <li class="on" data-val="Reading">阅读section1</li>
                    <li data-val="Writing">文法sesction2</li>
                    <li data-val="Math1">数学section3</li>
                    <li data-val="Math2">数学section4</li>
                </ul>
                <div class="ans-cnt">
                    <ul class="ans-classify">
                        <li class="on" data-val="all" data-sub="Reading">全部题目</li>
                        <li data-val="wrong" data-sub="Reading">查看错题</li>
                        <li data-val="long" data-sub="Reading">耗时较长题目</li>
                    </ul>
                    <ol></ol>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="tpId" data-val="<?php echo $report['tpId']?>">
    <input type="hidden" id="rid" data-val="<?php echo isset($report['id'])?$report['id']:''?>">
</section>
<!--底部-->
<script>
    $(function () {
        reportData('Reading','all');
        barChart('reportTime',[[parseInt(<?php echo Yii::$app->session->get('time')/60?>),230]],["你的时间","标准时间"],["做题时间"],{xAxisColor:'#002D71', xRotation:0, title: "做题时间", subtitle:'', yAxisUnit: '(min)', color: ['#36B2FB'], min: 0, max: 230, tooltipUnit: 'min', showValue: true})
        // 阅读
        pieChart('repReading',[parseFloat(Number('<?php echo $report['readnum']/52*100?>').toFixed(1)),parseFloat(Number('<?php echo $report['readerror']/52*100?>').toFixed(1)),parseFloat(Number('<?php echo (52-$report['readnum']-$report['readerror'])/52*100?>').toFixed(1))],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        pieChart('repWriting',[parseFloat(Number('<?php echo $report['writenum']/44*100?>').toFixed(1)),parseFloat(Number('<?php echo $report['writeerror']/44*100?>').toFixed(1)),parseFloat(Number('<?php echo (44-$report['writenum']-$report['writeerror'])/44*100?>').toFixed(1))],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        pieChart('repMath',[parseFloat(Number('<?php echo $report['mathnum']/58*100?>').toFixed(1)),parseFloat(Number('<?php echo $report['matherror']/58*100?>').toFixed(1)),parseFloat(Number('<?php echo ((58-$report['mathnum']-$report['matherror'])/58)*100?>').toFixed(1))],['正确','错误','放弃'], {legendEnable:false, xRotation:-30, title: '', yAxisUnit: '(%)',color: ['#05bc02','#e9604e','#2e9fd9'], min: 0, max: 100, tooltipUnit: '%', showValue: true,distance:-15});
        lineChart('reportHistory',[[<?php echo isset($tp[0]['score'])?$tp[0]['score']:''?>,<?php echo isset($tp[1]['score'])?$tp[1]['score']:''?>,<?php echo isset($tp[2]['score'])?$tp[2]['score']:''?>,<?php echo isset($tp[3]['score'])?$tp[3]['score']:''?>,<?php echo isset($tp[4]['score'])?$tp[4]['score']:''?>]],["<?php echo isset($tp[0]['score'])?$tp[0]['name'].$tp[0]['time']:''?>","<?php echo isset($tp[1]['score'])?$tp[1]['name'].$tp[1]['time']:''?>","<?php echo isset($tp[2]['score'])?$tp[2]['name'].$tp[2]['time']:''?>","<?php echo isset($tp[3]['score'])?$tp[3]['name'].$tp[3]['time']:''?>","<?php echo isset($tp[4]['score'])?$tp[4]['name'].$tp[4]['time']:''?>"],['分数'],{title: '历史成绩曲线图',min: 0,max: 1600,tooltipUnit: '分',showValue: true});
        $('.rep-subject li').click(function () {
            $('.rep-subject li').removeClass('on');
            $(this).addClass('on');
            var s = $(this).data('val'),
                c = 'all';
           $('.ans-classify li').data('sub',s);
            $('.ans-classify li').removeClass('on');
            $('.ans-classify li').eq(0).addClass('on');
            reportData(s,c);
        })
        $('.ans-classify li').click(function () {
            $('.ans-classify li').removeClass('on');
            $(this).addClass('on');
            var c = $(this).data('val'),
                s = $('.ans-classify li').data('sub');
            reportData(s,c);
        })
    })

</script>
