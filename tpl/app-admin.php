<script type="text/javascript">
/*app pass*/
function appPass( id ){
    $('#'+id).fadeOut();
    $.post("./request/app-admin.php",{'pass':id},function(msg){
        if( msg == 'success'){
            alert(id+'已成功上架~~~');
            window.location.reload();
        }else{
            $('#'+id).fadeIn();
            alert('遇到未知错误,请重试~~~');
        }
    });
}
/*app down*/
function appDown( id ){
    $('#'+id).fadeOut();
    $.post("./request/app-admin.php",{'down':id},function(msg){
        if( msg == 'success'){
            alert(id+'已成功下架~~~');
            window.location.reload();
        }else{
            $('#'+id).fadeIn();
            alert('遇到未知错误,请重试~~~');
        }
    });
}
/*app delete*/
function appDelete( id ){
    $('#'+id).fadeOut();
    $.post("./request/app-admin.php",{'delete':id},function(msg){
        if( msg == 'success'){
            alert(id+'已成功删除~~~');
        }else{
            $('#'+id).fadeIn();
            alert('遇到未知错误,请重试~~~');
        }
    });
}
/*check login form*/
function checkLogin(){
    var name = $('#name').val(), pwd = $('#pwd').val();
    if( name == '' || pwd == '' ){
        tip('每一项皆为必填项~~~');
    }else{
        $('#tip').fadeOut(0);
        $('#loading').fadeIn(100);
        var login = {'name':name,'pwd':pwd};
        $.post("./request/app-admin.php",{'login':login},function(msg){
            if( msg == 'success'){
                window.location.reload();
            }else if( msg == 'login_error' ){
                tip('用户名或密码错误~~~');
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
</script>

