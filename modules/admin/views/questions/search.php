
<div class="span10">
    id:<input name="id" type="text" class="search" >
    <botton  class="go" value="搜索">搜索</botton>
</div>
<script>
    $('.go').click(function () {
        location.href = "/admin/questions/add?id="+$('.search').val();
    })
</script>
