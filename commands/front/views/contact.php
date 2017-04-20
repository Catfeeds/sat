<div class="connection">
    <div class="connectHd hd">
        <b><a href="/contactus.html">联系申友</a></b>
        <span>全国免费咨询热线：<span>400-600-1123</span></span>
        <ul>
            <?php
                foreach($data as $k => $v) {
                    ?>
                    <li class="on"><?php echo $v['name']?></li>
                   <?php
                        if($k+1 != count($data)) {
                            ?>
                            <span class="liXian">|</span>
                        <?php
                        }
                            ?>
                <?php
                }
            ?>
        </ul>
    </div>

    <div class="connectBd">
        <?php
            foreach($data as $k => $v) {
                ?>
                <ul>
                    <li>
                        <div class="conBdLeft">
                            <div class="leftL">
                                <img src="<?php echo $v['image']?>" alt="城市图"/>
                            </div>
                            <div class="rightR">
                                <h3><?php echo $v['name']?>服务中心</h3>
                                <span><?php echo $v['phone']?"电话：".$v['phone']:''?></span>
                                <p><?php echo $v['email']?"邮箱：".$v['email']:''?></p>
                                <p><?php echo $v['place']?"地址：".$v['place']:''?></p>
                            </div>
                        </div>
                        <div class="conBdCenter">
                            <ul>
                                <li><?php echo $v['busRoutes']?"公交路线：".$v['busRoutes']:''?></pre></li>
                                <li><?php echo $v['metroRoutes']?"地铁路线：".$v['metroRoutes']:''?></li>
                            </ul>
                        </div>
                        <div class="conBdRight">
                            <a href="javascript:;">预约留学顾问</a>

                            <form action="" id="leaveWords">
                                <div style="margin-top: 20px">
                                    <img src="/cn/images/studyA_formIcon01.png" alt="图标"/>
                                    <label>姓&nbsp;&nbsp;&nbsp;名：</label>
                                    <input type="text" name="name" class="name comLength"/>
                                </div>
                                <div>
                                    <img src="/cn/images/studyA_formIcon02.png" alt="图标"/>
                                    <label>邮&nbsp;&nbsp;&nbsp;箱：</label>
                                    <input type="text" name="extendValue[]" class="email comLength "/>
                                </div>
                                <div>
                                    <img src="/cn/images/studyA_formIcon03.png" alt="图标"/>
                                    <label>电&nbsp;&nbsp;&nbsp;话：</label>
                                    <input type="text" name="extendValue[]" class="phone comLength"/>
                                </div>
                                <div>
                                    <img src="/cn/images/studyA_formIcon04.png" alt="图标"/>
                                    <label>验证码：</label>
                                    <input type="text"  name="code" class="phoneCode speLength"/>
                                    <input type="button" class="code speBtn" onclick="contactCode(this)" value="获取验证码"/>
                                </div>
                                <input type="button" onclick="contactSub(this)" value="确定"/>
                            </form>
                        </div>
                        <div style="clear: both"></div>
                    </li>
                </ul>
            <?php
            }
?>
    </div>
</div>
<script type="text/javascript">
    function contactCode(_this){
        var phone = $(_this).parent().prev().find('input').val();
        $.post('/cn/api/phone-code',{type:2,phoneNum:phone},function(re){
            alert(re.message);
        },"json")
    }

    function contactSub(_this){
        var phone = $(_this).prev().prev().find('.phone').val();
        var email = $(_this).prev().prev().prev().find('.email').val();
        var name = $(_this).prev().prev().prev().prev().find('.name').val();
        var code = $(_this).prev().find('.phoneCode').val();
        if(phone == ''){
            alert('留下您的联系方式');
            return false;
        }
        if(code == ''){
            alert('请输入验证码');
            return false;
        }
        if(name == ''){
            alert('请输入您的姓名');
            return false;
        }
        if(email == ''){
            alert('请输入你的联系邮箱');
            return false;
        }
        $.post('/cn/api/leave-words',{name:name,email:email,phone:phone,code:code},function(re){
            alert(re.message);
            window.location.reload()
        },"json")
    }
</script>