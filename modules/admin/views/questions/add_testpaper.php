<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/questions/index">题库管理</a></span>
        <span >&gt;</span>
        <span><a href="/admin/questions/testpaper">试卷管理</a></span>
        <span >&gt;</span>
        <span>添加试卷</span>
    </div>
    <form class="form" method="post" action="<?php echo baseUrl."/admin/questions/add_testpaper"?>">
        <table width="100%">
            <tr>
                <td width="80px">试卷类型:</td>
                <td>
                    <select name="name">
                        <option value ="">请选择类型</option>
                        <option value ="OG" <?php echo isset($data)&& $data['name']=="OG" ?  'selected':''?>>OG</option>
                        <option value ="princeton" <?php echo isset($data)&& $data['name']=="princeton" ?  'selected':''?>>普林斯顿</option>
                        <option value ="kaplan" <?php echo isset($data)&& $data['name']=="kaplan" ?  'selected':''?>>开普兰</option>
                        <option value ="BARRON" <?php echo isset($data)&& $data['name']=="BARRON" ?  'selected':''?>>BARRON</option>
                        <option value ="每日一题" <?php echo isset($data)&& $data['name']=="每日一题" ?  'selected':''?>>每日一题</option>
                        <option value ="测评" <?php echo isset($data)&& $data['name']=="测评" ?  'selected':''?>>测评</option>
                    </select>
                </td>
            </tr>
<!--            <tr>-->
<!--                <td>数学小节</td>-->
<!--                <td>-->
<!--                    <input type="text" name="math" value="--><?php //echo isset($data)?$data['math']:''?><!--" placeholder="如：section1,section2" style="width:80%;">-->
<!--<!--                    <select name="major">-->
<!--<!--                        <option value ="">请选择类型</option>-->
<!--<!--                        <option value ="数学" --><?php ////echo isset($data)&& $data['major']=="数学" ?  'selected':''?><!--</option>-->
<!--<!--                        <option value ="阅读" --><?php ////echo isset($data)&& $data['major']=="阅读" ?  'selected':''?><!--<!--></option>
<!--                        <option value ="作文" --><?php //echo isset($data)&& $data['major']=="作文" ?  'selected':''?><!--></option>
<!--<!--                    </select>-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>阅读小节</td>-->
<!--                <td>-->
<!--                    <input type="text" name="read" value="--><?php //echo isset($data)?$data['read']:''?><!--" placeholder="如：section1,section2" style="width:80%;">-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>写与语言</td>-->
<!--                <td>-->
<!--                    <input type="text" name="language" value="--><?php //echo isset($data)?$data['language']:''?><!--" placeholder="如：section1,section2" style="width:80%;">-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>写做</td>-->
<!--                <td>-->
<!--                    <input type="text" name="write" value="--><?php //echo isset($data)?$data['write']:''?><!--" placeholder="如：section1,section2" style="width:80%;">-->
<!--                </td>-->
<!--            </tr>-->
            <tr>
                <td>试卷名</td>
                <td><input type="text" name="time" value="<?php echo isset($data)?$data['time']:''?>" placeholder="具体名称，如：年份或者名称" ></td>
            </tr>
<!--            <tr>-->
<!--                <td>来源</td>-->
<!--                <td><input type="text" name="source" value="--><?php //echo isset($data)?$data['source']:''?><!--" placeholder="" style="width:80%;"></td>-->
<!--            </tr>-->
            <tr>
                <td>总分</td>
                <td><input type="text" name="score" value="<?php echo isset($data)?$data['score']:''?>" placeholder="总分" ></td>
            </tr>
            <tr>
                <td>登录做题</td>
                <td> <input name="isLogin" type="radio" value="0"  <?php echo isset($data['isLogin']) && $data['isLogin']==='0' ?  'checked="checked"':''?>/>不需登录
                    <input name="isLogin" type="radio" value="1" <?php echo isset($data['isLogin']) && $data['isLogin']==='1' ?  'checked="checked"':''?>/>需登录
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="hidden" name="id" value="<?php echo isset($data)?$data['id']:''?>"/>
                    <button type="submit" id="login-button">添加/修改</button>
                </td>
            </tr>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </table>
    </form>

</div>