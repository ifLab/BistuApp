<?php
session_start();
include "../config.php";
include "../lib/functions.php";
if( !empty( $_POST['login'] ) ){
    $login = $_POST['login'];
    $app_admin_arr = getData( DATA_PATH, 'app-admin' );
    $salt = substr($app_admin_arr['pwd'],0,8); //取出密码盐 
    $login['pwd'] = $salt . md5($salt . $login['pwd']);  //加盐
    if( ( $login['name'] == $app_admin_arr['name'] ) && ( $login['pwd'] == $app_admin_arr['pwd'] ) ){ //验证成功
        $_SESSION['app-admin'] = 'This Is A Secret.';
        exit( 'success' );
    }else{ //用户名或密码错误
        exit( 'login_error' );
    }
}elseif( !empty( $_POST['pass'] ) ){
    $id = $_POST['pass'];
    $submit_audit_arr = getData( DATA_PATH, 'submit-audit' );
    if( !isset($submit_audit_arr[$id]) ) exit('error');
    $app_arr = getData( DATA_PATH, 'app' );
    if( isset($app_arr[$id]) ) exit('error');
    $app_arr[$id] = $submit_audit_arr[$id];
    $ret = storeData( DATA_PATH, 'app', $app_arr );
    if( $ret == false ) exit('error');
    unset( $submit_audit_arr[$id] );
    $ret = storeData( DATA_PATH, 'submit-audit', $submit_audit_arr );
    if( $ret == false ) exit('error');
    //返回信息
    exit( 'success' );
}elseif( !empty( $_POST['delete'] ) ){
    $id = $_POST['delete'];
    //删除developer关联信息
    $developer_arr = getData( DATA_PATH, 'developer' );
    if( !isset($developer_arr[$id]) ) exit('error');
    unset( $developer_arr[$id] );
    $ret = storeData( DATA_PATH, 'developer', $developer_arr );
    if( $ret == false ) exit('error');
    //删除sunmit-audit关联信息
    $submit_audit_arr = getData( DATA_PATH, 'submit-audit' );
    if( !isset($submit_audit_arr[$id]) ) exit('error');
    unset( $submit_audit_arr[$id] );
    $ret = storeData( DATA_PATH, 'submit-audit', $submit_audit_arr );
    if( $ret == false ) exit('error');
    $ret = deleteApp( $id ); //彻底删除应用信息
    //返回信息
    exit( 'success' );
}elseif( !empty( $_POST['down'] ) ){
    $id = $_POST['down'];
    $app_arr = getData( DATA_PATH, 'app' );
    if( !isset($app_arr[$id]) ) exit('error');
    $submit_audit_arr = getData( DATA_PATH, 'submit-audit' );
    if( isset($submit_audit_arr[$id]) ) exit('error');
    $submit_audit_arr[$id] = $app_arr[$id];
    $ret = storeData( DATA_PATH, 'submit-audit', $submit_audit_arr );
    if( $ret == false ) exit('error');
    unset( $app_arr[$id] );
    $ret = storeData( DATA_PATH, 'app', $app_arr );
    if( $ret == false ) exit('error');
    //返回信息
    exit( 'success' );
}elseif( $_GET ){
    unset( $_SESSION['app-admin'] );
    header('Location:../index.php');
}else{
    exit('DENY ACCESS.');
}
