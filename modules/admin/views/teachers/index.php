
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>讲师管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/teachers/add'?>">添加讲师</>
    <table border="1" allrules="0" width="800px">
        <tr align="center">
            <th>id</th>
            <th>讲师</th>
            <th>图片</th>
            <th>简介</th>
            <th>课程</th>
            <th>荣誉</th>
            <th>资历</th>
            <th>操作</th>
        </tr>
        <?php
//        var_dump($data);exit;
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['id']?></td>
                <td><? echo $v['name']?></td>
                <td><? echo $v['pic']?></td>
                <td><? echo $v['introduction']?></td>
                <td><? echo $v['subject']?></td>
                <td><? echo $v['honorary']?></td>
                <td><? echo $v['seniority']?></td>

                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/teachers/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                  </td>
              </tr>
         <?php }?>
    </table>
</div>
<script>
        function del(id){
            if(confirm("确定删除内容吗")) {
                $.get("/admin/teachers/del", {id: id},
                    function (msg) {
                        if (msg) {
                            alert('删除成功');
                        }
                    }, 'text'
                );
            }
        }
</script>
