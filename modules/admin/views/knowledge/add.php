<div class="span10">
    <div >
        <div >
            <a>首页</a>
            <span >&gt;</span>
            <span>知识点管理</span>
            <span >&gt;</span>
            <span>添加</span>
        </div>
    </div>
    <form action="<?php echo baseUrl.'/admin/knowledge/add'?>" method="post">
        <table>
            <tr>
                <td>科目:</td>
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
                <td>知识点名称：</td>
                <td><input name="name" value="<?php echo isset($data)?$data['name']:''?>" type="text" style="width:500px;"></td>
            </tr>
            <tr>
                <td>知识点解析：</td>
                <td><input type="text" name="analysis" value="<?php echo isset($data)?$data['analysis']:''?>" style="width:500px;"></td>
            </tr>
            <tr>
                <td>相关题型：</td>
                <td><input type="text" name="related" value="<?php echo isset($data)?$data['related']:''?>" style="width:500px;"></td>
            </tr>

            <tr>
                <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <td colspan="2" align="right"> <input value="添加/修改" type="submit"></td>
            </tr>
        </table>
    </form>
</div>
