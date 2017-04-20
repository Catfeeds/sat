<!--<form method="post" action="/evaluation.html" onsubmit="return check()">
<img src="/cn/images/public_leftBtn.png" alt="缩小后显示图片" class="shrink" onclick="leftSuspen(this)"/>
<div class="leftFloatW">
    <i class="fa">×</i>
    <img src="/cn/images/left_xfcTittle.png" alt="左边悬浮窗图标" style="vertical-align: bottom"/>
    <div class="abroadPG">
            <?php
            foreach($extendData as $k => $v) {
                if ($k == 4) {
                    break;
                }
                $typeValue = explode(",",$v['typeValue']);
                ?>
                <div class="default defa01">
                    <span class="spanValue"><span style="color: red;">*</span><?php echo $v['name']?></span>
                    <input name="extendValue[]" class="value" type="hidden" value="" />
                    <div class="clickBac clickBac01" onclick="selectInfo(this)"></div>-->
                    <!--文字-->
                    <!--<div class="secFont secFont01">
                        <ul>
                            <?php foreach($typeValue as $val) { ?>
                                <li><?php echo $val?></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php
            }
            ?>
            <input name="extendValue[]"  type="hidden" value="" />
            <input name="extendValue[]"  type="hidden" value="" />
            <div class="leftBotInput">
                <ul>
                    <li>
                        <label><span>*</span>GPA</label>
                        <input name="extendValue[]" class="value" type="text" id="GPAS"/>
                        <div style="clear: both;"></div>
                    </li>
                    <li>
                        <label><span>*</span>托福/雅思</label>
                        <input name="extendValue[]" class="value" type="text" id="TOEFLS" />
                        <div style="clear: both;"></div>
                    </li>
                    <li>
                        <label><span>*</span>GRE/GMAT</label>
                        <input name="extendValue[]" class="value" type="text" id="GMATS" />
                        <div style="clear: both;"></div>
                    </li>
                </ul>
            </div>
    </div>
    <input type="hidden" name="collagen" id="collagens" value="">
    <input type="submit" value="立即免费评估">
</div>
</form>
<script type="text/javascript">
    function check(){
        var gpaReg1 = new RegExp("^[0-4]$");
        var gpaReg2 = new RegExp("^([0-3])+(.[0-9])?$");
        var toeflReg1 = new RegExp("^([0-1]+([0-2]{1})+([0-9]{1}))$");
        var toeflReg2 = new RegExp("^[1-9]+([0-9]{1})$");
        var toeflReg3 = new RegExp("^([0-9]|([3-8]+(.[0-9]{1})))$");
        var GPA = $('#GPAS').val();
        var TOEFL = $('#TOEFLS').val();
        var GMAT = $('#GMATS').val();
        var a = 1;
        $('.spanValue').each(function(){
            var spanVal = $(this).html();
            if(spanVal == '请选择'){
                spanVal = '';
            }
            $(this).next().val(spanVal);
        });
        $('.value').each(function(){
            if($(this).val() == "" || $(this).val() == "请选择"){
                alert('星标志位必填');
                a = 2;
                return false;
            }
        });
        if(a == 2){
            return false;
        }
        if(GPA<1 || GPA>4){
            alert('GPA请输入1-4之间的数字');
            return false;
        }else{
            if(GPA>=3.5){
                GPA = 90;
            }else
            if(GPA>=3 && GPA<=3.4){
                GPA = 80;
            }else
            if(GPA>=2 && GPA<=2.9){
                GPA = 65;
            }else
            if(GPA<2){
                GPA = 45;
            }
        }
        if(!toeflReg1.test(TOEFL) && !toeflReg2.test(TOEFL) && !toeflReg3.test(TOEFL)){
            alert('托福数值为10到120  雅思数值为3.0到9.0（最小间隔为0.5）');
            return false;
        }else{
            if(TOEFL>=10){
                if(TOEFL>=110){
                    TOEFL = 90;
                }else
                if(TOEFL>=100 && TOEFL<=109){
                    TOEFL = 80;
                }else
                if(TOEFL>=90 && TOEFL<=99){
                    TOEFL = 65;
                }else
                if(TOEFL<90){
                    TOEFL = 45;
                }
            }else{
                if(TOEFL>=8.0){
                    TOEFL = 90;
                }else
                if(TOEFL>=7.5 && TOEFL<=7.9){
                    TOEFL = 80;
                }else
                if(TOEFL>=5.5 && TOEFL<=7.4){
                    TOEFL = 65;
                }else
                if(TOEFL<5.5){
                    TOEFL = 45;
                }
            }
        }
        if((GMAT>=400 && GMAT<=800) || (GMAT>=261 && GMAT<=340)){
            if(GMAT>=350){
                if(GMAT>=750){
                    GMAT = 90;
                }else
                if(GMAT>=700 && GMAT<=749){
                    GMAT = 80;
                }else
                if(GMAT>=650 && GMAT<=699){
                    GMAT = 65;
                }else
                if(GMAT<650){
                    GMAT = 45;
                }
            }else{
                if(GMAT>=300){
                    GMAT = 90;
                }else
                if(GMAT>=250 && GMAT<=299){
                    GMAT = 80;
                }else
                if(GMAT>=200 && GMAT<=249){
                    GMAT = 65;
                }else
                if(GMAT<200){
                    GMAT = 45;
                }
            }
        }else{
            alert('GMAT数值为400到800（最小间隔为10），GRE数值为261-340');
            return false;
        }
        var all = GPA+GMAT+TOEFL;
        var collagen = Math.ceil(all/3)
        $('#collagens').val(collagen);
    }
</script>-->

<div class="w10 info-wrap">
    <div class="text-wrap">
        <h1 class="info-tit">我的留学方案</h1>
        <div class="user-info clearfix">
            <div>
                <p class="info-tit">姓名：</p>
                <input class="info-int" id="username" type="text" placeholder="">
            </div>
            <div>
                <p class="info-tit">联系电话：</p>
                <input class="info-int" id="tel" type="text" placeholder="">
            </div>
        </div>
        <p class="info-tit">我想去的国家：</p>
        <select class="info-select" name="country" id="country">
            <option value="美国">美国</option>
            <option value="加拿大">加拿大</option>
            <option value="英国">英国</option>
            <option value="澳洲">澳洲</option>
            <option value="香港">香港</option>
            <option value="其他">其他</option>
        </select>
        <p class="info-tit">我完成的阶段：</p>
        <select class="info-select" name="stage" id="stage">
            <option value="本科">本科</option>
            <option value="硕士">硕士</option>
            <option value="博士">博士</option>
        </select>
        <p class="info-tit">我计划出国的时间：</p>
        <select class="info-select" name="data" id="data">
            <option value="2018年入学">2018年入学</option>
            <option value="2017年春季入学">2017年春季入学</option>
            <option value="2017年秋季入学">2017年秋季入学</option>
            <option value="2018年春季入学">2018年春季入学</option>
        </select>
        <h1 onclick="lxfa()" class="info-btn tm">获取方案</h1>
    </div>

    </div>
    <script type="text/javascript">
        function lxfa() {
            var name = $("#username").val();
            var phone = $("#tel").val();
            var country = $("#country").val();
            var stage = $("#stage").val();
            var data = $("#data").val();
            if (name==''||phone==''){
                alert("请输入姓名/电话");
            }else {
                $.post('/cn/api/smart', {
                    name: name,
                    country: country,
                    phone: phone,
                    stage: stage,
                    data: data
                }, function (re) {
                    alert(re.message);
                }, "json")
            }

        }
    </script>