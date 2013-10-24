<?php
session_start();
include "../config.php";
include "../lib/functions.php";
if( $_POST && !empty($_SESSION['developer-email']) ){
    //允许接受的参数
    $arr = array( 'app_id', 'developer_name', 'name', 'version', 'requirement', 'intro', 'introduce', 'introduce_img', 'screenshot', 'package', 'category', 'filesize' );
    //防止传入非法参数
    $rows = array();
    foreach( $_POST as $k => $v ){
          if( in_array( $k, $arr ) ){
              $rows[$k] = trim($v);
          }
     }	
    $app_id = $rows['app_id']; //App ID 
    $update_time = date('Y-m-d');  //更新时间
    //清洗截图路径数据
    $rows['screenshot'] = implode( ',', array_filter( explode( ',', $rows['screenshot'] ) ) );
    
    $app_item_info_arr = getData( ITEM_PATH, $app_id );
    //处理应用详细信息
    $arr = array(
        'email' => $app_item_info_arr['email'],
        'name' => $rows['name'],
        'screenshot' => $rows['screenshot'],
        'category' => $rows['category'],
        'requirement' => $rows['requirement'],
        'version' => $rows['version'],
        'update_time' => $update_time,
        'developer_name' => $rows['developer_name'],
        'introduce' => $rows['introduce'],
        'package' => $rows['package'],
        'publish_time' => $app_item_info_arr['publish_time']
    );
    //储存应用详情信息 >> ITEM_PATH
    $ret = storeData( ITEM_PATH, $app_id, $arr );
    if( $ret == false ){ exit('store item failed'); }

    //处理索引数据信息
    $arr = array(
        'name' => $rows['name'],
        'introduce_img' => $rows['introduce_img'],
        'intro' => $rows['intro'],
        'package' => $rows['package'] 
    );
    //储存索引数据信息 >> INDEX_PATH
    $ret = storeData( INDEX_PATH, $app_id, $arr );
    if( $ret == false ){ exit('store index failed'); }
    //返回信息
    exit( 'success' );
}else{
	exit('DENY ACCESS.');
}
