<?php
include("../config.php");
$username=$_POST['user_id'];
$name=$_POST['name'];
$email=$_POST['email'];
$regid=$_POST['regId'];
$macid=$_POST['mac_id'];
$cdate = date('Y-m-d H:i:s');
$qry=mysql_query("Select * from login where username='".$username."'");

if(mysql_num_rows($qry)>0)
{
	
	$str="";
	$qryrow=mysql_fetch_row($qry);
	if($qryrow[4]==4)
{
	$qry1=my_query("Select engg_id from area_engg");
	$max=mysql_fetch_row($qry1);
	$str=$max[0];
}
elseif($qryrow==3)
{
	$qry1=my_query("Select head_id from area_head");
	$max=mysql_fetch_row($qry1);
	$str=$max[0];
}
$sql="INSERT INTO `notification_tble` (`id`, `logid`, `pid`, `macid`, `gcm_regid`, `name`, `email`, `created_at`, `status`) VALUES (NULL, '$qryrow[0]', '$str', '$macid', '$regid', '$name', '$email', '".$cdate."', '0')";
$result=mysql_query($sql);
if($result)
{
	$store=array();
$store[]=array('logid'=>$qryrow[0],'desgnid'=>$qryrow[4]);
}
else
{
	$store=$username." ".$name." ".$email." ".$regid." ".$macid;
}
}
else
{
	$store="-1";
}

echo json_encode($store);

?>