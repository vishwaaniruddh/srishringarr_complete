<?php
error_reporting(-1);
include("../config.php");

date_default_timezone_set('Asia/Kolkata');
$created_at = date('Y-m-d H:i:s');

$so_id = $_POST['so_id'];
$barcode_no = $_POST['barcode'];
$created_by = $_POST['user_id'];

$model_id = $_POST['model_id'];

$checkqry=mysqli_query($con1,"select barcode_no from so_order_barcode where barcode_no ='".$barcode_no."'");
if(mysqli_num_rows($checkqry)==0) {

$query_result = mysqli_query($con1,"insert into so_order_barcode (`so_id`, `model_id`, `barcode_no`,  `created_by`, `created_at`) values ('".$so_id."','".$model_id."','".$barcode_no."','".$created_by."','".$created_at."') ");

//========Multiple Models in UPS but same so_id=========
$assetcnt=[];
$assetqry= mysqli_query($con1, "Select po_qty from new_sales_order_asset where `so_trackid`='".$so_id."' and po_product='UPS'" );
while ($crow = mysqli_fetch_array($assetqry)) {
    $assetcnt[] = $crow["po_qty"]; 
}
$tot=array_sum($assetcnt);

$qry= mysqli_query($con1, "Select count(id) as `count` from so_order_barcode where `so_id`='".$so_id."'" );
$row=mysqli_fetch_assoc($qry);
$count=$row['count'];

if($tot==$count) {
$update_result = mysqli_query($con1,"update so_order SET  `call_status`='1' where po_id='".$so_id."'");
}

if($query_result)
{
       $array = array('code'=>200);
}       
else
{
    $array = array(['code'=>201]);
}
} else {
    $array = array(['code'=>201]);
}
    
echo json_encode($array);
    