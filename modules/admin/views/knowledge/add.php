<div class="span10">
    <div >
        <div >
            <a href="/index/index">首页</a>
            <span >&gt;</span>
            <span>知识点管理</span>
            <span >&gt;</span>
            <span>添加</span>
        </div>
    </div>
    <form action="<?php echo baseUrl.'/admin/knowledge/add'?>" method="post">
        <table>
<!--            <tr>-->
<!--                <td>科目:</td>-->
<!--                <td>-->
<!--                    <select name="major" style="width:500px;">-->
<!--                        <option value ="">请选择科目</option>-->
<!--                        <option value ="数学" --><?php //echo isset($data)&& $data['major']=="数学" ?  'selected':''?><!--></option>
<!--                        <option value ="阅读" --><?php //echo isset($data)&& $data['major']=="阅读" ?  'selected':''?><!--></option>
<!--                        <option value ="作文" --><?php //echo isset($data)&& $data['major']=="作文" ?  'selected':''?><!--></option>
<!--                    </select>-->
<!--                </td>-->
<!--            </tr>-->
            <tr>
                <td>类别:</td>
                <td>
                    <select name="major" style="width:500px;">
                        <option value ="">请选择类型</option>
                        <option value ="Expression Of Ideas" <?php echo isset($data)&& $data['major']=="Expression Of Ideas" ?  'selected':''?>>Expression Of Ideas</option>
                        <option value ="Standard English Conventions" <?php echo isset($data)&& $data['major']=="Standard English Conventions" ?  'selected':''?>>Standard English Conventions</option>
                        <option value ="数学" <?php echo isset($data)&& $data['major']=="作文" ?  'selected':''?>>数学</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>小类:</td>
                <td>
                    <select name="cate" style="width:500px;">
                        <option value ="">请选择类型</option>
                        <option value ="development" <?php echo isset($data)&& $data['cate']=="development" ?  'selected':''?>>development</option>
                        <option value ="organization" <?php echo isset($data)&& $data['cate']=="organization" ?  'selected':''?>>organization</option>
                        <option value ="effective language use" <?php echo isset($data)&& $data['cate']=="effective language use" ?  'selected':''?>>effective language use</option>
                        <option value ="structure" <?php echo isset($data)&& $data['cate']=="structure" ?  'selected':''?>>structure</option>
                        <option value ="usage" <?php echo isset($data)&& $data['cate']=="usage" ?  'selected':''?>>usage</option>
                        <option value ="punctutation" <?php echo isset($data)&& $data['cate']=="punctutation" ?  'selected':''?>>punctutation</option>
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

