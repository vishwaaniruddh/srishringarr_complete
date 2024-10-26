<?php
include("config.php");
 
 
 $engg_id=$_POST['engg_id'];
 $branch=$_POST['branch'];
 
 
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
 
 $date=date("Y-m-d",strtotime(str_replace("/","-",$_POST['date'])));
 
//echo $date;

if($engg_id !='') {

$str.="select * from engg_oth_expenses where claim_date='".$date."' and engg_id= '".$engg_id."' ";

$qry1=mysqli_query($con1,$str);

if (mysqli_num_rows($qry1)==0){

$qry=mysqli_query($con1,"INSERT INTO `engg_oth_expenses` (`engg_id`, `branch_id`, `claim_date`, `log_rem`, `log_exp`, `hand_rem`,`hand_exp`,`spare_rem`,`spare_exp`,`mobile_rem`,`mobile_exp`,`room_rem`,`room_exp`, `oth_rem`, `oth_exp`) VALUES ('".$engg_id."', '".$branch."','".$date."', '".$log_rem."', '".$log_exp."',  '".$hand_rem."', '".$hand_exp."', '".$spare_rem."', '".$spare_exp."', '".$mobile_rem."', '".$mobile_exp."', '".$room_rem."', '".$room_exp."', '".$oth_rem."', '".$oth_exp."')");

   
$insert_id=mysqli_insert_id($con1);

if($insert_id) { 

$up=mysqli_query($con1,"select * from engg_oth_expenses where id='".$insert_id."'")  ; 
$row=mysqli_fetch_row($up);

$total=array( $row[5],$row[7],$row[9],$row[11],$row[13],$row[15]);
$exp =array_sum($total);

$qr=mysqli_query($con1,"UPDATE engg_oth_expenses set total_exp='".$exp."' where id='".$insert_id."'");
}   
    
} 


 else {
    echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("Sorry!! You have already Entered/ Something went Wrong")';
    echo '</script>';
 echo '<script>window.location.href="engg_oth_exp.php"</script>'; 
 }
}
 else {
     echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("Please Check Your Login ID")';//msg
    echo '</script>';
echo '<script>window.location.href="engg_oth_exp.php"</script>';
 }

if($qry)
{
    echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("You have successfully entered your Claim")';//msg
    echo '</script>';
echo '<script>window.location.href="view_oth_expense.php"</script>';
	
}
 
?>