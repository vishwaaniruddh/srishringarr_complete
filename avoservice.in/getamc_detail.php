<?php
include('config.php'); 

if(isset($_GET['atm'])) 

$atmid=$_GET['atm'];

$atmnoX=mysqli_query($con1,"SELECT `ATMID`,BANKNAME,AREA,PINCODE,CITY,ADDRESS, BRANCH,STATE from Amc where `ATMID`='".$atmid."'");

//echo "SELECT `ATMID`,BANKNAME,AREA,PINCODE,CITY,BRANCH,STATE from Amc where `ATMID`='".$atmid."' ";

$atmnoY=mysqli_num_rows($atmnoX);	
    if($atmnoY>0){
    $row=mysqli_fetch_row($atmnoX);
    
    echo '2##'.$row[0].'##'.$row[1].'##'.$row[2].'##'.$row[3].'##'.$row[4].'##'.$row[5].'##'.$row[6].'##'.$row[7];
    
        
    } else{
	              echo '0';
	              }
	
?>
	
	

