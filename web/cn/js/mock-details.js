$(function () {
    //禁止刷新
    document.onkeydown = function (e) {
        return (e.which || e.keyCode) != 116;
    }
//  禁止右键
    document.oncontextmenu = function () {
        //return false;
    }
//  禁止后退
    window.history.forward(1);

    //做题区域高度自适应
    workHeight();
    //倒计时待完善
    if ($('.notice-wrap').css('display') != 'block') {
        countTime();
    }
    //下一题点击事件
    $('.work-next-icon').click(function () {
        ckBefore(0);
    })
    $('.do-next').click(function () {
        ckBefore(1);
    })
    //提交点击事件
    $('.work-submit').click(function () {
        ckBefore(0,'submit');
    })
    //离开点击事件
    $('.work-out').click(function () {
        workShade('.quit-wrap');
    })
    $('.shade-in').click(function () {
        $('.work-shade').hide();
        $('.shade-wrap').hide();
    })
    $('.exit-out').click(function () {
        exitOut();
    })
    //做题进度
    if ($.cookie('secPosition') == undefined || $.cookie('secPosition') == '') {
        var secNum = $('.secPosition').html();
    } else {
        secNum = $.cookie('secPosition');
        if (secNum >= $('.sec-all-num').html()) {
            $('.work-next-icon').hide();
            $('.work-submit').show();
        }
    }
    $('.sec-position').html(secNum);
    if($.cookie('allPosition') == undefined) {
        allNum = $('.all-position').html();
    }else {
        allNum = $.cookie('allPosition');
    }
    $('.all-position').html(allNum);
})

//获取uId
var uId = $.cookie('uid');
//时间
var TOTALTIME = '',
    TIME = '';

//做题区域高度自适应
function workHeight() {
    var h = $(window).height() - $('.work-mk-top').height() - $('.work-mk-btm').height();
    $('.work-mk-cnt').height(h);
    $('.work-wrap-left').height(h);
    $('.work-wrap-right').height(h);
}

//倒计时
function countTime() {
    if ($.cookie('countTime') == undefined) {
        TOTALTIME = $('#sectionTime').val();
    } else {
        TOTALTIME = $.cookie('countTime')/60;
    }
    TIME = Number(TOTALTIME*60);
    var intervalId = setInterval(timer,1000);
    function timer() {
        TIME--;
        if (TIME == 0) {
            clearInterval(intervalId);
            // autoSubmit();
            //ckBefore(2);
        }
        var min = Math.floor(TIME/60),
            sec = TIME - min*60,
            hour = Math.floor(min/60);
        min = min - hour*60;
        hour = checkTime(hour);
        min = checkTime(min);
        sec = checkTime(sec);
        $('.work-time-cnt').text("本section剩余时间: "+hour+ ":" +min+ ":" +sec);
    }
}
function checkTime(i) {
    return i<10? "0"+i: i;
}
//遮罩
function workShade(obj) {
    $('.work-shade').show();
    $(obj).show();
}
//答题时间到
function autoSubmit() {
    workShade('.auto-wrap');
}
//数学填空题
// function mathGap() {
//   var result = $('.math-gap-result input'),
//       btn = $('.math-btn');
//   console.log(btn);
//   btn.each(function () {
//     $(this).click(function () {
//       console.log('a');
//       result.get(0).value = $(this).html();
//     })
//   })
// }
//进度、倒计时等
function process() {
    $.cookie('countTime',TIME);
    if ($.cookie('secPosition') == undefined || $.cookie('secPosition') == '') {
        secNum = $('.sec-position').html();
    } else {
        secNum = $.cookie('secPosition');
    }
    secNum++;
    $.cookie('secPosition',secNum);
    if($.cookie('allPosition') == undefined) {
        allNum = $('.all-position').html();
    }else {
        allNum = $.cookie('allPosition');
    }
    allNum++;
    $.cookie('allPosition',allNum);
}
//下一题、提交
function ckBefore(flag,tag) {
    var ans = $('.work-select.active').data('id');
    if (flag == 1) {
        ans = '';
    } else if(ans == undefined && flag ==2) {
        ans = ''
    }
    if (ans == undefined) {
        workShade('.next-wrap');
    } else {
        process();
        var pos = location.search.indexOf('m=');
        if (pos == -1) {
            //    全套模考
            var u = location.search.split('&')[0].substr(1);
        } else {
            //    单科模考
            var arr = location.search.substr(1).split('&'),
                u = arr[0]+'&'+arr[1];
        }
        var subId = $('.work-que-list').data('id'),//题目ID
            testId = $('#testId').val(),//试卷ID
            subject = $('#subject').val(),//所属科目
            classify = $('#classify').val(),//题目类型（跨学科）
            sec = $('#section').val(),//小节
            num = $('#number').val();//题号
        if (tag == 'submit') {
            $.get('/cn/mock/next',{
                'tpId':testId,//试卷ID
                'section':sec,//小节
                'solution':ans//答案
            },function(data){
                window.location.href = '';
            },'json')
        } else {
            $.ajax({
                type: 'get',
                url: "/cn/mock/next",
                data: {
                    'qid':subId,
                    'solution':ans,
                    'uid':uId,
                    'major':subject,
                    'crossScore':classify,
                    'tid':testId,
                    'section':sec,
                    'number':num
                },
                dataType: 'json',
                success: function(data) {
                    window.location.href = '/mock_test?'+u+'&qid='+data.qid;
                }
            })
        }
    }
}
//提交
function subBefore() {
    var tpId = $('#testId').val(),//试卷ID
        sec = $('#section').val();//小节

}

//退出模考、测评
function exitOut() {
    $.get('/cn/mock/leave',function(obj){
        if (obj) {
            window.location.href = '/mock.html';
        }
    },'json')
}

