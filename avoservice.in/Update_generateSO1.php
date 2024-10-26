<?php
include("config.php");
$poid=$_POST['po_id'];
$typ=$_POST['typ'];
//=========== poid = So_ID=====
//echo $typ;
$var_update=$_POST['reason'];
$user=$_SESSION['user'];

$error='0';

$srchqr=mysqli_query($con1,"select user_mail,DO_no, do_date,po_trackid from new_sales_order where so_trackid='".$poid."'");
$pon=mysqli_fetch_row($srchqr);
$email=$pon[0];
$purchase_id =$pon[3];

//echo $pon[3];

$nm="select bank_name,atm_id, area,city,address,state,pincode from demo_atm where so_id='".$poid."'";

$atm=mysqli_query($con1,$nm);
$atmdets=mysqli_fetch_array($atm);
//=============e-mail============
$message="<html>";
$message=$message."<table border=1><th>PO/DO No.</th><th>SO Date</th><th>Consignee Name</th><th>Address</th><th>Site/Sol ID</th>";
$message=$message."<tr><td>".$pon[1]."</td><td>".$pon[2]."</td><td>".$atmdets[0]."</td><td>".$atmdets[4]."</td><td>".$atmdets[1]."</td>";
$message=$message."<tr></table></br></br>";
$message=$message."Update-<b>".$var_update."</b>";
 
$message=$message."</html>";


$qryinsert=mysqli_query($con1,"insert into SO_Update(po_id,date,Remarks_update,remarks_type,so_id,update_by ) values ('".$purchase_id."','".date('Y-m-d H:i:s')."','".$var_update."','".$typ."','".$poid."','".$user."')");


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



