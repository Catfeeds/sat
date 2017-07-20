<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">题库管理</a></span>
        <span >&gt;</span>
        <span>添加短文、图片</span>
    </div>
<!--        先添加短文或数学图片<a ><span id="addessay">添加\修改</span></a> </br>-->
<!--        添加题目及选项<a href="/admin/questions/add">添加题目</a></br></br>-->
    <div id="essay" >
        <form method="post" action="<?php echo baseUrl."/admin/questions/extend"?>">
            <span>试 &nbsp;&nbsp;&nbsp;&nbsp;卷:</span>
            <span>
                <select name="tid">
                    <option value ="">请选择试卷</option>
                    <?php foreach($arr as $v){?>
                        <option value ="<?php echo $v['id']?>" <?php echo isset($data['tpId'])&& $data['tpId']==$v['id'] ?  'selected':''?>><?php echo $v['name'].$v['time']?></option>
                    <?php }?>
                </select>
            </span>
            </br>

            <span width="80px">题 &nbsp;&nbsp;&nbsp;&nbsp;号 :</span>
            <span>
                <input type="text"  name="num" value="<?php echo isset($data['num'])?$data['num']:''?>" placeholder="题号" >
            </span>
            </br>

            <span >标&nbsp;&nbsp;&nbsp;&nbsp;题:</span>
            <span>
                <input type="text" name="topic"  style="width:500px;" value="<?php echo isset($data['topic'])? $data['topic']:''?>" >
            </br>

            <span>描&nbsp;&nbsp;&nbsp;&nbsp;述:</span>
            <span>
                <textarea  type="text/plain" name="details"   style="width:500px;height:300px;" ><?php echo isset($data['details'])? $data['details']:''?></textarea>
            </span>
            </br>

            <span>短文或图片:</span>
            <span>
                <textarea id="editor" type="text/plain" name="essay"   style="width:600px;height:300px;" ><?php echo isset($data['essay'])? $data['essay']:''?></textarea>
            </span>
            </br>
            <input type="hidden" name="id" value="<?php echo isset($data['id'])?$data['id']:''?>"/>
            <button type="submit" id="login-button">添加/修改</button></span>
        </form>
    </div>

</div>
<script>
    //实例化编辑器
    var ue = UE.getEditor('editor');
</script>