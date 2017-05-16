<div class="span10">
    <a href="/admin/student/case">添加学员案例</a>
    <table border="1"  width="800px">
        <tr align="center">
            <th>id</th>
            <th>姓名</th>
            <th>照片</th>
            <th>性别</th>
            <th>学校</th>
            <th>专业</th>
            <th>年级</th>
            <th>申请方向</th>
            <th>教师</th>
            <th>GPA</th>
            <th>TOFEL</th>
            <th>GMAT</th>
            <th>录取学校</th>
            <th>内容</th>
            <th>操作</th>
        </tr>
    <?php
    foreach($data as $v){?>
        <tr>
            <td><? echo $v['id']?></td>
            <td><? echo $v['name']?></td>
            <td><? echo $v['pic']?></td>
            <td><? echo $v['gender']?></td>
            <td><? echo $v['school']?></td>
            <td><? echo $v['major']?></td>
            <td><? echo $v['grade']?></td>
            <td><? echo $v['direction']?></td>
            <td><? echo $v['teacher']?></td>
            <td><? echo $v['GPA']?></td>
            <td><? echo $v['TOFEL']?></td>
            <td><? echo $v['GMAT']?></td>
            <td><? echo $v['matriculate']?></td>
            <td title="<? echo $v['content']?>"><? echo $v['content']?></td>

            <td>
                <a class="link-update" href="<?php echo baseUrl.'/admin/student/case'.'?'.'id='.$v['id']?>">修改</a>
                <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
            </td>
        </tr>
    <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/student/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>