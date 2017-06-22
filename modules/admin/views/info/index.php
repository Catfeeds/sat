<style>
    /*td {*/
        /*white-space:nowrap;overflow:hidden;text-overflow: ellipsis;*/
    /*}*/
</style>
<div class="span10">
    <div >
        <a href="">首页</a><span >&gt;</span><span>资讯管理</span>
    </div>
    <a href="<?php echo baseUrl.'/admin/info/add'?>">添加资讯</a>
    <table border="1"  >
        <tr align="center">
            <th style="width: 30px;">id</th>
            <th>资讯标题</th>
            <th>图片</th>
            <th>摘要</th>
            <th style="width:100px;">内容</th>
            <th>资讯类别</th>
            <th>发布时间</th>
            <th style="width: 50px;">点击量</th>
            <th>有效时间</th>
            <th>操作</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['title']?></td>
                <td title="<?php echo $v['pic']?>"><?php echo $v['pic']?></td>
                <td><?php echo $v['summary']?></td>
                <td style="width:300px;align:left;" title="<?php echo $v['content']?>"><?php echo $v['content']?></td>
                <td><?php echo $v['cate']?></td>
                <td><?php echo $v['publishTime']?></td>
                <td><?php echo $v['hits']?></td>
                <td><?php echo $v['validTime']?></td>
                <td>
                    <a class="link-update" href="<?php echo baseUrl.'/admin/info/add'.'?'.'id='.$v['id']?>">修改</a>
                    <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/info/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
