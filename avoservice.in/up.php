<?php
include("config.php");
/*$sel=mysqli_query($con1,"select alert_id from alert where alert_id<=3000");
while($selro=mysqli_fetch_array($sel))
{
$up=mysqli_query($con1,"select update_time from alert_updates where alert_id='".$selro[0]."' order by id ASC limit 1 ");
$upro=mysqli_fetch_row($up);
$up2=mysqli_query($con1,"update alert_delegation set `date`='".$upro[0]."' where alert_id='".$selro[0]."'");
}*/
echo date('Y-m-d H:i:s');
?>