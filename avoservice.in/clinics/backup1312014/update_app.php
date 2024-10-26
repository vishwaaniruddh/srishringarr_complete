<?php 
include('config.php');

$id=$_POST['id'];

$appdate=$_POST['appdate'];

$type=$_POST['type'];
$hosp=$_POST['hos1'];
$new=$_POST['new'];
$rema=$_POST['rem'];

$block_id=$_POST['block_id'];
$slot=$_POST['sl'];
//echo $hosp."/".$slot;

$sql="update appoint set type='".$type."',hospital='".$hosp."',app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y'),time ='".$time."',date=curdate(),new_old='".$new."',remarks='".$rema."',block_id='".$block_id."',slot='".$slot."' where app_real_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: View_app.php");

}
else
echo "error Updating data".mysql_error();

?>