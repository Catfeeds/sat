<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="span10">
    <div >
        <div >
            <a>首页</a>
            <span >&gt;</span>
            <span>学员案例</span>
            <span >&gt;</span>
            <span>添加</span>
        </div>
    </div>
    <form action="<?php echo baseUrl.'/admin/student/case'?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>姓名:</td>
                <td>
                    <input name="name" value="<?php echo isset($data)?$data['name']:''?>" type="text" style="width:500px;">*必填
                </td>
            </tr>
<!--            <tr>-->
<!--                <td>照片:</td>-->
<!--                <td>-->
<!--                    --><?php // if(isset($data)) {$pic=$data['pic'];echo"<input name='pic' type='text' value='$pic' style='width: 500px;;'>";}
//                    else {echo '<input id="file" type="file" name="pic" >';
//                    }?>
<!--                </td>-->
<!--            </tr>-->
            <?php if(isset($data)) {
                $str = '<tr>';
                $str .= '<td>原照片:</td>';
                $str .= '<td>';
                $pic = $data['pic'];
                $str .= "<input name='pic' type='text' value='" . $pic . "'></td></tr>";
                echo $str;
            } ?>

            <tr>
                <td>上传照片:</td>
                <td>
                    <input id="file" type="file" name="pic" >
                </td>
            </tr>
            <tr>
                <td>性别：</td>
                <td>
                    <input name="gender" type="radio" value="男" <?php echo isset($data)&& $data['gender']=="男" ?  'checked="checked"':''?>/>男
                    <input name="gender" type="radio" value="女" <?php echo isset($data)&& $data['gender']=="女" ?  'checked="checked"':''?>/>女
                </td>
            </tr>
            <tr>
                <td>学校：</td>
                <td><input type="text" name="school" value="<?php echo isset($data)?$data['school']:''?>" style="width:500px;"></td>
            </tr>
            <tr>
                <td>专业：</td>
                <td><input type="text" name="major" value="<?php echo isset($data)?$data['major']:''?>" style="width:500px;">*必填</td>
            </tr>
            <tr>
                <td>年级：</td>
                <td><input type="text" name="grade" value="<?php echo isset($data)?$data['grade']:''?>" style="width:500px;"></td>
            </tr>
            <tr>
                <td>申请方向：</td>
                <td><input type="text" name="direction" value="<?php echo isset($data)?$data['direction']:''?>" style="width:500px;">*必填</td>
            </tr>
            <tr>
                <td>教师：</td>
                <td><input type="text" name="teacher" value="<?php echo isset($data)?$data['teacher']:''?>" style="width:500px;"></td>
            </tr>
            <tr>
                <td>GPA：</td>
                <td><input type="text" name="GPA" value="<?php echo isset($data)?$data['GPA']:''?>" style="width:500px;"></td>
            </tr>
            <tr>
                <td>TOFEL：</td>
                <td><input type="text" name="TOFEL" value="<?php echo isset($data)?$data['TOFEL']:''?>" style="width:500px;"></td>
            </tr>
            <tr>
                <td>SAT：</td>
                <td><input type="text" name="SAT" value="<?php echo isset($data)?$data['SAT']:''?>" style="width:500px;"></td>
            </tr>
            <tr>
                <td>录取学校：</td>
                <td><input type="text" name="matriculate" value="<?php echo isset($data)?$data['matriculate']:''?>" style="width:500px;">*必填</td>
            </tr>
            <tr>
                <td>内容：</td>
                <td id="content">
                    <textarea id="editor" type="text/plain" name="content" style="width:600px;height:300px;">
                        <?php echo isset($data)? $data['content']:''?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <td colspan="2" align="right"> <input value="添加/修改" type="submit"></td>
            </tr>
        </table>
    </form>
</div>
<script>
    var ue = UE.getEditor('editor');
</script>
