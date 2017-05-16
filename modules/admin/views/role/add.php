<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/role/index">权限管理</a></span>
        <span >&gt;</span>
        <span>添加角色</span>
    </div>
    <form action="<?php echo baseUrl."/admin/role/add" ?>" method="post">
        <span>角色名:</span>
        <div><input type="text" name="name" value="<?php echo isset($data1)? $data1['name']:''?>"></div>
        <span>模&nbsp;&nbsp;块:</span>
        <div><input type="text" name="modules" value="admin" readonly="readonly"></div>
        <span>方法:</span>
        <div class="action" width="50%">
            <?php foreach($data as $v){?>
              <span style="padding-left:<?php echo $v['level']*20?>px">
                <input type="checkbox" name="ids[]" value="<?php echo $v['id']?>" <?php echo isset($data1) && strpos($data1['ids'],$v['id'])!==false ?  'checked':''?>>
                 <?php echo $v['name'] ?>
              </span></br>
            <?php } ?>
        </div>
            <input type="hidden" name="id" value="<?php echo isset($data1)? $data1['id']:''?>" />
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <input id="btn" type="button" value="分配权限" onclick="this.disabled=true; this.form.submit();">
    </form>
</div>