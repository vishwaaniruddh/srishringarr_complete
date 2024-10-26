<?php
include("../config.php");
//$version=$_GET['version'];
$qry=mysql_query("Select version from versionupdatesmanager");
if(mysql_num_rows($qry)>0)
	{
	$res=mysql_fetch_row($qry);
		$str=$res[0];
	}
	else
	{
		$str="0";
	}
	echo json_encode($str);


    ?>