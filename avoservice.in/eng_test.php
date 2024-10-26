<?php 
include('config.php');

$eng=232;
//echo "select alert_id from alert_delegation where engineer='".$eng."'  and `call_close_status`='0' ";
$eng_alert=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$eng."'  and `call_close_status`='0' ");
$all_alid=array();
while($eng_alert1=mysqli_fetch_row($eng_alert)){
         //echo $eng_alert1[0];
	 $all_alid[]=$eng_alert1[0];
}
$alert_string = implode(",",$all_alid);
//echo $alert_string;

if($eng!='-1')
$sql="select * from `alert` where alert_id in ($alert_string)";
echo $sql."<br>";
$res=mysqli_query($con1,$sql);
while($row=mysqli_fetch_row($res)){

//echo $row[0];
}



?>
