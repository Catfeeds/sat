<div id="myCarousel" class="carousel pull-left slide">
    <!-- 轮播（Carousel）指标 -->
    <?php var_dump($controller)?>
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="/cn/images/course-bg01.png" alt="First slide">
        </div>
        <div class="item">
            <img src="/cn/images/course-bg01.png" alt="Second slide">
        </div>
        <div class="item">
            <img src="/cn/images/course-bg01.png" alt="Third slide">
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <a class="carousel-control s-left" href="#myCarousel"
       data-slide="prev">&lt;</a>
    <a class="carousel-control s-right" href="#myCarousel"
       data-slide="next">&gt;</a>
</div>