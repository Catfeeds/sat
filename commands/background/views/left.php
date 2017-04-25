
<ul class="nav nav-tabs nav-stacked">
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/knowledge/index">知识点管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/classes/index">课程管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/user/index/index">用户管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/teachers/index">讲师管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/questions/index">题库管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/info/index">资讯管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/cate/index">分类管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/node/index">权限管理</a><li>-->
<!--    <li><a href="--><?php //echo baseUrl?><!--/admin/role/index">角色管理</a><li>-->
    <?php foreach ($data as $v){ if($v['pid']==0 && $v['isShow']==1){?>
    <li><a href="/<?php echo $v['path']?>"><?php echo $v['name']?></a><li>
    <?php } }?>
</ul>
