<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">题库管理</a></span>
        <span >&gt;</span>
        <span>添加题目拓展数据</span>
    </div>
    先添加短文或数学题目<a  href="/admin/questions/topic">添加</a> </br>
<!--            添加短文小题及选项<a><span id="addquestion">添加题目</span></a></br></br>-->
        <div id="question" >
                <form class="form" method="post" action="<?php echo baseUrl."/admin/questions/add"?>">
                    <span width="80px">题 &nbsp;&nbsp;&nbsp;&nbsp;号 :</span>
                    <span>
                        <input type="text"  name="number" value="<?php echo isset($questions)?$questions['number']:''?>" placeholder="题号" >
                    </span>
                    </br>

                    <span width="80px">短文小题或数学附加图片:</span>
                    <span>
                         <textarea id="editor" type="text/plain" name="content"   style="width:600px;height:300px;" ><?php echo isset($questions)? $questions['content']:''?></textarea>
                    </span>
                    </br>

                    <span>选 &nbsp;项 &nbsp;A:</span>
                    <span><input type="text" name="keyA" value="<?php echo isset($questions)?$questions['keyA']:''?>" placeholder="A选项" style="width:80%;"></span>
                    </br>

                    <span>选 &nbsp;项&nbsp; B:</span>
                    <span><input type="text" name="keyB" value="<?php echo isset($questions)?$questions['keyB']:''?>" placeholder="B选项" style="width:80%;"></span>
                    </br>

                    <span>选 &nbsp;项 &nbsp;C:</span>
                    <span><input type="text" name="keyC" value="<?php echo isset($questions)?$questions['keyC']:''?>" placeholder="C选项" style="width:80%;"></span>
                    </br>

                    <span>选 &nbsp;项&nbsp; D:</span>
                    <span><input type="text" name="keyD" value="<?php echo isset($questions)?$questions['keyD']:''?>" placeholder="D选项" style="width:80%;"></span>
                    </br>

                    <span>选 &nbsp;项&nbsp; E:</span>
                    <span><input type="text" name="keyE" value="<?php echo isset($questions)?$questions['keyE']:''?>" placeholder="E选项" style="width:80%;"></span>
                    </br>

                    <span>答 &nbsp;&nbsp;&nbsp;&nbsp;案 :</span>
                    <span><input type="text" name="answer" value="<?php echo isset($questions)?$questions['answer']:''?>" placeholder="答案"></span>
                    </br>

                    <span>短文、题干id:</span>
                    <span><input type="text" name="topicId" value="<?php echo isset($questions)?$questions['topicId']:''?>" placeholder="题干的id" ></span>
                    </br>

                    <span>subScores:</span>
                    <span>
                        <select name="subScores">
                            <option value ="">请选择类型</option>
                            <option value ="Heart of Algebra" <?php echo isset($questions)&& $questions['subScores']=="Heart of Algebra" ?  'selected':''?>>Heart of Algebra</option>
                            <option value ="Problem Solving and Data Analysis" <?php echo isset($questions)&& $questions['subScores']=="Problem Solving and Data Analysis" ?  'selected':''?>>Problem Solving and Data Analysis</option>
                            <option value ="Passport to Advanced Math" <?php echo isset($questions)&& $questions['subScores']=="Passport to Advanced Math" ?  'selected':''?>>Passport to Advanced Math</option>
                            <option value ="Expression of Ideas" <?php echo isset($questions)&& $questions['subScores']=="Expression of Ideas" ?  'selected':''?>>Expression of Ideas</option>
                            <option value ="Standard English Conventions" <?php echo isset($questions)&& $questions['subScores']=="Standard English Conventions" ?  'selected':''?>>Standard English Conventions</option>
                            <option value ="Words in Context" <?php echo isset($questions)&& $questions['subScores']=="Words in Context" ?  'selected':''?>>Words in Context</option>
                            <option value ="Command of Evidence" <?php echo isset($questions)&& $questions['subScores']=="Command of Evidence" ?  'selected':''?>>Command of Evidence</option>
                        </select>
                    </span>
                    </br>

                    <span>cross-testScores:</span>
                    <span>
                        <select name="crosstestScores">
                            <option value ="">请选择类型</option>
                            <option value ="history/social" <?php echo isset($questions)&& $questions['crosstestScores']=="history/social" ?  'selected':''?>>history/social</option>
                            <option value ="science"  <?php echo isset($questions)&& $questions['crosstestScores']=="science" ?  'selected':''?>>science</option>
                        </select>
                    </span>
                    </br>
              <span colspan="2" style=“align：center">
                    <input type="hidden" name="id" value="<?php echo isset($questions)?$questions['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button></span>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            </form>
            </div>
</div>
<script>
    //实例化编辑器
    var ue = UE.getEditor('editor');
</script>