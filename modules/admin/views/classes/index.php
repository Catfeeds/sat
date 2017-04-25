
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>课程管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/classes/add'?>">添加课程</>
    <table border="1" allrules="0" width="800px">
        <tr align="center">
            <th>课程名称</th>
            <th>图片地址</th>
            <th>课程类别</th>
            <th>课时</th>
            <th>价格</th>
            <th>科目</th>
            <th>讲师</th>
            <th>课程简介</th>
            <th>操作</th>
        </tr>
        <?php
//        var_dump($data);exit;
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['className']?></td>
                <td><? echo $v['pic']?></td>
                <td><? echo $v['cate']?></td>
                <td><? echo $v['duration']?></td>
                <td><? echo $v['price']?></td>
                <td><? echo $v['major']?></td>
                <td><? echo $v['teacher']?></td>
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
