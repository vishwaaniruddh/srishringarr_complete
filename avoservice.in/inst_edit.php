<? include('config.php');
session_start();

$user=$_SESSION['user'];
$soid= $_POST['id'];


$sql = "update new_sales_order set inst_request=1  where so_trackid='".$soid."'";

if(mysqli_query($con1,$sql)){
    echo '1';
    // echo $sql;

    $update_sales = mysqli_query($con1,"update so_order set status='1' where po_id='".$soid."'");
}

else{
    echo '2';
}


?>