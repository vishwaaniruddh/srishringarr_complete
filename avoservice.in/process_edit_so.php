<? session_start();
include('config.php');

$select = $_POST['select_product'];
$po_id = $_POST['po_id'];
$po_qty = $_POST['po_qty'];



if(!$po_qty){
    
    foreach($select as $key => $value){
        $sql = mysqli_query($con1,"select * from po_assets where assettrack_id='".$value."'");
        $sql_result = mysqli_fetch_assoc($sql);
        $po_qty[]=$sql_result['qty'];
    }
}


$date = date('Y-m-d H:i:s');

$consignee_name = $_POST["consignee_name"];
$city = $_POST["city"];
$area = $_POST["area"];
$address = $_POST["address"];
$pincode = $_POST['pincode'];

$site_branch = $_POST["site_branch"];
$state = $_POST["state"];

$statesql=mysqli_query($con1,"select * from state where state_id='".$state."'");
$state_result = mysqli_fetch_assoc($statesql);
$state_name = $state_result['state'];

$contact_person_name = $_POST["contact_person_name"];
$contact_person_mobile = $_POST["contact_person_mobile"];
$email_to = $_POST["email_to"];
$DO_no=$_POST['do_no'];
$so_by = $_SESSION['logid'];
$inst_request=$_POST['is_install'];
$buyback = $_POST['buyback'];
$po_custid=$consignee;
$del_type = $_POST['del_type'];
$delivered_to = $_POST['delivered_to'];


$so_trackid = $_GET['id'];

if($so_trackid){
    $sales_sql = "update new_sales_order set branch_id = '".$delivered_to."',del_type='".$del_type."',bb_available='".$buyback."',inst_request='".$inst_request."',user_cont_name='".$contact_person_name."',user_cont_phone='".$contact_person_mobile."',user_mail='".$email_to."',DO_no='".$DO_no."' where so_trackid='".$so_trackid."'";
    mysqli_query($con1,$sales_sql);


// SalesOrderAssets Table

$i = 0;

foreach($select as $key=>$val){
    
    $sql=mysqli_query($con1,"select * from po_assets where assettrack_id = '".$val."'");
    $sql_result=mysqli_fetch_assoc($sql);
    $asset_name  = $sql_result['assets_name'];
    $po_capacity = $sql_result['po_capacity'];
    $po_model    = $sql_result['po_model'];
    $po_specification = $sql_result['specs'];
    $po_validity = $sql_result['warranty'];
    $po_rate     = $sql_result['rate'];
    
    if($po_qty[$i]>0){
        
        $sales_order_sql = "update new_sales_order_asset set po_qty='".$po_qty[$i]."' where so_assetID='".$val."'";
        mysqli_query($con1,$sales_order_sql);
        $i++;
    }
}
   
    // End SalesOrderAssets Table
    
 
    // start buyback table
    
    $is_buyback = $_POST['buyback'];
    $buyback_product = $_POST['buyback_product'];
    $buyback_cap = $_POST['buyback_cap'];
    $buyback_qty = $_POST['buyback_qty'];
    $buyback_value = $_POST['buyback_value'];
    
    if($buyback==0){
        $buyback = 'NO';
    }else{
        $buyback = 'Yes';
    }
    
    $buyback_sql = "update new_buyback set bb_available='".$buyback."',bb_Product='".$buyback_product."',bb_cap='".$buyback_cap."',bb_qty='".$buyback_qty."',bb_value='".$buyback_value."' where so_trackid='".$so_trackid."'";
    mysqli_query($con1,$buyback_sql);    
    

    // end buyback table
    
    // start po_consumption
    $j = 0; 
    foreach($select as $key=>$val){
    
    $po_product = $val;
    $check_sql= mysqli_query($con1,"select * from po_consumption where po_trackid='".$po_id."' and po_product='".$po_product."'");
    $check_sql_result= mysqli_fetch_assoc($check_sql);
    $total_qty = $check_sql_result['po_qty'];
    $prev_consume_qty = $check_sql_result['po_consumqty'];
    $new_consume_qty = $prev_consume_qty + $po_qty[$j];
    
    if($check_sql_result){
        if($total_qty >= $new_consume_qty){
            mysqli_query($con1,"update po_consumption set po_consumqty='".$new_consume_qty."' where po_trackid='".$po_id."' and po_product='".$val."'");
    }
        else{
            echo '<script>
            alert("selected PO quantity is higher than expected !! ");
            </script>';
        }
    }
    
    
    if($total_qty == $new_consume_qty){
        mysqli_query($con1,"update po_consumption set po_status='0' where po_trackid='".$po_id."' and po_product='".$val."'");
            }
            else{
                mysqli_query($con1,"update po_consumption set po_status='1' where po_trackid='".$po_id."' and po_product='".$val."'");
            }
     $j++;
}

// end po_consumption

$atm_insert = $_POST['insert_site'];

// if($atm_insert){

    $purchase_sql=mysqli_query($con1,"select * from purchase_order where id='".$po_id."'");
    $purchase_sql_result = mysqli_fetch_assoc($purchase_sql);
    $po_date = $purchase_sql_result['po_date'];
   
    $atm_sql = "update demo_atm set bank_name='".$consignee_name."', area='".$area."', pincode= '".$pincode."', city= '".$city."', branch_id='".$site_branch."',  address='".$address."', DO_no='".$DO_no."', state='".$state_name."' where so_id='".$so_trackid."'";
    // echo $atm_sql;
    mysqli_query($con1,$atm_sql);
    
}


?>

<script>    
 <?php   if (mysqli_query($con1,$atm_sql)) { ?>
    alert("Sales order Updated successfully !! the sales id for your reference is <? echo $so_trackid;?>");
    <? } ?>
    setTimeout(function() { 
        window.location.href="view_so.php?id=<? echo $so_trackid; ?>";
    }, 1500);
</script>