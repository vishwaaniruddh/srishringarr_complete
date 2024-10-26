<?php
include("config.php");
 
 $id=$_POST['id'];
 
 
 $log_rem=mysqli_real_escape_string($con1,$_POST['log_rem']);
 $log_exp=$_POST['log_exp'];
 
 $hand_rem=mysqli_real_escape_string($con1,$_POST['hand_rem']);
 $hand_exp=$_POST['hand_exp'];
 
 $spare_rem=mysqli_real_escape_string($con1,$_POST['spare_rem']);
 $spare_exp=$_POST['spare_exp'];
 
 $mobile_rem=mysqli_real_escape_string($con1,$_POST['mobile_rem']);
 $mobile_exp=$_POST['mobile_exp'];
 
 $room_rem=mysqli_real_escape_string($con1,$_POST['room_rem']);
 $room_exp=$_POST['room_exp'];
 
 $oth_rem=mysqli_real_escape_string($con1,$_POST['oth_rem']);
 $oth_exp=$_POST['oth_exp'];
 
$total=array( $log_exp,$hand_exp,$spare_exp,$mobile_exp,$room_exp,$oth_exp);
$exp =array_sum($total); 

//echo "UPDATE `engg_oth_expenses` set `log_rem` = '".$log_rem."', `log_exp`='".$log_exp."', `hand_rem`= '".$hand_rem."',`hand_exp`='".$hand_exp."',`spare_rem`='".$spare_rem."',`spare_exp`='".$spare_exp."',`mobile_rem`='".$mobile_rem."',`mobile_exp`='".$mobile_exp."',`room_rem`='".$room_rem."',`room_exp`='".$room_exp."', `oth_rem`='".$room_exp."', `oth_exp`='".$room_exp."', total_exp='".$exp."' where id='".$id."'";

//die;

$qry=mysqli_query($con1,"UPDATE `engg_oth_expenses` set `log_rem` = '".$log_rem."', `log_exp`='".$log_exp."', `hand_rem`= '".$hand_rem."',`hand_exp`='".$hand_exp."',`spare_rem`='".$spare_rem."',`spare_exp`='".$spare_exp."',`mobile_rem`='".$mobile_rem."',`mobile_exp`='".$mobile_exp."',`room_rem`='".$room_rem."',`room_exp`='".$room_exp."', `oth_rem`='".$room_exp."', `oth_exp`='".$room_exp."', total_exp='".$exp."' where id='".$id."'");
 
if($qry)
{
    echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("You have successfully Updated your Claim")';//msg
    echo '</script>';
echo '<script>window.location.href="view_oth_expense.php"</script>';
	
}
 
?>