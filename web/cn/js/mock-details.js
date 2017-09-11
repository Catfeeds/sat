$(function () {
    //禁止刷新
    document.onkeydown = function (e) {
        return (e.which || e.keyCode) != 116;
    }
//  禁止后退
    window.history.forward(1);

    //做题区域高度自适应
    workHeight();
    //倒计时
    countTimeFun();
    //正计时
    upTime();
    upTime('b');
    //加载行号
    lineNum();
    //禁止复制以及右键
    document.oncopy = function(){
        return false;
    }
    document.oncontextmenu = function () {
        return false;
    };
    //下一题点击事件
    $('.work-next-icon').click(function () {
        ckBefore(0);
    })
    document.onkeydown = function (e) {
        var num = Number($('.sec-position').text()),
          allNum = Number($('.sec-all-num').text()-1);
        if (e.keyCode === 39) {
            if (num >= allNum) {
                ckBefore(0,'submit');
            }else {
                ckBefore(0);
            }
        }
    }
    $('.do-next').click(function () {
        if($('.sec-position').html() == $('.sec-all-num').html()-1){
            ckBefore(2,'submit');
        }else {
            ckBefore(1);
        }
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
    //跳过休息点击事件
    $('.skip-relax').click(function () {
        relaxEvent();
    })
    //做题进度
    if (sessionStorage.secPosition == undefined) {
        var secNum = $('.sec-position').html();
    } else {
        secNum = sessionStorage.secPosition;
        //显示下一题或提交按钮
        if (secNum >= $('.sec-all-num').html()-1) {
            $('.work-next-icon').hide();
            $('.work-submit').show();
        }
    }
    $('.sec-position').html(secNum);
    if (sessionStorage.allPosition == undefined) {
        var allNum = $('.all-position').html();
    }else {
        allNum = sessionStorage.allPosition;
    }
    $('.all-position').html(allNum);

})

var uId = $.cookie('uid'),//获取uId
    TOTALTIME = '',//section总时间
    TIME = '',//cookie存储时间
    relaxEvent = '';//跳过休息函数

//做题区域高度自适应
function workHeight() {
    var h = $(window).height() - $('.work-mk-top').height() - $('.work-mk-btm').height();
    $('.work-mk-cnt').height(h);
    $('.work-wrap-left').height(h);
    $('.work-wrap-right').height(h);
}
//加载行号
function lineNum(){
    var subName = $('#subName').text();
    if (subName != ''){
        var text = $('.read-text').html();
        var tNum = text.split('</p>').length;
        console.log(tNum);
        var line = '';
        if (subName == 'Reading') {
            for (var j=1;j<=tNum;j++){
//<<<<<<< HEAD
//                console.log(j);
//=======
//>>>>>>> master
                if (j%5 == 0){
                    line += '<p>'+j+'</p>';
                } else {
                    line += '<br>'
                }
            }
            $('.text-line').html(line);
        } else {
            $('.read-text').css({
               'paddingLeft': '38px'
            })
        }
    }
}
//倒计时
function countTimeFun() {
    if (sessionStorage.countTime == undefined) {
        TOTALTIME = $('#sectionTime').val();
    } else {
        TOTALTIME = sessionStorage.countTime / 60;
    }
    TIME = Number(TOTALTIME*60);
    timer();
    var intervalId = setInterval(timer,1000);
    function timer() {
        TIME--;
        if (TIME <= 0) {
            clearInterval(intervalId);
            workShade('.auto-wrap');
            autoTime();
        }
        var min = Math.floor(TIME/60),
            sec = parseInt(TIME % 60),
            hour = Math.floor(min/60);
        min = min % 60;
        hour = checkTime(hour);
        min = checkTime(min);
        sec = checkTime(sec);
        $('.work-time-cnt').text("本section剩余时间: "+hour+ ":" +min+ ":" +sec);
    }
}
//正计时
function upTime(flag) {
    if (flag == 'b') {
        if (sessionStorage.reltime == undefined) {
            var usedTime = 0;
        } else {
            var usedTime = Number(sessionStorage.reltime);
        }
    } else {
       var usedTime = 0;
    }
    setInterval(function() {
        usedTime = usedTime + 1;
        if (flag == 'b') {
            sessionStorage.reltime = usedTime;
        } else {
            sessionStorage.uptime = usedTime;
        }
    },1000)
}
//休息倒计时
function relaxTime () {
    var relTime = 300;
    var relaxId = setInterval(timer,1000);
    function timer() {
        relTime--;
        var min = Math.floor(relTime/60),
            sec = relTime % 60;
        if (relTime <= 0) {
            clearInterval(relaxId);
            relaxEvent();
        }
        sec = checkTime(sec);
        min = checkTime(min);
        $('.five-count span').html(min+':'+sec);
    }
}
//自动提交倒计时
function autoTime() {
    var aTime = 5;
    var autoId = setInterval(function () {
        aTime--;
        if (aTime <=0 ){
            clearInterval(autoId);
            ckBefore(2,'submit');
        }
        $('.auto-time').html(aTime);
    },1000)
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
//下一题、提交时进入进度、倒计时函数
function process() {
    sessionStorage.countTime = TIME;
    if (sessionStorage.secPosition == undefined) {
        secNum = $('.sec-position').html();
    } else {
        secNum = sessionStorage.secPosition;
    }
    secNum++;
    sessionStorage.secPosition = secNum;
    if (sessionStorage.allPosition == undefined) {
        allNum = $('.all-position').html();
    } else {
        allNum = sessionStorage.allPosition;
    }
    allNum++;
    sessionStorage.allPosition = allNum;
}

//清空sessionStorage
function clearSession(tag) {
    sessionStorage.removeItem('secPosition');
    sessionStorage.removeItem('countTime');
    if (tag == 'submit') {
        sessionStorage.clear();
    }
}

//下一题、提交
function ckBefore(flag,tag) {
    //判断是否选择题
    var ans = '';
    if ($('.math-table').css('display') == undefined) {
        ans = $('.work-select.active').data('id');//获取答案
    } else {
        ans = $('.math-table .math-value').text();
        if (ans == ''){
            ans = 'undefined';
        }
    }
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
        var subId = $('#subjectId').data('id'),//题目ID
          testId = $('#testId').val(),//试卷ID
          subject = $('#subject').val(),//所属科目
          classify = $('#classify').val(),//题目类型（跨学科）
          utime = sessionStorage.uptime,//单题计时,
          allPos = sessionStorage.allPosition,//总进度,
          allTime = sessionStorage.reltime,//做题总时间
          sec = $('#section').val(),//小节
          num = $('#number').val();//题号
        if (pos == -1) {
            //    全套模考
            var u = location.search.split('&')[0].substr(1);
            if (tag == 'submit') {//提交进入下一小节
                clearSession();
                $.post('/cn/mock/section',{
                    'tpId':testId,
                    'section':sec,
                    'qid':subId,
                    'solution':ans,
                    'utime': utime,
                    'allPos': allPos,
                    'allTime': allTime
                },function(data){
                    if (data == 'rep') {
                        clearSession('submit');
                        window.location.href = '/re.html';
                    }else{
                        if (data.section == 2 || data.section == 4) {
                            workShade('.relax-wrap');
                            relaxTime();
                            relaxEvent = function () {
                                $('.work-shade').hide();
                                $('.relax-wrap').hide();
                                window.location.href = '/mock_test?'+u+'&qid='+data.qid;
                            }
                        } else {
                            window.location.href = '/mock_test?'+u+'&qid='+data.qid;
                        }
                    }
                },'json')
            } else {//下一题
                $.ajax({
                    type: 'post',
                    url: "/cn/mock/next",
                    data: {
                        'qid':subId,
                        'solution':ans,
                        'uid':uId,
                        'major':subject,
                        'crossScore':classify,
                        'tid':testId,
                        'section':sec,
                        'number':num,
                        'utime': utime
                    },
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '/mock_test?'+u+'&qid='+data.qid;
                    }
                })
            }
        } else {
            //    单科模考
            var arr = location.search.substr(1).split('&'),
                u = arr[0]+'&'+arr[1];
            if (tag == 'submit') {
                $.post('/cn/mock/section',{
                    'tpId':testId,
                    'section':sec,
                    'qid':subId,
                    'solution':ans,
                    'utime': utime,
                    'allPos': allPos,
                    'allTime': allTime
                },function(data){
                    if (data.section == 4) {
                        clearSession();
                        window.location.href = '/mock_test?'+u+'&qid='+data.qid;
                    } else {
                        clearSession('submit');
                        window.location.href = '/re_single.html';
                    }
                },'json')
            }else {
                $.ajax({
                    type: 'post',
                    url: "/cn/mock/next",
                    data: {
                        'qid':subId,
                        'solution':ans,
                        'uid':uId,
                        'major':subject,
                        'crossScore':classify,
                        'tid':testId,
                        'section':sec,
                        'number':num,
                        'utime': utime
                    },
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = '/mock_test?'+u+'&qid='+data.qid;
                    }
                })
            }
        }
    }
}

//退出模考、测评
function exitOut() {
    $.post('/cn/mock/leave',function(obj){
        if (obj) {
            clearSession('submit');
            window.location.href = '/mock.html';
        }
    },'json')
}