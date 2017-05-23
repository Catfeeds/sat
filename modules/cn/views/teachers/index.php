
    <title>名师团队</title>
    <link rel="stylesheet" href="/cn/css/teacher.css">

<section class="s-teacher">
    <!--背景图-->
    <div class="bnr-wrap center-block">
        <div class="carousel-inner">
            <div class="item active">
                <img src="/cn/images/course-bg01.png" alt="First slide">
            </div>
        </div>
    </div>
    <div class="s-w1200">
        <ul>
            <?php foreach ($data as $v){?>
            <li class="clearfix">
                <a href="teachers_details/<?php echo $v['id']?>.html" class="s-img">
                    <img src="<?php echo $v['pic']?>" alt="">
                </a>
                <div class="s-introduce">
                    <dl>
                        <dt><?php echo $v['name']?></dt>
                        <dd><?php echo $v['subject']?></dd>
                    </dl>
                    <p><?php echo $v['introduction']?></p>
                    <a class="s-details" href="teachers_details/<?php echo $v['id']?>.html">查看详情</a>
                </div>
            </li>
            <?php }?>
        </ul>
        <ol>
            <?php for($i=1;$i<=$maxpage;$i++){?>
            <a href="<?php echo '/teachers.html'.'?'.'p='.$i?>"><li <?php if($i==Yii::$app->request->get('p',1)) echo 'class="on" '?> ><?php echo $i?></li></a><?php }?>
        </ol>
    </div>
</section>

<script>
    $(function () {
        $('.s-teacher .s-w1200 ol li').click(function () {
            $('.s-teacher .s-w1200 ol li').removeClass('on');
            $(this).addClass('on');
        })
    })
</script>
