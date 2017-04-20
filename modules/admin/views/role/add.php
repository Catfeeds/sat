<div class="table-box" xmlns="http://www.w3.org/1999/html">
    <form action="">
        <table>
            <tr>
                 <td>角色名:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
             <td>模&nbsp;&nbsp;块:</td>
            <td> </td>

        </tr>
            <tr>
            <td>控制器:</td>
            <td><?php foreach($data as $v){?>
                <input type="checkbox" id="checkbox"/><?php echo $v['name'] ?>
                <?php } ?>
            </td>
        </tr>
            <tr>
            <td>方法:</td>
            <td ></td>
        </tr>
        </table>
    </form>
</div>
<script>
    $("#ckeckbox").checked=function(

    )
</script>