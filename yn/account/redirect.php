<?php include($_SERVER["DOCUMENT_ROOT"].'/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$id = $_GET['id'];
$_SESSION['gid'] = $id;

$gid=$_SESSION['gid'];


$sql = mysqli_query($con,"select * from customer_login where login_id = '".$id."' and site='YN'");
$sql_result = mysqli_fetch_assoc($sql);

$email = $sql_result['email'];
$passwd = $sql_result['password'];



mysqli_query($con,"BEGIN");
mysqli_autocommit($con, FALSE);


$qrylogin=mysqli_query($con,"select * from customer_login where email='".$email."' and password='".$passwd."' and site='YN'");


$fetch1=mysqli_num_rows($qrylogin);


$fetch=mysqli_fetch_array($qrylogin);

$sql=mysqli_query($con,"select * from Registration where email='".$email."' and site='YN'");
$sql_result=mysqli_fetch_assoc($sql);



$_SESSION['fname']=$sql_result['Firstname'];
$_SESSION['lname']=$sql_result['Lastname'];
$_SESSION['mobile']=$sql_result['Mobile'];
$_SESSION['email'] = $sql_result['email'];




// $qryqty=mysqli_query($con,"select bill_id from cart where user_id='".$gid."' and ac_typ=2 and status=0");
// $fetchqty1=mysqli_num_rows($qryqty);


// if($fetchqty1 > 0)
// {

// while($ftcr2=mysqli_fetch_array($qryqty))
// {
    
//     if($ftcr2[0]>0)
//     {
        
//         $t1=mysqli_query($con3,"update `phppos_rent` set cust_id='".$fetch[0]."' where bill_id='".$ftcr2[0]."'");
        
//         $t2=mysqli_query($con3,"update `rent_amount` set cust_id='".$fetch[0]."' where bill_id='".$ftcr2[0]."'");
//     }
// }

// }

// $t4=mysqli_query($con,"update `cart` set user_id='".$fetch[0]."' where user_id='".$gid."'");
// /*Ruchi*/
// $cartUpdate=mysqli_query($con,"update `add_in_cart` set user_id='".$fetch[0]."' where user_id='".$gid."'");
// $cartItemUpdate=mysqli_query($con,"update `cart_items` set user_id='".$fetch[0]."' where user_id='".$gid."'");
// $_SESSION['gid']= $fetch[0]; 

// $_SESSION['loginstats']=1;
// $_SESSION['email']=$email;

mysqli_query($con,"COMMIT");
mysqli_commit($con);


?>
<script>
window.open(<? $_SERVER["DOCUMENT_ROOT"]; ?>'/account/orders.php','_self')
</script>
