<? include('config.php');

$atm = $_POST['atm'];

$sql = mysqli_query($con1,"select * from atm where atm_id='".$atm."'");

$sql_result=mysqli_fetch_assoc($sql);

//==================

if($sql_result){
$consignee = $sql_result['bank_name'];
$city = $sql_result['city'];
$area = $sql_result['area'];
$address = $sql_result['address'];
$branch = $sql_result['branch_id'];
$state = $sql_result['state1'] or $sql_result['state'];
//$state = $sql_result['state'];
$pincode = $sql_result['pincode'];
$atm_id = $sql_result['atm_id'];
$cust_id = $sql_result['cust_id']; 
$state_sql= mysqli_query($con1,"select * from state where state ='".$state."'");
$state_sql_result = mysqli_fetch_assoc($state_sql);
$state_id = $state_sql_result['state_id'];

$cust_sql= mysqli_query($con1,"select cust_name from customer where cust_id ='".$cust_id."'");
$cust_sql_result = mysqli_fetch_assoc($cust_sql);
$custname = $cust_sql_result['cust_name'];

$data=['consignee'=>$consignee,'city'=>$city,'area'=>$area,'address'=>$address,'branch'=>$branch,'state'=>$state_id,'pincode'=>$pincode,'getsite_id'=>$atm_id,'custname'=>$custname];

echo json_encode($data);    
}
else{
    echo 0;
}



?>