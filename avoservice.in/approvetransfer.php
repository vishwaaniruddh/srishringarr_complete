<?php
include("config.php");
 $id=$_POST['id'];
 $cmnt=$_POST['cmnt'];
 if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $cmnt))
{
   $cmnt=str_replace("'","\'",$cmnt);
}
 $status=$_POST['status'];
 $alert=mysqli_query($con1,"select * from alert where alert_id=(select alertid from transfersites where id='".$id."')");
 $alertro=mysqli_fetch_row($alert);
 $trans=mysqli_query($con1,"select * from transfersites where id='".$id."'");
 $trrow=mysqli_fetch_row($trans);
 
 	//echo "select `branch_id` from `state` where `state_id`='".$state."' <br>";
	//$branch=mysqli_query($con1,"select `branch_id` from `state` where `state`='".$trrow[2]."' ");
	//$branch1=mysqli_fetch_row($branch);
	//echo "brid=".$branch1[0];
 
 if($status=='disapprove')
 {
// echo "Update alert set transapp='0' where alert_id='".$alertro[0]."'";
 $qry=mysqli_query($con1,"Update alert set transapp='0' where alert_id='".$alertro[0]."'");
 $qry2=mysqli_query($con1,"Update transfersites set todesc='".$cmnt."',apptime='".date('Y-m-d H:i:s')."',approval='".$status."' where id='".$id."'");
 if($qry && $qry2)
 echo "1";
 else
 echo "0";
 }
 elseif($status=='approve')
 {
 //echo "Update alert set transapp='2',state='".$trrow[2]."' where alert_id='".$alertro[0]."'";
 $qry=mysqli_query($con1,"Update alert set transapp='2',state1='".$trrow[10]."',branch_id='".$trrow[2]."' where alert_id='".$alertro[0]."'");
 $qry2=mysqli_query($con1,"Update transfersites set todesc='".$cmnt."',apptime='".date('Y-m-d H:i:s')."',approval='".$status."' where id='".$id."'");
 if($alertro[21]=='site')
 { //update branch in table atm
 mysqli_query($con1,"Update atm set branch_id='".$trrow[2]."' where track_id='".$alertro[2]."'");
 }
 elseif($alertro[21]=='amc')
 { //update branch in table amc
 mysqli_query($con1,"Update Amc set branch='".$trrow[2]."' where amcid='".$alertro[2]."'");
 }
 if($qry && $qry2)
 {
 
 echo "1";
 }
 else
 {

 echo "0";
 }
 }
?>