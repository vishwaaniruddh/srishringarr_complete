<?php

include('config.php');

       $id=$_GET['cid'];
	   $qry="SELECT * FROM  `phppos_people` where person_id='$id'";
$res=mysql_query($qry);                
$row=mysql_fetch_row($res);
echo $row[2];
?>