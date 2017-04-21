$(function(){
    //联系方式
//  $(".conBd ul li").eq(2).addClass("on");
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

//    申友托福精品课程
$(".excel-in ul li").bind({
    "mouseenter":function(){
        $(this).addClass("on").siblings().removeClass("on");
        $(this).find(".eT-circle img").attr("src","/cn/images/toefl_icon0"+($(this).index()+1)+".png");//修改图片路径, 套程序后需要修改一下前面的路径
    },
    "mouseleave":function(){
        $(this).removeClass("on");
        $(this).find(".eT-circle img").attr("src","/cn/images/toefl_icon00"+($(this).index()+1)+".png");//修改图片路径
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