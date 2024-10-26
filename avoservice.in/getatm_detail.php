<?php
include('config.php'); 

if(isset($_GET['atm'])) 
 $nameatm=$_GET['atm'];  // name of atm coming from newsite1.php

//echo "SELECT atm_id,bank_name,area,pincode,city,branch_id,state1 from atm where `atm_id`='".$nameatm."' and active='Y'";
$atmno=mysqli_query($con1,"SELECT atm_id,bank_name,area,pincode,city,branch_id,state1 from atm where `atm_id`='".$nameatm."' and active='Y'");
$atmno1=mysqli_num_rows($atmno);	

if($atmno1>0){
	//if 1 atm allready exist
	$row=mysqli_fetch_row($atmno);
	echo '1##'.$row[0].'##'.$row[1].'##'.$row[2].'##'.$row[3].'##'.$row[4].'##'.$row[5].'##'.$row[6];
	}else{
	//if 0 atm is not exist	
	$atmnoX=mysqli_query($con1,"SELECT `ATMID`,BANKNAME,AREA,PINCODE,CITY,BRANCH,STATE from Amc where `ATMID`='".$nameatm."' and active='Y'");
        $atmnoY=mysqli_num_rows($atmnoX);	
        if($atmnoY>0){
                      $row=mysqli_fetch_row($atmnoX);
                      echo '2##'.$row[0].'##'.$row[1].'##'.$row[2].'##'.$row[3].'##'.$row[4].'##'.$row[5].'##'.$row[6];
                     }
                      else{
	              echo '0';
	              }
	}
?>
	
	

