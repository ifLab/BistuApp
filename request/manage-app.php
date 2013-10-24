<?php
session_start();
include "../config.php";
include "../lib/functions.php";
if( !empty( $_POST['login'] ) ){  //开发者登录
    $arr = array( 'pwd', 'email' ); //允许接收的参数
    $rows = array();
    foreach( $_POST['login'] as $k => $v ){
          if( in_array( $k, $arr ) ){
              $rows[$k] = trim($v);
          }
     }	
    $developer_info_arr = getData( DEVELOPER_PATH, $rows['email'] );
    if( empty( $developer_info_arr ) ) exit( 'email_error' );  //账号不存在
    $rows['pwd'] = enPwdByPwd( $rows['pwd'], $developer_info_arr['pwd'] );
    if( ( $rows['pwd'] == $developer_info_arr['pwd'] ) ){ //验证成功
        $_SESSION['developer-email'] = $rows['email'];
        exit( 'success' );
    }else{ //密码错误
        exit( 'pwd_error' );
    }
}elseif( !empty( $_POST['developer'] ) ){ //修改开发者信息
    $arr = array( 'pwd', 'phone' ); //允许接收的参数
    $rows = array();
    foreach( $_POST['developer'] as $k => $v ){
          if( in_array( $k, $arr ) ){
              $rows[$k] = trim($v);
          }
     }	
    //判断是否已登录
    if( empty( $_SESSION['developer-email'] ) ) exit( 'DENY ACCESS.' );
    //信息更新处理
    $email = $_SESSION['developer-email'];
    $developer_info_arr = getData( DEVELOPER_PATH, $email );
    if( $rows['pwd'] != '' ){
        $developer_info_arr['pwd'] = enPwd( $rows['pwd'] );
        $developer_info_arr['phone'] = $rows['phone'];
    }else{
        $developer_info_arr['phone'] = $rows['phone'];
    }
    $ret = storeData( DEVELOPER_PATH, $email, $developer_info_arr );
    if( $ret == false ) exit('error');
    //返回信息
    exit( 'success' );
}elseif( $_GET ){
    unset( $_SESSION['developer-email'] );
    header('Location:../index.php');
}else{
    exit('DENY ACCESS.');
}
