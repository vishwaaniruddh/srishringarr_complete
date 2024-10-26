<?php
include("config.php");
 
 
 $engg_id=$_POST['engg_id'];
 $branch=$_POST['branch'];
 $calls=$_POST['calls'];
 $close=$_POST['close']; // other visits
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
 $oth_visit_reasn=mysqli_real_escape_string($con1,$_POST['oth_reason']);
 
 if($oth_visit_reasn==''){$oth_visit_reasn='No remarks added by Engr';}
 $date=date("Y-m-d",strtotime(str_replace("/","-",$_POST['date'])));
 
//echo $date;

if($engg_id !='') {

$str.="select * from daily_expenses where date='".$date."' and engg_id= '".$engg_id."' ";

$qry1=mysqli_query($con1,$str);

if (mysqli_num_rows($qry1)==0){


$qry=mysqli_query($con1,"INSERT INTO `daily_expenses` (`engg_id`, `branch_id`, `date`, `call_count`, `close_count`, `bike_km`,`bike_exp`,`cab_km`,`cab_exp`,`public_km`,`public_exp`,`food_exp`,`lodging`, `status`, `comp_km`, `oth_visit_reasn`,`mobile` , `room`) VALUES ('".$engg_id."', '".$branch."','".$date."', '".$calls."', '".$close."',  '".$bike_km."', '".$bike_exp."', '".$cab_km."', '".$cab_exp."', '".$public_km."', '".$public_exp."', '".$food."', '".$lodge."', '1', '".$comp_km."', '".$oth_visit_reasn."', '".$mobile."', '".$room."' )");



$insert_id=mysqli_insert_id($con1);

if($insert_id) { 

$up=mysqli_query($con1,"select * from daily_expenses where id='".$insert_id."'")  ; 
$row=mysqli_fetch_row($up);

$total=array($row[7],$row[9],$row[11],$row[12],$row[13],$row[16],$row[23]);
$exp =array_sum($total);

$travel= array($row[6],$row[8],$row[10]);
$km= array_sum($travel);

$qr=mysqli_query($con1,"UPDATE daily_expenses set total_exp='".$exp."', total_km='".$km."' where id='".$insert_id."'");
}   
    
} 


 else {
    echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("Sorry!! You have already Entered/ Something went Wrong")';
    echo '</script>';
 echo '<script>window.location.href="expense_entry.php"</script>'; 
 }
}
 else {
     echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("Please Check Your Login ID")';//msg
    echo '</script>';
echo '<script>window.location.href="expense_entry.php"</script>';
 }

if($qry)
{
    echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("You have successfully entered your Claim")';//msg
    echo '</script>';
echo '<script>window.location.href="view_expense.php"</script>';
	
}
 
?>