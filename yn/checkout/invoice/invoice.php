<?php 
include('header_new.php');
 $con = OpenCon();
 
 $orderid = $_GET['orderid'];
// $orderid = 286;

$orderResult=mysqli_query($con,"select * from Order_ent where id='".$order_id."' ");
$result = mysqli_fetch_assoc($orderResult);

$oid = $result['id'];

echo $oid;
if (! empty($result)) {
    require_once __DIR__ . "/PDFService.php";
    $pdfService = new PDFService();
    $pdfService->generatePDF($result, $oid);
    echo 1;
}


 CloseCon($con);
?>