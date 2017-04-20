<div class="span10">
        <div >
            <div >
                <a href="">首页</a>
                <span >&gt;</span>
                <span>分类管理</span>
            </div>
        </div>
        <div >
            <form name="myform" id="myform" method="post">
                <div>
                    <div>
                        <a href="<?php echo baseUrl."/admin/cate/add"?>">添加顶级分类</a>
                    </div>
                </div>
                <div>
                    <table  width="80%" border="1">
                        <tr>
                            <th>id</th>
                            <th>名字</th>
                            <th>父分类</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach ($data as $v){?>
                        <tr>
                            <td><?php echo $v['id']?></td>
                            <td style="padding-left:<?php echo $v['level']*20?>px"><?php echo $v['name']?></td>
                            <td><?php echo $v['pid']?></td>
                            <td>
                                <a  href="<?php echo baseUrl."/admin/cate/add"."?id=".$v['id']?>">添加子类</a>
                                <a  href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </form>
        </div>
</div>
<script>
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/cate/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
