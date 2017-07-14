<div>
    <div >
        <a href="/index/index">首页</a>
        <span >&gt;</span>
        <span>知识点管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/knowledge/add'?>">添加知识点</a>
    <table border="1" width="80%">
        <tr>
            <th>id</th>
            <th>科目</th>
            <th>类别</th>
            <th>知识点名</th>
            <th>知识点分析</th>
            <th>相关题目</th>
            <th>操作</th>
        </tr>
        <?php foreach ($data as $v){?>
        <tr>
            <td><?php echo $v['id']?></td>
            <td><?php echo $v['major']?></td>
            <td><?php echo $v['cate']?></td>
            <td><?php echo $v['name']?></td>
            <td><?php echo $v['analysis']?></td>
            <td><?php echo $v['related']?></td>
            <td>
                <a class="link-update" href="<?php echo baseUrl.'/admin/knowledge/add'.'?'.'id='.$v['id']?>">修改</a>
                <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
            </td>
        </tr>
        <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/knowledge/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>