<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/role/index">权限管理</a></span>
        <span >&gt;</span>
        <span>管理员列表</span>
    </div>
    <div><a href="/admin/role/admin_add">添加管理员</a></div>
    <table border="1" width="60%">
        <thead>
        <tr>
            <th>序号</th>
            <th>名字</th>
            <th>密码</th>
            <th>角色id</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $val){?>
            <tr>
                <td><?php echo $val['id'] ?></td>
                <td><?php echo $val['userName'] ?></td>
                <td><?php echo $val['userPass'] ?></td>
                <td><?php echo $val['roleId'] ?></td>
                <td>
                    <a  href="<?php echo baseUrl."/admin/role/admin_add"."?id=".$val['id']?>">修改</a>
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
                $.get("/admin/role/admin_del", {id: id},
                    function (msg) {
                        if (msg) {
                            alert('删除成功');
                        }
                    }, 'text'
                );
            }
        }
    </script>