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
    //if ($('.notice-wrap').css('display') != 'block') {
    //    countTime();
    //}
    countTime();
    upTime();
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
        clearCookie();
        exitOut();
    })
    //做题进度
    if ($.cookie('secPosition') == undefined || $.cookie('secPosition') == '') {
        var secNum = $('.sec-position').html();
    } else {
        secNum = $.cookie('secPosition');
        //显示下一题或提交按钮
        console.log(secNum);
        console.log($('.sec-all-num').html()-1);
        if (secNum >= $('.sec-all-num').html()-1) {
            $('.work-next-icon').hide();
            $('.work-submit').show();
        }
    }
    $('.sec-position').html(secNum);
    if($.cookie('allPosition') == undefined || $.cookie('allPosition') == '') {
        var allNum = $('.all-position').html();
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
        if (TIME <= 0) {
            clearInterval(intervalId);
            // autoSubmit();
            //ckBefore(2);
        }
        var min = Math.floor(TIME/60),
            sec = TIME % 60,
            hour = Math.floor(min/60);
        min = min % 60;
        hour = checkTime(hour);
        min = checkTime(min);
        sec = checkTime(sec);
        $('.work-time-cnt').text("本section剩余时间: "+hour+ ":" +min+ ":" +sec);
    }
}
//正计时
function upTime() {
    var usedTime = 0;
    var intervalId = setInterval(timer, 1000);
    function timer() {
        usedTime = usedTime + 1;
        $.cookie("upTime", usedTime, {expires: 1, path:"/"});
        var mins = Math.floor(usedTime / 60);
        var secs = usedTime % 60;
        var hrs = Math.floor(usedTime / 3600);
        mins = checkTime(mins);
        secs = checkTime(secs);
        hrs = checkTime(hrs);
        console.log("已用时间："+ hrs +":" + mins + ":" + secs);
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
    if($.cookie('allPosition') == undefined || $.cookie('allPosition') == '') {
        allNum = $('.all-position').html();
    }else {
        allNum = $.cookie('allPosition');
    }
    allNum++;
    $.cookie('allPosition',allNum);
}
//清空cookie
function clearCookie(tag) {
    $.cookie('secPosition','',{expires:-1});
    $.cookie('countTime','',{expires:-1});
    if (tag != 'submit') {
        console.log('sa');
        $.cookie('allPosition','',{expires:-1});
    }
}
//下一题、提交
function ckBefore(flag,tag) {
    var ans = $('.work-select.active').data('id');
    if (flag == 1) {
        //无选项下一题答案
        ans = '';
    } else if(ans == undefined && flag ==2) {
        //自动提交下一题答案
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
        if (tag == 'submit') {//提交进入下一小节
            clearCookie(tag);
            $.get('/cn/mock/section',{
                'tpId':testId,
                'section':sec,
                'qid':subId,
                'solution':ans
            },function(data){
                window.location.href = '/mock_test?'+u+'&qid='+data.qid;
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

//退出模考、测评
function exitOut() {
    $.get('/cn/mock/leave',function(obj){
        if (obj) {
            window.location.href = '/mock.html';
        }
    },'json')
}

