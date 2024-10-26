<?php
include("config.php");
$qry=mysqli_query($con1,"select track_id,podate from atm where track_id>=64688");
while($fetch=mysqli_fetch_array($qry))
{
$qr=mysqli_query($con1,"select valid from site_assets where atmid='".$fetch[0]."' and assets_name='UPS'");
$fetch1=mysqli_fetch_array($qr);
$st=substr($fetch1[0],0,2);
//echo "checkkk".$st;
$expdt="INTERVAL ".$st." Month";
$updt=mysqli_query($con1,"update atm set expdt=DATE_ADD('".$fetch[1]."',".$expdt.") where track_id='".$fetch[0]."'");
echo "update atm set expdt=DATE_ADD('".$fetch[1]."',".$expdt.") where track_id='".$fetch[0]."'";

}



?>
