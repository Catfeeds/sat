<div class="span10">
    <a href="/admin/user/index">用户管理</a>>添加上课地址
    <form class="form" method="post" action="<?php echo baseUrl."/admin/user/apply_edit"?>">
        <table>
            <tr>
                <td>授课地址:</td>
                <td><input type="text" name="address" value="<?php echo isset($data)?$data['address']:''?>" placeholder="" ></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <input type="hidden" name="id" value="<?php echo $id?>" />
                    <button type="submit" id="login-button">添加</button>
                </td>
            </tr>
        </table>
    </form>
</div>