<link rel="stylesheet" href="/cn/css/animate.min.css">
<div class="footer">
    <div class="footerFont">
        <ul>
            <li>
                <ol class="olTwo">
                    <li><a href="/USA.html">美国留学</a></li>
                    <li><a href="/UK.html">英国留学</a></li>
                    <li><a href="/HK.html">香港留学</a></li>
                    <li><a href="/AUS.html">澳洲留学</a></li>
                    <li class="tm"><a href="/COUNTRY.html">其他</a></li>
                </ol>
            </li>
            <li>
                <ol class="olTwo twoDiff tm">
                    <li><a href="/public-class.html">GMAT课堂</a></li>
                    <li><a href="/gmatsheet.html">GMAT培训</a></li>
                    <li><a href="/gmatsheet.html">GMAT课程</a></li>
                    <li><a href="/toefl/assistance.html">托福培训</a></li>
                    <li><a href="/case.html">高分案例</a></li>
                </ol>
            </li>
            <li>
                <ol class="olThree threeML">
                    <li><a href="/Undergraduate.html">本科留学</a></li>
                    <li><a href="/Postgraduate.html">硕士留学</a></li>
                    <li><a href="/Doctor.html">博士留学</a></li>
                    <li><a href="/practices.html">游学服务</a></li>

                </ol>
            </li>
            <li>
                <ol class="olThree threeDiff">
                    <li>
                        <a href="/schools.html">院校搜索</a>
                        <a href="/study-aboard/assistance.html" class="mla">留学方案</a>
                    </li>
                    <li>
                        <a style="font-size: 12px" href="/problem.html">GMAT题库</a>
                        <a style="margin-left: 22px" href="/public-class.html" class="mla">申友课堂</a>
                    </li>
                    <li>
                        <a href="/mentor.html">留学顾问</a>
                        <a href="/practices.html" class="mla">实习资源</a>
                    </li>
                    <li>
                        <a href="/question.html">留学问答</a>
                        <a href="/evaluation.html" class="mla">留学评估</a>
                    </li>

                </ol>
            </li>
            <li>
                <ol class="olTwo">
                    <li><a href="/about-thinku.html">关于我们</a></li>
                    <li><a href="/teachers/interviews.html">名师文档</a></li>
                    <li><a href="/about-thinku.html">行业资质</a></li>
                    <li><a href="/joinus.html">加入我们</a></li>
                    <li><a href="/contactus.html">联系我们</a></li>
                </ol>
            </li>
        </ul>
    </div>
    <div style="clear: both"></div>
    <div class="footerPhone">
        <b>400-600-1123</b>
        <ul class="tm">
            <li>
                <div class="left-ewm">

                    <img src="/cn/images/index_erweima01.jpg" alt="申友GMAT"/>
                </div>
                <div class="right-font">
                    <span>申友GMAT</span>
                </div>
            </li>
            <li>
                <div class="left-ewm">

                    <img src="/cn/images/index_erweima02.jpg" alt="申友留学"/>
                </div>
                <div class="right-font">
                    <span>申友留学</span>
                </div>
            </li>
            <li>
                <div class="left-ewm">

                    <img src="/cn/images/index_erweima03.png" alt="托福100"/>
                </div>
                <div class="right-font">
                    <span>官方微博</span>
                </div>
            </li>
        </ul>
    </div>
    <div style="clear: both"></div>
</div>
<div class="smallFoot">
    <p>
        <b>友情链接：</b>
        <?php
        $data = \app\modules\cn\models\Content::getContent(['fields' => 'url', 'category' => '220']);
        foreach ($data as $k => $v) {
            ?>
            <a href="<?php echo $v['url'] ?>"
               target="_blank"><?php echo $v['name'] ?><?php echo ($k + 1 != count($data)) ? '|' : '' ?></a>
            <?php
        }
        ?>
        <!--        百度商桥客服代码-->
        <script
            type="text/javascript"> var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
            document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe59a33493ccdfd0202bca0a2225bb1c8' type='text/javascript'%3E%3C/script%3E")) </script>
    </p>
    <span>Copyright © 2015 All Right Reserved 申友教育 版权所有
        <a target="_blank" href="http://www.miitbeian.gov.cn/">京ICP备16000003号</a>
        <span>京公网安备 11010802018491</span>
        <a target="_blank" href="/cn/index/disclaimer">免责声明</a>
    </span>
</div>

<!-----------------------------右边弹窗-------------------------->
<!--<div class="rightLayer">-->
<!--    <div class="close_icon" onclick="hideLayer()">×</div>-->
<!--    <div class="top_ul">-->
<!--        <ul>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">在线咨询</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">GMAT培训</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">托福培训</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">美国留学</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">英国留学</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">其他留学</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=605 8744&ucid=3827656&cp=&cr=&cw=">海外咨询</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">留学规划</a></li>-->
<!--            <li><a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw=">游学与实习</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="bottom_top" onclick="scroll_Top();"></div>-->
<!--</div>-->
<!--<div class="rightLayer_two" onclick="showLayer();"></div>-->
<!--Hrisi --弹窗-->
<!--<div id="right-wrap" class="right-wrap">-->
<!--    <div class="img-wrap">-->
<!--        <div class="wx-wrap">-->
<!--            <div class="erm-wrap"><img src="/cn/images/erm-1.jpg" alt=""></div>-->
<!--        </div>-->
<!--        <div class="tel-wrap2">-->
<!--            <div class="tel-text2">400-600-1123</div>-->
<!--        </div>-->
<!--        <img src="/cn/images/consult.png" alt="">-->
<!--        <a class="online" href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=&cw="></a>-->
<!--        <div class="close-wrap"></div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="rightLayer_two" ></div>-->
<!--Anne --弹窗-->
<!-------------------咨询框------------------------>
<div class="referBox">
    <div class="refer_close" onclick="closeRefer()"></div>
    <div class="refer_top"></div>
    <div class="refer_con">
        <ul>
            <li>
                <a href="http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=%E6%96%B0%E5%AE%98%E7%BD%91%EF%BC%88thinkwithu%EF%BC%89&cw=%E5%AE%98%E7%BD%91%E5%8F%B3%E4%BE%A7%E5%AE%A2%E6%9C%8D%E5%88%97%E8%A1%A8http://p.qiao.baidu.com/im/index?siteid=6058744&ucid=3827656&cp=&cr=%E6%96%B0%E5%AE%98%E7%BD%91%EF%BC%88thinkwithu%EF%BC%89&cw=%E5%AE%98%E7%BD%91%E5%8F%B3%E4%BE%A7%E5%AE%A2%E6%9C%8D%E5%88%97%E8%A1%A8"
                   target="_blank">
                    <div class="diffBG01"></div>
                    <p>在线咨询</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <div class="diffBG02"></div>
                    <p>微信</p>
                    <div class="tanc_mask01 animated"><img src="/cn/images/thinku_ewm.jpg" alt="二维码图片"></div>
                </a>
            </li>
            <li>
                <a href="tencent://message/?uin=2265835386&amp;Site=www.cnclcy&amp;Menu=yes" target="_blank">
                    <div class="diffBG03"></div>
                    <p>QQ</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <div class="diffBG04"></div>
                    <p>电话</p>
                    <div class="tanc_mask02 animated">400-600-1123</div>
                </a>
            </li>
            <li>
                <a href="tencent://message/?uin=3435834301&amp;Site=www.cnclcy&amp;Menu=yes" target="_blank">
                    <div class="diffBG05"></div>
                    <p>吐槽入口</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="referTop();">
                    <div class="diffBG06 animated">
<!--                        <img src="/cn/images/refer_icon06.png" alt="回到顶部图标"/>-->
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>


<script>

    $(".close-wrap").click(function(){
        $("#right-wrap").hide();
        $(".rightLayer_two").fadeIn();
    });
    $(".rightLayer_two").click(function(){
        $(this).hide();
        $("#right-wrap").fadeIn();
    });
    
    //百度自动推送工具代码
    (function(){
	    var bp = document.createElement('script');
	    var curProtocol = window.location.protocol.split(':')[0];
	    if (curProtocol === 'https'){
	   bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
	  }
	  else{
	  bp.src = 'http://push.zhanzhang.baidu.com/push.js';
	  }
	    var s = document.getElementsByTagName("script")[0];
	    s.parentNode.insertBefore(bp, s);
	})();
</script>