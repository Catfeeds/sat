<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
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
                <td width="80px">适合学生:</td>
                <td>
                    <textarea type="text/plain" id="editor" name="student" placeholder="入学要求" style="height:300px;width:70%"><?php echo isset($data)? $data["student"]:''?></textarea>
                </td>
            </tr>
<!--            <tr>-->
<!--                <td>图片:</td>-->
<!--                <td>-->
<!--                    --><?php // if(isset($data)&& $data['pic']!='') {$pic=$data['pic'];echo"<input name='pic' type='text' value='$pic'>";}
//                    else {echo '<input id="file" type="file" name="pic" >';
//                    }?><!-- 只能添加'gif','jpg','jpeg','bmp','png'格式的图片-->
<!--                </td>-->
<!--            </tr>-->
            <?php if(isset($data)) {
                $str = '<tr>';
                $str .= '<td>原图片:</td>';
                $str .= '<td>';
                $pic = $data['pic'];
                $str .= "<input name='pic' type='text' value='" . $pic . "'></td></tr>";
                echo $str;
            } ?>

            <tr>
                <td>上传\修改图片:</td>
                <td>
                    <input id="file" type="file" name="pic" >
                </td>
            </tr>
            <tr>
                <td>类别:</td>
<!--                <td><input type="text" name="cate" placeholder="类别"></td>-->
                <td>
                    <select name="cate">
                        <option value ="">请选择班级</option>
                        <option value ="暑期全能小班" <?php echo isset($data)&& $data['cate']=="暑期全能小班" ?  'selected':''?>>暑期全能小班</option>
                        <option value ="暑期冲刺小班" <?php echo isset($data)&& $data['cate']=="暑期冲刺小班" ?  'selected':''?>>暑期冲刺小班</option>
                        <option value ="全能周末班" <?php echo isset($data)&& $data['cate']=="全能周末班" ?  'selected':''?>>全能周末班</option>
                        <option value ="在线强化班" <?php echo isset($data)&& $data['cate']=="在线强化班" ?  'selected':''?>>在线强化班</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>课时及分类</td>
                <td ><input type="text" style="width: 600px;" name="duration" placeholder="格式如：阅读:15,文法:15...英文符号" value="<?php echo isset($data)? $data['duration']:''?>"/></td>
            </tr>
            <tr>
                <td>授课教师：</td>
                <td><input type="text" style="width: 600px;" name="teacher" placeholder="老师" value="<?php echo isset($data)? $data['teacher']:''?>"/></td>
            </tr>
            <tr>
                <td>学习计划：</td>
                <td>
                    <textarea type="text/plain" id="plan"  name="plan" placeholder="学习计划" style="height:300px;width:70%"><?php echo isset($data)? $data['plan']:''?></textarea>
                </td>
            </tr>
            <tr>
                <td>价格：</td>
                <td><input type="text"  style="width: 600px;" name="price" placeholder="课程价格" value="<?php echo isset($data)? $data['price']:''?>"/></td>
            </tr>
            <tr>
                <td>课程简介：</td>
                <td>
                    <textarea type="text/plain" id="intro"  name="introduction" placeholder="课程简介" style="height:300px;width:70%"><?php echo isset($data)? $data['introduction']:''?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"> <button type="submit" id="login-button">添加课程</button></td>
            </tr>
            <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>
</div>
<script>
    //实例化编辑器
    var ue = UE.getEditor('editor');
    var plan = UE.getEditor('plan');
    var intro = UE.getEditor('intro');
</script>