
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="span10">
    <a href="">首页</a><span >&gt;</span><span>资讯管理</span><span >&gt;</span><span>添加/修改</span>
    <form name="form" method="post" action="<?php echo baseUrl."/admin/info/add"?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td width="80px">标题:</td>
                <td><input type="text" name="title" placeholder="标题" style="width: 500px;" value="<?php echo isset($data)? $data['title']:''?>"></td>
            </tr>
            <tr>
                <td>类别:</td>
                <!--                <td><input type="text" name="cate" placeholder="类别"></td>-->
                <td>
                    <select name="cate" id="cate" >
                        <option value ="">请选择类型</option>
                        <option value ="备考资讯" <?php echo isset($data)&& $data['cate']=="备考资讯" ?  'selected=selected':''?>>备考资讯</option>
                        <option value ="新闻资讯" <?php echo isset($data)&& $data['cate']== "新闻资讯" ?  'selected=selected':''?>>新闻资讯</option>
                        <option value ="公开课" <?php echo isset($data)&& $data['cate']== "公开课" ?  'selected=selected':''?>>公开课</option>
                        <option value ="开班信息" <?php echo isset($data)&& $data['cate']== "开班信息" ?  'selected=selected':''?>>开班信息</option>
                    </select>
                </td>
            </tr>
            <tr id="name" style="display:none">
                <td>主讲人</td>
                <td>
                    <input type="text" name="name" placeholder=""  style="width: 500px;" value="<?php echo isset($data)? $data['name']:''?>" />
                </td>
            </tr>
            <tr id="activeTime" style="display:none">
                <td>活动时间</td>
                <td>
                    <input type="text" name="activeTime" placeholder=""  style="width: 500px;" value="<?php echo isset($data)? $data['activeTime']:''?>" />
                </td>
            </tr>
            <tr>
                <td>内容图片</td>
                <td>
                    <?php  if(isset($data)) {$pic=$data['pic'];echo"<input name='pic' type='text' value='$pic' style='width: 500px;;'>";}
                    else {echo '<input id="file" type="file" name="pic" value='.'"$pic">';
                    }?>
                </td>
                <!--                    <input id="file_upload" name="file_upload" type="file" multiple="true">-->
            </tr>
            <tr id="summary">
                <td >摘要</td>
                <td>
                    <input type="text" name="summary" placeholder=""  style="width: 500px;" value="<?php echo isset($data)? $data['summary']:''?>" />限200字内
                </td>
            </tr>
            <tr>
                <td>内容</td>
                <td id="content">
                    <textarea id="editor" type="text/plain" name="" style="width:600px;height:300px;">
                        <?echo isset($data)? $data['content']:''?>
                    </textarea>
                </td>
            </tr>

            <tr>
                <td>有效时间:</td>
                <td>
                    <input type="text" name="validTime" placeholder="格式为: 年-月-日 时：分, 无则填：2037-8-8"  style="width: 500px;" value="<?php echo isset($data)? $data['validTime']:''?>" />
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
        $("#cate").change(function(){
        var cate = document.getElementById("cate").value;
        if(cate=="公开课"){
            $('#name').show();
            $('#activeTime').show();
        }else{
            $('#name').hide();
            $('#activeTime').hide();
        }
        })



</script>