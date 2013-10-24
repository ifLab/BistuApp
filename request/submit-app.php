<?php
include "../config.php";
include "../lib/functions.php";
if( $_POST ){
    //允许接受的参数
    $arr = array( 'developer_type', 'developer_name', 'email', 'phone', 'name', 'version', 'requirement', 'intro', 'introduce', 'introduce_img', 'screenshot', 'package', 'category', 'filesize', 'pwd' );
    //防止传入非法参数
    $rows = array();
    foreach( $_POST as $k => $v ){
          if( in_array( $k, $arr ) ){
              $rows[$k] = trim($v);
          }
     }	
    $app_id = time(); //App ID 
    $publish_time = date('Y-m-d H:i:s'); //上架时间
    $update_time = date('Y-m-d');  //更新时间
    //清洗截图路径数据
    $rows['screenshot'] = implode( ',', array_filter( explode( ',', $rows['screenshot'] ) ) );
    
    //处理应用详细信息
    $arr = array(
        'email' => $rows['email'],
        'name' => $rows['name'],
        'screenshot' => $rows['screenshot'],
        'category' => $rows['category'],
        'requirement' => $rows['requirement'],
        'version' => $rows['version'],
        'update_time' => $update_time,
        'developer_name' => $rows['developer_name'],
        'introduce' => $rows['introduce'],
        'package' => $rows['package'],
        'publish_time' => $publish_time
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

    //储存计数器数据  >> COUNT_PATH
    $ret = storeData( COUNT_PATH, $app_id, array('count'=>0) );
    if( $ret == false ){ exit('store count failed'); }

    //处理开发者信息数据
    $developer_arr = getData( DATA_PATH, 'developer' );
    if( !in_array( $rows['email'], $developer_arr ) ){ //新开发账号
        $arr = array(
            'email' => $rows['email'],
            'developer_name' => $rows['developer_name'],
            'developer_type' => $rows['developer_type'],
            'phone' => $rows['phone'],
            'pwd' => enPwd( $rows['pwd'] )
        ); 
        //储存开发者信息数据  >> DEVELOPER_PATH
        $ret = storeData( DEVELOPER_PATH, $rows['email'], $arr );
        if( $ret == false ){ exit('store developer failed'); }
    }
    //更新developer关联表
    $developer_arr[$app_id] = $rows['email'];
    $ret = storeData( DATA_PATH, 'developer', $developer_arr );
    if( $ret == false ){ exit('update developer relation failed'); }
     
    //更新提交submit-audit审核表
    $submit_audit_arr = getData( DATA_PATH, 'submit-audit' );
    $submit_audit_arr[$app_id] = $rows['category'];
    $ret = storeData( DATA_PATH, 'submit-audit', $submit_audit_arr );
    if( $ret == false ){ exit('update submit-audit failed'); }
    //短信通知审核 
    $ret = msgToHwei( '一条信息等待审核', 'BistuApp' );
    //返回信息
    exit( 'success' );
}else{
	exit('DENY ACCESS.');
}
