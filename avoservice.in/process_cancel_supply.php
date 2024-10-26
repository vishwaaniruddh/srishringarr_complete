<?php
session_start();
include("access.php");
include("config.php");
$user=$_SESSION['user'];

$so_id=$_POST['id'];
$reason=$_POST['reason'];
$update=$_POST['update'];

$date=date('Y-m-d H:i:s');
$cdate=date('Y-m-d');


mysqli_begin_transaction($con1);
//mysqli_query('BEGIN');

$error=0;

$so_order=mysqli_query($con1,"update so_order set status=9 where po_id='".$so_id."'");
if(!$so_order){$error++; } 

$barcode=mysqli_query($con1,"delete from so_order_barcode where so_id='".$so_id."'");
if(!$barcode){$error++; } 
$atmqry=mysqli_query($con1,"update atm set po='Last PO Cancelled' where so_id='".$so_id."'");
if(!$atmqry){$error++; } 
$asset=mysqli_query($con1,"update site_assets set po='PO Cancelled', status=0,start_date='0000-00-00',exp_date='".$cdate."' where so_id='".$so_id."'");
if(!$asset){$error++; } 

$update=mysqli_query($con1,"insert into sales_return set so_id='".$so_id."', reason='".$reason."',remarks='".$update."',createdby='".$user."', created_at='".$date."'");
if(!$update){$error++; }

if($error==0){
   // mysqli_query("COMMIT");
    mysqli_commit($con1)
?>
<script>
    alert("Updated Successfully");
window.close();
</script>
<?
} else {
  mysqli_rollback($con1); 
  echo "Failed".mysqli_error($con1);
}