<script type="text/javascript">
/*edit developer form*/
function editDeveloper(){
    var email = $('#email').val(), pwd = $('#pwd').val(), phone = $('#phone').val();
    $('#tip').fadeOut(0);
    $('#loading').fadeIn(100);
    var developer = {'email':email,'pwd':pwd,'phone':phone};
    $.post("./request/manage-app.php",{'developer':developer},function(msg){
        if( msg == 'success'){
            tip('信息修改成功~~~');
        }else{
            tip('遇到未知错误,请重试~~~');
        }
    });
}
/*check login form*/
function checkLogin(){
    var email = $('#email').val(), pwd = $('#pwd').val();
    var regex_email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/; 
    if( email == '' || pwd == '' ){
        tip('每一项皆为必填项~~~');
    }else if( !regex_email.test(email) ){
        tip('请输入有效的开发者账号(E-mail)~~~');
    }else{
        $('#tip').fadeOut(0);
        $('#loading').fadeIn(100);
        var login = {'email':email,'pwd':pwd};
        $.post("./request/manage-app.php",{'login':login},function(msg){
            if( msg == 'success'){
                window.location.reload();
            }else if( msg == 'email_error' ){
                tip('账号不存在~~~');
            }else if( msg == 'pwd_error' ){
                tip('密码错误~~~');
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

