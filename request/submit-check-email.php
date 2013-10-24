<?php
include "../config.php";
include "../lib/functions.php";
if( !empty( $_POST['email'] ) ){
    $email = trim( $_POST['email'] );
    $developer_arr = getData( DATA_PATH, 'developer' );
    if( !in_array( $email, $developer_arr ) ){ //新开发账号
        exit('new'); 
    }else{
        exit('old');
    }
}else{
    exit('DENY ACCESS.');
}
