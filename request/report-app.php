<?php
include "../config.php";
include "../lib/functions.php";
if( !empty( $_POST['report'] ) ){ 
    $arr = array( 'app_id', 'report', 'user' ); //允许接收的参数
    $rows = array();
    foreach( $_POST['report'] as $k => $v ){
          if( in_array( $k, $arr ) ){
              $rows[$k] = trim($v);
          }
     }	
    $report_arr = getData( DATA_PATH, 'report' );
    $rows['time'] = date( 'Y-m-d H:i:s' );
    $report_arr[] = $rows;
    $ret = storeData( DATA_PATH, 'report', $report_arr );
    if( $ret == false ) exit('error');
    //返回信息
    exit( 'success' );
}else{
    exit('DENY ACCESS.');
}
