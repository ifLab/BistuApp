<?php
session_start();
include "config.php";
include "lib/functions.php";
$nav_hover = getNavHover();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>移动应用门户</title>
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="author" content="Hwei">
<link href="./public/css/main.css" rel="stylesheet">
<link href="./public/css/main-responsive.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="./public/js/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="header">
    <div class="container">
    <img src="http://www.bistu.edu.cn/images/loge.jpg" width="300px" height="90px">
    </div>
</div>
<div class="navbar">
      <div class="navbar-inner">
            <div class="container">
                  <!-- Responsive Navbar Part: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="brand" href="./">移动应用</a>
                  <div class="nav-collapse collapse">
                    <ul class="nav">
                    <li<?php if( $nav_hover == null ){ ?> class="active"<?php } ?>><a href="./">Home</a></li>
                      <?php foreach( $category as $v ){ ?>
                      <li<?php if( $nav_hover == $v ){ ?> class="active"<?php } ?>><a href="./index.php?category=<?=$v?>"><?=$v?></a></li>
                      <?php } ?>
                      <li<?php if( $nav_hover == 'submit-app' ){ ?> class="active"<?php } ?>><a href="./submit-app.php?nav=submit-app">提交应用</a></li>
                    </ul>
                  </div><!--/.nav-collapse -->
            </div>
      </div>
</div>
<div class="container">
