
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="span10">
    <a href="/index/index">首页</a><span >&gt;</span><span>资讯管理</span><span >&gt;</span><span>添加/修改</span>
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
                        <option value ="学术报告" <?php echo isset($data)&& $data['cate']=="学术报告" ?  'selected=selected':''?>>学术报告</option>
                        <option value ="新闻资讯" <?php echo isset($data)&& $data['cate']== "新闻资讯" ?  'selected=selected':''?>>新闻资讯</option>
                        <option value ="公开课" <?php echo isset($data)&& $data['cate']== "公开课" ?  'selected=selected':''?>>公开课</option>
                        <option value ="开班信息" <?php echo isset($data)&& $data['cate']== "开班信息" ?  'selected=selected':''?>>开班信息</option>
                        <option value ="公告" <?php echo isset($data)&& $data['cate']== "公告" ?  'selected=selected':''?>>公告</option>
                        <option value ="高分经验" <?php echo isset($data)&& $data['cate']== "高分经验" ?  'selected=selected':''?>>高分经验</option>
                    </select>
                </td>
            </tr>
            <tr id="name" style="display:none" >
                <td>老师/主讲人：</td>
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
            <?php if(isset($data)) {
                $str = '<tr>';
                $str .= '<td>原图片:</td>';
                $str .= '<td>';
                $pic = $data['pic'];
                $str .= "<input name='pic' type='text' value='" . $pic . "'></td></tr>";
                echo $str;
            } ?>
            <tr>
                <td>内容图片:</td>
                <td>
                    <input id="file" type="file" name="pic" >
                </td>
            </tr>
            <tr id="videoAddress" style="display:none">
                <td>视频网址:</td>
                <td>
                    <input type="text" name="videoAddress" value="<?php echo isset($data)? $data['videoAddress']:''?>">
                </td>
            </tr>
            <tr id="summary">
                <td>摘要：</td>
                <td>
                    <input type="text" name="summary" placeholder=""  style="width: 500px;" value="<?php echo isset($data)? $data['summary']:''?>" />限200字内
                </td>
            </tr>
            <tr>
                <td>关键词：</td>
                <td>
                    <input type="text" name="keywords" placeholder=""  style="width: 500px;" value="<?php echo isset($data)? $data['keywords']:''?>" />限200字内
                </td>
            </tr>
            <tr>
                <td>内容：</td>
                <td id="content">
                    <textarea id="editor" type="text/plain" name="" style="width:600px;height:300px;">
                        <?php echo isset($data)? $data['content']:''?>
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
                <td>初始化点击量:</td>
                <td>
                    <input type="text" name="hits" placeholder=""  style="width: 500px;" value="<?php echo isset($data)? $data['hits']:''?>" />
                </td>
            </tr>
            <tr>
                <td>是否置顶:</td>
                <td>
                    <input type="radio" name="isShow" value="0" <?php echo isset($data)&&($data['isShow']=='0') ? 'checked="checked"':''?> />置顶
                    <input type="radio" name="isShow" value="1" <?php echo isset($data)&&($data['isShow']=='1') ? 'checked="checked"':''?> />不置顶
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button>
                </td>
            </tr>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>

</div>
<script>
    //实例化编辑器
    var ue = UE.getEditor('editor');
    function chageCate(){
        var cate = document.getElementById("cate").value;
        if(cate=="公开课"){
            $('#activeTime').show();
            $('#videoAddress').show();
            $('#name').show();
        }else{
            $('#activeTime').hide();
            $('#videoAddress').hide();
            $('#name').hide();
        }
    }
    chageCate();
    $("#cate").change(function(){
        chageCate();
    })
</script>