<!-- Modal Begin -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">举报信息</h3>
  </div>
  <div class="modal-body">
     <form class="form-horizontal" id="submitForm">
         <div class="control-group">
              <label class="control-label" for="report">举报内容</label>
              <div class="controls">
                <textarea rows="3" id="report" name="report"></textarea>
              </div>
         </div>
        <div class="control-group">
          <label class="control-label" for="user">您的联系方式</label>
          <div class="controls">
            <input type="text" id="user" name="user">
            <input type="hidden" id="app_id" name="app_id" value="<?=$app_id?>">
            <span class="help-block">Tel，QQ，E-mail...</span>
          </div>
        </div>
     </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary" onclick="checkReport();">确认举报</button><img width="43px" height="11px" id="loading" style="display:none;margin-left:20px;" src="public/img/ajax-loader.gif"/><span style="margin-left:20px;color:red;display:none;" id="tip"></span>
  </div>
</div>
<!-- Modal End -->
<script type="text/javascript">
/*count plus*/
function countPlus( id ){
     setTimeout(function () {
           $.post("./request/count-plus.php",{'count':id},function(msg){
                if( msg == 'success'){
                    //success
                }else{
                    //failed
                }
            });
     },2000); //avoid conflict GET
}
/*check report form*/
function checkReport(){
    var report = $('#report').val(), user = $('#user').val(), app_id = $('#app_id').val();
    if( report == '' || user == '' ){
        tip('每一项皆为必填项~~~');
    }else{
        $('#tip').fadeOut(0);
        $('#loading').fadeIn(100);
        var report = {'report':report,'user':user,'app_id':app_id};
        $.post("./request/report-app.php",{'report':report},function(msg){
            if( msg == 'success'){
                alert( '举报信息已成功提交，感谢您的信任与支持！' );
                window.location.reload();
            }else{
                tip('遇到未知错误,请重试~~~');
            }
        });
    }
}
/*display tip*/
function tip(info){
        $('#loading').fadeOut(0);
        $('#tip').html(info).fadeIn(200);
        return false;
}
var jiathis_config = {
     title:"<?=$app_arr['name']?>",
     imageUrl:"<?=$screenshot_arr[0]?>"
}
</script>
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
