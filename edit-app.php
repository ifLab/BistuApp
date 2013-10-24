<?php 
include "header.php";
$app_id = isset($_GET['id'])?intval(trim($_GET['id'])):null;
if( !empty( $_SESSION['developer-email'] ) && $app_id ){
    $developer_arr = getData( DATA_PATH, 'developer' );
    if( ( !isset( $developer_arr[$app_id] ) ) || ( $developer_arr[$app_id] != $_SESSION['developer-email'] ) ) exit( '您无权限访问。' );
    $app_item_arr = getData( ITEM_PATH, $app_id );
    $app_index_arr = getData( INDEX_PATH, $app_id );
    if( empty($app_item_arr) ) exit( '您所请求的页面不存在，或已被删除，请检查地址是否输入正确。' );
    $screenshot_arr =  explode( ',', $app_item_arr['screenshot'] );
}else{
    exit( '您所请求的页面不存在，或无权限访问。' );
}
$nav_hover = 'edit-app';
?>
      <div class="well" style="width:100%;">
      <div class="row"><div class="span11">
        <p class="lead muted">修改应用信息<p>
      <hr>
        <form class="form-horizontal" id="submitForm">
            <div class="control-group">
              <label class="control-label" for="developer_name">开发者名称</label>
              <div class="controls">
                  <input type="hidden" id="app_id" name="app_id" value="<?=$app_id?>">
                  <input type="hidden" id="category" name="category" value="<?=$app_item_arr['category']?>">
                  <input type="text" id="developer_name" name="developer_name" value="<?=$app_item_arr['developer_name']?>">
              </div>
            </div>
           <div class="control-group">
              <label class="control-label" for="name">应用名称</label>
              <div class="controls">
                  <input type="text" id="name" name="name" value="<?=$app_item_arr['name']?>">
                <span class="help-block">不少于2个字符，不多于16个字符</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="version">应用版本</label>
              <div class="controls">
                <input type="text" id="version" name="version" value="<?=$app_item_arr['version']?>">
                <span class="help-block">格式：1.0</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="requirement">系统要求</label>
              <div class="controls">
                <input type="text" id="requirement" name="requirement" value="<?=$app_item_arr['requirement']?>">
                <span class="help-block">格式：Android2.2及以上</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="intro">应用简介</label>
              <div class="controls">
                <textarea rows="3" id="intro" name="intro"><?=$app_index_arr['intro']?></textarea>
                <span class="help-block">将在首页或分类页展示应用简介，不多于30字</span>
              </div>
            </div>
             <div class="control-group">
              <label class="control-label" for="introduce">应用介绍</label>
              <div class="controls">
                <textarea rows="5" id="introduce" name="introduce"><?=$app_item_arr['introduce']?></textarea>
                <span class="help-block">请认真填写，不少于50字</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="">安装包链接</label>
              <div class="controls">
                <input type="text" id="package" name="package" value="<?=$app_item_arr['package']?>">
                <span class="help-block">可以是应用商店链接，iTunes链接等</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="">应用简图</label>
              <div class="controls">
                <input type="hidden" id="introduce_img" name="introduce_img" value="<?=$app_index_arr['introduce_img']?>">
                <input type="file" id="imgUpload" value="">
                <span class="help-block">将在首页或分类页展示应用简图，建议高度为200px</span>
                <img id="introduce_img_preview" src="<?=$app_index_arr['introduce_img']?>"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="">应用截图</label>
              <div class="controls">
                <input type="hidden" id="screenshot" name="screenshot" value="<?=$app_item_arr['screenshot']?>">
                <input type="file" id="screenshotUpload" value="">
                <span class="help-block">将在应用详情页展示应用截图，3~5张为宜，建议宽度不超过370px</span>
                <span class="del-tip text-error">Tip：双击缩略图可删除相应图片</span>
                <ul id="thumblist" style="margin:0;"> 
                <?php foreach( $screenshot_arr as $v ){ ?>
                    <li id="<?=$v?>"><a href="javascript:void(0)" title="用力双击将删除该图片"><img ondblclick="deleteImg('<?=$v?>')" src="<?=$v?>"/></a></li>
                <?php } ?>
                </ul>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="button" onclick="submitApp();" class="btn btn-success">确 认 修 改</button><img width="43px" height="11px" id="loading" style="display:none;margin-left:20px;" src="public/img/ajax-loader.gif"/><span style="margin-left:20px;color:red;display:none;" id="tip"></span>
              </div>
            </div>
          </form>
    </div> </div><!-- /.row span11 -->
    </div><!-- /.well-->
<?php include "footer.php"; ?>
