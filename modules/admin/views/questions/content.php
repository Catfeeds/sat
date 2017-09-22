<link rel="stylesheet" href="/cn/css/bootstrap.min.css">
<script src="/cn/js/bootstrap.min.js"></script>
<style xmlns="http://www.w3.org/1999/html">

    .info-wrap>td {
        text-align: center;
    }
    .info-wrap>td>div {
        max-height: 200px;
        overflow-y: auto;
    }
    .tiao-val {
        width: 30px;
        height: 30px;
        margin: 5px 5px 0 0;
        outline: none;
        font-size: 14px;
    }
    .tiao-btn {
        font-size: 14px;
    }

</style>
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="<?php echo baseUrl.'/admin/questions/index'?>">题库管理</a></span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/add'?>">添加具体题目</a></br>
    <a href="<?php echo baseUrl.'/admin/questions/search'?>">搜索题目</a>
    <div><?php echo $str?><input type="text" class="tiao-val"><button class="tiao-btn">跳转</button></div>
    <div id="topic">
        题目信息表
        <table border="1"  width="100%" >
            <tr align="center">
                <th>id</th>
                <th>题号</th>
                <th>题目</th>
                <th>答案</th>
                <th>科目</th>
                <th>短文id</th>
                <th>题目来源</th>
                <th>subScores</th>
                <th>cross-testScores</th>
                <th>操作</th>
        </tr>
        <?php
        foreach($arr as $v){?>
            <tr style="line-height:50px;overflow:hidden;">
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['number']?></td>
                <td><?php echo $v['content']?></td>
                <td><?php echo $v['answer']?></td>
                <td><?php echo $v['major']?></td>
                <td><?php echo $v['essayId']?></td>
                <td><?php echo $v['tpId']?></td>
                <td><?php echo $v['subScores']?></td>
                <td><?php echo $v['crosstestScores']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/questions/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
         <?php }?>
    </table>
    </div>

</div>
<script>
    $(function () {
        $('.tiao-btn').click(function () {
            location.href = location.pathname+"?p="+$('.tiao-val').val();
        })
    });
        function del(id){
            if(confirm("确定删除内容吗")) {
                $.get("/admin/questions/del", {id: id},
                    function (msg) {
                        if (msg) {
                            alert('删除成功');
                        }
                    }, 'text'
                );
            }
        }

</script>
