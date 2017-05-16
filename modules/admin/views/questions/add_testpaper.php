<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>题库管理</span>
        <span >&gt;</span>
        <span>添加试卷</span>
    </div>
    <form class="form" method="post" action="<?php echo baseUrl."/admin/questions/add_testpaper"?>">
        <table width="100%">
            <tr>
                <td width="80px">试卷名称:</td>
                <td>
                    <input type="text"  name="name" value="<?php echo isset($data)?$data['name']:''?>" style="width:80%;">
                </td>
            </tr>
            <tr>
                <td>科目</td>
                <td>
                    <select name="major">
                        <option value ="">请选择类型</option>
                        <option value ="数学" <?php echo isset($data)&& $data['major']=="数学" ?  'selected':''?>>数学</option>
                        <option value ="阅读" <?php echo isset($data)&& $data['major']=="阅读" ?  'selected':''?>>阅读</option>
                        <option value ="作文" <?php echo isset($data)&& $data['major']=="作文" ?  'selected':''?>>作文</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>年份</td>
                <td><input type="text" name="time" value="<?php echo isset($data)?$data['time']:''?>" placeholder="如：2017" style="width:80%;"></td>
            </tr>
            <tr>
                <td>来源</td>
                <td><input type="text" name="source" value="<?php echo isset($data)?$data['source']:''?>" placeholder="" style="width:80%;"></td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button>
                </td>
            </tr>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>

</div>