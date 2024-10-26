<?php
	//echo "From Server".json_encode($_POST)."<br>";
	$pid=$_POST['acno'];
	$assmid=array();
	$serv=array();
	$dur=array();
	$type=array();
	$j=0;
	
	for($i=0;$i<count($_POST['service']);$i++)
	{
	if($_POST['service'][$i]!='')
	{
	$assid[]=$_POST['id'][$i];
	$serv[]=$_POST['service'][$i];
	$dur[]=$_POST['dur'][$i];
	$type[]=$_POST['type'][$i];
	$amt[]=$_POST['amt'][$i];
	$j=$j+1;
	}
	}
	if($j=='0')
	echo "<h2><font color=red>Error : Please Select service</font></h2>";
	else
	{
	include_once('sql/include/DB.php');
	$cdate=date('Y-m-d H:i:s');
	$k=0;
	mysql_query("BEGIN");
	for($i=0;$i<count($serv);$i++){
	$ins=mysql_query("INSERT INTO `facilitiesused` (`id`, `pmemid`, `membershipid`, `serviceused`, `amount`, `entrydt`, `type`,`duration`) VALUES (NULL, '".$pid."', '".$assid[$i]."', '".$serv[$i]."', '".$amt[$i]."','".$cdate."', '".$type[$i]."', '".$dur[$i]."')");
	if(!$ins)
	$k=$k+1;
	}
	if($k==0)
	{
	mysql_query("COMMIT");
	echo "<h2><font color=red>SErvice Updated Successfully</font></h2>";
	}
	else
	{
	mysql_query("ROLLBACK");
	echo "<h2><font color=red>Some Error Occurred".mysql_error()."</font></h2>";
	}
	}
?>