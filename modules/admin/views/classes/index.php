
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>课程管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/classes/add'?>">添加课程</>
    <table border="1" allrules="0" width="800px">
        <tr align="center">
            <th>id</th>
            <th>适合学生</th>
            <th>图片地址</th>
            <th>课程类别</th>
            <th>价格</th>
            <th>阅读课时</th>
            <th>文法课时</th>
            <th>词汇课时</th>
            <th>数学课时</th>
            <th>写作课时</th>
            <th>点评课时</th>
            <th>课程简介</th>
            <th>操作</th>
        </tr>
        <?php
//        var_dump($data);exit;
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['id']?></td>
                <td><? echo $v['student']?></td>
                <td><? echo $v['pic']?></td>
                <td><? echo $v['cate']?></td>
                <td><? echo $v['price']?></td>
                <td><? echo $v['read']?></td>
                <td><? echo $v['grammar']?></td>
                <td><? echo $v['vocabulary']?></td>
                <td><? echo $v['math']?></td>
                <td><? echo $v['write']?></td>
                <td><? echo $v['comments']?></td>
                <td><? echo $v['introduction']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/classes/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<script>
        function del(id){
            if(confirm("确定删除内容吗")) {
                $.get("/admin/classes/del", {id: id},
                    function (msg) {
                        if (msg) {
                            alert('删除成功');
                        }
                    }, 'text'
                );
            }
        }
</script>
