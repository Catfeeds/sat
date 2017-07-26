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