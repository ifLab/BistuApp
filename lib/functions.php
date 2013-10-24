<?php
function getNavHover(){
    $nav_hover = isset($_GET['category'])?strval(trim($_GET['category'])):null;
    if( !$nav_hover ){
       $nav_hover = isset($_GET['nav'])?strval(trim($_GET['nav'])):null;
    }
    return $nav_hover;
}

/**
 *储存数据 失败返回false 成功返回写入的字节数
 *$data array
 */
function storeData( $folder, $filename, $data ){
    $folder = APP_PATH.$folder;
    if( !is_dir($folder) )__mkdirs( $folder );
    $sfile = $folder.md5($filename).".php";
    $data = '<?php die();?>'.serialize($data); // 数据被序列化后保存
    return file_put_contents( $sfile, $data );
}
/**
 *获取数据 如果没有获取到数据，则返回空数组
 */
function getData( $folder, $filename ){
    $folder = APP_PATH.$folder;
    $sfile = $folder.md5($filename).".php";
    // 读数据，检查文件是否可读，同时将去除数据前部的内容以返回
    if( !is_readable($sfile) )return array();
    $data = file_get_contents($sfile);
    return unserialize( substr( $data, 14 ) ); // 数据反序列化后返回
}
/**
 *截取指定长度字符,并剥去标签
 */
function getSubStr( $content, $length ){
    $content = trim( strip_tags( $content ) ); //去除HTML及PHP标签
    if( mb_strlen( $content, 'utf-8' ) > $length ){
        $content = mb_substr( $content,0,$length,'utf-8' ).'...';  //截取指定长度字符并加省略号
    }
    return $content;
}
/**
 *取盐加密处理
 */
function enPwdByPwd( $pwd, $old_pwd ){
    $salt = substr($old_pwd,0,8); //取出密码盐 
    $pwd = $salt . md5($salt . $pwd);  //加盐
    return $pwd;
}
/**
 *密码加盐加密处理
 */
function enPwd( $pwd ){
    //密码加盐加密处理
    $code = md5(rand(99,999));  //产生随机验证码
    $salt = substr($code,0,8);  //创建随机盐
    $pwd = $salt . md5( $salt . $pwd );  //密码加盐
    return $pwd;
}
/**
 * * __mkdirs
 * **
 * ** 循环建立目录的辅助函数
 * **
 * ** @param dir    目录路径
 * ** @param mode    文件权限
 * **/
function __mkdirs($dir, $mode = 0777) {
    if ( !is_dir($dir) ) {
        __mkdirs( dirname($dir), $mode );
        return @mkdir( $dir, $mode );
    }
    return true;
}
/**
 *删除应用信息 无返回信息
 */
function deleteApp( $filename ){
    $arr = array( ITEM_PATH, INDEX_PATH, COUNT_PATH );
    foreach( $arr as $v ){
        $sfile = APP_PATH.$v.md5($filename).".php";
        unlink( $sfile );
    }
    return true;
}
/*
 *msgToHwei
 */
function msgToHwei( $msg, $from ){
    $cn=curl_init();
    curl_setopt($cn,CURLOPT_URL,"http://hi.hwei.org/?msg=".$msg."&from=".$from);
    curl_setopt($cn,CURLOPT_RETURNTRANSFER,1);
    $ret = curl_exec($cn);
    curl_close($cn);
    return $ret;
}
