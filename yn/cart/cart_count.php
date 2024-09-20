<? include($_SERVER['DOCUMENT_ROOT'].'/config.php');


$userid=$_POST['userid'];

// $userid=5095 ;
$sql = "select count(cart_id) as numrow from cart  where user_id='".$userid."' and status=0";
 

$table=mysql_query($sql,$con);
 
$table_result=mysql_fetch_assoc($table);
 
if($table_result){
    $cart_count = $table_result['numrow'];
} else {
    $cart_count = 0;
}
 
//  echo $cart_count;
 echo  $cart_count;
 
 
?>