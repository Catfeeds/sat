$(function () {
  var sub = {
    init: function () {
      this.bindEvent();
      this.countTime();
    },
    bindEvent: function () {
      var _this = this;
      //选择题点击效果
      $('.work-mk-cnt').on('click','.work-que-wrap', function () {
        $(this).siblings().find('.work-select').removeClass('active');
        $(this).find('.work-select').addClass('active');
      });
      //下一小节点击事件
      $('.work-next-icon').click(function () {
        var sec = $('#secNum').attr('data-sec'),//第几小节
            id = $('#secNum').attr('data-id'),//试卷id
            name = $('.work-main-title strong').html();//试卷名称
        if (sec == 5) {
          var time = sessionStorage.getItem('t');
        }
        $.ajax({
          type    : 'post',
          url     : '/cn/evaulation/next',
          data: {
            id    : id,
            s     : sec,
            ans   : _this.answer(sec,name),
            time  : time
          },
          dataType : 'json',
          success  : function (res) {
            if (res.code) {
              _this.wordTemplate(res);
              console.log(res);
            }else {
              window.location.href = '/evaulation_report.html';
            }
          }
        })
      });
    //  退出
      $('.work-out').click(function(){
        $('.work-shade').show();
        $('.quit-wrap').show();
      });
      $('.quit-wrap .shade-in').click(function(){
        $('.work-shade').hide();
        $('.quit-wrap').hide();
      });
      //退出测评
      $('.quit-wrap .exit-out').click(function(){
        window.location.href = '/evaulation.html';
      })
    },
    //获取答案
    answer : function (sec,name) {
      var ans = [];
      //第二小节文法答案
      if ((sec == 2) && (name == '测评初级卷')) {
        var artInputL   = $('.article-input').length,
          artSelectL  = $('.work-mk-cnt .work-question-part').length,
          artSelectS  = $('.work-select.active').length;
        for (var i=0; i<artInputL; i++) {
          if ($('.article-input').eq(i).val()) {
            $('.article-input').eq(i).addClass('hva');
          }
        }
        if (($('.article-input.hva').length < artInputL) || (Number(artSelectS) < 5)) {
          alert('还有题目没做哦！');
        } else {
          var artNum = Number(artInputL) + Number(artSelectL);
          for (var i=0; i<artNum; i++) {
            ans[i] = new Array();
            if (i < artInputL) {
              for (var j=0; j<1; j++) {
                ans[i].push($('.article-input').eq(i).parent().attr('data-pid'));
                ans[i].push($('.article-input').eq(i).val());
              }
            }
            if (i >= artInputL){
              for (var j=0; j<1; j++) {
                ans[i].push($('.work-select.active').eq(i-artInputL).parent().parent().attr('data-pid'));
                ans[i].push($('.work-select.active').eq(i-artInputL).attr('data-id'));
              }
            }
          }
          return ans;
        }
      }
      //第三小节翻译答案
      else if (sec == 3) {
        var sentenceL = $('.translate-ans').length;
        for (var i=0; i<sentenceL; i++) {
          if ($('.translate-ans').eq(i).val()) {
            $('.translate-ans').eq(i).addClass('tran');
          }
        }
        if ($('.translate-ans.tran').length < sentenceL) {
          alert('还有题目没做哦！');
        } else {
          for (var i=0;i<sentenceL; i++) {
            ans[i] = new Array();
            for (var j=0;j<1;j++) {
              ans[i].push($('.translate-ans').eq(i).attr('data-pid'));
              ans[i].push($('.translate-ans').eq(i).val());
            }
          }
          return ans;
        }
      }
      //第一、二、四、五小节（单词、中级文法、高级文法、阅读、数学）答案
      else {
        var long  = $('.work-mk-cnt .work-question-part').length,
            short = $('.work-select.active').length;
        if (Number(short) < Number(long)) {
          alert('还有题目没做哦！');
        } else {
          for (var i=0;i<long; i++) {
            ans[i] = new Array();
            for (var j=0;j<1;j++) {
              ans[i].push($('.work-select.active').eq(i).parent().parent().attr('data-pid'));
              ans[i].push($('.work-select.active').eq(i).attr('data-id'));
            }
          }
          return ans;
        }
      }
    },
    //倒计时
    countTime : function () {
      var _this = this;
      var time = 120,
          t = 0;
      time = 120 * 60;
      var countSet = setInterval(function(){
        time --;
        t++;
        sessionStorage.setItem('t',t);
        if (time <= 0){
          clearInterval(countSet);
        } else {
          var m = Math.floor(time/60),
            s = parseInt(time % 60),
            h = Math.floor(m/60);
          m = m%60;
          m = _this.checkZero(m);
          s = _this.checkZero(s);
          h = _this.checkZero(h);
          $('.work-time span:eq(1)').text(h+': '+m+': '+s);
        }
      },1000)
    },
    checkZero : function (m) {
      return m<10? "0"+m : m;
    },
    //小节模板
    wordTemplate : function(res){
      //第二小节（初级卷--文法）
      if ((res.section == 2) && (res.test == '初级卷')) {
        $('.work-mk-cnt').html('');
        var div = '';
        div+= "<div class='work-wrap-left pull-left'>"+
              "<div class='grammer'>"+
              "<div class='article'>"+ res.data[0]['essay'] +"</div>"+
              "<ul class='article-list'>";
        $.each(res.data, function (i,data) {
          if (i<=4) {
            div+= "<li data-pid='"+ data['qid'] +"'>"+
                  "<label>"+ (i+1) +".</label>"+
                  "<input class='article-input' type='text'>"+
                  "</li>";
          }
        });
        div+="</ul>"+
              "</div>"+
              "</div>"+
              "<div class='work-wrap-right pull-right'>"+
              "<ul class='words-ul'>";
        $.each(res.data, function (i,data) {
          if (i>4) {
            div+= "<li class='work-question-part'>"+
              "<span class='num pull-left'>"+(i+1)+".</span>"+
              "<div class='question'>"+ data['content'] + "</div>"+
              "<ul class='work-que-list' data-pid='"+ data['qid'] +"'>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='A'>A</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              " </li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='B'>B</div>"+
              "<div class='work-que'>"+ data['keyB'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='C'>C</div>"+
              "<div class='work-que'>"+ data['keyC'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='D'>D</div>"+
              "<div class='work-que'>"+ data['keyD'] +"</div>"+
              "</li>"+
              "</ul>"+
              "</li>";
          }
        });
        div+="</ul>"+
             "</div>";
        $('#secNum').html('section'+res.data[0]['section']);
        $('#secNum').attr('data-sec',res.data[0]['section']);
        $('#secName').html(res.data[0]['major']);
        $('.work-main-title strong').html("测评"+res.test);
        $('.work-mk-cnt').html(div);
      }
      //第二小节（中级卷--文法）
      else if ((res.section == 2) && (res.test == '中级卷')) {
        $('.work-mk-cnt').html('');
        var div = '';
        div+="<div class='work-wrap-left pull-left'>"+
          "<ul class='words-ul'>";
        $.each(res.data, function (i,data) {
          if (i<=3) {
            div+="<li class='work-question-part'>"+
              "<div class='clearfix'>"+
              "<span class='num pull-left'>"+ (i+1) +".</span>"+
              "<div class='question pull-left'>"+ data['content'] +"</div>"+
              "</div>"+
              "<ul class='work-que-list' data-pid='"+ data['qid'] +"'>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='A'>A</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='B'>B</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='C'>C</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='D'>D</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "</ul>"+
              "</li>";
          }
        });
        div+="</ul>"+
          "</div>"+
          "<div class='work-wrap-right pull-right'>"+
          "<ul class='words-ul'>";
        $.each(res.data, function (i,data) {
          if (i>3) {
            div+="<li class='work-question-part'>"+
              "<div class='clearfix'>"+
              "<span class='num pull-left'>"+ (i+1) +".</span>"+
              "<div class='question pull-left'>"+ data['content'] +"</div>"+
              "</div>"+
              "<ul class='work-que-list' data-pid='"+ data['qid'] +"'>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='A'>A</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='B'>B</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='C'>C</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='D'>D</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "</ul>"+
              "</li>";
          }
        })
        div+=" </ul>"+
          "</div>";
        $('#secNum').html('section'+res.data[0]['section']);
        $('#secNum').attr('data-sec',res.data[0]['section']);
        $('#secName').html(res.data[0]['major']);
        $('.work-main-title strong').html("测评"+res.test);
        $('.work-mk-cnt').html(div);
      }
      //第三小节（翻译）模板
      else if (res.section == 3) {
        $('.work-mk-cnt').html('');
        var div = '';
        div+= "<div class='work-wrap-left pull-left'>"+
              "<ul class='translate'>";
        $.each(res.data,function(i,data){
          if (i<=4) {
            div+=" <li>"+
                  "<span class='pull-left'>"+ (i+1) +".</span>"+
                  "<div class='e-sentence'>"+ data['content'] +"</div>"+
                  "<textarea class='translate-ans' data-pid='"+ data['qid'] +"' cols='70' rows='5'></textarea>"+
                  "</li>";
          }
        });
        div+="</ul>"+
              "</div>"+
              "<div class='work-wrap-right pull-right'>"+
              "<ul class='translate'>";
        $.each(res.data,function(i,data) {
          if (i>4 && i<10) {
            div+=" <li>"+
                  "<span class='pull-left'>"+ (i+1) +".</span>"+
                  "<div class='e-sentence'>"+ data['content'] +"</div>"+
                  "<textarea class='translate-ans' data-pid='"+ data['qid'] +"' cols='70' rows='5'></textarea>"+
                  "</li>";
          }
        });
        div+="</ul>"+
              "</div>";
        $('#secNum').html('section'+res.data[0]['section']);
        $('#secNum').attr('data-sec',res.data[0]['section']);
        $('#secName').html(res.data[0]['major']);
        $('.work-main-title strong').html("测评"+res.test);
        $('.work-mk-cnt').html(div);
        }
        //第四小节（阅读）
        else if ((res.section == 4) || ((res.test == '高级卷') && (res.section == 2))) {
          $('.work-mk-cnt').html('');
          var div = '';
          div+="<div class='work-wrap-left pull-left'>"+
                "<div class='work-box'>"+
                "<div class='read-text'>"+ res.data[0]['essay'] +"</div>"+
                "</div>"+
                "</div>"+
                " <div class='work-wrap-right pull-right'>"+
                "<ul class='words-ul'>";
        $.each(res.data, function (i,data) {
          div+="<li class='work-question-part'>"+
                "<div class='clearfix'>"+
                "<span class='num pull-left'>"+ (i+1) +".</span>"+
                "<div class='question pull-left'>"+ data['content'] +"</div>"+
                "</div>"+
                "<ul class='work-que-list' data-pid='"+ data['qid'] +"'>"+
                "<li class='work-que-wrap clearfix'>"+
                "<div class='work-select' data-id='A'>A</div>"+
                "<div class='work-que'>"+ data['keyA'] +"</div>"+
                "</li>"+
                "<li class='work-que-wrap clearfix'>"+
                "<div class='work-select' data-id='B'>B</div>"+
                "<div class='work-que'>"+ data['keyA'] +"</div>"+
                "</li>"+
                "<li class='work-que-wrap clearfix'>"+
                "<div class='work-select' data-id='C'>C</div>"+
                "<div class='work-que'>"+ data['keyA'] +"</div>"+
                "</li>"+
                "<li class='work-que-wrap clearfix'>"+
                "<div class='work-select' data-id='D'>D</div>"+
                "<div class='work-que'>"+ data['keyA'] +"</div>"+
                "</li>"+
                "</ul>"+
                "</li>";
        });
        div+=" </ul>"+
              "</div>";
        $('#secNum').html('section'+res.data[0]['section']);
        $('#secNum').attr('data-sec',res.data[0]['section']);
        $('#secName').html(res.data[0]['major']);
        $('.work-main-title strong').html("测评"+res.test);
        $('.work-mk-cnt').html(div);
      }
      //数学模板
      else {
        $('.work-mk-cnt').html('');
        var div = '';
        div+="<div class='work-wrap-left pull-left'>"+
              "<ul class='words-ul'>";
        $.each(res.data, function (i,data) {
          if (i<=4) {
            div+="<li class='work-question-part'>"+
              "<div class='clearfix'>"+
              "<span class='num pull-left'>"+ (i+1) +".</span>"+
              "<div class='question pull-left'>"+ data['content'] +"</div>"+
              "</div>"+
              "<ul class='work-que-list' data-pid='"+ data['qid'] +"'>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='A'>A</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='B'>B</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='C'>C</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='D'>D</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "</ul>"+
              "</li>";
          }
        });
        div+="</ul>"+
              "</div>"+
              "<div class='work-wrap-right pull-right'>"+
              "<ul class='words-ul'>";
        $.each(res.data, function (i,data) {
          if (i>4) {
            div+="<li class='work-question-part'>"+
              "<div class='clearfix'>"+
              "<span class='num pull-left'>"+ (i+1) +".</span>"+
              "<div class='question pull-left'>"+ data['content'] +"</div>"+
              "</div>"+
              "<ul class='work-que-list' data-pid='"+ data['qid'] +"'>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='A'>A</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='B'>B</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='C'>C</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "<li class='work-que-wrap clearfix'>"+
              "<div class='work-select' data-id='D'>D</div>"+
              "<div class='work-que'>"+ data['keyA'] +"</div>"+
              "</li>"+
              "</ul>"+
              "</li>";
          }
        })
        div+=" </ul>"+
              "</div>";
        $('#secNum').html('section'+res.data[0]['section']);
        $('#secNum').attr('data-sec',res.data[0]['section']);
        $('#secName').html(res.data[0]['major']);
        $('.work-main-title strong').html("测评"+res.test);
        $('.work-mk-cnt').html(div);
      }
    }
  }
  sub.init();
  //禁止复制以及右键
  document.oncopy = function(){
    return false;
  }
  document.oncontextmenu = function () {
    return false;
  };
})