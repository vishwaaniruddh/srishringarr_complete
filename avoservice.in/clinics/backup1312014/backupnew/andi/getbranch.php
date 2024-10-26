<?php
include('../config.php');
$arr=array();
 $area1=mysql_query("select * from area ORDER BY name ASC");
				while($area=mysql_fetch_row($area1)){
				//$arr[]=$area[0];
				$arr[] = array( 'area' => $area[0]);
				 } 
				 
				    echo json_encode($arr);
				 ?>
