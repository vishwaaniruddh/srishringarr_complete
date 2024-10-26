<?php
include("../config.php");
//$version=$_GET['version'];
$qry=mysqli_query($con1,"Select version from versionupdatescs");
if(mysqli_num_rows($qry)>0)
	{
	$res=mysqli_fetch_row($qry);
		$str=$res[0];
	}
	else
	{
		$str="0";
	}
	echo json_encode($str);


    ?>