<div class="span10">
    用户管理>公开课报名信息
        <table border="1"  width="800px">
            <tr align="center">
                <th>id</th>
                <th>课程名称</th>
                <th>报名用户id</th>
                <th>用户电话号码</th>
                <th>公开课地址</th>
                <th>操作</th>
            </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><? echo $v['id']?></td>
                <td><? echo $v['title']?></td>
                <td><? echo $v['uid']?></td>
                <td><? echo $v['phone']?></td>
                <td><? echo $v['address']?></td>
                <td>发送公开课地址</td>
            </tr>
        <?php }?>
</div>