<div class="span10">
    <a>首页</a>
    <span >&gt;</span>
    <span><a href="/admin/role/index">权限管理</a></span>
    <span >&gt;</span>
    <span>节点管理</span></br>
    <a href="<?php echo baseUrl?>/admin/node/add">节点添加</a>

    <table border="1" width="80%">
        <thead>
        <tr>
            <th>序号</th>
            <th>节点名称</th>
            <th>级数</th>
            <th>父节点</th>
            <th>模块</th>
            <th>控制器</th>
            <th>方法</th>
            <th>路径</th>
            <th>1显示0不显</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td style="padding-left:<?php echo $v['level']*20?>px"><?php echo $v['name']?></td>
                <td><?php echo $v['level']?></td>
                <td><?php echo $v['pid']?></td>
                <td><?php echo $v['module']?></td>
                <td><?php echo $v['controller']?></td>
                <td><?php echo $v['action']?></td>
                <td><?php echo $v['path']?></td>
                <td><?php echo $v['isShow']?></td>
                <td>
                    <a  href="<?php echo baseUrl."/admin/node/add"."?id=".$v['id']?>">修改</a>
                    <a  href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
<!--    <input id="btn" type="button" value="分配权限">-->
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/node/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
