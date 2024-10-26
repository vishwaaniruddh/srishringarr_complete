<? session_start();
include('config.php');

if($_COOKIE['yn_userid'] > 0 ){
$userid =     $_COOKIE['yn_userid'] ;
}else{
$userid = $_SESSION['gid'];
}

$subamt = $_POST['subtotalamt'];


if($subamt>0)
{
    $_SESSION['totalamt'] = $subamt;
}
else{


$address = $_POST['delivery'];
$_SESSION['address'] =$address ;

$total_amount_sql = mysqli_query($con,"select sum(total_amt) as total_amount from cart  where user_id='".$userid."' and ac_typ=2");
$total_amount_sql_result = mysqli_fetch_assoc($total_amount_sql);
$total_amount = $total_amount_sql_result['total_amount'];
$_SESSION['total_amount'] = $total_amount;

// $_SESSION['totalamt'] = $subamt;




}


$address = $_POST['delivery'];
$_SESSION['address'] =$address ;






?>

<script>
    window.location.href="checkout/pay.php"
</script>