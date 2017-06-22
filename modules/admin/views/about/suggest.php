<div class="span10">
    <div >
        <a href="/admin/about/index">关于我们</a><span >&gt;</span><span><a href='<?php echo baseUrl."/admin/about/suggest"?>'>用户建议</a></span>
    </div>
    <table border="1"  width="800px">
        <tr align="center">
            <th>id</th>
            <th>uid</th>
            <th>建议</th>
        </tr>
        <?php
        foreach($data as $v){?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['uid']?></td>
                <td><?php echo $v['suggest']?></td>
            </tr>
        <?php }?>
    </table>
</div>
