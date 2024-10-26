<?php
 
include('config.php');

       $cname=$_GET['cname'];
	   $service=$_GET['service'];
	   $curdate=date('Y-m-d');
	   
 if($service=="sales")
 {
     $sql1=mysql_query("select item_id,ctype,purchase_date from phppos_service where id='$cname'");
 }
 
 else
 {
    $sql1=mysql_query("select item_id,amc_cust from phppos_service1 where id='$cname'");
 }
	
	$row1 = mysql_fetch_row($sql1);
	if($row1[7]>$curdate){
	
$out="
<input type='hidden' name='type' value='$row1[1]' />
<input type='text' name='sdate' id='sdate' value='$row1[7]' />";

    
	}
echo $out;  
?>