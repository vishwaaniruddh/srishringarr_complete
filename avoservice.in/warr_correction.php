 <?php
include("config.php");
$date=date('Y-m-d'); //  2024-05-08 running date==test id:and atmid=63634
//======To identify those modifed callid marked as =22 and original exp date is in *type*======

$sitedata= mysqli_query($con1,"select site_ass_id, exp_date, assets_name,atmid  from site_assets where status=1 and exp_date > '".$date."' and exp_date < '2024-08-01' ");

while($row=mysqli_fetch_row($sitedata)) {
    
$changeexp=date('Y-m-d', strtotime("-2 months $row[1]"));

if($changeexp < $date) {

echo "<br> update site_assets set status=0, exp_date='".$changeexp."', type='".$row[1]."', callid='22' where site_ass_id='".$row[0]."'";

mysqli_query($con1,"update site_assets set status=0, exp_date='".$changeexp."', type='".$row[1]."', callid='22' where site_ass_id='".$row[0]."'");
if($row[2] =='UPS'){
    echo "<br> update atm set active= 'N' where track_id='".$row[3]."'";
mysqli_query($con1,"update atm set active= 'N' where track_id='".$row[3]."'");
}


} elseif($changeexp > $date) {

 echo "<br> update site_assets set exp_date='".$changeexp."', type='".$row[1]."', callid='22' where site_ass_id='".$row[0]."'";
 
mysqli_query($con1,"update site_assets set exp_date='".$changeexp."', type='".$row[1]."', callid='22' where site_ass_id='".$row[0]."'");
}
}

mysqli_close($con1);
mysqli_close($con2);

?>