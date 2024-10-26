<?php
include('../config.php');
$arr=array();
$mac_id=$_GET['mac_id'];
$sqlqry=("Select * from notification_tble where mac_id='".$mac_id."' and status=0");
// $qry=mysql_query("Select * from notification_tble where macid='".$macid."'");
 //echo $sqlqry;
 
 $res=mysql_query($sqlqry);
if(mysql_num_rows($res)>0)
{
	$str=array();
$row=mysql_fetch_row($res);
//echo "Select * from login where srno='".$row[1]."'";
$qry=mysql_query("Select * from login where srno='".$row[1]."'");
 $reslt=mysql_fetch_row($qry);
$str[]=array('regId'=>$row[4],'desgid'=>$reslt[4],'pid'=>$row[2],'logid'=>$row[1],'username'=>$reslt[1],'password'=>$reslt[2]);
//header('location:createmsg.php?regId=$row[4]&desgid=reslt[4]&pid=$row[2]&logid=$row[1]');

}
else
$str="-1";


echo json_encode($str);
 
				
?>