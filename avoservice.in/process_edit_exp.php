<?php
include("config.php");
 
 
 $id= $_POST['id'];
 $calls=$_POST['calls'];
 $close=$_POST['close'];
 $bike_km=$_POST['bike_km'];
 $bike_exp=$_POST['bike_exp'];
 $cab_km=$_POST['cab_km'];
 $cab_exp=$_POST['cab_exp'];
 $public_km=$_POST['public_km'];
 $public_exp=$_POST['public_exp'];
 $food=$_POST['food'];
 $lodge=$_POST['lodge'];
 $mobile=$_POST['mobile'];
$room=$_POST['room'];


 $comp_km=$_POST['comp_km'];
 $oth_visit_reasn=trim($_POST['oth_reason']);
 
$qry="UPDATE `daily_expenses` set `call_count`='".$calls."', `close_count`='".$close."' , `bike_km`='".$bike_km."',`bike_exp`= '".$bike_exp."',`cab_km`= '".$cab_km."',`cab_exp`= '".$cab_exp."',`public_km`= '".$public_km."',`public_exp`= '".$public_exp."',`food_exp`= '".$food."',`lodging`= '".$lodge."', `mobile`='".$mobile."', `room`='".$room."', `comp_km`= '".$comp_km."', `oth_visit_reasn`= '".$oth_visit_reasn."' where id = '".$id."' " ;

$qry2=mysqli_query($con1,$qry);

$up=mysqli_query($con1,"select * from daily_expenses where id='".$id."'")  ; 
$row=mysqli_fetch_row($up);

$total=array($row[7],$row[9],$row[11],$row[12],$row[13],$row[16],$row[23]);
$exp =array_sum($total);

$travel= array($row[6],$row[8],$row[10]);
$km= array_sum($travel);

$qr=mysqli_query($con1,"UPDATE daily_expenses set total_exp='".$exp."', total_km='".$km."' where id='".$id."'");
  
    
 
if($qry2)
{
    echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("You have successfully Updated your Claim")';//msg
    echo '</script>';
echo '<script>window.location.href="view_expense.php"</script>';
	
}
else
  echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("Something Wrong")';//msg
    echo '</script>';
echo '<script>window.location.href="view_expense.php"</script>';
 
?>