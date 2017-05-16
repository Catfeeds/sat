<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>讲师管理</span>
        <span >&gt;</span>
        <span>添加</span>
    </div>
    <table>
        <form class="form" method="post" action="<?php echo baseUrl."/admin/teachers/add"?>" enctype="multipart/form-data">
            <tr>
                <td width="80px">讲师:</td>
                <td><input type="text" name="name" value="<?php echo isset($data)?$data['name']:''?>" placeholder="讲师名"></td>
            </tr>
            <tr>
                <td>照片:</td>
                <td>
<!--                    <input type="text" name="pic" value="--><?php //echo isset($data)?$data[0]['pic']:''?><!--" placeholder="图片">-->
                    <?php  if(isset($data)) {$pic=$data['pic'];echo"<input name='pic' type='text' value='$pic'>";}
                    else {echo '<input id="file" type="file" name="pic" >';
                    }?>
                </td>
            </tr>
            <tr>
                <td>简介:</td>
                <td><input type="text" name="introduction" value="<?php echo isset($data)?$data['introduction']:''?>" placeholder="简介"></td>
            </tr>
            <tr>
                <td>主讲课程:</td>
                <td><input type="text" name="subject" value="<?php echo isset($data)?$data['subject']:''?>" placeholder="主讲课程" ></td>
            </tr>
            <tr>
                <td>荣誉职称:</td>
                <td><input type="text" name="honorary" value="<?php echo isset($data)?$data['honorary']:''?>"  placeholder="荣誉职称" ></td>
            </tr>
            <tr>
                <td>资历:</td>
                <td><input type="text" name="seniority" value="<?php echo isset($data)?$data['seniority']:''?>" placeholder="资历" ></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button></td>
            </tr>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

        </form>
    </table>
</div>