
<div class="span10">
    <div >
        <a href="/index/index">首页</a>
        <span >&gt;</span>
        <span>课程管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/classes/add'?>">添加课程</a>
    <table border="1" rules="0" width="100%">
        <tr align="center">
            <th>id</th>
            <th>适合学生</th>
            <th>图片地址</th>
            <th>课程类别</th>
            <th>价格</th>
            <th>课时及模块</th>
            <th>授课教师</th>
            <th>学习计划</th>
            <th>课程介绍</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>

                <td><?php echo $v['id']?></td>
                <td><?php echo $v['student']?></td>
                <td><?php echo $v['pic']?></td>
                <td><?php echo $v['cate']?></td>
                <td><?php echo $v['price']?></td>
                <td><?php echo $v['duration']?></td>
                <td><?php echo $v['teacher']?></td>
                <td><?php echo $v['plan']?></td>
                <td><?php echo $v['introduction']?></td>

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
