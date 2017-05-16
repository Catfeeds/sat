
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>题库管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/add'?>">添加题目</>
    </br>
    <a href="<?php echo baseUrl.'/admin/questions/testpaper'?>">试卷</>
    <table border="1"  width="100%">
        <tr align="center">
            <th>id</th>
            <th>题目</th>
            <th>选项A</th>
            <th>选项B</th>
            <th>选项C</th>
            <th>选项D</th>
<!--            <th>选项E</th>-->
            <th>答案</th>
            <th>分数</th>
            <th>科目</th>
            <th>题目来源</th>
            <th>难度</th>
            <th>操作</th>
        </tr>
        <?php
//        var_dump($data);exit;
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['id']?></td>
                <td><? echo $v['content']?></td>
                <td><? echo $v['keyA']?></td>
                <td><? echo $v['keyB']?></td>
                <td><? echo $v['keyC']?></td>
                <td><? echo $v['keyD']?></td>
<!--                <td>--><?// echo $v['keyE']?><!--</td>-->
                <td><? echo $v['answer']?></td>
                <td><? echo $v['score']?></td>
                <td><? echo $v['major']?></td>
                <td><? echo $v['sourceId']?></td>
                <td><? echo $v['leverId']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/questions/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                  </td>
              </tr>
         <?php }?>
    </table>
</div>
<script>
        function del(id){
            if(confirm("确定删除内容吗")) {
                $.get("/admin/questions/del", {id: id},
                    function (msg) {
                        if (msg) {
                            alert('删除成功');
                        }
                    }, 'text'
                );
            }
        }
</script>
