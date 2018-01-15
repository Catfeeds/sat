/**
 * Created by daicunya on 2018/1/15.
 */
$(function(){
//名师团队
  $(".summerBd ul li").bind({
    "mouseenter":function(){
      $(this).find(".summerTop").css({
        width:"178px",
        height:"178px",
        marginTop:"-20px",
        marginLeft:"-20px"
      }).find(".summer-mask").show().end().end().find(">span").hide().next("p").hide();

    },
    "mouseleave":function(){
      $(this).find(".summerTop").css({
        width:"140px",
        height:"140px",
        marginTop:"0",
        marginLeft:"0"
      }).find(".summer-mask").hide().end().end().find(">span").show().next("p").show();
    }
  });
//申友GMAT课程服务特色
  $(".in-special ul li").bind({
    "mouseenter":function(){
      $(this).find(".bigBG").eq(0).hide();
      $(this).find(".bigBG").eq(1).show();
    },
    "mouseleave":function(){
      $(this).find(".bigBG").eq(0).show();
      $(this).find(".bigBG").eq(1).hide();
    }
  });
});

