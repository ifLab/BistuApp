</div><!-- /.container -->
<div id="footer">
    <div class="container">
        <p>&copy; <?=date('Y')?> <a style="color:#444444;" href="http://www.bistu.edu.cn/">北京信息科技大学</a>&nbsp;&nbsp;<a style="color:#444444;" href="http://iflab.org">网络实践创新联盟</a>&nbsp;&nbsp;<a style="color:#444444;" href="./app-admin.php">网站管理</a>&nbsp;&nbsp;<a href="./submit-app.php?nav=submit-app">提交应用</a>&nbsp;&nbsp;<a href="./manage-app.php">管理应用</a></p>
    </div>
</div>
<script src="./public/js/jquery-1.8.3.min.js"></script>
<script src="./public/js/bootstrap.js"></script>
<script src="./public/js/holder.js"></script>
<?php 
if( $nav_hover == 'submit-app' ){ 
    include "./tpl/submit-app.php"; 
}elseif( $nav_hover == 'app-admin' ){
    include "./tpl/app-admin.php"; 
}elseif( $nav_hover == 'manage-app' ){
    include "./tpl/manage-app.php"; 
}elseif( $nav_hover == 'edit-app' ){
    include "./tpl/edit-app.php"; 
}elseif( $nav_hover == 'item' ){
    include "./tpl/item.php"; 
}elseif( $nav_hover == 'index' ){
    include "./tpl/index.php"; 
}
?>
</body>
</html>
