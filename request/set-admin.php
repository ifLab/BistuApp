<?php
/*
 *设置管理员账户名和密码
 */
include "../config.php";
include "../lib/functions.php";
$arr = array( 'name'=> 'secret', 'pwd'=> 'secret' );
$arr['pwd'] = enPwd( $arr['pwd'] );
$ret = storeData( DATA_PATH, 'app-admin', $arr );
echo $ret;
