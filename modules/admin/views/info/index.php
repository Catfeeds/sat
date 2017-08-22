<style xmlns="http://www.w3.org/1999/html">
    .info-wrap>td {
        text-align: center;
    }
    .info-wrap>td>div {
        max-height: 200px;
        overflow-y: auto;
    }
    .tiao-val {
        width: 30px;
        height: 30px;
        margin: 5px 5px 0 0;
        outline: none;
        font-size: 14px;
    }
    .tiao-btn {
        font-size: 14px;
    }

</style>
<link rel="stylesheet" href="/cn/css/bootstrap.min.css">
<script src="/cn/js/bootstrap.min.js"></script>
<div class="span10">
    <div >
        <a href="/index/index">首页</a><span >&gt;</span><span>资讯管理</span>
    </div>

    <a href="<?php echo baseUrl.'/admin/info/add'?>">添加资讯</a>
    <table border="1"  style="table-layout: fixed;width:100%;">
        <tr align="center">
            <th width="60px">id</th>
            <th>资讯标题</th>
            <th>图片</th>
            <th>视频地址</th>
            <th>关键词</th>
            <th>摘要</th>
            <th>内容</th>
            <th width="80px">资讯类别</th>
            <th width="120px">发布时间</th>
            <th width="60px">点击量</th>
            <th width="100px">有效时间</th>
            <th width="100px">操作</th>
        </tr>
        <?php foreach($data as $v){?>
            <tr class="info-wrap">
                <td>
                    <div>
                        <?php echo $v['id']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['title']?>
                    </div>
                </td>
                <td title="<?php echo $v['pic']?>">
                    <div>
                        <?php echo $v['pic']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['videoAddress']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['keywords']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['summary']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['content']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['cate']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['publishTime']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['hits']?>
                    </div>
                </td>
                <td>
                    <div>
                        <?php echo $v['validTime']?>
                    </div>
                </td>
                <td>
                    <div>
                        <a class="link-update" href="<?php echo baseUrl.'/admin/info/add'.'?'.'id='.$v['id']?>">修改</a>
                        <a class="link-del" href="" onclick="del(<?php echo $v['id'] ?>)">删除</a>
                    </div>
                </td>
            </tr>
        <?php }?>
    </table>
    <div class="tiao-wrap">
        <?php echo $str?>
        <input type="text" class="tiao-val"><button class="tiao-btn">跳转</button>
    </div>
</div>

<script>
    $(function () {
        $('.tiao-btn').click(function () {
            location.href = location.pathname+"?p="+$('.tiao-val').val();
        })
    })
    function del(id){
        if(confirm("确定删除内容吗")) {
            $.get("/admin/info/del", {id: id},
                function (msg) {
                    if (msg) {
                        alert('删除成功');
                    }
                }, 'text'
            );
        }
    }
</script>
