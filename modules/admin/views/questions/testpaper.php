<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">题库管理</a></span>
        <span >&gt;</span>
        <span>试卷管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/index'?>">返回</></br>
    <a href="<?php echo baseUrl.'/admin/questions/add_testpaper'?>">添加试卷</>
    <table border="1"  width="100%">
        <tr align="center">
            <th>id</th>
            <th>试卷名称</th>
            <th>数学</th>
            <th>阅读</th>
            <th>写作</th>
            <th>作文</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        <?php
        //        var_dump($data);exit;
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['id']?></td>
                <td><? echo $v['name']?></td>
                <td><? echo $v['math']?></td>
                <td><? echo $v['read']?></td>
                <td><? echo $v['language']?></td>
                <td><? echo $v['write']?></td>
                <td><? echo $v['time']?></td>
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
