<?php
include('config.php');
$qryitem=mysql_query("select distinct category from phppos_items");
	 	$items=array();
		$itemid=array();
		$category=array();
		 while($row=mysql_fetch_row($qryitem))
		 {
		echo "INSERT INTO `categories` (`category`, `typ`) VALUES('".$row[0]."')";
		$insqr=mysql_query("INSERT INTO `categories` (`category`, `typ`) VALUES('".$row[0]."','0')");
		
				//$category[]=$row[0];
			}

?>