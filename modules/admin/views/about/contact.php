<div class="span10">
    <div >
        <a href="/admin/about/index">关于我们</a><span >&gt;</span><span><a href='<?php echo baseUrl."/admin/about/contact"?>'>联系我们</a></span>
    </div>
    <a href="<?php echo baseUrl.'/admin/about/contact_add'?>">添加联系方式</a>
    <table border="1"  width="800px">
        <tr align="center">
            <th>id</th>
            <th>城市</th>
            <th>图片</th>
            <th>服务区</th>
            <th>电话</th>
            <th>地址</th>
            <th>公交线路</th>
            <th>地铁线路</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['city']?></td>
                <td><?php echo $v['pic']?></td>
                <td><?php echo $v['name']?></td>
                <td><?php echo $v['telephone']?></td>
                <td><?php echo $v['address']?></td>
                <td><?php echo $v['bus']?></td>
                <td><?php echo $v['subWay']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/about/contact_add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/about/contact_del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
