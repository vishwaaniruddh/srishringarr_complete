<?php session_start();
include("functions.php");

include("Whatsapp_delegation/delegation_fun.php");

$userid = $_SESSION['logid'];
$branchid = $_SESSION['branchid'];



// var_dump($_POST);

// return;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    $id = $_GET['id'];


function get_customer_address($id){
     global $con1;
    
    $sql = mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    return $sql_result['buyer_address'];
}

function get_gst($id){
     global $con1;
    
    $sql = mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    return $sql_result['buyer_gst'];
}


function get_asset_name($id){
     global $con1;
    
    $sql = mysqli_query($con1,"select * from assets where assets_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['assets_name'];
}
$date = date('Y-m-d h:i:s');

$only_date = date('Y-m-d');


if(isset($_GET['action']) && $_GET['action']=='delete'){
     global $con1;
    
    $id = $_GET['id'];
    $sql=mysqli_query($con1,"update purchase_order set po_status = 9 where id ='".$id."' ");
    if($sql){
        echo '<script>alert("Record deleted successfully");window.location.href="view_purchase_order.php"</script>';
    } 
} else {
   
$raiseby = $_SESSION['logid'];

//echo '<pre>';print_r($_POST);echo '</pre>';

$buyer_id = $_POST['buyerID'];
$customer_vertical = $_POST['customer_vertical']; 
$sales_exe_name = $_POST['sales_exe_name'];

$modeOfSale = $_POST['modeOfSale'];

$po_number = $_POST['po_number'];
$po_date = $_POST['po_date']; 


$warr_type = $_POST['warr_type'];


$product = $_POST['product'];

$model = $_POST['model'];
// $capacity = $_POST['capacity']; 
$quantity = $_POST['quantity'];
$basic_Price = $_POST['price'];

$warranty = $_POST['warranty'];
$delivery_mode = $_POST['delivery_mode']; 
$other_charges = $_POST['other_charges'];
$payment_term = $_POST['payment_term'];
$tat = $_POST['tat'];
$remarks =$_POST['remarks'];

$whatsno=$_POST['whatsno'];

//======================= OAN
/*$qrr=mysqli_query($con1,"select * from purchase_order where po_time LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2; */

//====================

if($_GET['action']=='edit' && $_GET['id']>0){

function get_assets_name($id){
    global $con1;
    
    $sql = mysqli_query($con1,"select * from assets where assets_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['assets_name'];
}

$i=0;
    $assets_sql = mysqli_query($con1,"select * from po_assets where po_trackid='".$id."'");
    while($assets_sql_result = mysqli_fetch_assoc($assets_sql)){
        
        $assets_name = get_assets_name($product[$i]);
        $assettrack_id = $assets_sql_result['assettrack_id'];
        
        mysqli_query($con1,"update po_assets set assets_name = '".$assets_name."', specs='".$model[$i]."',qty='".$quantity[$i]."',warranty='".$warranty[$i]."',rate='".$basic_Price[$i]."' where assettrack_id='".$assettrack_id."'");
        
        $i++;
    }


     $sql=mysqli_query($con1,"update purchase_order set cust_id='".$customer_vertical."',buyer_id='".$buyer_id."' ,po_raiseby= '".$raiseby."',po_mode='".$modeOfSale."',po_tat='".$tat."',po_payment='".$payment_term."',salesperson='".$sales_exe_name."',po_remarks='".$remarks."',warr_type='".$warr_type."',delivery_mode='".$delivery_mode."', other_charge='".$other_charges."' where id='".$id."' ");
     
         ?>
         
         
         <script>
            alert("PO Succefully updated");
            window.location.href="view_purchase_order.php"
            
            </script>';
<? 
} 
else {
    
 mysqli_query($con1,"BEGIN");   
   $errors=0;
   
    $sql_insert = mysqli_query($con1,"insert into  purchase_order (po_no,cust_id,buyer_id,po_raiseby,po_mode,po_tat,po_payment,salesperson,po_remarks,po_status,warr_type,other_charge,delivery_mode,buyeraddress,gst,po_time,po_date,branch_id,created_by, whatsapp)  values('".$po_number."','".$customer_vertical."','".$buyer_id."','".$raiseby."','".$modeOfSale."','".$tat."','".$payment_term."','".$sales_exe_name."','".$remarks."','1','".$warr_type."','".$other_charges."','".$delivery_mode."','".get_customer_address($buyer_id)."','".get_gst($buyer_id)."','".$date."','".$po_date."','".$branchid."','".$userid."','".$whatsno."')") ;
    

    $insert_id = mysqli_insert_id($con1);
    
 if(!$sql_insert) {
     $errors++;
     $reason="PO Table insert error";
 }  
    
    $product_count = count($_POST['product']);

    for($i=0;$i<$product_count;$i++){

  
        $sql_asset = mysqli_query($con1,"insert into  po_assets (po_no,assets_name,qty,warranty,rate,po_trackid,po_product,specs) values('".$po_number."','".get_asset_name($product[$i])."','".$quantity[$i]."','".$warranty[$i]."','".$basic_Price[$i]."','".$insert_id."','".$product[$i]."','".$model[$i]."')") ;
    }    

 if(!$sql_asset) {
     $errors++;
     $reason="PO Assets Not Inserted";
 }  

//=========WhatsApp===========

$poqry=mysqli_query($con1,"select * from purchase_order where id='".$insert_id."' ");
$po=mysqli_fetch_row($poqry);

$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$po[2]."'");
$cust=mysqli_fetch_row($custqry);

$executive_qry = mysqli_query($con2,"SELECT exe_contact FROM salesteam where exe_id = '".$po[11]."'");
$exec=mysqli_fetch_row($executive_qry);
$exe_mob=$exec[0];

        $MassageNew = "[PO]*Switching AVO Electro Power Ltd*";
        $Massage1="*Order Acknowledgement Note*";
        $Massage2="New PO is received and being processed";
        $Massage3="*Vertical:* ".$cust[0];
        $Massage4="*PO No:* ".$po[0];
        $Massage5="*PO Date:* ".$po[5];
        $Massage6="*Product Details:* Please refer the PO copy" ;
        $Massage7="*PO Remarks:* ".$po[19] ;
        $Massage8="*Delivery TAT:* Our standard TAT will be:"."\n"."Metro / State Capitals: Within 2 Days"."\n"."Other Cities/Suburban: Within 4-5 Days"."\n"." Rural sites: Approx - One Week";
        
$exe_mob=$exec[0]; 
$gmobile=$po[25];
$whats_no=$exe_mob.",".$gmobile;
//$whats_no=$exe_mob;

$allMessage = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8;

SendWhatmsg($whats_no,$allMessage);	
}
}
if($errors==0)
{
    mysqli_query($con1,"COMMIT");
?>
<script>
    alert("PO Added successfully !! the OAN No: <? echo $insert_id;?>");
    
    setTimeout(function() { 
       
      window.location.href="view_purchase_order.php";
    
    }, 1500);
    
</script>

<? } else 
mysqli_query($con1,"ROLLBACK");

die('Failed Reason:<br>'.$reason."<br>".mysqli_error());