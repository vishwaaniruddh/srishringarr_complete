<? session_start();
include('config.php');
include("access.php");

include("Whatsapp_delegation/delegation_fun.php");

// echo '<br><br>';
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


function is_atm_exist($name){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from atm where atm_id='".$name."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    if($sql_result){
        
        return true;
        
    }
    else{
        return false;
    }
    

}


function get_atm_data($parameter, $id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select $parameter from atm where atm_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}

$date = date('Y-m-d H:i:s');


$custid = $_POST['cust_id'];
$buyerid = $_POST['buyerid'];
$po = $_POST['purchase_order'];
$atmid = trim($_POST['site_id']);


// save consignee details

$site_id = trim($_POST["site_id"]);                                // ATM ID
$consignee_name = mysqli_real_escape_string($con1,$_POST["consignee_name"]);
$city = mysqli_real_escape_string($con1,$_POST["city"]);
if($city==''){ $city='NULL';}
$area = $_POST["area"];
if($area==''){ $area='NULL';}

$address = mysqli_real_escape_string($con1,$_POST["address"]);
$pincode = $_POST['pincode'];
if($pincode==''){ $pincode='NULL';}

 
$contact_person_name = trim($_POST["contact_person_name"]);
$contact_person_mobile = $_POST["contact_person_mobile"];
$email_to = $_POST["email_to"];
if($email_to==''){ $email_to='NULL';}
$DO_no=$_POST['do_no'];
if($DO_no==''){ $DO_no='NULL';}
$so_by = $_SESSION['logid'];
$inst_request=$_POST['is_install'];
$buyback = $_POST['buyback'];

$del_type = $_POST['del_type'];

$delivered_to = $_POST['delivered_to']; /// Delivery branch in SO table

$remarks = mysqli_real_escape_string($con1,$_POST['remarks']);
$whatsno=$_POST['whatsno'];
if($whatsno==''){ $whatsno='NULL';}

/*function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}*/

$ccmail=$_POST['ccmail'];
if($ccmail==''){ $ccmail='NULL';}


$avo_branch = $_POST["avo_branch"];
$state = $_POST["state"];

$same_customer = $_POST['same_customer'];
if($same_customer=='on'){
$buyerqry=mysqli_query($con1,"select * from buyer where buyer_ID='".$buyerid."'");
    $buyerrow = mysqli_fetch_assoc($buyerqry);
    $avo_branch = $buyerrow['avo_branch'];
    $state_id = $buyerrow['buyer_state'];
}
else 
{
 $state_id = $state;   
$avo_branch = $_POST["avo_branch"];
}

$stateqr=mysqli_query($con1,"select * from state where state_id='".$state_id."'");
    
    $statero = mysqli_fetch_assoc($stateqr);
    $state_name = $statero['state'];



if(is_atm_exist($site_id) == true){
    
    $avo_branch = get_atm_data('branch_id',$site_id);
    
    $state_name = get_atm_data('state1',$site_id);
    
}


if($po_id){
mysqli_query($con1,"BEGIN");
$errors=0;

if($del_type==''){ $errors++; $errname.="Select Delivery Type"; } 
else if($buyback==''){ $errors++; $errname.="Select Buyback Type"; }


$sales_sql="insert into new_sales_order(po_trackid,DO_no,po_custid,buyerid,so_by,atm_id,inst_request,user_cont_name,user_cont_phone,user_mail,bb_available,status,do_date,del_type,branch_id, so_time, remarks, ccmail, whatsapp) VALUES('".$po_id."','".$DO_no."','".$custid."','".$buyerid."','".$so_by."','".$atmid."','".$inst_request."','".$contact_person_name."','".$contact_person_mobile."','".$email_to."','".$buyback."','1','".$date."','".$del_type."','".$delivered_to."','".$date."',  '".$remarks."', '".$ccmail."', '".$whatsno."')";

$newso=mysqli_query($con1,$sales_sql);
$so_trackid = mysqli_insert_id($con1);

if(!$newso){
  $errors++;
  $errname.="New SO Insert Error!! Check Field / Char Lengths";
} 

//===== Demo atm insert==========
 $purchase_sql=mysqli_query($con1,"select * from purchase_order where id='".$po_id."'");
    
    $purchase_sql_result = mysqli_fetch_assoc($purchase_sql);
    
    $po_date = $purchase_sql_result['po_date'];
    
    $atm_sql = "insert into demo_atm(atm_id, cust_id, so_id,so_date,po_trackid,bank_name, area, pincode, city, branch_id,  address, DO_no, state, pending_status) values('".$atmid."', '".$custid."', '".$so_trackid."','".$date."','".$po_id."','".$consignee_name."', '".$area."', '".$pincode."', '".$city."','".$avo_branch."', '".$address."', '".$DO_no."' , '".$state_name."', '1')";

  $atmqr=mysqli_query($con1,$atm_sql);

if(!$atmqr){
  $errors++;
  $errname.="New Consignee Details Error!! Check Field / Char Lengths";

} 

//====== SalesOrderAssets Table

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

    $sales_order_sql = "insert into new_sales_order_asset(so_trackid,po_trackid,po_product,po_model,po_qty,po_warr,po_rate) values('".$so_trackid."','".$po_id."','".$asset_name."','".$po_specification."','".$po_qty[$i]."','".$po_validity."','".$po_rate."')";
    
    }

    
    $asset=mysqli_query($con1,$sales_order_sql);
    
    $so_assetID[] = mysqli_insert_id($con1);
    $i++;

    }

    if(!$asset) {
      $errors++;
  $errname.="New Asset Error!! Check Field / Char Lengths";   
    } 

    
    // =============start buyback table
    $is_buyback = $_POST['buyback'];
    $bb_prud = $_POST['buyback_product'];
    $buyback_product = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $bb_prud);
    
   // $buyback_product = mysqli_real_escape_string($con1,$buyback_pr);
    $buyback_cap = mysqli_real_escape_string($con1,$_POST['buyback_cap']);
    $buyback_qty = mysqli_real_escape_string($con1,$_POST['buyback_qty']);
    $buyback_value = mysqli_real_escape_string($con1,$_POST['buyback_value']);
    
    
    if($is_buyback=='1' || $is_buyback==1){
        
        $buyback_sql ="insert into new_buyback(so_trackid,bb_available,bb_Product,bb_cap,bb_qty,bb_value) values('".$so_trackid."','Yes','".$buyback_product."','".$buyback_cap."','".$buyback_qty."','".$buyback_value."')";
        
      
        $bb=mysqli_query($con1,$buyback_sql);
        
    if(!$bb) {
      $errors++;
  $errname.=" Buyback Insert Error!! Check Field / Char Lengths";   
    }    
            
    }
   
    
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
else{
    
    
     $sql=mysqli_query($con1,"select * from po_assets where assettrack_id = '".$val."'");
    $sql_result=mysqli_fetch_assoc($sql);
    

    $asset_name  = $sql_result['assets_name'];
    $po_cap = $sql_result['po_capacity'];
    $po_model    = $sql_result['specs'];
    $po_validity = $sql_result['warranty'];
    $po_rate     = $sql_result['rate'];
    $po_quantity = $sql_result['qty'];
    
    
    if($po_quantity == $po_qty[$j]){
    $po_status = '0';
    }
    else{
            $po_status = '1';
    }
    

    
     $consumption_sql = "insert into po_consumption(po_trackid,so_trackid,po_product,po_model,po_cap,po_qty,po_consumqty,po_status,so_assetID) values('".$po_id."','".$so_trackid."','".$po_product."','".$po_model."','0','".$po_quantity."','".$po_qty[$j]."','".$po_status."','".$so_assetID[$j]."')";
  
   
    mysqli_query($con1,$consumption_sql);
   

   
}

  if($total_qty == $new_consume_qty){
                
                mysqli_query($con1,"update po_consumption set po_status='0' where po_trackid='".$po_id."' and po_product='".$val."'");
    
            }
     $j++;
}

// end po_consumption

$atm_insert = $_POST['insert_site'];


//============whatsapp======================Mail=========
		
$qryal=mysqli_query($con1,"Select * from new_sales_order where so_trackid='".$so_trackid."'");
$sorow=mysqli_fetch_row($qryal);

$poqry=mysqli_query($con1,"Select po_no from purchase_order where id='".$sorow[1]."'");
$po=mysqli_fetch_row($poqry);

$cusal=mysqli_query($con1,"Select cust_name from customer where cust_id='".$sorow[3]."'");
$cust=mysqli_fetch_row($cusal);

$brqry=mysqli_query($con1,"Select name from avo_branch where id='".$sorow[4]."'");
$br=mysqli_fetch_row($brqry);


$atmqry=mysqli_query($con1,"select * from demo_atm where so_id='".$so_trackid."'");
$atmrow=mysqli_fetch_row($atmqry);

$executive_qry = mysqli_query($con2,"SELECT exe_contact FROM salesteam where exe_id = '".$po[11]."'");
$exec=mysqli_fetch_row($executive_qry);
$exe_mob=$exec[0];

        $MassageNew = "[SO] *Switching AVO Electro Power Ltd*";
        $Massage1="*Internal Sales Order raised against your PO:* ".$po[0];
        $Massage2="Materials will be billed & dispatched Shortly !!";
        $Massage3="======== Details ========";
        $Massage4="*Vertical:* ".$cust[0];
        $Massage5="*Site /Sol / ATM Id:* ".$sorow[7];
        $Massage6="*End User Name:* ".$atmrow[6] ;
        $Massage7="*Delivery Address:* ".$atmrow[11] ;
        $Massage8="*State:* ".$atmrow[13] ;
        $Massage9="*Remarks:* We try our best to dispatch & deliver the materials at the earliest subject to stock & transport availability"."\n"."You will get the next update very soon !!";
        $Massage10="*Note:* Keep This site / Sol / ATM Id: *".$sorow[7]."* as reference / Track id for any support till the Expiry of Warranty!!";
        
$exe_mob=$exec[0]; 
$cmobile=$sorow[10];
$gmobile=$sorow[19];
$whats_no=$exe_mob.",".$cmobile.",".$gmobile;
//$whats_no=$exe_mob;

$allMessage = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8."\n".$Massage9."\n".$Massage10;

SendWhatmsg($whats_no,$allMessage);	



//================mail==========================

$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<table border='1' width='700px'>
<tr>
	
	<th>Site/Sol ID</th>
	<th>Customer</th>
	<th>End User</th>
	<th>City</th>
	<th>Address</th>
	<th>AVO Branch</th>
	<th>DO No</th>
	<th>Asset Details</th>
	
</tr>";
$tbl.="<tr>
		<td>".$sorow[7]."</td>
		<td>".$cust[0]."</td>
		<td>".$atmrow[6]."</td>
		<td>".$atmrow[9]."</td>
		<td>".$atmrow[11]."</td>
		<td>".$br[0]."</td>
		<td>".$sorow[2]."</td>
	
		
		
	</tr>";	
	
	$to = $sorow[11];
	$cc=$sorow[18];
	$subject = "Sales Order for site id:- ".$sorow[7]." has been generated";
	
	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			<br><br><font color='blue'>SO Raised By:</font> <font color='red'>".$_SESSION['user']."</font> </body></html>";
	$headers = "From:<e_salesorder@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	
	$mailqry=mail($to, $subject, $message, $headers);

}
if($errors==0)
{
    mysqli_query($con1,"COMMIT");
?>
<script>
    alert("Sales order created successfully !! the sales id for your reference is <? echo $so_trackid;?>");
    
    setTimeout(function() { 
       
      window.location.href="view_sales_order.php";
    
    }, 1500);
    
</script>
<? } else {
mysqli_query($con1,"ROLLBACK");

die('Failed to Insertable.:<br>'.$errname."<br>".mysqli_error($con1));

}
?>