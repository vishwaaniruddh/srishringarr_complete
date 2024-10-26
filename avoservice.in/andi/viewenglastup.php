<?php
include("../config.php");
$alertid=$_GET['alertid'];
$engid=$_GET['engid'];
//echo "Select feedback from eng_feedback where alert_id='".$alertid."'";
$qry=mysql_query("Select feedback from eng_feedback where alert_id='".$alertid."' order by feed_date DESC");
if(mysql_num_rows($qry)>0)
{
$str=array();
//$row=mysql_fetch_row($qry);
while($result1=mysql_fetch_row($qry))
		{
		$str[]=array('feedback'=>$result1[0]);
		}

}

else
$str="-1";

echo json_encode($str);
?>