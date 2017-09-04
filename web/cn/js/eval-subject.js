$(function () {
  var sub = {
    init: function () {
      this.bindEvent();
      this.countTime();
    },
    bindEvent: function () {
      var _this = this;
      $('.work-next-icon').click(function () {
        var sec = $('#secNum').attr('data-sec'),//第几小节
            id = $('#secNum').attr('data-id');//试卷id
        //_this.answer(sec);
        if (sec == 5) {
          var time = sessionStorage.getItem('t');
        }
        $.ajax({
          type    : 'post',
          url     : '/cn/evaulation/next',
          data: {
            id    : id,
            s     : sec,
            ans   : _this.answer(sec),
            time  : time
          },
          dataType : 'json',
          success  : function (res) {
            //_this.wordTemplate(res);
            console.log(res);
          }
        })
      })
    },
    answer : function (sec) {
      var ans = [];
      if (sec == 2) {
        var artInputL   = $('.article-input').length,
          artSelectL  = $('.words-ul .work-question-part').length,
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
                ans[i].push($('.article-input').eq(i).val());
              }
            } else {
              for (var j=0; j<2; j++) {
                ans[i].push($('.work-question-part').eq(i-artInputL).find('.work-select.active').data('id'));
              }
            }
          }
          console.log(ans);
          return ans;
        }
      } else if (sec == 3) {
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
              ans[i].push($('.translate-ans').eq(j).attr('data-pid'));
              ans[i].push($('.translate-ans').eq(j).val());
            }
          }
          console.log(ans);
          return ans;
        }
      } else {
        var long  = $('.words-ul .work-question-part').length,
          short = $('.work-select.active').length;
        if (Number(short) < Number(long)) {
          alert('还有题目没做哦！');
        } else {
          for (var i=0;i<long; i++) {
            ans[i] = new Array();
            for (var j=0;j<1;j++) {
              ans[i].push($('.work-select.active').eq(j).parent().parent().attr('data-pid'));
              ans[i].push($('.work-select.active').eq(j).attr('data-id'));
            }
          }
          console.log(ans);
          return ans;
        }
      }
    },
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
    wordTemplate : function(res){
      if (res.section == 'section2') {
        var div = '';
        div+= "<div class='work-wrap-left pull-left' style='display: none;'>"+
          "<div class='grammer'>"+
        "<div class='article'>"+
        "I hunted for 30 years for various reasons, mostly because my grandfather and"+
        " my father did. We ate what we killed. I began _1_(look) at hunting differently"+
        "in November 1989.That day I happened _2_ (walk) in the forest when a deer hunter"+
        "shot me in the leg. The irresponsible hunter left me for death. Loading me in a truck,"+
        " my twelve-year-old son drove me 40 miles to a hospital. That did give me a solid taste"+
        " of what the animals endured. I started _3_ (understand) that the animal was not just"+
        "target, but a living thing, a thing that suffered when shot, a thing that I had no"+
        "right _4_ (kill). I was sorry _5_ (kill) so many animals. To help animals, rather than"+
        "kill them, is of great importance to me."+
        "</div>"+
        "<ul class='article-list'>"+
        "<li>"+
        "<label>1.</label>"+
        "<input class='article-inpu' type='text'>"+
        "</li>"+
        "</ul>"+
        "</div>"+
        "</div>"+
        "<div class='work-wrap-right pull-right'>"+
        "<ul class='words-ul'>"+
        "<li class='work-question-part'>"+
        "<span class='num pull-left'>1.</span>"+
        "<div class='question'>"+
        "Remember _______ the newspaper when you have finished it."+
        "</div>"+
        "<ul class='work-que-list' data-pid='0000'>"+
        "<li class='work-que-wrap clearfix'>"+
        "<div class='work-select' data-id='A'>A</div>"+
        "<div class='work-que'>putting back </div>"+
        " </li>"+
        "<li class='work-que-wrap clearfix'>"+
        "<div class='work-select' data-id='B'>B</div>"+
        "<div class='work-que'> put back </div>"+
        "</li>"+
        "<li class='work-que-wrap clearfix'>"+
        "<div class='work-select' data-id='C'>C</div>"+
        "<div class='work-que'>to put back </div>"+
        "</li>"+
        "<li class='work-que-wrap clearfix'>"+
        "<div class='work-select' data-id='D'>D</div>"+
        "<div class='work-que'>be put back </div>"+
        "</li>"+
        "</ul>"+
        "</li>"+
        "</ul>"+
        "</div>"
      }
    }
  }
  sub.init();

})




