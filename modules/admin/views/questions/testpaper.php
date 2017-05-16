<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>题库管理</span>
        <span >&gt;</span>
        <span>试卷管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/index'?>">返回</></br>
    <a href="<?php echo baseUrl.'/admin/questions/add_testpaper'?>">添加试卷</>
    <table border="1"  width="100%">
        <tr align="center">
            <th>id</th>
            <th>试卷名称</th>
            <th>科目</th>
            <th>年份</th>
            <th>来源</th>
            <th>操作</th>
        </tr>
        <?php
        //        var_dump($data);exit;
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['id']?></td>
                <td><? echo $v['name']?></td>
                <td><? echo $v['major']?></td>
                <td><? echo $v['time']?></td>
                <td><? echo $v['source']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/questions/add_testpaper'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/questions/del_testpaper", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
