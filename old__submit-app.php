<?php include "header.php"; ?>
      <div class="well" style="width:100%;">
      <div class="row"><div class="span11">
        <p class="lead muted">提交应用<a class="pull-right" href="./manage-app.php"><small>管理应用</small></a><p>
      <hr>
        <form class="form-horizontal" id="submitForm">
            <div class="control-group">
              <label class="control-label" for="developer_type">开发者类型</label>
              <div class="controls">
                <label class="radio inline">
                     <input type="radio" name="developer_type" id="developer_type" value="team" checked>
                     团队
                </label>
                <label class="radio inline">
                     <input type="radio" name="developer_type" id="developer_type" value="person">
                     个人
                </label>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="developer_name">开发者名称</label>
              <div class="controls">
                <input type="text" id="developer_name" name="developer_name">
                <span class="help-block">将在应用详情页中展示开发者名称，个人开发请填写真实姓名</span>
              </div>
            </div>
           <div class="control-group">
              <label class="control-label" for="email">电子邮箱</label>
              <div class="controls">
                <input type="text" id="email" name="email" onblur="checkEmail();" autocomplete="off">
                <span class="help-block">请如实填写，我们将会通过此邮箱与您联系，以后管理应用也会用到该邮箱</span>
                <span class="text-success dev_tip" style="display:none;">该邮箱账号之前已启用，可通过该账号和之前设置的密码管理与该账号关联的所有应用</span>
              </div>
            </div>
           <div class="control-group dev_info" style="display:none;">
              <label class="control-label" for="pwd">管理密码</label>
              <div class="controls">
                <input type="password" id="pwd" name="pwd">
                <span class="help-block">请为新的开发者账号设置密码，以后可通过邮箱和此密码管理应用</span>
              </div>
            </div>
           <div class="control-group dev_info" style="display:none;">
              <label class="control-label" for="phone">手机号码</label>
              <div class="controls">
                <input type="text" id="phone" name="phone">
                <span class="help-block">选填，以便我们能将您的应用审核结果在第一时间给您反馈，此号码不会对外公布。格式：13912345678</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="name">应用名称</label>
              <div class="controls">
                <input type="text" id="name" name="name">
                <span class="help-block">不少于2个字符，不多于16个字符</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="version">应用版本</label>
              <div class="controls">
                <input type="text" id="version" name="version">
                <span class="help-block">格式：1.0</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="requirement">系统要求</label>
              <div class="controls">
                <input type="text" id="requirement" name="requirement">
                <span class="help-block">格式：Android2.2及以上</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="intro">应用简介</label>
              <div class="controls">
                <textarea rows="3" id="intro" name="intro"></textarea>
                <span class="help-block">将在首页或分类页展示应用简介，不多于30字</span>
              </div>
            </div>
             <div class="control-group">
              <label class="control-label" for="introduce">应用介绍</label>
              <div class="controls">
                <textarea rows="5" id="introduce" name="introduce"></textarea>
                <span class="help-block">请认真填写，不少于50字</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="">应用简图</label>
              <div class="controls">
                <input type="hidden" id="introduce_img" name="introduce_img">
                <input type="file" id="imgUpload" value="">
                <span class="help-block">将在首页或分类页展示应用简图，建议高度为200px</span>
                <img id="introduce_img_preview" style="display:none;" src="holder.js/330x200"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="">应用截图</label>
              <div class="controls">
                <input type="hidden" id="screenshot" name="screenshot">
                <input type="file" id="screenshotUpload" value="">
                <span class="help-block">将在应用详情页展示应用截图，3~5张为宜，建议宽度不超过370px</span>
                <span class="del-tip text-error" style="display:none;">Tip：双击缩略图可删除相应图片</span>
                <ul id="thumblist" style="display:none;margin:0;"> </ul>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="">应用安装包</label>
              <div class="controls">
                <input type="hidden" id="package" name="package">
                <input type="hidden" id="category" name="category">
                <input type="hidden" id="filesize" name="filesize">
                <input type="file" id="packageUpload" value="">
                <a id="package_preview" style="display:none;" target="_blank" href="#"></a>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="button" onclick="submitApp();" class="btn btn-success">确 认 提 交</button><img width="43px" height="11px" id="loading" style="display:none;margin-left:20px;" src="public/img/ajax-loader.gif"/><span style="margin-left:20px;color:red;display:none;" id="tip"></span>
              </div>
            </div>
          </form>
    <!-- Success Tip Begin -->
    <h4 class="text-success app-success-tip" style="display:none;margin-top:50px;">您的应用《<span id="app-name"></span>》已成功提交，我们会尽快审核上架。</h4>
    <h4 class="text-info developer-success-tip" style="display:none;">开发者账号<span id="developer-email"></span>已注册，您以后可通过该账号和密码维护应用信息。</h4>
    <h4 class="app-success-tip" style="display:none;margin-bottom:50px;">如果疑问，请联系<a target="_blank" href="http://iflab.org">网络实践创新联盟</a>。</h4>
    <!-- Success Tip End -->
    </div> </div><!-- /.row span11 -->
    </div><!-- /.well-->
<?php include "footer.php"; ?>
