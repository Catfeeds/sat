<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">题库管理</a></span>
        <span >&gt;</span>
        <span>添加题目</span>
    </div>
        先添加短文或数学题目<a ><span id="addessay">添加\修改</span></a> </br>
        添加短文小题及选项<a href="/admin/questions/add">添加题目</a></br></br>
    <div id="essay" >
        <form method="post" action="<?php echo baseUrl."/admin/questions/topic"?>">
            <span>试 &nbsp;&nbsp;&nbsp;&nbsp;卷 &nbsp;:</span>
            <span>
                <select name="tpId">
                    <option value ="">请选择试卷</option>
                    <?php foreach($arr as $v){?>
                        <option value ="<?php echo $v['id']?>" <?php echo isset($data['tpId'])&& $data['tpId']==$v['id'] ?  'selected':''?>><?php echo $v['name'].$v['time']?></option>
                    <?php }?>
                </select>
            </span>
            </br>
            <span>所属小节:</span>
            <span>
                <input type="text"  name="section" value="<?php echo isset($data['section'])?$data['section']:''?>" placeholder="短文所属的小节" >
            </span>
            </br>
            <span>科&nbsp;&nbsp;&nbsp;&nbsp;目:</span>
                    <span>
                        <select name="major">
                            <option value ="">请选择类型</option>
                            <option value ="math1" <?php echo isset($data['major'])&& $data['major']=="math1" ?  'selected':''?>>数学1（带计算器）</option>
                            <option value ="math2" <?php echo isset($data['major'])&& $data['major']=="math2" ?  'selected':''?>>数学2（不带计算器）</option>
                            <option value ="reading" <?php echo isset($data['major'])&& $data['major']=="reading" ?  'selected':''?>>阅读</option>
                            <option value ="writing" <?php echo isset($data['major'])&& $data['major']=="writing" ?  'selected':''?>>写作</option>
                            <option value ="essay" <?php echo isset($data['major'])&& $data['major']=="essay" ?  'selected':''?>>作文</option>
                        </select>
                    </span>
            </br>

            <span width="80px">题 &nbsp;&nbsp;&nbsp;&nbsp;号 :</span>
            <span>
                <input type="text"  name="number" value="<?php echo isset($data['number'])?$data['number']:''?>" placeholder="题号" >
            </span>
            </br>

            <span>短文或数学题干:</span>
            <span>
                <textarea id="editor" type="text/plain" name="topic"   style="width:600px;height:300px;" ><?php echo isset($data['topic'])? $data['topic']:''?></textarea>
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