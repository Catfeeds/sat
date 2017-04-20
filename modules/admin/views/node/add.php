
<div class="stran10">
    <form action="<?php echo baseUrl."/admin/node/add"?>" method="post">
        <table>
        <tr>
            <td>节点名称：</td>
            <td><input type="text" name="name" placeholder="节点名称" /></td>
        </tr>
<!--        <tr>-->
<!--            <td>节点别名：</td>-->
<!--            <td><input type="text" name="title" placeholder="节点别名" /></td>-->
<!--        </tr>-->

            <td>父节点：</td>
            <td>
                <select name="pid">
                    <option value="0">顶级节点</option>
                    <?php foreach($data as $v){?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php }?>
                </select>
            </td>
        
        <tr>
            <td>模块名：</td>
            <td><input type="text" name="module" placeholder="模块名" /></td>
        </tr>
        <tr>
            <td>控制器名：</td>
            <td><input type="text" name="controller" placeholder="控制器名" /></td>
        </tr>
        <tr>
            <td>方法名：</td>
            <td><input type="text" name="action" placeholder="方法名" /> </td>
        </tr>

        <tr>
            <td>路径：</td>
            <td><input type="text" name="path" /> </td>
        </tr>
        <tr >
            <td>级别：</td>
            <td><input type="text" name="level" /> </td>
        </tr>
<!--        <tr >-->
<!--            <td>排序：</td>-->
<!--            <td><input type="text" name="sort" /></td>-->
<!--        </tr>-->
        <tr >
            <td>是否显示：</td>
            <td><input type="text" name="isShow" /></td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <input type="button" value="添加节点" onclick="this.disabled=true; this.form.submit();">
            </td>
        </tr>
    </table>
</form>
</div>
