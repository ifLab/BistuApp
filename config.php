<?php
/* *
 *Author: Hwei
 *Created Time: 2013-10-03
 *Description: BistuApp Config File
 *
 *
 * 开发者与应用关联文件名 developer e.g. array(1380942025=>'hwei@hwei.org');
 * 上架应用索引信息文件名 app e.g. array(1380942025=>'Android');
 * 新提交应用待审核列表文件名 submit-audit e.g. array(1380942025=>'Android');
 * 网站管理账户文件名 app-admin e.g. array('name'=>'','pwd'=>'');
 * 举报信息文件名 report e.g. array( array('app_id'=>'','report'=>'',user=>'',time=>'') );
 */

define( 'APP_PATH', dirname(__FILE__).'/' ); //网站根目录
define( 'IMAGE_PATH', 'file/image/' ); //图片文件夹
define( 'PACKAGE_PATH', 'file/package/' ); //安装包文件夹
define( 'DATA_PATH', 'file/data/' ); //数据文件夹
define( 'ITEM_PATH', 'file/data/item/' ); //应用详情数据文件夹
define( 'INDEX_PATH', 'file/data/index/' ); //应用索引数据文件夹
define( 'COUNT_PATH', 'file/data/count/' ); //应用计数器数据文件夹
define( 'DEVELOPER_PATH', 'file/data/developer/' ); //开发者信息文件夹
$category = array(
    'Android',
    'iOS'
);
$package_ext = array(
    'apk' => 'Android',
    'ipa' => 'iOS',
    'deb' => 'iOS',
    'pxl' => 'iOS'
);
