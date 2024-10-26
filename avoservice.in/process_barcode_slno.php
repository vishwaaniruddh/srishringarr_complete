<?php
session_start();
include("access.php");
include('config.php');
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];


if(isset($_POST['delegate']))
{
 $so_id=$_POST['so_id']; 
 $model=$_POST['model'];
 $product_count=$_POST['count'];
 $slno=$_POST['slno'];
 
//echo var_dump($_POST);


$cdate = date('Y-m-d H:i:s');
$err=0;
$error='';
for($i=0;$i<$product_count;$i++){
    
    if($slno[$i] !='') {

$checkqry=mysqli_query($con1,"select barcode_no from so_order_barcode where barcode_no ='".$slno[$i]."'");        
if(mysqli_num_rows($checkqry)==0) {

    $insert= "Insert into so_order_barcode(so_id,model_id,barcode_no,created_at,created_by) Values('".$so_id."','".$model."','".$slno[$i]."','".$cdate."','".$_SESSION['logid']."')";
    $sql=mysqli_query($con1,$insert);
} else { $error="Already Sl. No in the database";
$err++;
    
}
    
    }
} 

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

if($insert)
{
?>
<script type="text/javascript">
alert("<?php echo $error;  ?> Error Count:<? echo $err; ?> Successfully Uploaded Sl. No");
window.location='barcode_status.php';
</script>
<?php
} else { 
?>
<script type="text/javascript">
alert("<?php echo $error;  ?> Error Count:<? echo $err; ?> Oops!!");
window.location='barcode_status.php';
</script>
<?php    
}
}
else
?>
<script type="text/javascript">
alert("Oops!!! Something Wrong. Please try again");
window.location='barcode_pending.php';
</script>
