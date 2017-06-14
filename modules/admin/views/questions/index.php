
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>题库管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/add'?>">添加题目</>
    </br>
    <a href="<?php echo baseUrl.'/admin/questions/testpaper'?>">试卷</>
    <table border="1"  width="100%" style="table-layout:fixed ;">
        <tr align="center">
            <th>id</th>
            <th>题号</th>
            <th>题目</th>
            <th>短文</th>

<!--            <th>选项A</th>-->
<!--            <th>选项B</th>-->
<!--            <th>选项C</th>-->
<!--            <th>选项D</th>-->
<!--            <th>选项E</th>-->
            <th>答案</th>
            <th>科目</th>
            <th>短文id</th>
            <th>题目来源</th>
            <th>subScores</th>
            <th>cross-testScores</th>
            <th>操作</th>
        </tr>
        <?php
//        var_dump($data);exit;
        foreach($data as $v){?>
            <tr style="line-height:50px;overflow:hidden;">
                <td><? echo $v['id']?></td>
                <td><? echo $v['number']?></td>
                <td style="overflow:hidden;"><? echo $v['content']?></td>
                <td style="overflow:hidden;"><? echo  ($v['essay']!=false)? '此处有短文':'无内容';?></td>
<!--                <td style="overflow:hidden;">--><?// echo $v['keyA']?><!--</td>-->
<!--                <td style="overflow:hidden;">--><?// echo $v['keyB']?><!--</td>-->
<!--                <td style="overflow:hidden;">--><?// echo $v['keyC']?><!--</td>-->
<!--                <td style="overflow:hidden;">--><?// echo $v['keyD']?><!--</td>-->
<!--                <td style="overflow:hidden;">--><?// echo $v['keyE']?><!--</td>-->
                <td><? echo $v['answer']?></td>
<!--                <td>--><?// echo $v['score']?><!--</td>-->
                <td><? echo $v['major']?></td>
                <td><? echo $v['pid']?></td>
                <td><? echo $v['sourceId']?></td>
                <td><? echo $v['subScores']?></td>
                <td><? echo $v['crosstestScores']?></td>
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
