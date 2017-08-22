<div class="span10">
    <a href="/admin/user/index">用户管理</a>>公开课报名信息
        <table border="1"  width="800px">
            <tr align="center">
                <th>id</th>
                <th>课程id</th>
                <th>课程名称</th>
                <th>用户联系方式</th>
<!--                <th>用户邮箱</th>-->
<!--                <th>公开课地址</th>-->
<!--                <th>操作</th>-->
            </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['pubclass_id']?></td>
                <td id="title<?php echo $v['id']?>"><?php echo $v['title']?></td>
                <td id="vip<?php echo $v['id']?>"><?php echo $v['phone']?></td>
<!--                <td>--><?php //echo $v['email']?><!--</td>-->
<!--                <td id="addr--><?php //echo $v['id']?><!--">--><?php //echo $v['address']?><!--</td>-->
<!--                <td><a><span onclick="leftCode('--><?php //echo $v['id']?>
<!--                //')">发送公开课地址</span></a>-->
<!--                    <a href="--><?php //echo baseUrl.'/admin/user/apply_edit'.'?'.'id='.$v['id']?><!--">添加公开课地址</a>-->
                </td>
            </tr>
        <?php }?>
</div>
<script>
    function leftCode(code){
        var phone = $('#vip'+code).html();
        var title = $('#title'+code).html();
        var address = $('#addr'+code).html();
        $.post('/user/api/class-address',{phone:phone,title:title,address:address},function(re){
            alert(re.message);
        },"json")
    }
</script>