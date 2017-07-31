<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/cn/css/search.css">
</head>
<body>
    <section>
        <div class="search-bc">
            <form class="search-form clearfix" action="">
                <div class="search-select select2 pull-left">
                    <p>题目</p>
                    <ul>
                        <li>题目</li>
                        <li>资讯</li>
                    </ul>
                </div>
                <input type="button" class="search-btn pull-right" value="搜索" onclick="keySearch(this)">
                <input class="search-text text2" name="keyword" onkeyup="enterKey(event,this)" type="text" x-webkit-speech="">
            </form>
        </div>
        <div class="search-cnt search-subject">
            <ul>
                <?php if($data==false){echo '无搜索结果';}else{foreach ($data as $k=>$v){?>
                <li class="search-list">
                    <h2>
                        <?php echo isset($v['title'])?'<a href="/info_details/'.$v['id'].'.html">'. $v['title']:'<a href="/exercise_details/'.$v['qid'].'.html">'.$v['essay']?>
                        </a></h2>
                    <div>
                        <p><?php echo isset($v['summary'])?$v['summary']:$v['content']?> </p>
                    </div>
                </li>
                <?php }}?>
            <?php echo $str?>
        </div>
    </section>
</body>
</html>