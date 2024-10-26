<?php 
include('config.php');

$id=$_POST['id'];

$appdate=$_POST['appdate'];

//$type=$_POST['type'];
$hosp=$_POST['hos1'];
//$new=$_POST['new'];
$rema=$_POST['rem'];

$block_id=$_POST['block_id'];
$slot=$_POST['sl'];
//echo $hosp."/".$slot;
$time=$_POST['sl'];
$sql="update appoint set hospital='".$hosp."',app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y'),time ='".$time."',date=curdate(),remarks='".$rema."',block_id='".$block_id."',slot='".$slot."',center='".$_POST['center']."' where app_real_id='".$id."'";
//echo $sql;
$result=mysql_query($sql);
if($result)
{
	
header("location: View_app.php?searchdate=".$appdate);

}
else
echo "error Updating data".mysql_error();

?>