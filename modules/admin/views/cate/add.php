 <div class="span10">
     <div >
         <div >
             <a href="">首页</a>
             <span >&gt;</span>
             <span>分类管理</span>
             <span >&gt;</span>
             <span>添加</span>
         </div>
     </div>
     <form action="<?php echo baseUrl.'/admin/cate/add'?>" method="post">
         <table>
             <tr>
                 <td>分类名称：</td>
                 <td><input name="name" value="" type="text"></td>
             </tr>
             <tr>
                 <td>深度：</td>
                 <td><input type="text" name="level"></td>
             </tr>
             <tr>
                 <input type="hidden" name="pid" value="<?php echo isset($data)?$data['id']:'0'?>">
<!--                 <input type="hidden" name="path" value="--><?php //echo isset($data)?$data['sourceId']:''?><!--">-->
                 <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                 <td colspan="2" align="right"> <input value="提交" type="submit"></td>
             </tr>
         </table>
     </form>
 </div>
