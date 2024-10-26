<?php
session_start();
include("config.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$user=$_SESSION['user'];

 
 $id= $_POST['id'];
 $log_amt=$_POST['log_amt'];
  $hand_amt=$_POST['hand_amt'];
   $spare_amt=$_POST['spare_amt'];
    $mobile_amt=$_POST['mobile_amt'];
     $room_amt=$_POST['room_amt'];
 
 $oth_amt=$_POST['oth_amt'];
 $Total=$_POST['Total'];
 
 $remarks=mysqli_real_escape_string($con1, $_POST['app_rem']);


$str="select * from engg_oth_expenses where id='".$id."' ";

//echo $str; die;

$qry=mysqli_query($con1,$str);
$row=mysqli_fetch_assoc($qry);


//echo "INSERT INTO `other_approved_expenses` (`claim_id`,`engg_id`, `branch_id`, `claim_date`, `log_amt`,`hand_amt`,`spare_amt`,`mobile_amt`,`room_amt`,`oth_amt`, `total`, `remarks`, `approved_by`) VALUES ('".$row['id']."', '".$row['engg_id']."','".$row['branch_id']."', '".$row['claim_date']."','".$log_amt."','".$hand_amt."','".$spare_amt."', '".$mobile_amt."', '".$room_amt."', '".$oth_amt."', '".$Total."','".$remarks."', '".$user."')";
//die;

$qry=mysqli_query($con1,"INSERT INTO `other_approved_expenses` (`claim_id`,`engg_id`, `branch_id`, `claim_date`, `log_amt`,`hand_amt`,`spare_amt`,`mobile_amt`,`room_amt`,`oth_amt`, `total`, `remarks`, `approved_by`) VALUES ('".$row['id']."', '".$row['engg_id']."','".$row['branch_id']."', '".$row['claim_date']."','".$log_amt."','".$hand_amt."','".$spare_amt."', '".$mobile_amt."', '".$room_amt."', '".$oth_amt."', '".$Total."','".$remarks."', '".$user."')");

if ($qry) {
$qr=mysqli_query($con1,"UPDATE engg_oth_expenses set status='2' where id='".$id."'");
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