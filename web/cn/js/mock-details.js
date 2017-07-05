$(window).load(function () {
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
})
$(function () {
    //做题区域高度自适应
    workHeight();
    //倒计时待完善
    if ($('.notice-wrap').css('display') != 'block') {
        countTime();
    }
    //下一题点击事件
    $('.work-btm-next').click(function () {
        var flag = 0;
        ckBefore(flag);
    })
    $('.do-next').click(function () {
       var flag = 1;
        ckBefore(flag);
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

    //var t = $.cookie('countTime');
    //$('#sectionTime').val(t);
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
    TOTALTIME = $('#sectionTime').val();
    TIME = Number(TOTALTIME*60);
    var intervalId = setInterval(timer,1000);
    function timer() {
        TIME--;
        if (TIME == 0) {
            clearInterval(intervalId);
            // autoSubmit();
            //var flag = 2;
            //ckBefore(flag);
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
//下一题
function ckBefore(flag) {
    var ans = $('.work-select.active').data('id');
    if (flag == 1) {
        ans = '';
    } else if(ans == undefined && flag ==2) {
        ans = ''
    }
    if (ans == undefined) {
        workShade('.next-wrap');
    } else {
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
            correctAns = $('#correctAns').val(),//正确答案
            subject = $('#subject').val(),//所属科目
            classify = $('#classify').val(),//题目类型（跨学科）
            sec = $('#section').val(),//小节
            num = $('#number').val();//题号
        $.ajax({
            type: 'get',
            url: "/cn/mock/next",
            data: {
                'qid':subId,
                //'answer':correctAns,
                'solution':ans,
                'uid':uId,
                'major':subject,
                //'crossScore':classify,
                'tid':testId,
                'section':sec,
                'number':num,
                'cTime': TIME
            },
            dataType: 'json',
            success: function(data) {
                window.location.href = '/mock_test?'+u+'&qid='+data.qid;
            }
        })
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

