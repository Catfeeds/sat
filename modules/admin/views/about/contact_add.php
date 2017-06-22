<div class="span10">
    <a href='<?php echo baseUrl."/admin/about/index"?>'>关于我们</a><span >&gt;</span><span><a href='<?php echo baseUrl."/admin/about/contact"?>'>联系我们</a></span><span >&gt;</span><span>添加/修改</span>
    <form name="form" method="post" action="<?php echo baseUrl."/admin/about/contact_add"?>" enctype="multipart/form-data">
        <table>
            <tr>
                <td width="80px">城市:</td>
                <td><input type="text" name="city" placeholder="城市"  value="<?php echo isset($data)? $data['city']:''?>"></td>
            </tr>
            <tr>
                <td width="80px">服务区名:</td>
                <td><input type="text" name="name" placeholder="城市"  value="<?php echo isset($data)? $data['name']:''?>"></td>
            </tr>
<!--            <tr>-->
<!--                <td>图片</td>-->
<!--                <td>-->
<!--                    --><?php // if(isset($data)) {$pic=$data['pic'];echo"<input name='pic' type='text' value='$pic'>";}
//                    else {echo '<input id="file" type="file" name="pic" >';
//                    }?>
<!--                </td>-->
<!--            </tr>-->
            <?php if(isset($data)) {
                $str = '<tr>';
                $str .= '<td>原图片:</td>';
                $str .= '<td>';
                $pic = $data['pic'];
                $str .= "<input name='pic' type='text' value='" . $pic . "'></td></tr>";
                echo $str;
            } ?>

            <tr>
                <td>上传、修改图片:</td>
                <td>
                    <input id="file" type="file" name="pic" >
                </td>
            </tr>
            <tr>
                <td>电话:</td>
                <td>
                    <input  type="text" name="telephone" value="<?php echo isset($data)? $data['telephone']:''?>" />
                </td>
            </tr>
            <tr>
                <td>地址:</td>
                <td>
                    <input  type="text" name="address"  value="<?php echo isset($data)? $data['address']:''?>" />
                </td>
            </tr>
            <tr>
                <td>公交线路:</td>
                <td>
                    <input  type="text" name="bus"  value="<?php echo isset($data)? $data['bus']:''?>" />
                </td>
            </tr>
            <tr>
                <td>地铁线路:</td>
                <td>
                    <input  type="text" name="subWay"  value="<?php echo isset($data)? $data['subWay']:''?>" />
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