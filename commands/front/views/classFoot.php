<div class="open-footer">
    <div>
        <a href="/about-thinku.html">关于申友</a>
        <a href="/contactus.html">联系我们</a>
        <a href="/joinus.html">申友招聘</a>
    </div>
    <div>
        <span>友情链接：</span>
        <?php
        $data = \app\modules\cn\models\Content::getContent(['fields' =>'url', 'category' => '220']);
        foreach($data as $k => $v) {
            ?>
            <a href="<?php echo $v['url']?>" target="_blank"><?php echo $v['name']?> <?php echo ($k+1 != count($data))?'|':''?></a>
        <?php
        }
        ?>
    </div>
    <div>
        <span>Copyright &copy; 2015 All Right Reserved 申友教育 版权所有 京ICP备16000003号</span>
        <span>京公网安备11010802018491</span>
        <a target="_blank" href="/cn/index/disclaimer">免责声明</a>
    </div>
</div>