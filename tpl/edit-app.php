<?php
    $package_ext_arr = array();
    foreach( $package_ext as $k => $v ){
       $package_ext_arr[] = '*.'.$k; 
    }
    $package_ext_str = implode( ';', $package_ext_arr );
?>
<script charset="utf-8" src="public/editor/kindeditor.js"></script>
<script charset="utf-8" src="public/editor/lang/zh_CN.js"></script>
<link href="public/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="public/uploadify/jquery.uploadify-3.1.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K) {
     window.editor = K.create('#introduce');
});
$(function() {
    $("#imgUpload").uploadify({
            'auto'              : true,
            'multi'             : false, //Default Value true
            'uploadLimit'       : 3,
            'buttonText'        : '请选择图片',
            'height'            : 20,
            'width'             : 120,
            'removeCompleted'   : true,  //Default Value true
            'swf'               : 'public/uploadify/uploadify.swf',
            'uploader'          : './request/upload.php',
            'fileTypeExts'      : '*.jpg; *.jpeg; *.png;',//*.gif;
            'fileSizeLimit'     : '1024KB',
            'onUploadSuccess'   : function(file, data, response) {
                var msg = $.parseJSON(data);
                if( msg.result == 'success' ){
                    $("#introduce_img").val( msg.img );
                    $("#introduce_img_preview").attr("src",msg.img).fadeIn(0);
                }else{
                    tip('遇到未知错误,请选择图片重新上传~~~');
                }
            },
            'onCancel' : function(file) {
                    tip('Hey，图片（' + file.name + '）已被删除。');
            }
    });
    $("#screenshotUpload").uploadify({
            'auto'              : true,
            'multi'             : true, //Default Value true
            'uploadLimit'       : 10,
            'buttonText'        : '请选择图片（支持多选）',
            'height'            : 20,
            'width'             : 180,
            'removeCompleted'   : true,  //Default Value true
            'swf'               : 'public/uploadify/uploadify.swf',
            'uploader'          : './request/upload.php',
            'fileTypeExts'      : '*.jpg; *.jpeg; *.png;',//*.gif;
            'fileSizeLimit'     : '2048KB',
            'onUploadSuccess'   : function(file, data, response) {
                var msg = $.parseJSON(data);
                if( msg.result == 'success' ){
                    $("#thumblist").show(1000);
                    $(".del-tip").show(1000);
                    var list = '<li id="'+msg.img+'"><a href="javascript:void(0)" title="用力双击将删除该图片"><img ondblclick=deleteImg("'+msg.img+'") src="'+msg.img+'"/></a></li>';
                    $("#thumblist").append(list);
                    var screenshot = $('#screenshot').val();   //将相对路径存入#screenshot
                    if( screenshot == '' ){
                        $('#screenshot').val(msg.img);
                    }else{
                        var new_screenshot = screenshot+","+msg.img;
                        $('#screenshot').val(new_screenshot);
                    }
                }else{
                    tip('遇到未知错误,请选择图片重新上传~~~');
                }
            },
            'onCancel' : function(file) {
                    tip('Hey，图片（' + file.name + '）已被删除。');
            }
    });
 /*   $("#packageUpload").uploadify({
            'auto'              : true,
            'multi'             : false, //Default Value true
            'uploadLimit'       : 3,
            'buttonText'        : '请选择文件',
            'height'            : 20,
            'width'             : 120,
            'removeCompleted'   : true,  //Default Value true
            'swf'               : 'public/uploadify/uploadify.swf',
            'uploader'          : './request/upload.php?package=1',
            'fileTypeExts'      : '<?=$package_ext_str?>',
            'fileSizeLimit'     : '20480KB', //20MB
            'onUploadSuccess'   : function(file, data, response) {
                var msg = $.parseJSON(data);
                if( msg.result == 'success' ){
                    $("#package").val( msg.link );
                    $("#category").val( msg.category );
                    $("#filesize").val( msg.filesize );
                    $("#package_preview").text(msg.filename).fadeIn(0);
                    $("#package_preview").attr("href",msg.link);
                }else{
                    tip('遇到未知错误,请选择文件重新上传~~~');
                }
            },
            'onCancel' : function(file) {
                    tip('Hey，文件（' + file.name + '）已被删除。');
            }
    });*/
});
/*delete screenshot*/
function deleteImg( del_img ){
    $.post("./request/upload.php",{'del_img':del_img},function(msg){
        if( msg == 'success'){
            document.getElementById(del_img).style.display = 'none'; //隐藏图片
            var screenshot = document.getElementById('screenshot').value;  //修改#screenshot的value
            var new_screenshot = screenshot.replace(del_img,'');
            document.getElementById('screenshot').value = new_screenshot;
        }else{
            alert("未知原因，删除失败。可能服务器上已经丢失该文件！");
        }
    });
}
/*submit check*/
function submitApp(){
    window.editor.sync();
    var developer_name = $('#developer_name').val(), name = $('#name').val(), version = $('#version').val(), requirement = $('#requirement').val(), intro = $('#intro').val(), introduce = $('#introduce').val(), introduce_img = $('#introduce_img').val(), screenshot = $('#screenshot').val(), my_package = $('#package').val(); //Note：package(保留字) 
    var regex_email = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/; 
    if( developer_name == '' ){
        tip('开发者名称不能为空~~~');
    }else if( ( name.length > 16 ) || ( name.length < 2 ) ){
        tip('应用名称长度不符合要求~~~');
    }else if( version == '' ){
        tip('应用版本不能为空~~~');
    }else if( requirement == '' ){
        tip('系统需求不能为空~~~');
    }else if( ( intro.length < 1 ) || ( intro.length > 30 ) ){
        tip('应用简介长度不符合要求~~~');
    }else if( introduce.length < 50 ){
        tip('应用介绍长度不符合要求~~~');
    }else if( my_package == '' ){
        tip('应用安装包链接不能为空~~~');
    }else if( introduce_img == '' ){
        tip('请上传一张应用简图~~~');
    }else if( screenshot == '' ){
        tip('请至少上传一张应用截图~~~');
    }else{
        $('#tip').fadeOut(0);
        $('#loading').fadeIn(100);
        $.post("./request/edit-app.php",$('#submitForm').serialize(),function(msg){
            if( msg == 'success'){
                alert( '信息修改成功' );
                window.location.href = './manage-app.php?nav=manage-app';
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
