<?php 
include "header.php"; 
$app_id = isset($_GET['id'])?intval(trim($_GET['id'])):null;
if( $app_id ){
    $app_arr = getData( ITEM_PATH, $app_id );
    if( empty($app_arr) ) exit( '您所请求的页面不存在，或已被删除，请检查地址是否输入正确。' );
    $count_arr = getData( COUNT_PATH, $app_id );
    $screenshot_arr =  explode( ',', $app_arr['screenshot'] );
}else{
    exit( '您所请求的页面不存在，或已被删除，请检查地址是否输入正确。' );
}
$nav_hover = 'item';
?>
      <div class="well" style="100%;">
      <div class="row">
      <!-- Item Begin -->
                 <div class="span4">
                 <!--Picture Carousel Begin-->
                 <div id="myCarousel" class="carousel slide" style="width:100%;overflow:hidden;">
                    <?php if( count( $screenshot_arr ) <= 1 ){ ?>
                    <div class="item active"> <img src="<?=$screenshot_arr[0]?>" alt=""> </div> 
                    <?php }else{ ?>
                    <ol class="carousel-indicators">
                      <?php foreach( $screenshot_arr as $k => $v ){ ?>
                      <li data-target="#myCarousel" data-slide-to="<?=$k?>"<?php if( $k == 0 ){ ?> class="active"<?php } ?>></li>
                      <?php } ?>
                    </ol>
                    <div class="carousel-inner" id="itemCarousel">
                      <?php foreach( $screenshot_arr as $k => $v ){ ?>
                      <div class="item<?php if( $k == 0 ){ ?> active<?php } ?>"><img src="<?=$v?>" alt=""></div>
                      <?php } ?>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                    <?php } ?>
                </div>
                <!--Picture Carousel End-->
                </div><!-- /.span4 -->
                <div class="span7">
                <p style="line-height: 40px;"><span style="font-size:35px;color:#555;"><?=$app_arr['name']?></span> <span class="pull-right"><a href="http://www.jiathis.com/share" class="jiathis jiathis_txt" style="line-height:18px;color:#555;" target="_blank">分享</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a data-toggle="modal" href="#myModal" style="color:#555;">举报</a> </span></p>
                     <div class="row-fluid">
                     <div class="span4">版本：<?=$app_arr['version']?></div> <div class="span4">下载次数：<?=$count_arr['count']?></div> <div class="span4">系统要求：<?=$app_arr['requirement']?></div>
                      </div>
                      <div class="row-fluid">
                             <div class="span4">类型：<?=$app_arr['category']?></div> <div class="span4">更新时间：<?=$app_arr['update_time']?></div> <div class="span4">开发者：<?=$app_arr['developer_name']?></div>
                      </div>
                      <hr>
                     <div style="word-wrap:break-word;"><?=$app_arr['introduce']?></div>
                     <p style="margin-top:10px;"><a class="btn btn-info" target="_blank" href="<?=$app_arr['package']?>" onclick="countPlus(<?=$app_id?>);">点击下载</a></p>
                </div><!-- /.span7 -->
       <!-- Item End -->
       </div><!-- /.row -->
       </div><!-- /.well -->
<?php include "footer.php"; ?>
