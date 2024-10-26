<? include('config.php');


$po = $_POST['po'];

$sql = mysqli_query($con1,"select * from purchase_order where po_no='".$po."'");

if($sql_result = mysqli_fetch_assoc($sql)){
    
    echo '1';
}
else{

echo '0';    
}



?>