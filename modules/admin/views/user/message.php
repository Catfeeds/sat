<div class="span10">
    <a href="/admin/user/index">用户管理</a>>用户留言信息
        <table border="1"  width="800px">
            <tr align="center">
                <th>id</th>
                <th>姓名</th>
                <th>电话</th>
                <th>邮箱</th>
                <th>申请国家</th>
                <th>sat的目标分数</th>
                <th>sat考试时间</th>
                <th>留言时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['name']?></td>
                <td><?php echo $v['phone']?></td>
                <td><?php echo $v['email']?></td>
                <td><?php echo $v['country']?></td>
                <td><?php echo $v['goal']?></td>
                <td><?php echo $v['examinationTime']?></td>
                <td><?php echo $v['time']?></td>
                <td>
                    <?php echo $v['flag']=='0'?'未处理':'已处理'?>
                </td>
                <td><a><span onclick="check('<?php echo $v['id']?>','1')">已处理</span></a>
                    <a><span onclick="check('<?php echo $v['id']?>','0')">未处理</span></a>
                </td>
            </tr>
        <?php }?>
</div>
<script>
    function check(id,flag){
        $.post('/admin/user/check',{id:id,flag:flag},function(re){
            alert(re.message);
            window.location.href='/admin/user/message';
        },"json")
    }
</script>