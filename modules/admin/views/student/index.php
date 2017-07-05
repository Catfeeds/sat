<div class="span10">
    <a href="/admin/student/case">添加学员案例</a>
    <table border="1"  width="100%">
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
            <th>SAT</th>
            <th>录取学校</th>
            <th>内容</th>
            <th>操作</th>
        </tr>
    <?php
    foreach($data as $v){?>
        <tr>
            <td><?php echo $v['id']?></td>
            <td><?php echo $v['name']?></td>
            <td><?php echo $v['pic']?></td>
            <td><?php echo $v['gender']?></td>
            <td><?php echo $v['school']?></td>
            <td><?php echo $v['major']?></td>
            <td><?php echo $v['grade']?></td>
            <td><?php echo $v['direction']?></td>
            <td><?php echo $v['teacher']?></td>
            <td><?php echo $v['GPA']?></td>
            <td><?php echo $v['TOFEL']?></td>
            <td><?php echo $v['SAT']?></td>
            <td><?php echo $v['matriculate']?></td>
            <td title="<?php echo $v['content']?>"><? echo $v['content']?></td>

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