<? session_start();
include('config.php');




if(!isset($_POST['select_product'])){
    
    echo '<script>alert("Please select a product");
          window.history.back();
    </script>';


}



function get_spec_id($name){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from assets_specification where name LIKE'%".$name."%'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['ass_spc_id'];
}



 function string_between_two_string($str, $starting_word, $ending_word) 
{ 
    $subtring_start = strpos($str, $starting_word);
    $subtring_start += strlen($starting_word);
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    return substr($str, $subtring_start, $size);   
} 


function get_po_id($po_id){
    
    global $con1;
    

    $sql = mysqli_query($con1,"select * from purchase_order where po_no='".$po_id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['id'];
    
}




function get_new_sales_order_data($parameter, $id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select $parameter from new_sales_order where so_trackid='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}


/*

["frmpg"]
["so_id"]
["sub"]
["callid"]
*/



/*["po_qty"]
["buybkdesc"]
["adate"]
["state_st"]
["branch_avo"]
*/


$demo_atm_id = $_POST['demo_atm_id'];
$doc = $_POST["doc"];
$sub = $_POST["sub"];
$custid = $_POST["cust"];
$asset = $_POST["assetsme"];
$problem = $_POST["prob"];
$cname = $_POST["cname"];
$cphone =$_POST["cphone"];
$is_email = $_POST["em"];
$cemail = $_POST["cemail"];
$cc = $_POST["cc"];
$ccemail = $_POST["ccemail"];

$cdate = date('Y-m-d');




function get_state_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from state where state_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $state_name = $sql_result['state'];
    
    return $state_name;
}


function get_branch($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch = $sql_result['avo_branch'];
    
    return $branch;
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







$select = $_POST['select_product'];
$date = date('Y-m-d H:i:s');

$po_id = $_POST['po'];

$po = get_po_id($po_id);

$atmid = $_POST['ref_id'];
$po_qty = $_POST['po_qty'];




// save consignee details

$site_id = $_POST["ref_id"];


$so_trackid = $_GET['id'];






if($demo_atm_id){
    




// insert atm

$demo_atm_sql = mysqli_query($con1,"select * from demo_atm where so_id='".$so_trackid."'");

$demo_atm_sql_result = mysqli_fetch_assoc($demo_atm_sql);


$atm_id = $demo_atm_sql_result['atm_id'];
$cust_id = $demo_atm_sql_result['cust_id'];
$bank_name = $demo_atm_sql_result['bank_name'];
$area = $demo_atm_sql_result['area'];
$pincode = $demo_atm_sql_result['pincode'];
$city = $demo_atm_sql_result['city'];

$atmdate = $demo_atm_sql_result['so_date'];
$address = $demo_atm_sql_result['address'];

// $branch_id = $demo_atm_sql_result['branch_id'];
// $state = $demo_atm_sql_result['state'];



$branch_id = $_POST['branch_avo'];
$state = $_POST['state_st'];



$check_atm_sql = mysqli_query($con1,"select * from atm where atm_id='".$demo_atm_id."'");

$check_atm_sql_result = mysqli_fetch_assoc($check_atm_sql);


if($check_atm_sql_result){



    echo '<script>
    alert(THIS ATM ID IS ALREADY IN USE.. PLEASE SELECT A DIFFERENT NAME FOR ATM ID);
  window.history.back();

    </script>';
    
    // $update_atm = "update atm set cust_id='".$cust_id."', bank_name='".$bank_name."',area='".$area."',pincode='".$pincode."',city='".$city."',branch_id='".$branch_id."',start_date='".$start_date."',address='".$address."',po='".$po."',servicetype='".$servicetype."',podate='".$atmdate."',expdt='".$expdt."',state1='".$state."',service_date1='".$service_date1."',service_date2='".$service_date2."',service_date3='".$service_date3."',so_id='".$so_trackid."' where atm_id='".$atm_id."'";
    
    // mysqli_query($con1,$update_atm);

    // $site_asset_call_id = $check_atm_sql_result['track_id'];
    
}
else{
    mysqli_query($con1,"insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po,servicetype,podate,expdt,state1,service_date1,service_date2,service_date3,so_id) values('".$_POST['demo_atm_id']."','".$cust_id."','".$_POST['demo_bank_name']."','".$_POST['demo_area']."','".$_POST['demo_pincode']."','".$_POST['demo_city']."','".$_POST['demo_branch']."','".$start_date."','".$_POST['demo_address']."','".$po."','".$servicetype."','".$atmdate."','".$expdt."','".$_POST['state']."','".$service_date1."','".$service_date2."','".$service_date3."','".$so_trackid."')");

$site_asset_call_id = mysqli_insert_id();

}


// insert site asset

for($i=0;$i<count($asset);$i++)
{
    
$strhy=explode("-",$asset[$i]);

     $asstre = $strhy[0];
	$qtyre = $strhy[1];
	
	$qtyex=explode("*",$qtyre);
	$qtyfinal=$qtyex[0];
	$valid=$qtyex[1];

$model = string_between_two_string($asstre, '(', ')');


$asstre = str_replace('('.$model.')', '', $asstre);

$asstre  = preg_replace('/[^a-zA-Z0-9_ -]/s','',$asstre);








$valid = $valid.' months';





$serialno=  '1';




mysqli_query($con1,"INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, serialno, type, rate, status, callid,so_id) VALUES ('".$custid."', '".$po_id."', '".$asstre."','".get_spec_id($model)."', '".$valid."', '".$po_qty[$i]."', '".$_POST['demo_atm_id']."', '".$serialno."', 'NEW', '', '0', '".$site_asset_call_id."','".$so_trackid."')");

}




// insert alert
// $qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
// $qry2ro=mysqli_fetch_row($qry2);
// $qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
// 	$num=mysqli_num_rows($qrr);
// 	$num2=$num+1;
// 	if($num2>0 && $num2<=9)
// 	$num3="0".$num2;
// 	else
// 	$num3=$num2;




// $query=mysqli_query($con1,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`, `pincode`, `problem`, `caller_name`, `caller_phone`, `caller_email`, `entry_date`, `alert_date`, `call_status`, `alert_type`, `po`,`state1`, `createdby`,`subject`,`custdoctno`,`assetstatus`) Values('".$custid."','".$_POST['demo_atm_id']."', '".$_POST['demo_bank_name']."','".$_POST['demo_area']."','".$_POST['demo_address']."','".$_POST['demo_city']."','".$_POST['demo_branch']."','".$_POST['demo_pincode']."','".$problem."','".$cname."','".$cphone."','".$cemail."','".$cdate."','".$cdate."','Pending','new','".$po_id."','".$state."','".$qry2ro[0]."_".date("ymd").$num3."', '".$sub."', '".$doc."', 'site')");






// start so_consumption



$j = 0; 
foreach($select as $key=>$val){
    
    $po_product = $val;
    
    

    $check_sql= mysqli_query($con1,"select * from so_consumption where po_trackid='".get_po_id($po_id)."' and po_product='".$po_product."'");
    

    $check_sql_result= mysqli_fetch_assoc($check_sql);
    
    
    $total_qty = $check_sql_result['po_qty'];
            
        $prev_consume_qty = $check_sql_result['po_consumqty'];
        $new_consume_qty = $prev_consume_qty + $po_qty[$j];
    
    if($check_sql_result){
        
        if($total_qty >= $new_consume_qty){


            mysqli_query($con1,"update so_consumption set po_consumqty='".$new_consume_qty."' where po_trackid='".get_po_id($po_id)."' and po_product='".$val."'");
        }
        else{
            
            echo '<script>
            alert("selected PO quantity is higher than expected !! ");
            </script>';

        }

          
            
    }
else{
    
    
    $sql=mysqli_query($con1,"select * from new_sales_order_asset where so_trackid = '".$so_trackid."' and so_assetID='".$val."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    
    
    
    $asset_name  = $sql_result['po_product'];
    $so_assetID = $sql_result['so_assetID'];
    $po_model    = $sql_result['po_model'];
    
    $po_validity = $sql_result['po_warr'];
    
    $po_quantity = $sql_result['po_qty'];
    

    
    
    if($po_quantity == $po_qty[$j]){
    $po_status = '0';
    }
    else{
            $po_status = '1';
    }
    

    
     $consumption_sql = "insert into so_consumption(po_trackid,so_trackid,po_product,po_model,po_cap,po_qty,po_consumqty,po_status) values('".get_po_id($po_id)."','".$so_trackid."','".$po_product."','".$po_model."','".$po_cap."','".$po_quantity."','".$po_qty[$j]."','".$po_status."')";
    
    // echo $consumption_sql;
    mysqli_query($con1,$consumption_sql);
    

   
}

  if($total_qty == $new_consume_qty){
                
                mysqli_query($con1,"update so_consumption set po_status='0' where po_trackid='".$po_id."' and po_product='".$val."'");
    
            }
     $j++;
}




}



if($query)
{

if(isset($_POST['em'])){
function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}
$cc=implode(",",extract_email_address($_POST['ccemail']));
$mailto=$cemail;
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";

$tbl.="<tr><td>".$qry2ro[0]."_".date("ymd").$num3."</td><td>".$_POST['ref_id']."</td><td>".$_POST['bank']."</td><td>".$_POST['state_st']."</td><td>".$_POST['city']."</td><td>".$_POST['address']."</td><td>New Installation at Site</td><td><b>Pending</b></td></tr>";



//print_r($cc);
$subject=$qry2ro[0]."_".date("ymd").$num3." <Switching AVO Electro Power Limited>";
//echo "<br>";
$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";
//echo $tbl."<br>";
//echo $mailto." ".$cc;
$headers = "From: Switching AVO Electro Power Limited\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$headers .= "Cc: ".$cc."\r\n";
			//echo $tbl;
			$message=$tbl;
			if(isset($_POST['em']))
			{
			mail($mailto, $subject, $message, $headers);
			}

}
}

?>

<script type="text/javascript">
    
    alert("Alert created successfully and complaint number is <?php echo $qry2ro[0]."_".date("ymd").$num3; ?>");
    
    
    setTimeout(function() { 
       
      window.location='view_ware_noninstall.php';
    
    }, 2500);
    
</script>