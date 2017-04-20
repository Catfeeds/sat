<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span>知识点管理</span>
        <span >&gt;</span>
        <span>修改</span>
    </div>
    <table>
        <form class="form" method="post" action="<?php echo baseUrl."/admin/classes/edit"?>">
            <tr>
                <td width="80px">课程:</td>
                <td><input type="text" name="className" placeholder="课程名" value="<?php echo $data['className']?>"></td>
            </tr>
            <tr>
                <td>图片:</td>
                <td><input type="text" name="pic" placeholder="图片"  value="<?php echo $data['pic']?>"></td>
<!--                <td><img src="--><?php //echo $data['pic']?><!--"></td>-->
            </tr>
            <tr>
                <td>类别:</td>
<!--                <td><input type="text" name="cate" placeholder="类别"  value="--><?php //echo $data[0]['cate']?><!--"></td>-->
                <td> <select name="cate">
                        <option value ="">请选择班级</option>
                        <option value ="基础班" <?php if($data['cate'] =="基础班") echo "selected"?>>基础班</option>
                        <option value ="强化班" <?php if($data['cate'] =="强化班") echo "selected"?>>强化班</option>
                        <option value="精英班"  <?php if($data['cate'] =="精英班") echo "selected"?>>精英班</option>
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>价格:</td>
                <td><input type="text" name="price" placeholder="价格" value="<?php echo $data['price']?>"></td>
            </tr>
            <tr>
                <td>课时:</td>
                <td><input type="text" name="duration" placeholder="课时" value="<?php echo $data['duration']?>"></br></td>
            </tr>
            <tr>
                <td>科目:</td>
<!--                <td><input type="text" name="major" placeholder="科目" value="--><?php //echo $data[0]['duration']?><!--"></td>-->
                <td>
                    <select name="major" >
                        <option value ="">请选择课程</option>
                        <option value ="数学" <?php if($data['major'] =="数学") echo "selected"?>>数学</option>
                        <option value ="阅读" <?php if($data['major'] =="阅读") echo "selected"?>>阅读</option>
                        <option value="作文" <?php if($data['major'] =="作文") echo "selected"?>>作文</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>讲师:</td>
                <td><input type="text" name="teacher" placeholder="讲师" value="<?php echo $data['teacher']?>"></td>
            </tr>
            <tr>
                <td>课程简介:</td>
                <td><input type="text" name="introduction" placeholder="简介" value="<?php echo $data['introduction']?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="hidden" name="id" value="<?php echo $data['id']?>"/>
                    <button type="submit" id="login-button">修改课程</button></td>
            </tr>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

        </form>
    </table>
</div>