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
                <td><input type="text" name="student" placeholder="入学要求" value="<?php echo isset($data)? $data["student"]:''?>"></td>
            </tr>
            <tr>
                <td>图片:</td>
                <td>
                    <?php  if(isset($data)&& $data['pic']!='') {$pic=$data['pic'];echo"<input name='pic' type='text' value='$pic'>";}
                    else {echo '<input id="file" type="file" name="pic" >';
                    }?> 只能添加'gif','jpg','jpeg','bmp','png'格式的图片
                </td>
            </tr>
            <tr>
                <td>类别:</td>
<!--                <td><input type="text" name="cate" placeholder="类别"></td>-->
                <td>
                    <select name="cate">
                        <option value ="">请选择班级</option>
                        <option value ="全能小班" <?php echo isset($data)&& $data['cate']=="全能小班" ?  'selected':''?>>全能小班</option>
                        <option value ="冲刺小班" <?php echo isset($data)&& $data['cate']=="冲刺小班" ?  'selected':''?>>冲刺小班</option>
                        <option value ="全能周末班" <?php echo isset($data)&& $data['cate']=="全能周末班" ?  'selected':''?>>全能周末班</option>
                    </select>
                </td>
            </tr>
<!--            <tr>-->
<!--                <td>总课时</td>-->
<!--                <td><input type="text" name="duration" placeholder="课程总时长" value="--><?php //echo isset($data)? $data['duration']:''?><!--"/></td>-->
<!--            </tr>-->
            <tr>
                <td>价格</td>
                <td><input type="text" name="price" placeholder="课程价格" value="<?php echo isset($data)? $data['price']:''?>"/></td>
            </tr>
            <tr>
                <td>阅读课时</td>
                <td><input type="text" name="read" placeholder="阅读的课时" value="<?php echo isset($data)? $data['read']:''?>"/></td>
            </tr>
            <tr>
                <td>文法课时:</td>
                <td><input type="text" name="grammar" placeholder="文法课时" value="<?php echo isset($data)? $data['grammar']:''?>" ></br></td>
            </tr>
            <tr>
                <td>词汇课时:</td>
                <td><input type="text" name="vocabulary" placeholder="词汇课时" value="<?php echo isset($data)? $data['vocabulary']:''?>" ></br></td>
            </tr>
            <tr>
                <td>数学课时:</td>
                <td><input type="text" name="math" placeholder="数学课时" value="<?php echo isset($data)? $data['math']:''?>" ></br></td>
            </tr>
            <tr>
                <td>写作课时:</td>
                <td><input type="text" name="write" placeholder="写作课时" value="<?php echo isset($data)? $data['write']:''?>" ></br></td>
            </tr>
            <tr>
                <td>模考点评:</td>
                <td><input type="text" name="comments" placeholder="模考点评" value="<?php echo isset($data)? $data['comments']:''?>" ></br></td>
            </tr>
            <tr>
                <td>课程简介:</td>
                <td><input type="text" name="introduction" placeholder="课程简介" value="<?php echo isset($data)? $data['introduction']:''?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="right"> <button type="submit" id="login-button">添加课程</button></td>
            </tr>
            <input type="hidden" name='id' value="<?php echo isset($data)? $data['id']:''?>"/>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>
</div>