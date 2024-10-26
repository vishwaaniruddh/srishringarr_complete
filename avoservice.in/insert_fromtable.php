<?php
include("access.php");
include('config.php');

$psbqry=mysqli_query($con1,"Select * from tanfinet_sno");

while($row=mysqli_fetch_row($psbqry)) {

$pmqry="insert into so_order_barcode set so_id = '".$row[1]."', barcode_no = '".$row[0]."', model_id=1, created_by=71, created_at='2024-02-29 13:00:00'";
echo $pmqry."</br>"; 

$qry=mysqli_query($con1,$pmqry) ;

}       


mysqli_close($con);
mysqli_close($con2);   

?>