<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <a href="/admin/seo/index">seo管理</a>
    </div>
    <a href="/admin/seo/add">seo添加</a>
    <table border="1" width="80%">
        <thead>
        <tr>
            <th>序号</th>
            <th>地址</th>
            <th>标题</th>
            <th>关键词</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['url']?></td>
                <td><?php echo $v['title']?></td>
                <td><?php echo $v['keywords']?></td>
                <td><?php echo $v['description']?></td>
                <td>
                    <a  href="<?php echo baseUrl."/admin/seo/add"."?id=".$v['id']?>">修改</a>
                    <a  href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/seo/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>