function page(opt) {
    if(!opt.id) {return false};

    var obj = $('#'+opt.id);
    var pageStr = '';
    var nowNum = opt.nowNum || 1;
    var allNum = opt.allNum || 5;
    var callBack = opt.callBack || function () {};
    //当前页数大于等于4或者总页数大于等于6时显示首页
    if (nowNum >= 4 && allNum >= 6){
        pageStr+="<a href='#1' class='grey'>首页</a>";
    };
    //当前页数大于等于2时显示上一页
    if (nowNum>=2) {
        pageStr+="<a href='#"+(nowNum-1)+"' class='grey'>上一页</a>";
    };
    //总页数小于等于5时
    if (allNum<=5) {
        for (var i=1;i<=allNum;i++) {
            if (nowNum == i){
                pageStr+="<a href='#"+i+"' class='blue'>"+i+"</a>"
            }else {
                pageStr+="<a href='#"+i+"' class='grey'>"+i+"</a>"
            }
        }
    }
    else {
        for (var i=1;i<=5;i++) {
            if (nowNum == 1 || nowNum == 2) {
                if (nowNum == i) {
                    pageStr+="<a href='#"+i+"' class='blue'>"+i+"</a>"
                } else {
                    pageStr+="<a href='#"+i+"' class='grey'>"+i+"</a>"
                }
            }else if((allNum == nowNum) || (nowNum == allNum-1)) {
                if ((allNum == nowNum) && i==5) {
                    pageStr+="<a href='#"+(allNum-5+i)+"' class='blue'>"+(allNum-5+i)+"</a>"
                }else if ((nowNum == allNum-1) && i == 4) {
                    pageStr+="<a href='#"+(allNum-5+i)+"' class='blue'>"+(allNum-5+i)+"</a>"
                } else {
                    pageStr+="<a href='#"+(allNum-5+i)+"' class='grey'>"+(allNum-5+i)+"</a>"
                }
            } else {
                if (i == 3) {
                    pageStr+="<a href='#"+(nowNum-3+i)+"' class='blue'>"+(nowNum-3+i)+"</a>"
                } else {
                    pageStr+="<a href='#"+(nowNum-3+i)+"' class='grey'>"+(nowNum-3+i)+"</a>"
                }
            }
        }
    };
    if ((allNum - nowNum) >= 1) {
        pageStr+="<a href='#"+(nowNum+1)+"' class='grey'>下一页</a>"
    };
    if ((allNum - nowNum) >= 3 && allNum >= 6) {
        pageStr+="<a href='#"+allNum+"' disabled='true' class='grey forbid'>尾页</a>"
    };
    obj.append(pageStr);
    callBack(nowNum,allNum);

    var aA = $('a');
    for (var i=0;i<aA.length;i++) {
        console.log(aA);
        aA.click(function () {
            console.log($(this));
            console.log($(this).attr('href'));
            var nowNum = parseInt($(this).attr('href').substring(1));
            obj.empty();
            page({
                id: opt.id,
                nowNum: nowNum,
                allNum: allNum,
                callBack: callBack
            });
        })
    }
}