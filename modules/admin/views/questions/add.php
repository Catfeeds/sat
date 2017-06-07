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

            若有短文题干，先添加短文<a><span id="addessay">添加</span></a> </br>
            若无短文题干，请直接添加题目 <a><span id="addquestion">添加题目</span></a></br></br>
        <div id="essay" style="display:none;">
            <form method="post" action="<?php echo baseUrl."/admin/questions/essay"?>">
                <span>所属小节:</span>
                <span>
                    <input type="text"  name="section" value="<?php echo isset($data)?$data['section']:''?>" placeholder="短文所属的小节" style="width:80%;">
                </span></br>
                <span>题干:</span>
                <span>
                    <textarea id="editor" type="text/plain" name="essay"   style="width:600px;height:300px;" ><?php echo isset($data)? $data['essay']:''?></textarea>
                </span>
                </br>
            
                <span>包含题目:</span>
                <span>
                    <input type="text"  name="nums" value="<?php echo isset($data)?$data['nums']:''?>" placeholder="上边题干所包含的题目题号，如1,2,3 标点为英文状态" style="width:80%;">
                </span></br>
                <span>试 &nbsp;&nbsp;&nbsp;&nbsp;卷&nbsp;:  </span>
                <span>
                    <input type="text"  name="tpID" value="<?php echo isset($data)?$data['tpID']:''?>" placeholder="试卷的id名" style="width:80%;">
                </span>
                </br>
                <input type="hidden" name="id" value="<?php echo isset($data)?$data['essayId']:''?>"/>
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <button type="submit" id="login-button">添加/修改</button></span>
            </form>
            </div>
        <div id="question" style="display:none;">
            <form class="form" method="post" action="<?php echo baseUrl."/admin/questions/add"?>">
                <span width="80px">题 &nbsp;&nbsp;&nbsp;&nbsp;号 :</span>
                <span>
                    <input type="text"  name="number" value="<?php echo isset($data)?$data['number']:''?>" placeholder="题号" style="width:80%;">
                </span>

                </br>
                <span width="80px">题  &nbsp;&nbsp;&nbsp;&nbsp;目 :</span>
                <span>
                    <input type="text"  name="content" value="<?php echo isset($data)?$data['content']:''?>" placeholder="题目" style="width:80%;">
                </span>
                </br>

                <span>选 &nbsp;项 &nbsp;A:</span>
                <span><input type="text" name="keyA" value="<?php echo isset($data)?$data['keyA']:''?>" placeholder="A选项" style="width:80%;"></span>
                </br>
            
                <span>选 &nbsp;项&nbsp; B:</span>
                <span><input type="text" name="keyB" value="<?php echo isset($data)?$data['keyB']:''?>" placeholder="B选项" style="width:80%;"></span>
                </br>
            
                <span>选 &nbsp;项 &nbsp;C:</span>
                <span><input type="text" name="keyC" value="<?php echo isset($data)?$data['keyC']:''?>" placeholder="C选项" style="width:80%;"></span>

                </br>
                <span>选 &nbsp;项&nbsp; D:</span>
                <span><input type="text" name="keyD" value="<?php echo isset($data)?$data['keyD']:''?>" placeholder="D选项" style="width:80%;"></span>
                </br>

                <span>选&nbsp;项&nbsp;E:</span>
                <span><input type="text" name="keyE" value="<?php echo isset($data)?$data['keyE']:''?>" placeholder="E选项" style="width:80%;"></span>
                </br>
            
                <span>答 &nbsp;&nbsp;&nbsp;&nbsp;案 :</span>
                <span><input type="text" name="answer" value="<?php echo isset($data)?$data['answer']:''?>" placeholder="答案"></span>
                </br>
            
<!--                <span>分 &nbsp;&nbsp;&nbsp;&nbsp;数 :</span>-->
<!--                <span><input type="text" name="score" value="--><?php //echo isset($data)?$data['score']:''?><!--" placeholder="分数" ></span>-->
<!--                </br>-->
                <span>所属小节 :</span>
                <span><input type="text" name="section" value="<?php echo isset($data)?$data['section']:''?>" placeholder="所属小节" ></span>
                </br>

                <span>短&nbsp;文&nbsp;id  :</span>
                <span><input type="text" name="essayId" value="<?php echo isset($data)?$data['essayId']:''?>" placeholder="短文的id" ></span>
                </br>

                <span>题目来源:</span>
                <span><input type="text" name="sourceId" value="<?php echo isset($data)?$data['sourceId']:''?>"  placeholder="题目来源" ></span>
                </br>
            
                <span>科 &nbsp;&nbsp;&nbsp;&nbsp;目 &nbsp;:</span>
<!--                <span><input type="text" name="major" value="--><?php //echo isset($data)?$data['major']:''?><!--"  placeholder="科目" ></span>-->
               <span>
                   <select name="major">
                    <option value ="">请选择类型</option>
                    <option value ="数学" <?php echo isset($data)&& $data['major']=="数学" ?  'selected':''?>>数学</option>
                    <option value ="阅读" <?php echo isset($data)&& $data['major']=="阅读" ?  'selected':''?>>阅读</option>
                    <option value ="作文" <?php echo isset($data)&& $data['major']=="作文" ?  'selected':''?>>作文</option>
                   </select>
               </span>
                </br>
                <span>subScores:</span>
                <span>
                    <select name="subScores">
                        <option value ="">请选择类型</option>
                        <option value ="Heart of Algebra" <?php echo isset($data)&& $data['subScores']=="Heart of Algebra" ?  'selected':''?>>Heart of Algebra</option>
                        <option value ="Problem Solving and Data Analysis" <?php echo isset($data)&& $data['subScores']=="Problem Solving and Data Analysis" ?  'selected':''?>>Problem Solving and Data Analysis</option>
                        <option value ="Passport to Advanced Math" <?php echo isset($data)&& $data['subScores']=="Passport to Advanced Math" ?  'selected':''?>>Passport to Advanced Math</option>
                        <option value ="Expression of Ideas" <?php echo isset($data)&& $data['subScores']=="Expression of Ideas" ?  'selected':''?>>Expression of Ideas</option>
                        <option value ="Standard English Conventions" <?php echo isset($data)&& $data['subScores']=="Standard English Conventions" ?  'selected':''?>>Standard English Conventions</option>
                        <option value ="Words in Context" <?php echo isset($data)&& $data['subScores']=="Words in Context" ?  'selected':''?>>Words in Context</option>
                        <option value ="Command of Evidence" <?php echo isset($data)&& $data['subScores']=="Command of Evidence" ?  'selected':''?>>Command of Evidence</option>
                    </select>
                </span>
                </br>
                <span>cross-testScores:</span>
                <span><select name="crosstestScores">
                        <option value ="">请选择类型</option>
                        <option value ="history/social" <?php echo isset($data)&& $data['crosstestScores']=="history/social" ?  'selected':''?>>history/social</option>
                        <option value ="science" <?php echo isset($data)&& $data['crosstestScores']=="science" ?  'selected':''?>>science</option>
                    </select></span>
                </br>
                <span colspan="2" align="center">
                    <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button></span>
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            </form>
        </div>
    </form>

</div>
<script>
    //实例化编辑器
    var ue = UE.getEditor('editor');
    $('#addessay').click(function(){
        if($('#essay').is(':hidden')){
            $('#essay').show();
            $('#question').hide();
        }else{
            $('#essay').hide();
        }
    });
    $('#addquestion').click(function(){
        if($('#question').is(':hidden')){
            $('#question').show();
            $('#essay').hide();
        }else{
            $('#question').hide();
        }

    });
</script>