<?php
if(isset($_POST['closecall']))
{
$str2=array();
 $id=$_POST[id];
 $cdate = date('Y-m-d H:i:s');
 $br=$_POST['br'];
 $up=$_POST['up']." Installation has been completed";
 $email=$_POST['email'];
 $rtime=$_POST['rtime'];
require_once('class_files/insert.php');
$in_obj=new insert();
$tab=$in_obj->insert_into('localhost','hav_acc','Myaccounts123*','hav_accounts','alert_updates',array("alert_id","up","update_time","branch"),array($id,$up,$cdate,$br3));
include("config.php");
if($rtime!='')
{
$sql2=mysqli_query($con1,"select po,atm_id,cust_id,responsetime from alert where alert_id='$id'");
$row2=mysqli_fetch_row($sql2);
$qry2=mysqli_query($con1,"Update alert set close_date='".$rtime."', call_status='Done' where alert_id='".$id."'");
 $time=strtotime($rtime);

if($row2[3]=='0000-00-00 00:00:00')
$qry2=mysqli_query($con1,"Update alert set responsetime='".$rtime."' where alert_id='".$id."'");
$sql5=mysqli_query($con1,"select Ref_id from atm where atm_id='".$row2[1]."'");
$row5=mysqli_fetch_row($sql5);
//echo "select servicetype from atm where po='$row2[0]' and atm_id LIKE '".$row2[1]."%' Limit 1";
$sql3=mysqli_query($con1,"select servicetype from atm where po='$row2[0]' and atm_id LIKE '".$row2[1]."%' Limit 1");
$row3=mysqli_fetch_row($sql3);
//echo "select * from site_assets where po IN ('".$row2[0]."') ";
$sql=mysqli_query($con1,"select * from site_assets where po IN ('".$row2[0]."') ");
while($row=mysqli_fetch_array($sql))
{
//echo "<br><br>".$row[5];
//echo "INSERT INTO `satyavan_accounts`.`installed_sites` (`id`, `custid`, `po`, `atmid`, `Ref_id`, `assdescid`, `startdt`, `expdt`, `status`) VALUES (NULL, '".$row2[2]."', '".$row[0]."', '".$row2[1]."', '".$row5[0]."', '".$row[4]."', '".$rtime."', '".date("Y-m-d",strtotime("+".$str[0]." months", $time))."', '1')";
$str=split(",",$row[5]);
//echo "<br>".$str[0]."  ".date("Y-m-d",strtotime("+".$str[0]." months", $time));
$sql4=mysqli_query($con1,"INSERT INTO `installed_sites` (`id`, `custid`, `po`, `atmid`, `Ref_id`, `assdescid`, `startdt`, `expdt`, `status`) VALUES (NULL, '".$row2[2]."', '".$row[0]."', '".$row2[1]."', '".$row5[0]."', '".$row[4]."', '".$rtime."', '".date("Y-m-d",strtotime("+".$str[0]." months", $time))."', '1')");

$str2[]=$str[0];
}
//echo "<br>".$row3[0]."<br>";

$endlimit=max($str2)/$row3[0];
//echo "<br>".max($str2)." ".$row3[0]." ".$endlimit."<br><br>";
for($i=1;$i<=$endlimit;$i++)
{
$j=$row3[0]*$i;
//echo date("Y-m-d",strtotime("+".$j." months", $time))."<br><br>";
//echo "Insert into servicemonth(`po`,`date`,`type`) Values('".$row2[0]."','".date("Y-m-d",strtotime("+".$j." months", $time))."','new')";
$sql6=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`) Values('".$row2[0]."','".date("Y-m-d",strtotime("+".$j." months", $time))."','new')");
}
//$qry=mysqli_query($con1,"Insert into installed_sites()");
}


if($email!='')
{
$to = $email;
			
			$subject = 'Updates for Alert';
			
			$headers = "From: " .AVOUPS. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".$cdate."<br><br>Update : ".$up;
			
		mail($to, $subject, $message, $headers);
}
header("location:view_alert.php");

}

?>