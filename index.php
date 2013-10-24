<?php
include "header.php"; 
$app_arr = getData( DATA_PATH, 'app' );
$new_app_arr = array();
if( in_array( $nav_hover, $category ) ){
    foreach( $app_arr as $k => $v ){
        if( $v == $nav_hover ) $new_app_arr[] = $k;
    }
}else{
    foreach( $app_arr as $k => $v ){
        $new_app_arr[] = $k;
    }
}
shuffle( $new_app_arr );
$app_index_arr = array();
foreach( $new_app_arr as $v ){
   $app_index_arr[$v] = getData( INDEX_PATH, $v ); 
}
$nav_hover = 'index';
?>
      <!-- App Index Begin -->
      <div class="row">
      <?php foreach( $app_index_arr as $k => $v ){ ?>
         <div class="span4">
           <div class="well">
             <div style="width:100%;text-align:center;height:200px;overflow:hidden;"> <img src="<?=$v['introduce_img']?>"></div>
             <h2><?=$v['name']?></h2>
             <p style="height:40px;word-wrap:break-word;overflow:hidden;"><?=$v['intro']?></p>
             <p><a class="btn btn-primary" href="./item.php?id=<?=$k?>">查看详情 &raquo;</a>&nbsp;&nbsp;<a class="btn btn-warning" target="_blank" href="<?=$v['package']?>" onclick="countPlus(<?=$k?>);">直接下载</a></p>
           </div>
        </div><!-- /.span4 -->
      <?php } ?>
        <div class="span4">
           <div class="well">
             <div style="width:100%;text-align:center;height:200px;background-color:#eee;"> <img src="public/img/330_200.png"> </div>
             <h2>iBistu</h2>
             <p style="height:40px;word-wrap:break-word;overflow:hidden;">其实我就是来占位的，不要点我。其实我就是来占位的，不要点我。</p>
             <p><a class="btn btn-primary" href="#">查看详情 &raquo;</a></p>
           </div>
        </div><!-- /.span4 -->
        <div class="span4">
           <div class="well">
             <div style="width:100%;text-align:center;height:200px;background-color:#eee;"> <img src="public/img/330_200.png"> </div>
             <h2>iBistu</h2>
             <p style="height:40px;word-wrap:break-word;overflow:hidden;">其实我就是来占位的，不要点我。其实我就是来占位的，不要点我。</p>
             <p><a class="btn btn-primary" href="#">查看详情 &raquo;</a></p>
           </div>
        </div><!-- /.span4 -->
        <div class="span4">
           <div class="well">
             <div style="width:100%;text-align:center;height:200px;background-color:#eee;"> <img src="public/img/330_200.png"> </div>
             <h2>iBistu</h2>
             <p style="height:40px;word-wrap:break-word;overflow:hidden;">其实我就是来占位的，不要点我。其实我就是来占位的，不要点我。</p>
             <p><a class="btn btn-primary" href="#">查看详情 &raquo;</a></p>
           </div>
        </div><!-- /.span4 -->
      </div><!-- /.row -->
      <!-- App Index End -->
<?php include "footer.php"; ?>
