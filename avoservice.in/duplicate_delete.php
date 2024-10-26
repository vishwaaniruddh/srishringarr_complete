<?php
include("config.php");

$date=date('Y-m-d');



$sitedata= mysqli_query($con1,"select * from site_assets where atmid=231703");

while($row=mysqli_fetch_row($sitedata)) {


$atmqry=mysqli_query($con1,"select track_id from atm where atm_id='".$atm_id."'" );
$delete= "DELETE S1 FROM site_assets AS S1 INNER JOIN site_assets AS S2 WHERE S1.site_ass_id < S2.site_ass_id AND S1.assets_name = S2.assets_name AND S1.assets_spec=S2.assets_spec AND S1.atmid=S2.atmid AND S1.po=S2.po AND S2.atmid=231703 "; 

"DELETE S1 FROM site_assets AS S1 INNER JOIN site_assets AS S2 WHERE S1.site_ass_id < S2.site_ass_id AND S1.assets_name = S2.assets_name AND S1.assets_spec=S2.assets_spec AND S1.atmid=S2.atmid AND S1.po=S2.po and S1.start_date=S2.start_date AND S2.cust_id=9";



}


?>