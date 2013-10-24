<?php 
include "header.php"; 
$nav_hover = 'app-admin';
?>
      <div class="well" style="width:100%;">
      <div class="row"><div class="span11">
        <p class="lead muted">网站管理<p>
      <hr>
<?php if( empty( $_SESSION['app-admin']  ) ){ ?>
        <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="name">账户</label>
              <div class="controls">
                <input type="text" id="name" name="name">
              </div>
            </div>
           <div class="control-group">
              <label class="control-label" for="pwd">密码</label>
              <div class="controls">
                <input type="password" id="pwd" name="pwd">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="button" onclick="checkLogin();" class="btn btn-success">确 认 登 录</button><img width="43px" height="11px" id="loading" style="display:none;margin-left:20px;" src="public/img/ajax-loader.gif"/><span style="margin-left:20px;color:red;display:none;" id="tip"></span>
              </div>
            </div>
          </form>
<?php }else{ 
    $developer_arr = getData( DATA_PATH, 'developer' );
    $developer_count = count( array_unique( $developer_arr ) );
    $app_arr = getData( DATA_PATH, 'app' );
    $app_count = count( $app_arr );
    $submit_audit_arr = getData( DATA_PATH, 'submit-audit' );
    $report_arr = getData( DATA_PATH, 'report' );
    foreach( $app_arr as $k => $v ){
        $app_arr[$k] = getData( DEVELOPER_PATH, $developer_arr[$k] );
    }
    foreach( $submit_audit_arr as $k => $v ){
        $submit_audit_arr[$k] = getData( DEVELOPER_PATH, $developer_arr[$k] );
    }
?>
<ul class="nav nav-tabs">
  <li class="active"><a href="./app-admin.php">网站信息</a></li>
  <li><a href="./request/app-admin.php?logout=logout">安全退出</a></li>
</ul>
<p><span class="label">上架APP总数：</span>&nbsp;&nbsp;<span class="badge badge-info"><?=$app_count?></span></p>
<p><span class="label">开发者总数：</span>&nbsp;&nbsp;<span class="badge badge-info"><?=$developer_count?></span></p>
<p class="lead">站点操作：</p><hr>
<p><span class="label label-success">应用上架审核：</span></p>
<ol>
<?php foreach( $submit_audit_arr  as $k => $v ){ ?>
    <li style="line-height:40px;" id="<?=$k?>"><a href="./item.php?id=<?=$k?>" target="_blank"><?=$k?></a>&nbsp;&nbsp;<?=$v['developer_name']?>&nbsp;&nbsp;<?=$v['phone']?>&nbsp;&nbsp;<?=$v['email']?>&nbsp;&nbsp;<button class="btn btn-success" onclick="appPass(<?=$k?>)">上架</button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="appDelete(<?=$k?>)">删除</button></li> 
<?php } ?>
</ol>
<p><span class="label label-success">应用下架操作：</span></p>
<ol>
<?php foreach( $app_arr  as $k => $v ){ ?>
    <li style="line-height:40px;" id="<?=$k?>"><a href="./item.php?id=<?=$k?>" target="_blank"><?=$k?></a>&nbsp;&nbsp;<?=$v['developer_name']?>&nbsp;&nbsp;<?=$v['phone']?>&nbsp;&nbsp;<?=$v['email']?>&nbsp;&nbsp;<button class="btn btn-danger" onclick="appDown(<?=$k?>)">下架</button></li> 
<?php } ?>
</ol>
<p><span class="label label-success">举报信息：</span></p>
<ol>
<?php foreach( $report_arr as $k => $v ){ ?>
    <li style="line-height:40px;" id="<?=$k?>"><a href="./item.php?id=<?=$v['app_id']?>" target="_blank"><?=$v['app_id']?></a>&nbsp;&nbsp;<?=$v['report']?>【<?=$v['user']?>】【<?=$v['time']?>】</a>&nbsp;&nbsp;<button class="btn btn-info" onclick="">已处理（暂无）</button></li> 
<?php } ?>
</ol>

<?php } ?>
    </div> </div><!-- /.row span11 -->
    </div><!-- /.well-->
<?php include "footer.php"; ?>
