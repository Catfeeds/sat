$(function(){
    //联系方式
    $(".conBd ul li").eq(2).addClass("on");
    $(".conBd ul li").bind({
        "mouseenter":function(){
            if($(this).hasClass("on")){
                $(this).removeClass("on");
            }else{
                $(this).addClass("on");
                $(this).siblings().removeClass("on");
            }
        }
    });


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

//轮播显示上一张
function slidePrev(){
    var liOb=$(".conBd ul li").last();
    $(".conBd ul").prepend(liOb);
}

//轮播显示下一张
function slideNext(){
    var liOb=$(".conBd ul li").first();
    $(".conBd ul").append(liOb);
//    $(".conBd ul li").first().remove();
}

//关闭底部固定咨询框
function closeZX(o){
    $(o).parent().hide();
}