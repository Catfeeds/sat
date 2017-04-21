<div class="table-box" xmlns="http://www.w3.org/1999/html">
    <form action="<?php echo baseUrl."/admin/role/add"?>" method="post">
        <table>
            <tr>
                <td>角色名:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>模&nbsp;&nbsp;块:</td>
                <td><input type="text" name="modules" value="admin" readonly="readonly"></td>

            </tr>
            <tr>
                <td>控制器:</td>
                <td>
                    <?php foreach($data as $v){?>
                    <a id="<?php echo$v['id']?>" onclick="show(<?php echo$v['id']?>)"> <?php echo $v['name'] ?></a>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>方法:</td>
                <td ><?php foreach($data1 as $val){?>
                        <input type="checkbox" name="action" value="<?php echo $val['id'] ?>"/><?php echo $val['name'] ?>

                    <?php } ?></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <input id="btn" type="button" value="分配权限" onclick="this.disabled=true; this.form.submit();">
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    function show(id){
//        alert(id);
                $.get("/admin/role/show", {id: id},
                    function (msg) {
                        if (msg) {
//                            var obj = eval( msg );
//                            console.log(obj);
////                      var item;
//                            $.each(msg,function(i,result){
//                                item = "<tr><td>"+result['num']+"</td><td>"+result['title']+"</td><td>"+result['credate']+"</td><td>操作</td></tr>";
//                                $('.table').append(item);
//                            });
                        }
                    }, 'json'
                );
    }

</script>