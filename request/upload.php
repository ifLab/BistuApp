<?php
include "../config.php";
//Ajax循环接收uploadify并处理
if ( !empty($_FILES) && !empty($_GET['package']) ){
        $path_arr = pathinfo($_FILES['Filedata']['name']);
        $ext = strtolower($path_arr['extension']);
        $temp_file = $_FILES['Filedata']['tmp_name'];
        $target_path   = APP_PATH.PACKAGE_PATH.time().'/';
        if( !is_dir($target_path) ){            //如果（时间）文件夹不存在，则创建
            mkdir($target_path,0777,true);      //默认的 mode 是 0777，意味着最大可能的访问权
        }
        $new_file_name = $path_arr['basename'];
        $target_file = $target_path.$new_file_name;           //安装包绝对路径
        move_uploaded_file($temp_file,$target_file);

        if( !file_exists( $target_file ) ){   //上传失败
            $ret['result'] = 'upload failure';
        } else {
            $filesize = $_FILES['Filedata']['size'];  //返回文件大小
            if( $filesize > 1048576 ){
               $ret['filesize'] = round( $filesize/1048576, 1 ).'MB'; 
            }else{
               $ret['filesize'] = round( $filesize/1024, 1 ).'KB'; 
            }
            $ret['result'] = 'success';
            $ret['filename'] = $new_file_name;
            $ret['category'] = $package_ext[$ext];
            $ret['link'] = str_replace( APP_PATH, '', $target_file );  //返回相对路径
        }
        exit( json_encode( $ret ) );
}elseif( !empty($_FILES) ){
        $path_arr = pathinfo($_FILES['Filedata']['name']);
        $ext = strtolower($path_arr['extension']);
        $temp_file = $_FILES['Filedata']['tmp_name'];
        $target_path   = APP_PATH.IMAGE_PATH.date('Ym').'/';
        if( !is_dir($target_path) ){            //如果（年月）文件夹不存在，则创建
            mkdir($target_path,0777,true);      //默认的 mode 是 0777，意味着最大可能的访问权
        }
        $new_file_name = date('dHis').rand(1000, 9999).'.'.$ext;
        $target_file = $target_path.$new_file_name;           //图片绝对路径
        move_uploaded_file($temp_file,$target_file);

        if( !file_exists( $target_file ) ){   //原始图片上传失败
            $ret['result'] = 'upload failure';
        } else {
            $ret['result'] = 'success';
            $ret['img'] = IMAGE_PATH.date('Ym').'/'.$new_file_name;  //返回图片相对路径
        }
        exit( json_encode( $ret ) );
}

//接收删除图片请求
if( !empty($_POST['del_img']) ){    
        $del_img = APP_PATH.$_POST['del_img']; //转为绝对路径
        $result = unlink( $del_img );       
        if( $result == true ){
            $ret = 'success';
        }else{
            $ret = 'failed';
        }       
        exit( $ret );
}
