
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="span10">
    <a href="">首页</a><span >&gt;</span><span>资讯管理</span><span >&gt;</span><span>添加/修改</span>
    <form name="form" method="post" action="<?php echo baseUrl."/admin/info/add"?>" enctype="multipart/form-data">
        <table>

            <tr>
                <td width="80px">标题:</td>
                <td><input type="text" name="title" placeholder="标题" style="width: 500px;;" value="<?php echo isset($data)? $data['title']:''?>"></td>
            </tr>
            <tr>
                <td>内容图片</td>
                <td>
                    <?php  if(isset($data)) {$pic=$data['pic'];echo"<input name='up' type='text' value='$pic' style='width: 500px;;'>";}
                    else {echo '<input id="file" type="file" name="up" >';
                    }?>
                </td>
                <!--                    <input id="file_upload" name="file_upload" type="file" multiple="true">-->
            </tr>
            <tr>
                <td>内容:</td>
                <td>
                    <textarea id="editor" type="text/plain" name="content"  style="width:600px;height:300px;" ><?php echo isset($data)? $data['content']:''?></textarea>
                </td>
            </tr>
            <tr>
                <td>类别:</td>
                <!--                <td><input type="text" name="cate" placeholder="类别"></td>-->
                <td>
                    <select name="cate">
                        <option value ="">请选择类型</option>
                        <option value ="备考资讯" <?php echo isset($data)&& $data['cate']=="备考资讯" ?  'selected':''?>>备考资讯</option>
                        <option value ="新闻资讯" <?php echo isset($data)&& $data['cate']== "新闻资讯" ?  'selected':''?>>新闻资讯</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button></td>
            </tr>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>

</div>
<script>
    //实例化编辑器
    var ue = UE.getEditor('editor');
            //这段要放在文本编辑器的实例化之后
//        function uptext(){
//            if (!UE.getEditor('editor').hasContents()){
//                alert('请先填写内容!');
//            }else{
//                document.setweb.info.value=UE.getEditor('editor').getContent();
//                document.setweb.submit();
//            }
//        }
</script>