<?php
session_start();
include("config.php");


 $id= $_POST['id'];


 $pcall=$_POST['pcall'];

 
 if(isset($_POST['port_km']) && $_POST['port_km'] ==''){
  $port_km = 0;   
 } else {
 $port_km=$_POST['port_km'];}

 $app_amt=$_POST['app_amt'];
 $remarks=$_POST['app_rem'];
$user=$_SESSION['user'];

$str.="select * from daily_expenses where id='".$id."' ";

//echo $str;
$qry=mysqli_query($con1,$str);
$row=mysqli_fetch_assoc($qry);

$qry=mysqli_query($con1,"INSERT INTO `approved_expenses` (`claim_id`,`engg_id`, `branch_id`, `claim_date`, `portal_calls`,`app_amt`,`portal_dis`,`app_remarks`,`status`, `approved_by`) VALUES ('".$row['id']."', '".$row['engg_id']."','".$row['branch_id']."', '".$row['date']."','".$pcall."','".$app_amt."','".$port_km."','".$remarks."', '1', '".$user."')");

if ($qry) {
$qr=mysqli_query($con1,"UPDATE daily_expenses set status='2' where id='".$id."'");
}

 
else { ?>
    
    <script type="text/javascript">
alert("Something went wrong !!");

		window.close(); </script> 
<?
 }

if($qry)  { ?>
    <script type="text/javascript">
alert("Your Approval is Successfully updated!!");

		window.close(); </script> 
<?
	
}
 
?>