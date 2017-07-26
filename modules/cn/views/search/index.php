<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/cn/css/search.css">
    <script src="/cn/js/search.js"></script>
</head>
<body>
    <section>
        <div class="search-bc">
            <form action="/cn/search/index" method="post">
                <i class="nav-search-sure search-icon fa fa-search"></i>
                <input class="input-cnt search-input" name="keyword" type="text">
                <input type="submit">
            </form>
        </div>
        <ul class="search-toggle">
            <li class="on">资讯</li>
            <li>题目</li>
        </ul>
        <div class="search-cnt search-subject">
            <ul>
                <?php foreach ($info as $k=>$v){?>
                <li class="search-list">
                    <h2><a href="/info_details/<?php echo $v['id']?>.html"><?php echo $v['title']?></a></h2>
                    <div>
                        <p><?php echo $v['summary']?> </p>
                    </div>
                </li>
                <?php }?>

<!--                <li class="search-list">-->
<!--                    <h2><a href="#">ndjknakj ndfjakj dnsak</a></h2>-->
<!--                    <div>-->
<!--                        <p>ndjknakj ndfjakj dnsakndjknakj ndfjakj dnsakndjknakj ndfjakj dnsakndjknakj ndfjakj dnsak</p>-->
<!--                    </div>-->
<!--                </li>-->
            </ul>
            <?php echo $strinfo?>
        </div>
        <div class="search-cnt search-info">
            <ul>
            <?php foreach ($que as $k=>$v){?>
                <li class="search-list">
                    <h2><a href="/exercise_details/<?php echo $v['qid']?>.html"><?php echo $v['essay']?></a></h2>
                    <div>
                        <p><?php echo $v['content']?> </p>
                    </div>
                </li>
            <?php }?>
            </ul>
            <?php echo $strque?>
        </div>

    </section>
</body>
</html>