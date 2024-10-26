<?php
session_start();
include("config.php");
$poid=$_POST['po_id'];
$typ=$_POST['typ'];

//echo $typ;
$var_update=$_POST['reason'];
$user=$_SESSION['user'];
//echo $user;

$error='0';

$srchqr=mysqli_query($con1,"select * from new_sales_order where so_trackid='".$poid."'");
$pon=mysqli_fetch_array($srchqr);

$email=$pon[10];


$nm="select bank_name,atm_id,cust_id,area,city,address,state,pincode,branch_id from demo_atm where so_id='".$pon[0]."'";

	    $atm=mysqli_query($con1,$nm);
$atmdets=mysqli_fetch_array($atm);

$message="<html>";
$message=$message."<table border=1><th>PO/Delivery Order</th><th>SO Date</th><th>Consignee Name</th><th>Address</th><th>Site/Sol Id</th><th>State</th>";
$message=$message."<tr><td>".$pon[2]."</td><td>".$pon[14]."</td><td>".$atmdets[0]."</td><td>".$atmdets[5]."</td><td>".$atmdets[1]."</td><td>".$atmdets[6]."</td>";
$message=$message."</tr></table></br></br>";
$message=$message."<table border=1> <tr><td>New Update on above PO: </td>";
$message=$message."<b>".$var_update."</b>";
$message=$message."</tr></table>";
$message=$message."</html>";


$qryinsert=mysqli_query($con1,"insert into SO_Update(so_id,date,Remarks_update,remarks_type, update_by, po_id) values ('".$poid."','".date('Y-m-d H:i:s')."','".$var_update."','".$typ."', '".$user."', '0')");

//echo "insert into SO_Update(po_id,date,Remarks_update,remarks_type) values ('".$poid."','".date('Y-m-d H:i:s')."','".$var_update."','".$typ."')";


if(!$qryinsert)
{
//$error++;

}
if($error==0)
{

if($email!="")
{
$subject="SO UPDATE-".$atmdets[1];
$headers = "From: <Accounts@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		mail($email, $subject, $message, $headers);

}



?>
<script type="text/javascript">
alert("Data Updated !!");

		window.close(); </script>
<?php }
else
{
?>
<script type="text/javascript">
alert("error!!");

		window.close(); </script>
		
<?php
}

?>



