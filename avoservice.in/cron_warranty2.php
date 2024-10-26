 <?php
include("config.php");

$date=date('Y-m-d');

//======================== Asset status as per exp date======

$sitedata= mysqli_query($con1,"select site_ass_id, exp_date, assets_name,atmid  from site_assets where status=1 " );

//$sitedata= mysqli_query($con1,"select site_ass_id, exp_date, assets_name,atmid  from site_assets where exp_date > '".$date."' and status=0 and po !='FT-3009/2021' " );

//$sitedata= mysqli_query($con1,"select site_ass_id, exp_date, assets_name,atmid  from site_assets where atmid=197131 " );

while($row=mysqli_fetch_row($sitedata)) {

if($row[1] < $date) {
mysqli_query($con1,"update site_assets set status=0 where site_ass_id='".$row[0]."'");
} elseif($row[1] > $date) {
    echo "<br> update site_assets set status=1 where site_ass_id='".$row[0]."'";
    
mysqli_query($con1,"update site_assets set status=1 where site_ass_id='".$row[0]."'");
if($row[2] =='UPS'){
mysqli_query($con1,"update atm set active= 'y' where track_id='".$row[3]."'");
}
}
}

mysqli_close($con1);
mysqli_close($con2);

?>