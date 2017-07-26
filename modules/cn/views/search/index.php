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
                <?php foreach ($data as $k=>$v){?>
                <li class="search-list">
                    <h2>
                        <?php echo isset($v['title'])?'<a href="/info_details/'.$v['id'].'.html">'. $v['title']:'<a href="/exercise_details/'.$v['id'].'.html">'.$v['essay']?>
                        </a></h2>
                    <div>
                        <p><?php echo isset($v['summary'])?$v['summary']:$v['content']?> </p>
                    </div>
                </li>
                <?php }?>
            <?php echo $str?>
        </div>
    </section>
</body>
</html>