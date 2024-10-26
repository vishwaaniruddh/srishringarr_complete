<?php
include("config.php");

$date=date('Y-m-d');

$qry=mysqli_query($con1,"select * from en_uw_opex ");


while($row=mysqli_fetch_row($qry)) {
    

$atmqq=mysqli_query($con1,"select track_id from atm where atm_id ='".$row[0]."'");

$atm=mysqli_fetch_row($atmqq);

$siteqry= mysqli_query($con1,"update site_assets set type='opex' where atmid='".$atm[0]."'"); 


$atmq= mysqli_query($con1,"update atm set site_type='opex'  where track_id='".$atm[0]."'"); 


} 

mysqli_close($con);
mysqli_close($con2);


?>