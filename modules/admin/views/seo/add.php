<div class="span10">
    <div >
        <a>首页</a>
        <span >&gt;</span>
        <span><a href="/admin/seo/index">seo管理</a></span>
        <span >&gt;</span>
        <span>添加</span>
    </div>
    <form action="<?php echo baseUrl."/admin/seo/add" ?>" method="post">
        <span>地址:</span>
        <div>
            <input type="text" name="url" value="<?php echo isset($data)? $data['url']:''?>">
        </div>

        <span>标题:</span>
        <div>
            <input type="text" name="title" value="<?php echo isset($data)? $data['title']:''?>" >
        </div>

        <span>关键词:</span>
        <div>
            <input type="text" name="keywords" value="<?php echo isset($data)? $data['keywords']:''?>">
        </div>


        <span>描述:</span>
        <div>
            <textarea type="text" name="description" style="height:80px"><?php echo isset($data)? $data['description']:''?></textarea>
        </div>
            <input type="hidden" name="id" value="<?php echo isset($data)? $data['id']:''?>" />
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <input id="btn" type="button" value="添加、修改" onclick="this.disabled=true; this.form.submit();">
    </form>
</div>