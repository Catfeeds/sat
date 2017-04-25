<div class="span10">
    <a href="<?php echo baseUrl?>/admin/role/add">分配权限</a>
    <table border="1" width="60%">
        <thead>
        <tr>
            <th>序号</th>
            <th>角色名</th>
            <th>权限列表</th>
            <th>权限路径</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $val){?>
            <tr>
                <td><?php echo $val['id'] ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['ids'] ?></td>
                <td><?php echo $val['path'] ?></td>
                <td>
                    <a  href="<?php echo baseUrl."/admin/role/add"."?id=".$val['id']?>">修改</a>
                    <a  href="" onclick="del(<?php echo $val['id'] ?>)">删除</a>
                </td>
            </tr>

        <?php }?>
        </tbody>
    </table>
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