<div class="span10">
    <div >
        <a href="/admin/about/index">关于我们</a><span >&gt;</span><span><a href='<?php echo baseUrl."/admin/about/join"?>'>加入我们</a></span>
    </div>
    <a href="<?php echo baseUrl.'/admin/about/join_add'?>">添加招聘信息</a>
    <table border="1"  width="800px">
        <tr align="center">
            <th>id</th>
            <th>分类</th>
            <th>职务</th>
            <th>任职要求</th>
            <th>就职地点</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['cate']?></td>
                <td><?php echo $v['job']?></td>
                <td><?php echo $v['demand']?></td>
                <td><?php echo $v['city']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/about/join_add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/about/join_del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
