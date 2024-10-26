<?php
include("access.php");
include('config.php');

//$qry=mysqli_query($con1,"select * from west_bengal_buyback");


while($row=mysqli_fetch_row($qry)) {

$soqry=mysqli_query($con1,"select po_id from so_order where inv_no='".$row[0]."'");

$so=mysqli_fetch_row($soqry);



$update=mysqli_query($con1,"update new_buyback is_collected='1', buyback_date='".$row[2]."', ups_spec='".$row[3]."' , ups_qty='".$row[4]."' , batt_spec='".$row[5]."' , batt_qty='".$row[6]."' , remark='".$row[7]."' , other_qty='".$row[8]."' where so_trackid='".$so[0]."' ");

echo "update new_buyback is_collected='1', buyback_date='".$row[2]."', ups_spec='".$row[3]."' , ups_qty='".$row[4]."' , batt_spec='".$row[5]."' , batt_qty='".$row[6]."' , remark='".$row[7]."' , other_qty='".$row[8]."' where so_trackid='".$so[0]."' ";


}

mysqli_close($con);
mysqli_close($con2);    

?>
