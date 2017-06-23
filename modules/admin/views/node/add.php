
<div class="stran10">
    <span><a href="/admin/role/index">权限管理</a></span>
    <span >&gt;</span>
    <span>节点管理</span>
    <span >&gt;</span>
    <span>添加节点</span>
    <form action="<?php echo baseUrl."/admin/node/add"?>" method="post">
        <table>
        <tr>
            <td>节点名称：</td>
            <td><input type="text" name="name" placeholder="节点名称" value="<?php echo isset($arr)? $arr['name']:''?>"/></td>
        </tr>
        <tr>
            <td>父节点：</td>
            <td>
                <select name="pid">
                    <option value="0" <?php echo isset($arr)&&$arr['pid']=="0" ? "selected":''?>>顶级节点</option>
                    <?php foreach($data as $v){?>
                    <option value="<?php echo $v['id']?>" <?php echo isset($arr)&&$arr['pid']==$v['id'] ? "selected":''?>><?php echo $v['name']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td>模块名：</td>
            <td><input type="text" name="module" placeholder="模块名" value="<?php echo isset($arr)? $arr['module']:''?>"/></td>
        </tr>
        <tr>
            <td>控制器名：</td>
            <td><input type="text" name="controller" placeholder="控制器名" value="<?php echo isset($arr)? $arr['controller']:''?>"/></td>
        </tr>
        <tr>
            <td>方法名：</td>
            <td><input type="text" name="action" placeholder="方法名" value="<?php echo isset($arr)? $arr['action']:''?>"/> </td>
        </tr>

        <tr>
            <td>路径：</td>
            <td><input type="text" name="path"  placeholder="以admin/index/add格式添加"value="<?php echo isset($arr)? $arr['path']:''?>"/> </td>
        </tr>
        <tr >
            <td>级别：</td>
            <td><input type="text" name="level" value="<?php echo isset($arr)? $arr['level']:''?>"/> </td>
        </tr>
<!--        <tr >-->
<!--            <td>排序：</td>-->
<!--            <td><input type="text" name="sort" /></td>-->
<!--        </tr>-->
        <tr >
            <td>是否显示：</td>
            <td><input type="text" name="isShow" value="<?php echo isset($arr)? $arr['isShow']:''?>"/></td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="hidden" name="id" value="<?php echo isset($arr)? $arr['id']:''?>" />
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <input type="button" value="添加节点" onclick="this.disabled=true; this.form.submit();">
            </td>
        </tr>
    </table>
</form>
</div>
