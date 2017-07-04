<div class="span10">
    用户管理>给出复习建议
    <form class="form" method="post" action="<?php echo baseUrl."/admin/user/suggest_edit"?>">
        <table>
        <tr>
            <td>科目:</td>
            <td>
                <select name="major">
                    <option value ="">请选择类型</option>
                    <option value ="Math" <?php echo isset($data['major'])&& $data['major']=="Math" ?  'selected':''?>>数学</option>
                    <option value ="Reading" <?php echo isset($data['major'])&& $data['major']=="Reading" ?  'selected':''?>>阅读</option>
                    <option value ="Writing" <?php echo isset($data['major'])&& $data['major']=="Writing" ?  'selected':''?>>写作</option>
                    <option value ="Essay" <?php echo isset($data['major'])&& $data['major']=="Essay" ?  'selected':''?>>作文</option>
                </select>

            </td>
        </tr>
        <tr>
            <td>最低分:</td>
            <td><input type="text" name="min" value="<?php echo isset($data)?$data['min']:''?>" placeholder="与最高分构成分数区间" ></td>
        </tr>
        <tr>
            <td>最高分:</td>
            <td><input type="text" name="max" value="<?php echo isset($data)?$data['max']:''?>" placeholder="与最低分构成分数区间" ></td>
        </tr>
        <tr>
            <td>复习建议:</td>
            <td><input type="text" name="suggestion" value="<?php echo isset($data)?$data['suggestion']:''?>" placeholder="" ></td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>" />
                <button type="submit" id="login-button">添加</button>
            </td>
        </tr>
        </table>
    </form>
</div>