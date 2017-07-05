
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>题库管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/questions/add'?>">添加具体题目</a></br>
    <a href="<?php echo baseUrl.'/admin/questions/extend'?>">添加短文或题目图片</a></br>
    <a href="<?php echo baseUrl.'/admin/questions/testpaper'?>">试卷管理</a><br/> </br>
    显示<a><span id="showtop">题目</span></a></br>
    显示<a><span id="showextend">题目附件信息</span></a>
    <div id="topicextend" style="display:none;">
        短文、图片表
        <table border="1"  width="100%" >
            <tr align="center">
                <th>id</th>
                <th>题号</th>
                <th>题目</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($data as $v){?>
                <tr>
                    <td><?php echo $v['id']?></td>
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

    <div id="topic" style="display:none;">
        题目信息表
        <table border="1"  width="100%" >
            <tr align="center">
                <th>id</th>
                <th>题号</th>
                <th>题目</th>
                <th>答案</th>
                <th>科目</th>
                <th>题目来源</th>
                <th>subScores</th>
                <th>cross-testScores</th>
                <th>操作</th>
        </tr>
        <?php
        foreach($arr as $v){?>
            <tr style="line-height:50px;overflow:hidden;">
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['number']?></td>
                <td><?php echo $v['content']?></td>
                <td><?php echo $v['answer']?></td>
                <td><?php echo $v['major']?></td>
                <td><?php echo $v['tpId']?></td>
                <td><?php echo $v['subScores']?></td>
                <td><?php echo $v['crosstestScores']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/questions/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
         <?php }?>
    </table>
    </div>
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
        $('#showtop').click(function(){
            if($('#topic').is(':hidden')){
                $('#topic').show();
                $('#topicextend').hide();
            }else{
                $('#topic').hide();
            }
        });
        $('#showextend').click(function(){
            if($('#topicextend').is(':hidden')){
                $('#topicextend').show();
                $('#topic').hide();
            }else{
                $('#topicextend').hide();
            }

        });
</script>
