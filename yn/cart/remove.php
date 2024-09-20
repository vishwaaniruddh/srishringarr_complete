<? include('../config.php');

$id = $_REQUEST['id'];

$sql = "delete from cart where cart_id ='".$id."'"; 
if(mysqli_query($con,$sql)){
    echo 1;
}else{
    echo 0;
}

?>