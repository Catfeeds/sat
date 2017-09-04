<div class="span10">
    <a href="/admin/user/index">用户管理</a>>复习建议</br>
    <a href="/admin/user/suggest_edit">添加复习建议</a>
    <table border="1"  width="800px"  >
        <tr align="center">
            <th>id</th>
            <th>科目</th>
            <th>分数区间</th>
            <th>建议</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['major']?></td>
                <td><?php echo $v['min']?>-<?php echo $v['max']?></td>
                <td><?php echo $v['suggestion']?></td>
                <td>
                    <a href="<?php echo baseUrl.'/admin/user/suggest_edit'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/user/del3", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>