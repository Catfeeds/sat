$(window).load(function () {
    //禁止刷新
    document.onkeydown = function (e) {
        return (e.which || e.keyCode) != 116;
    }
//  禁止右键
    document.oncontextmenu = function () {
        // return false;
    }
//  禁止后退
    window.history.forward(1);
})
$(function () {
    //做题区域高度自适应
    workHeight();
    //倒计时
    countTime();
    //收藏点击事件
    $('.work-collect').click(function () {
        collectEvent(this);
    });
    //选择题点击事件
    $('.work-que-wrap').click(function () {
        var _this = $(this);
        if (_this.parent().find('.active').length) {
            _this.parent().find('.work-select').attr('class','work-select')
        }
        _this.find('.work-select').attr('class', 'work-select active');
        var id = _this.parent().parent().parent().attr('id');
        $('#a'+id).addClass('active');
    })
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
        window.location.href='../mock/index.html';
    })

    var result = $('.math-gap-result input');
    $('.math-btn').click(function () {
        result.get(0).value += $(this).html();
    })
    $('.math-clear').click(function () {
        result.val('');
    })
    $('.math-sure').click(function () {
        $('.math-gap-table tr').addClass('sure');
        $('.math-gap-table').addClass('sure');
        $('.math-gap-table td').hover(function () {
            $('.math-gap-table td').css({
                'color': '#ccc',
                'backgroundColor': '#f1f1f1'
            })
        });
        $('.math-btn').removeClass('math-btn');
    })
})

//做题区域高度自适应
function workHeight() {
    var h = $(window).height() - $('.work-mk-top').height() - $('.work-mk-btm').height();
    $('.work-mk-cnt').height(h);
    $('.work-wrap-left').height(h);
    $('.work-wrap-right').height(h);
}
//收藏事件
function collectEvent(obj) {
    var _this = $(obj);
    if (_this.find('i').hasClass('icon-star-empty')) {
        _this.addClass('active');
        _this.find('i').removeClass('icon-star-empty');
        _this.find('i').addClass('icon-star');
    } else {
        _this.removeClass('active');
        _this.find('i').removeClass('icon-star');
        _this.find('i').addClass('icon-star-empty');
    }
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
//提交题目
function checkBefore() {
    var done = true;
    $('.work-select').each(function () {
        if ($(this).hasClass('active')) {
            done = false;
            console.log($(this).data('id'));
        }
    });
    if (done) {
        workShade('.next-wrap');
    }
}

