<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">题库管理</a></span>
        <span >&gt;</span>
        <span>添加题目数据</span>
    </div>
<!--    先添加短文或题目图片<a  href="/admin/questions/extend">添加</a> </br>-->
<!--            添加短文小题及选项<a><span id="addquestion">添加题目</span></a></br></br>-->
        <div id="question" >
                <form class="form" method="post" action="<?php echo baseUrl."/admin/questions/add"?>">
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

                    <span>填 空 题:</span>
                    <span>
                        <input name="isFilling" type="radio" value="0"  <?php echo isset($data['isFilling']) && $data['isFilling']==='0' ?  'checked="checked"':''?>/>否
                        <input name="isFilling" type="radio" value="1" <?php echo isset($data['isFilling']) && $data['isFilling']==='1' ?  'checked="checked"':''?>/>是
                    </span>
                    </br>

                    <span>所属小节:</span>
                    <span>
                        <input type="text"  name="section" value="<?php echo isset($data['section'])?$data['section']:''?>" placeholder="短文所属的小节" >
                    </span>
                    </br>

                    <span>科&nbsp;&nbsp;&nbsp;&nbsp; 目 :</span>
                    <span>
                        <select name="major">
                            <option value ="">请选择类型</option>
                            <option value ="Math1" <?php echo isset($data['major'])&& $data['major']=="Math1" ?  'selected':''?>>数学1（带计算器）</option>
                            <option value ="Math2" <?php echo isset($data['major'])&& $data['major']=="Math2" ?  'selected':''?>>数学2（不带计算器）</option>
                            <option value ="Reading" <?php echo isset($data['major'])&& $data['major']=="Reading" ?  'selected':''?>>阅读</option>
                            <option value ="Writing" <?php echo isset($data['major'])&& $data['major']=="Writing" ?  'selected':''?>>写作</option>
                            <option value ="Essay" <?php echo isset($data['major'])&& $data['major']=="Essay" ?  'selected':''?>>作文</option>
                        </select>
                    </span>
                    </br>

                    <span width="80px">题 &nbsp;&nbsp;&nbsp;&nbsp;号 :</span>
                    <span>
                        <input type="text"  name="number" value="<?php echo isset($data)?$data['number']:''?>" placeholder="题号" >
                    </span>
                    </br>

                    <span>短文、图片id:</span>
                    <span><input type="text" name="essayId" value="<?php echo isset($data)?$data['essayId']:''?>" placeholder="题干的id" ></span>
                    </br>

                    <span width="80px">问 &nbsp;&nbsp;&nbsp;&nbsp;题：</span>
                    <span>
                         <textarea  type="text/plain" name="content"   style="width:500px;height:100px;" ><?php echo isset($data)? $data['content']:''?></textarea>
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

                    <span>选 &nbsp;项&nbsp; E:</span>
                    <span><input type="text" name="keyE" value="<?php echo isset($data)?$data['keyE']:''?>" placeholder="E选项" style="width:80%;"></span>
                    </br>

                    <span>答 &nbsp;&nbsp;&nbsp;&nbsp;案 :</span>
                    <span><input type="text" name="answer" value="<?php echo isset($data)?$data['answer']:''?>" placeholder="答案"></span>
                    </br>
                    <span>解 &nbsp;&nbsp;&nbsp;&nbsp;析 :</span>
                    <span><textarea type="text" name="analysis" style="width:500px;height: 100px;"><?php echo isset($data)?$data['analysis']:''?></textarea>限400字</span>
                    </br>

                    <span>subScores:</span>
                    <span>
                        <select name="subScores">
                            <option value ="">请选择类型</option>
                            <option value ="algebra" <?php echo isset($data)&& $data['subScores']=="algebra" ?  'selected':''?>>Heart of Algebra</option>
                            <option value ="analysis" <?php echo isset($data)&& $data['subScores']=="analysis" ?  'selected':''?>>Problem Solving and Data Analysis</option>
                            <option value ="math" <?php echo isset($data)&& $data['subScores']=="math" ?  'selected':''?>>Passport to Advanced Math</option>
                            <option value =expression" <?php echo isset($data)&& $data['subScores']=="expression" ?  'selected':''?>>Expression of Ideas</option>
                            <option value ="english" <?php echo isset($data)&& $data['subScores']=="english" ?  'selected':''?>>Standard English Conventions</option>
                            <option value ="words" <?php echo isset($data)&& $data['subScores']=="words" ?  'selected':''?>>Words in Context</option>
                            <option value ="evidence" <?php echo isset($data)&& $data['subScores']=="evidence" ?  'selected':''?>>Command of Evidence</option>
                        </select>
                    </span>
                    </br>

                    <span>cross-testScores:</span>
                    <span>
                        <select name="crosstestScores">
                            <option value ="">请选择类型</option>
                            <option value ="social" <?php echo isset($data)&& $data['crosstestScores']=="social" ?  'selected':''?>>history/social</option>
                            <option value ="science"  <?php echo isset($data)&& $data['crosstestScores']=="science" ?  'selected':''?>>science</option>
                        </select>
                    </span>
                    </br>
              <span colspan="2" style=“align：center">
                    <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button></span>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            </form>
            </div>
</div>
<script>
    //实例化编辑器
    var ue = UE.getEditor('editor');
</script>