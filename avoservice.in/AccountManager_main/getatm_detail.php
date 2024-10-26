<?php
include('config.php'); 

if(isset($_GET['atm'])) 
 $nameatm=$_GET['atm'];  // name of atm coming from newsite1.php

//echo "select `atm_id` from `atm` where `atm_id`='".$nameatm."'";
$atmno=mysql_query("SELECT `atm_id` from atm where `atm_id`='".$nameatm."'");
$atmno1=mysql_num_rows($atmno);	

if($atmno1>0){
	//if 1 atm allready exist
	echo '1';
	}else{
	//if 0 atm is not exist	
	echo '0';
	}

	
?>
	
	

