<div class="relatedArticles">
    <div class="relateA">
        <p>
            相关文章 <br/>
            <span>READ</span>
        </p>
        <ul>
            <?php
            foreach($related as $v) {
                ?>
                <li><a href="/word-details/<?php echo $v['id']?>/<?php echo $v['catId']?>.html"><?php echo $v['name']?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
    <div class="ceping">
        <h1>GMATONLINE智能测评</h1>
        <span>选择最适合你的题目难度</span>
        <ul>
            <li>
                <a href="http://www.gmatonline.cn/practise/cepingtishi&kzid=66&cptime=45" target="_blank">
                    <div class="circleWhite">
                        <span></span>
                        <img src="/cn/images/quesAnswer_cepingIcon01.png" alt="图标"/>
                    </div>
                    <p>
                        未考过GMAT <br>
                        无IBT/IELTS成绩
                    </p>
                </a>
            </li>
            <li>
                <a href="http://www.gmatonline.cn/practise/cepingtishi&kzid=67&cptime=45" target="_blank">
                    <div class="circleWhite">
                        <span></span>
                        <img src="/cn/images/quesAnswer_cepingIcon02.png" alt="图标"/>
                    </div>
                    <p>
                        未考过GMAT <br>
                        有IBT/IELTS成绩
                    </p>
                </a>
            </li>
            <li>
                <a href="http://www.gmatonline.cn/practise/cepingtishi&kzid=68&cptime=50" target="_blank">
                    <div class="circleWhite">
                        <span></span>
                        <img src="/cn/images/quesAnswer_cepingIcon03.png" alt="图标" style="width: 41px"/>
                    </div>
                    <p>
                        考过GMAT <br>
                        600以下
                    </p>
                </a>
            </li>
            <li>
                <a href="http://www.gmatonline.cn/practise/cepingtishi&kzid=69&cptime=55" target="_blank">
                    <div class="circleWhite">
                        <span></span>
                        <img src="/cn/images/quesAnswer_cepingIcon04.png" alt="图标"/>
                    </div>
                    <p>
                        考过GMAT <br>
                        650以下
                    </p>
                </a>
            </li>
            <li>
                <a href="http://www.gmatonline.cn/practise/cepingtishi&kzid=70&cptime=55" target="_blank">
                    <div class="circleWhite">
                        <span></span>
                        <img src="/cn/images/quesAnswer_cepingIcon05.png" alt="图标" style="width: 54px"/>
                    </div>
                    <p>
                        考过GMAT <br>
                        700以下
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>