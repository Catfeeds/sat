<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/role/index">权限管理</a></span>
        <span >&gt;</span>
        <span>添加管理员</span>
    </div>
    <form action="<?php echo baseUrl."/admin/role/admin_add" ?>" method="post">
        <span>用户名:</span>
        <div><input type="text" name="userName" value="<?php echo isset($data)? $data['userName']:''?>" style="width:500px"></div>
        <span>密码:</span>
        <div><input type="text" name="userPass" value="<?php echo isset($data)? $data['userPass']:''?>" style="width:500px"></div>
        <span>角色Id:</span>
        <div><input type="text" name="roleId" value="<?php echo isset($data)? $data['roleId']:''?>" style="width:500px"></div>

            <input type="hidden" name="id" value="<?php echo isset($data)? $data['id']:''?>" />
            <input id="btn" type="button" value="添加管理员" onclick="this.disabled=true; this.form.submit();">
    </form>
</div>