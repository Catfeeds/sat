<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">题库管理</a></span>
        <span >&gt;</span>
        <span>试卷管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/index'?>">返回</a></br>
    <a href="<?php echo baseUrl.'/admin/questions/add_testpaper'?>">添加试卷</a>
    <table border="1"  width="100%">
        <tr align="center">
            <th>id</th>
            <th>试卷类</th>
            <th>总分</th>
            <th>试卷名</th>
            <th>操作</th>
        </tr>
        <?php
        //        var_dump($data);exit;
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['name']?></td>
                <td><?php echo $v['score']?></td>
                <td><?php echo $v['time']?></td>
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
                    if (msg==1) {
                        alert('删除成功');
                    }else{
                        alert('无权限！请联系管理员修改权限！')
                    }
                }, 'text'
            );
        }
    }
</script>
