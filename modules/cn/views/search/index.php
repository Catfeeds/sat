<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>雷哥SAT官网</title>
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
                    <i class="search-icon fa fa-angle-down"></i>
                </div>
                <input type="button" class="search-btn pull-right" value="搜索" onclick="keySearch(this)">
                <input class="search-text text2" name="keyword" onkeyup="enterKey(event,this)" type="search" x-webkit-speech="">
            </form>
        </div>
        <div class="search-cnt search-subject">
            <ul>
                <?php if($data==false){echo '无搜索结果';}else{ $keyword = Yii::$app->request->get('keyword', '');foreach ($data as $k=>$v){?>
                <li class="search-list">
                    <h2>
                        <?php echo isset($v['title'])?'<a href="/info_details/'.$v['id'].'.html">'.(str_replace($keyword,"<span style='color:red;'>".$keyword.'</span>',strip_tags($v['title']))):'<a href="/exercise_details/'.$v['qid'].'.html">'.$v['name'].'-'.$v['time'].'-'.$v['major'].'-'.$v['number'];?>
                        </a>
                    </h2>
                    <div>
                        <?php echo isset($v['summary'])?strip_tags($v['summary']):str_replace($keyword,'<span style="color:red;">'.$keyword.'</span>',strip_tags($v['content']))?>
                    </div>
                </li>
                <?php }}?>
            <?php echo $str?>
        </div>
    </section>
</body>
<script>
    $(function () {
        $('.search-text').val("<?php echo Yii::$app->request->get('keyword', '');?>");
    })
</script>
</html>