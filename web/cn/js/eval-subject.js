$(function () {
  var sub = {
    init: function () {
      this.bindEvent();
      this.countTime();
    },
    bindEvent: function () {
      var _this = this;
      $('.work-next-icon').click(function () {
        var sec = $('#secNum').attr('data-sec'),//
            id = $('#secNum').attr('data-id');
        //_this.answer(sec);
        $.ajax({
          type: 'post',
          url: '',
          data: {
            id : id,
            sec : sec,
            ans : _this.answer(sec)
          },
          dataType : 'json',
          success : function (res) {
            //_this.wordTemplate(res);
            consosle.log(res);
          }
        })
      })
    },
    answer : function (sec) {
      var ans = [];
      if (sec == 'section2') {
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
                ans[i][j] = $('.article-input').eq(i).val();
              }
            } else {
              for (var j=0; j<2; j++) {
                ans[i][j] = $('.work-question-part').eq(i-artInputL).find('.work-select.active').data('id');
              }
            }
          }
          console.log(ans);
        }
      } else if (sec == 'section3') {
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
              ans[i].push($('.work-select.active').eq(i).parent().parent().attr('data-pid'));
              ans[i].push($('.work-select.active').eq(i).attr('data-id'));
            }
          }
          console.log(ans);
          return ans;
        }
      }
    },
    countTime : function () {
      var _this = this;
      var time = 120;
      time = 120 * 60;
      var countSet = setInterval(function(){
        time --;
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

    }
  }
  sub.init();

})




