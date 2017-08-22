<div class="person-side pull-left">
    <ul>
        <li class="person-title">
            <div class="person-name">
                <img src="/cn/images/login.png" alt="头像">
                <p>
                    <span><?php echo $user['nickname']?$user['nickname']:$user['username']?></span>
                    <span>(初出茅庐)</span>
                </p>
            </div>
            <ul>
                <li>做题数:<span><?php echo $crr['count'];?></span></li>
                <li>正确率:<span><?php echo (sprintf("%.2f",$crr['correctRate']))?></span></li>
            </ul>
        </li>
        <li <?php if(strpos($path,'collect')!==false) echo 'class="on"';?>>
            <a href="/person_collect.html" >
                <i class="fa fa-bookmark"></i>收藏题目
            </a>
        </li>
        <li <?php if(strpos($path,'mock')!==false) echo 'class="on"';?>>
            <a href="/person_mock.html" >
                <i class="fa fa-clipboard"></i>模考记录
            </a>
        </li>
        <li <?php if(strpos($path,'exercise')!==false) echo 'class="on"';?>>
            <a href="/person_exercise.html" >
                <i class="fa fa-file-text-o"></i>做题记录
            </a>
        </li>
    </ul>
</div>