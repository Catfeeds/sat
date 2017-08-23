<!--<link rel="stylesheet" href="/cn/css/bootstrap.min.css">-->
<script src="/cn/js/bootstrap.min.js"></script>
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="<?php echo baseUrl.'/admin/questions/index'?>">题库管理</a></span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/extend'?>">添加短文或题目图片</a></br>

    <div id="topicextend">
        短文、图片表
        <table border="1"  width="100%" >
            <tr align="center">
                <th>id</th>
                <th>试卷</th>
                <th>题号</th>
                <th>题目</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($data as $v){?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['name'].$v['time']?></td>
                    <td><?php echo $v['num']?></td>
                    <td><?php echo $v['essay']?></td>
                    <td>
                        <a class="link-update" href="<?php echo baseUrl.'/admin/questions/extend'.'?'.'id='.$v['id']?>">修改</a>
                        <a class="link-del" href="" onclick="del2(<?php echo $v['id'] ?>)">删除</a>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
    <div><?php echo $str?></div>
</div>
<script>
        function del2(id){
            if(confirm("确定删除内容吗")) {
                $.get("/admin/questions/del2", {id: id},
                    function (msg) {
                        if (msg) {
                            alert('删除成功');
                        }
                    }, 'text'
                );
            }
        }
</script>
