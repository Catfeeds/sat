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
            <form class="search-form" action="">
                <select name="cate" class="search-select select2" onclick="cat(this)">
                    <option value="q">题目</option>
                    <option value="i">资讯</option>
                </select>
                <input class="search-text text2" name="keyword" onkeyup="enterKey(event,this)" type="text" x-webkit-speech="">
                <input type="button" class="search-btn" value="搜索" onclick="keySearch(this)">
            </form>
        </div>
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
    </section>
</body>
</html>