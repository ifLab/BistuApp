<script type="text/javascript">
/*count plus*/
function countPlus( id ){
     setTimeout(function () {
           $.post("./request/count-plus.php",{'count':id},function(msg){
                if( msg == 'success'){
                    //success
                }else{
                    //failed
                }
            });
     },2000);//avoid conflict GET
}
</script>
