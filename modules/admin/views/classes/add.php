<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>课程管理</span>
        <span >&gt;</span>
        <span>添加</span>
    </div>
    <form class="form" method="post" action="<?php echo baseUrl."/admin/classes/add"?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td width="80px">课程:</td>
                <td><input type="text" name="className" placeholder="课程名" value="<?php echo isset($data)? $data['className']:''?>"></td>
            </tr>
            <tr>
                <td>图片:</td>
                <td>
                    <?php  if(isset($data)&& $data['pic']!='') {$pic=$data['pic'];echo"<input name='up' type='text' value='$pic'>";}
                    else {echo '<input id="file" type="file" name="up" >';
                    }?> 只能添加'gif','jpg','jpeg','bmp','png'格式的图片
                </td>
            </tr>
            <tr>
                <td>类别:</td>
<!--                <td><input type="text" name="cate" placeholder="类别"></td>-->
                <td>
                    <select name="cate">
                        <option value ="">请选择班级</option>
                        <option value ="基础班" <?php echo isset($data)&& $data['cate']=="基础班" ?  'selected':''?>>基础班</option>
                        <option value ="提高班" <?php echo isset($data)&& $data['cate']=="提高班" ?  'selected':''?>>提高班</option>
                        <option value ="精英班" <?php echo isset($data)&& $data['cate']=="精英班" ?  'selected':''?>>精英班</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>价格:</td>
                <td><input type="text" name="price" placeholder="价格" value="<?php echo isset($data)? $data['price']:''?>"/></td>
            </tr>
            <tr>
                <td>课时:</td>
                <td><input type="text" name="duration" placeholder="课时" value="<?php echo isset($data)? $data['duration']:''?>" ></br></td>
            </tr>
            <tr>
                <td>科目:</td>
                <td>
                    <select name="major" >
                        <option value ="">请选择课程</option>
                        <option value ="数学" <?php echo isset($data)&& $data['major']=="数学" ?  'selected':''?>>数学</option>
                        <option value ="阅读" <?php echo isset($data)&& $data['major']=="阅读" ?  'selected':''?>>阅读</option>
                        <option value ="写作" <?php echo isset($data)&& $data['major']=="写作" ?  'selected':''?>>写作</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>讲师:</td>
                <td><input type="text" name="teacher" placeholder="讲师" value="<?php echo isset($data)? $data['teacher']:''?>"></td>
            </tr>
            <tr>
                <td>课程简介:</td>
                <td><input type="text" name="introduction" placeholder="课程简介" value="<?php echo isset($data)? $data['introduction']:''?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="right"> <button type="submit" id="login-button">添加课程</button></td>
            </tr>
            <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>
</div>