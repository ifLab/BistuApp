<?php 
include "header.php"; 
$nav_hover = 'manage-app';
?>
      <div class="well" style="width:100%;">
      <div class="row"><div class="span11">
        <p class="lead muted">管理应用<p>
      <hr>
<?php if( empty( $_SESSION['developer-email']  ) ){ ?>
        <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="email">开发者账号</label>
              <div class="controls">
                <input type="text" id="email" name="email">
              </div>
            </div>
           <div class="control-group">
              <label class="control-label" for="pwd">管理密码</label>
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
    $email = $_SESSION['developer-email'];
    $tab = isset($_GET['tab'])?strval(trim($_GET['tab'])):null;
    if( $tab == 'developer-info' ){ //开发者信息
        $developer_info_arr = getData( DEVELOPER_PATH, $email );
    }else{
        $developer_arr = getData( DATA_PATH, 'developer' );
        $app_arr = getData( DATA_PATH, 'app' );
        $user_app_arr = array();
        foreach( $developer_arr as $k => $v ){
            if( $v == $email ){
                $app_info_arr = getData( INDEX_PATH, $k );
                $user_app_arr[$k]['info'] = $app_info_arr;   
                if( array_key_exists( $k, $app_arr ) ){
                    $user_app_arr[$k]['state'] = '1';   
                }else{
                    $user_app_arr[$k]['state'] = '0';   
                }
            }  
        }
        $user_app_count = count( $user_app_arr );
    }
?>
<ul class="nav nav-tabs">
  <li<?php if( $tab == null ){ ?> class="active"<?php } ?>><a href="./manage-app.php">应用信息</a></li>
  <li<?php if( $tab == 'developer-info' ){ ?> class="active"<?php } ?>><a href="./manage-app.php?tab=developer-info">开发者信息</a></li>
  <li><a href="./request/manage-app.php?logout=logout">安全退出</a></li>
</ul>

<?php if( $tab == 'developer-info' ){ ?>
        <form class="form-horizontal" id="developerForm">
             <div class="control-group">
              <label class="control-label" for="email">开发者账号</label>
              <div class="controls">
                  <input type="text" id="email" name="email" value="<?=$developer_info_arr['email']?>" readonly>
              </div>
            </div>
             <div class="control-group">
              <label class="control-label" for="pwd">管理密码</label>
              <div class="controls">
                  <input type="password" id="pwd" name="pwd">
                  <span class="help-block">您可通过在此输入新的管理密码来重置密码，留空为不修改密码</span>
              </div>
            </div>
           <div class="control-group">
              <label class="control-label" for="phone">手机号码</label>
              <div class="controls">
                  <input type="text" id="phone" name="phone" value="<?=$developer_info_arr['phone']?>">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="button" onclick="editDeveloper();" class="btn btn-success">修 改 信 息</button><img width="43px" height="11px" id="loading" style="display:none;margin-left:20px;" src="public/img/ajax-loader.gif"/><span style="margin-left:20px;color:red;display:none;" id="tip"></span>
              </div>
            </div>
          </form>
<?php }else{ ?>
    <p><span class="label">我的APP总数：</span>&nbsp;&nbsp;<span class="badge badge-info"><?=$user_app_count?></span></p>
    <ol>
    <?php foreach( $user_app_arr  as $k => $v ){ ?>
        <li style="line-height:40px;" id="<?=$k?>">
        <span class="lead"><?=$v['info']['name']?></span>（<span><?=$v['info']['intro']?></span>）<span class="label label-success"><?php if( $v['state'] == '1' ){ echo '已上架'; }else{ echo '审核中'; }?></span>
            <a href="./item.php?id=<?=$k?>" class="btn btn-primary" target="_blank">查看详情 &raquo;</a>&nbsp;&nbsp;<a class="btn btn-info" href="./edit-app.php?id=<?=$k?>">编辑</a></li> 
    <?php } ?>
    </ol>
<?php } ?>

<?php } ?><!-- /.$_SESSION -->
    </div> </div><!-- /.row span11 -->
    </div><!-- /.well-->
<?php include "footer.php"; ?>
