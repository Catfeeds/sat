<div class="span10">
    <div >
        <a href="/admin/about/index">关于我们</a><span >&gt;</span><span>建议</span>
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
                <td><? echo $v['id']?></td>
                <td><? echo $v['uid']?></td>
                <td><? echo $v['suggest']?></td>
            </tr>
        <?php }?>
    </table>
</div>