<div class="span10">
    用户管理>公开课报名信息
        <table border="1"  width="800px">
            <tr align="center">
                <th>id</th>
                <th>课程id</th>
                <th>课程名称</th>
                <th>用户电话号码</th>
                <th>公开课地址</th>
                <th>操作</th>
            </tr>
        <?php
//        var_dump($data);die;
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['id']?></td>
                <td><? echo $v['pubclass_id']?></td>
                <td id="title<?php echo $v['id']?>"><? echo $v['title']?></td>
                <td id="vip<?php echo $v['id']?>"><? echo $v['phone']?></td>
                <td id="addr<?php echo $v['id']?>"><? echo $v['address']?></td>
                <td><a><span onclick="leftCode('<?php echo $v['id']?>')">发送公开课地址</span></a>
                    <a href="<?php echo baseUrl.'/admin/user/apply_edit'.'?'.'id='.$v['id']?>">添加公开课地址</a>
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