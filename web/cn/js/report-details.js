function createPieDataObject(data, lineName, color) {
    var oTempCar = new Object();
    oTempCar.name = lineName;
    oTempCar.y = data;
    if (typeof (color) != "undefined" && color != null && color != "") {
        oTempCar.color = color;
    }
    return oTempCar;
}
function createHighChartDataObject(data, lineName, color) {
    var oTempCar = new Object();
    oTempCar.name = lineName;
    oTempCar.data = data;
    if (typeof (color) != "undefined" && color != null && color != "") {
        oTempCar.color = color;
    }
    return oTempCar;
}
//设置相关属性
function setProperty(pre) {
    var defPer = {
        title: "",//主标题
        subtitle: "",//副标题
        yAxisTitle: "",//y轴标题
        yAxisUnit: "",//y轴数值单位
        xAxisTitle: "",//x轴标题
        xAxisUnit: "",//x轴数值单位
        tooltipUnit: "",//提示框显示数值的单位
        xOffset: 0,
        max: null,
        spacingLeft: 10,
        min: 0,
        pointWidth: null,
        tickInterval: null,
        plotBackgroundColor: '#f5f5f5',
        backgroundColor: '#f5f5f5',
        showValue: false, //是否显示图上的字
        showValueUnit: '', //显示图上数值的单位
        legendEnable: true,
        legendLayout: 'horizontal',
        legendAlign: 'center',
        legendverticalAlign: 'bottom',
        exportEnabled: false,
        credits: '',
        linkUrl: '',
        color: [],
        xRotation: 0,
        pname: '',
        punit: '',
        xFontFamily: null,
        xAxisColor: '#3C3D41',//x轴字的颜色
        changeColorNumForDataLabels : -99999,
        changeColorForDataLabels : ""
    }
    return $.extend(defPer, pre || {});
}
//饼状图
function pieChart(divId,data,categories,pre) {
    pre = setProperty(pre);
    var hcSeries=new Array();
    for(var i=0;i<data.length;i++){
        hcSeries.push(createPieDataObject(data[i],categories[i],pre.color[i]))
    };
    $('#'+divId).highcharts({
        chart: {
            plotShadow: false,
            backgroundColor:pre.backgroundColor,
            plotBackgroundColor:pre.plotBackgroundColor,
            plotBackgroundImage:pre.plotBackgroundImage,
            marginTop: -2,
            type: 'pie'
        },
        title: {
            text: pre.title
        },
        credits:{
            text:pre.credits
        },
        tooltip: {
            pointFormat: '百分比'+'<b>:{point.percentage:.1f}</b>%'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color:'#333',
                    style:{"font-family": "Microsoft Yahei", },
                    formatter:function(){
                        if(this.y==0){
                            return null;
                        }
                        return this.y;
                    },
                    distance:pre.distance
                }
            }
        },
        series: [{
            type: 'pie',
            data: hcSeries
        }]
    })
}
//柱形图
function barChart(divId,data,categories,lineName,pre) {
    pre = setProperty(pre);
    var hcSeries=new Array();
    for(var i=0;i<data.length;i++){
        hcSeries.push(createHighChartDataObject(data[i],lineName[i],pre.color[i]))
    };
    $('#'+divId).highcharts({
        chart: {
            type: 'column',
            backgroundColor: pre.backgroundColor
        },
        title: {
            text: pre.title,
            style: {
                fontFamily: 'Aarial',
                fontSize: '14px',
                color: '#3C3D41'
            }
        },
        subtitle: {
            text: pre.subtitle,
            style: {
                fontFamily: 'Aarial',
                fontSize: '14px',
                color: '#3C3D41'
            }
        },
        exporting: {
            enabled: pre.exportEnabled
        },
        xAxis: {
            categories: categories,
            labels: {
                rotation: pre.xRotation,
                style: {
                    fontFamily: 'Aarial',
                    fontSize: '14px',
                    color: '#3C3D41'
                }
            }
        },
        plotOptions: {
            column: {
                pointWidth: pre.pointWidth,
                dataLables: {
                    enabled: pre.showValue,
                    rotation: 0,
                    inside: true,
                    color: '#fff',
                    align: 'center',
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana,sans-serif'
                    },
                    useHTML: true
                }
            }
        },
        legend: {
            enabled: pre.legendEnable,
            layout: pre.legendLayout,
            align: pre.legendAlign,
            verticalAlign: pre.legendverticalAlign
        },
        credits: {
            text: pre.credits
        },
        tooltip: {
            shared: true,
            useHTML: true,
            valueSuffix: pre.tooltipUnit
        },
        yAxis: {
            gridLineColor: '#c0c0c0',
            gridLineWidth: '1px',
            gridLineDashStyle: 'Solid',
            tickInterval: pre.tickInterval, //刻度值
            title: {
                text: pre.yAxisTitle
            },
            max: pre.max,
            min: pre.min,
            allowDecimals: false,
            labels: {
                formatter: function () {
                    return this.value + pre.yAxisUnit
                },
                style: {
                    fontFamily: 'Arial',
                    color: '#000000',
                    fontSize: '15px'
                }
            }
        },
        series: hcSeries
    })
}
//折线图
function lineChart(divId,data,categories,lineName,pre) {
    pre = setProperty(pre);
    var hcSeries = new Array();
    var xTickInterval = Math.ceil(categories.length / 8);
    for (var i = 0; i < data.length; i++) {
        hcSeries.push(createHighChartDataObject(data[i], lineName[i], pre.color[i]))
    }
    $('#' + divId).highcharts({
        chart: {
            plotBackgroundImage: pre.plotBackgroundImage,
            backgroundColor: pre.backgroundColor,
            animation: true,
            type: 'spline'
        },
        exporting: {
            enabled: pre.exportEnabled
        },
        title: {
            text: pre.title,
            style: {
                fontFamily: 'inherit',
                fontSize: '14px',
                fontWeight: 'bold',
                color: '#3C3D41'
            }
        },
        subtitle: {
            text: pre.subtitle
        },
        xAxis: {
            tickInterval: xTickInterval,
            showLastLabel: true,
            categories: categories,
            labels: {
                formatter: function () {
                    return this.value + pre.xAxisUnit
                },
                style: {
                    fontFamily: '微软雅黑',
                    fontSize: '14px',
                    color: '#3C3D41'
                }
            }
        },
        legend: {
            enabled: pre.legendEnable,
            layout: pre.legendLayout,
            align: pre.legendAlign,
            verticalAlign: pre.legendverticalAlign,
            itemMarginBottom: 5
        },
        credits: {
            text: pre.credits
        },
        yAxis: {
            title: {
                text: pre.yAxisTitle
            },
            tickInterval: pre.tickInterval,
            allowDecimals: false,
            max: pre.max,
            min: pre.min,
            labels: {
                formatter: function () {
                    return this.value + pre.yAxisUnit
                },
                style: {
                    color: '#979797',
                    fontSize: '12px'
                }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            shared: true,
            crosshairs: true,
            valueSuffix: pre.tooltipUnit

        },
        plotOptions: {
            spline: {
                dataLabels: {
                    enabled: pre.showValue,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: hcSeries
    })
}
//做题详情
function reportData(s,c) {
    $.ajax({
        url: '/cn/report/que',
        type: 'get',
        data: {
            'sub': s,
            'classify': c,
            'tid': $('#tpId').data('val'),
            'rid': $('#rid').data('val')
        },
        dataType: 'json',
        success: function (data) {
            $('.ans-cnt ol').empty();
            var li = '';
            $.each(data,function(index,array) {
                li+=" <li class='clearfix'>"+
                  "<div class='lost-time pull-left'>"+
                  "<span>耗时</span>"+
                  "<p>"+array['1']+"</p>"+
                  "<span>秒</span>"+
                  "</div>"+
                  "<div class='show-correct-ans pull-right'>"+
                  "<strong>"+array['0']+"</strong>"+
                  "<i>/</i>"+
                  "<b>"+array['answer']+"</b>"+
                  "</div>"+
                  " <div class='question-stem'>"+
                  "<p>"+
                  "<a href=/exercise_details/"+array['id']+".html target='_blank'>"+array['content']+"</a>"+
                  "</p>"+
                  "</div>"+
                  "</li>"
            });
            $('.ans-cnt ol').append(li);
        },
        complete: function () {
            $('.ans-cnt ol li').each(function (i) {
                var st = $('.ans-cnt ol li').eq(i).find('.show-correct-ans').find('strong').html();
                var sr = $('.ans-cnt ol li').eq(i).find('.show-correct-ans').find('b').html();
                if (st.indexOf('/') != -1){
                    var st1 = Number(st.split('/')[0]);
                    var st2 = Number(st.split('/')[1]);
                    st = (st1/st2).toFixed(2);
                }
                if (sr.indexOf('/') != -1){
                    var sr1 = Number(sr.split('/')[0]);
                    var sr2 = Number(sr.split('/')[1]);
                    sr = (sr1/sr2).toFixed(2);
                }
                if (st == sr){
                    $('.ans-cnt ol li').eq(i).find('.show-correct-ans').find('strong').css('color','green');
                }
            })
        },
        error: function() {
            console.log('错误');
        }
    })
}