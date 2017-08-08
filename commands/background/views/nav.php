
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a href="index.php" target="_blank" class="brand"><img src="/css/coreCss/img/favicon.png">sat在线后台</a>
            <div class="nav-collapse navbar-responsive-collapse">

                <ul class="nav pull-right">
                    <li>
                        <a href="<?php echo baseUrl?>/admin/role/index" >后台权限管理</a>
                    </li>
                    <li>
                        <a href="<?php echo baseUrl?>/basic/index/index" >后台首页</a>
                    </li>
<!--                    <li>-->
<!--                        <a href="--><?php //echo baseUrl?><!--/user/login/html">生成静态页</a>-->
<!--                    </li>-->
                    <li>
                        <a href="" > <?php echo "欢迎您,管理员：".$_SESSION['userName']; ?></a>
                    </li>
                    <li>
                        <a href="/admin/login/login-out">退出管理</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>