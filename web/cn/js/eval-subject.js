$(function () {
  var sub = {
    init: function () {
      this.bindEvent();
      this.counTime();
    },
    bindEvent: function () {
      var _this = this;
      //this.counTime();
      $('.work-next-icon').click(function () {
        _this.ans();
      })
    },
    ans : function () {
      var ans = [],
        long = $('.words-ul .work-question-part').length,
        short = $('.work-select.active').length;
      if (Number(short) < Number(long)) {
        alert('还有答案没选哦！');
      } else {
        for (var i=0;i<long; i++) {
          ans[i] = new Array();
          for (var j=0;j<1;j++) {
            ans[i][j] = $('.work-question-part').eq(i).find('.work-select.active').data('id');
          }
        }
        console.log(ans);
      }
    },
    counTime : function () {
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
  };
  sub.init();

})




