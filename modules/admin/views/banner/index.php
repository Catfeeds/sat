<div class="span10">
    <div >
        <a href="">首页</a><span >&gt;</span><span>banner管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/banner/add'?>">添加banner</>
    <table border="1"  width="800px">
        <tr align="center">
            <th>图片</th>
            <th>模块</th>
            <th>外链地址</th>
            <th>说明</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['module']?></td>
                <td><? echo $v['pic']?></td>
                <td><? echo $v['url']?></td>
                <td><? echo $v['alt']?></td>
                <td><? echo $v['time']?></td>

                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/banner/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>//)">删除</a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/info/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
