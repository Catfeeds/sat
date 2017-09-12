<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/role/index">权限管理</a></span>
        <span >&gt;</span>
        <span>权限分配</span>
    </div>
    <a href="<?php echo baseUrl?>/admin/role/add">分配权限</a>
    <table border="1" width="1000px" style="TABLE-LAYOUT: fixed">
        <thead>
        <tr>
            <th width="50px">序号</th>
            <th width="50px">角色名</th>
            <th style="WORD-WRAP: break-word;word-break:break-all;" >权限列表</th>
            <th width="300px">权限路径</th>
            <th width="35px">操作</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $val){?>
            <tr>
                <td><?php echo $val['id'] ?></td>
                <td><?php echo $val['name'] ?></td>
                <td style="overflow: auto;"><?php echo $val['ids'] ?></td>
                <td><?php echo $val['path'] ?></td>
                <td>
                    <a  href="<?php echo baseUrl."/admin/role/add"."?id=".$val['id']?>">修改</a>
                    <a  href="" onclick="del(<?php echo $val['id'] ?>)">删除</a>
                </td>
            </tr>

        <?php }?>
        </tbody>
    </table>
</div>
    <script>
        function del(id){
            if(confirm("确定删除内容吗")) {
                $.get("/admin/role/del", {id: id},
                    function (msg) {
                        if (msg) {
                            alert('删除成功');
                        }
                    }, 'text'
                );
            }
        }
    </script>