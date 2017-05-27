<div class="span10">
    <a href='<?php echo baseUrl."/admin/about/index"?>'>关于我们</a><span >&gt;</span><span><a href='<?php echo baseUrl."/admin/about/join"?>'>加入我们</a></span><span >&gt;</span><span>添加/修改</span>
    <form name="form" method="post" action="<?php echo baseUrl.'/admin/about/join_add'?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td width="80px">类别:</td>
                <td>
                    <select name="cate" >
                        <option value ="">请选择工作类别</option>
                        <option value ="教育类" <?php echo isset($data)&& $data['cate']=="教育类" ?  'selected':''?>>教育类</option>
                        <option value ="营销/市场类" <?php echo isset($data)&& $data['cate']=="营销/市场类" ?  'selected':''?>>营销/市场类</option>
                        <option value ="留学顾问类" <?php echo isset($data)&& $data['cate']=="留学顾问类" ?  'selected':''?>>留学顾问类</option>
                        <option value ="综合类" <?php echo isset($data)&& $data['cate']=="综合类" ?  'selected':''?>>综合类</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="80px">职位:</td>
                <td><input type="text" name="job" placeholder='职位'  value="<?php echo isset($data)? $data['job']:''?>"></td>
            </tr>
            <tr>
                <td>任职要求:</td>
                <td>
                    <textarea name="demand" id="" cols="30" rows="10"><?php echo isset($data)? $data['demand']:''?></textarea>
                </td>
            </tr>
            <tr>
                <td>就职城市</td>
                <td>
                    <input  type="text" name="city"  value="<?php echo isset($data)? $data['city']:''?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button>
                </td>
            </tr>

        </table>
    </form>

</div>