<?php
include "../config.php";
include "../lib/functions.php";
if( !empty( $_POST['count'] ) ){ 
    $app_id = $_POST['count'];
    $count_arr = getData( COUNT_PATH, $app_id );
    if( empty( $count_arr ) ){ exit( 'count not exists' ); }
    $count_arr['count']++; //+1
    $ret = storeData( COUNT_PATH, $app_id, $count_arr );
    if( $ret == false ) exit('error');
    //返回信息
    exit( 'success' );
}else{
    exit('DENY ACCESS.');
}
