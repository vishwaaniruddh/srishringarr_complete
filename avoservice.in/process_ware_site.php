<? session_start();
include('config.php');

if(!isset($_POST['select_product'])){
    
    echo '<script>alert("Please select a product");
          window.history.back();
    </script>';

}


 function string_between_two_string($str, $starting_word, $ending_word) 
{ 
    $subtring_start = strpos($str, $starting_word);
    $subtring_start += strlen($starting_word);
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    return substr($str, $subtring_start, $size);   
} 


$demo_atm_id = $_POST['demo_atm_id'];
$doc = mysqli_real_escape_string($con1,$_POST["doc"]);
$sub = mysqli_real_escape_string($con1,$_POST["sub"]);
$cust_id = $_POST["cust"];
$asset = $_POST["assetsme"];
$problem = mysqli_real_escape_string($con1,$_POST["prob"]);
$cname = mysqli_real_escape_string($con1,$_POST["cname"]);
$cphone =mysqli_real_escape_string($con1,$_POST["cphone"]);
$is_email = mysqli_real_escape_string($con1,$_POST["em"]);
$cemail = mysqli_real_escape_string($con1,$_POST["cemail"]);
$cc = mysqli_real_escape_string($con1,$_POST["cc"]);
$ccemail = mysqli_real_escape_string($con1,$_POST["ccemail"]);
$cdate = date('Y-m-d');
$edate = date('Y-m-d H:i:s');
$select = $_POST['select_product'];
$po_no = $_POST['po'];
$atmid_ref = $_POST['ref_id'];
$po_qty = $_POST['po_qty'];
$so_trackid = $_GET['id'];
$start_date = date("Y-m-d") ;



$bank= mysqli_real_escape_string($con1,$_POST['demo_bank_name']);
$area= mysqli_real_escape_string($con1,$_POST['demo_area']);
$city= mysqli_real_escape_string($con1,$_POST['demo_city']);
$address= mysqli_real_escape_string($con1,$_POST['demo_address']);
$pincode= mysqli_real_escape_string($con1,$_POST['demo_pincode']);

if($pincode=='') {$pincode='NULL'; }
if($city=='') {$city='NULL'; }
if($area=='') {$area='NULL'; }
if($ccemail=='') {$ccemail='NULL'; }
if($problem=='') {$problem='NULL'; }

$branch_id = $_POST['branch_avo'];
$state = $_POST['state_st'];

mysqli_query($con1,"BEGIN");

$poqry = mysqli_query($con1,"select * from purchase_order where po_no='".$po_no."'");
$porow = mysqli_fetch_assoc($poqry);
$po_id = $porow['id'];    
$po_date= $porow['po_date']; 

$error=0;
//================so consumtion

for($i=0;$i<count($asset);$i++)
{
    
$strhy=explode("*",$asset[$i]);

$so_asstid=$strhy[0];
     $soasst_name = $strhy[1];
     $so_model=$strhy[2];
	$so_qty = $strhy[3];
	$valid=$strhy[4];
	
$so_consmqry= mysqli_query($con1,"select * from so_consumption where so_trackid='".$so_trackid."' and po_product='".$so_asstid."'");
   
    
if(mysqli_num_rows($so_consmqry) > 0 ) {
} else {
    
     $so_cons_row= mysqli_fetch_assoc($so_consmqry);
   
    $so_cons_insert = "insert into so_consumption(po_trackid,so_trackid,po_product,po_model,po_cap,po_qty,po_consumqty,po_status) values('".$po_id."','".$so_trackid."','".$so_asstid."','".$so_model."','0','".$so_qty."','0','1')";
    mysqli_query($con1,$so_cons_insert);
   
        }

} 

if($demo_atm_id){

$check_atm_sql = mysqli_query($con1,"select * from atm where atm_id='".$demo_atm_id."'");

$check_atm_sql_result = mysqli_fetch_assoc($check_atm_sql);


if($check_atm_sql_result){

    echo '<script>
    alert(This Site ID is already exists. Please Use differnt Site Id);
  window.history.back();

    </script>';

}
else{
    
//echo "insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po,podate,state1,so_id, ref_id,site_type) values('".$demo_atm_id."','".$cust_id."','".$bank."','".$area."','".$pincode."','".$city."','".$branch_id."','".$start_date."','".$address."','".$po_no."','".$po_date."','".$state."','".$so_trackid."', '".$atmid_ref."', 'ware_del')";

  $atm_insert= mysqli_query($con1,"insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po,podate,state1,so_id, ref_id,site_type) values('".$demo_atm_id."','".$cust_id."','".$bank."','".$area."','".$pincode."','".$city."','".$branch_id."','".$start_date."','".$address."','".$po_no."','".$po_date."','".$state."','".$so_trackid."', '".$atmid_ref."', 'ware_del')");
$atmtrackid = mysqli_insert_id($con1);

if(!$atm_insert) {
    $error++ ;
    $err_name="Not entered in Warranty";
}


}

//================ insert site asset OLD=======


$j = 0; 
foreach($select as $key=>$val){
    
    if($po_qty !=0 or $po_qty !='') {
    $so_assetid = $val;
    
    $so_assetqtry= mysqli_query($con1,"select * from new_sales_order_asset where so_trackid='".$so_trackid."' and so_assetID='".$so_assetid."'");
    
    $so_asstr= mysqli_fetch_assoc($so_assetqtry);
    $asst_name=$so_asstr['po_product'];
    $s_model=$so_asstr['po_model'];
    $valid=$so_asstr['po_warr'];
$serialno=  '1';

//echo "<br> INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, serialno, type, rate, status, callid,so_id,atm_trackid, entry_dt, start_date,po_date, alert_id) VALUES ('".$cust_id."', '".$po_no."', '".$asst_name."','".$s_model."', '".$valid."', '".$po_qty[$j]."', '".$atmtrackid."', '".$serialno."', 'NEW', '0', '1', '0','".$so_trackid."', '".$atmtrackid."', '".$edate."', '".$cdate."', '".$po_date."', '0')";

$site_insert=mysqli_query($con1,"INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, serialno, type, rate, status, callid,so_id,atm_trackid, entry_dt, start_date,po_date, alert_id) VALUES ('".$cust_id."', '".$po_no."', '".$asst_name."','".$s_model."', '".$valid."', '".$po_qty[$j]."', '".$atmtrackid."', '".$serialno."', 'NEW', '0', '1', '0','".$so_trackid."', '".$atmtrackid."', '".$edate."', '".$cdate."', '".$po_date."', '0')");
if(!$site_insert){
    $error++;
    $err_name="Site Assets Not entered";
}

$socon_up = mysqli_query($con1,"select * from so_consumption where so_trackid='".$so_trackid."' and po_product='".$so_assetid."'");
$consump=mysqli_fetch_assoc($socon_up);

         $total_qty = $consump['po_qty'];
        $prev_consume_qty = $consump['po_consumqty'];
        $new_consume_qty = $prev_consume_qty + $po_qty[$j];
        
      if($total_qty > $new_consume_qty){

    $update_con= mysqli_query($con1,"update so_consumption set po_consumqty='".$new_consume_qty."' where so_trackid='".$so_trackid."' and po_product='".$so_assetid."'");
        } elseif ($total_qty == $new_consume_qty){
    $update_con= mysqli_query($con1,"update so_consumption set po_consumqty='".$new_consume_qty."', po_status=0 where so_trackid='".$so_trackid."' and po_product='".$so_assetid."'");
 }else{
            
            echo '<script>
            alert("selected PO quantity is higher than expected !! ");
            </script>';
$error++;
$err_name="SO Consumption Not Updated";
        }
  $j++;
    } else {  echo '<script>
            alert("One Product selected value either Zero or Blank !! ");
            </script>';
$error++;
$err_name="SO Consumption Not Updated";
}


}

}

if($error ==0)
{
mysqli_query($con1,"COMMIT");

 ?>

<script type="text/javascript">

    
    alert("Site Added Succefully in Warranty ");

    setTimeout(function() { 
      
      window.location='view_ware_noninstall.php';
    
    }, 2500);
    
</script>

<? } else 
mysqli_query($con1,"ROLLBACK");
die('Failed :<br>'.$err_name."<br>---".mysqli_error($con1));
?>
<script type="text/javascript">
    
    alert("Soemthing Went Wrong!! You must check all the fields and data ");
    
    
    setTimeout(function() { 
      
     window.history.back();
    
    }, 2500);
    
</script>