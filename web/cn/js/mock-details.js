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
        checkBefore();
    })
    //离开点击事件
    $('.work-out').click(function () {
        workShade('.quit-wrap');
    })
    $('.shade-in').click(function () {
        $('.work-shade').hide();
        $('.shade-wrap').hide();
    })
    //确认离开点击事件
    $('.exit-out').click(function () {
        window.location.href='/mock.html';
    })

    //开始做题点击事件
    $('.notice-next-start').click(function(){
        $('.work-shade').hide();
        $('.notice-wrap').remove();
    })
})
//获取uId
var uId = $.cookie('uid');
//做题区域高度自适应
function workHeight() {
    var h = $(window).height() - $('.work-mk-top').height() - $('.work-mk-btm').height();
    $('.work-mk-cnt').height(h);
    $('.work-wrap-left').height(h);
    $('.work-wrap-right').height(h);
}

//倒计时
function countTime() {
    var totalTime = $('#sectionTime').val(),
        time = Number(totalTime*60),
        intervalId = setInterval(timer,100);
    function timer() {
        time--;
        if (time == 0) {
            clearInterval(intervalId);
            // autoSubmit();
        }
        var min = Math.floor(time/60),
            sec = time - min*60,
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

//进入下一题
function checkBefore() {
    var done = true;
    $('.work-select').each(function () {
        if ($(this).hasClass('active')) {
            done = false;
            var ans = $(this).data('id'),//用户答案
                subId = $('.work-que-list').data('id'),//题目ID
                testId = $('#testId').val(),//试卷ID
                correctAns = $('#correctAns').val(),//正确答案
                subject = $('#subject').val(),//所属科目
                classify = $('#classify').val(),//题目类型（跨学科）
                readAllNum = $('#readAllNum').val(),
                readNum = $('#readNum').val();
            $.ajax({
                type: 'get',
                url: "/cn/mock/next",
                data: {
                    'id':subId,
                    'answer':correctAns,
                    'solution':ans,
                    'uid': uId
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    //alert(data);
                }
            })
        }
    });
    if (done) {
        workShade('.next-wrap');
    }
}

