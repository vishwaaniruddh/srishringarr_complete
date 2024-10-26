<?php
session_start();


include_once 'andi/GCM.php';
include("config.php");

//echo $_SESSION['designation'];



$so_id = $_POST['so_id'];

$cust=$_POST['cust'];
$bank=mysqli_real_escape_string($con1, $_POST['bank']);
$state=$_POST['state_st'];
$branch_id=$_POST['branch_avo'];

$city=mysqli_real_escape_string($con1,$_POST['city']);
$area=mysqli_real_escape_string($con1,$_POST['area']);
$add=mysqli_real_escape_string($con1,$_POST['address']);
$pin=$_POST['pin'];
$adate=$_POST['adate'];

$prob=mysqli_real_escape_string($con1,$_POST['prob']);
$cname=mysqli_real_escape_string($con1,$_POST['cname']);
$cphone=mysqli_real_escape_string($con1,$_POST['cphone']);
$cemail=mysqli_real_escape_string($con1,$_POST['cemail']);
$ccmail = mysqli_real_escape_string($con1,$_POST['ccemail']);
$cdate = date('Y-m-d H:i:s');
$start_date= date('Y-m-d');
$po=$_POST['po'];
$asset=$_POST['assetsme'];

 $atmid = $_POST['ref_id'];
 
$po_qty = $_POST['po_qty'];
$so_order_id = $_POST['so_order_id'];


if($ccmail=='') {$ccmail='NULL';}


$poqry = mysqli_query($con1,"select * from purchase_order where po_no='".$po."'");

$porow = mysqli_fetch_assoc($poqry);
$poid = $porow['id'];    
$po_date= $porow['po_date']; 

//echo $poid."---".$add;

 //var_dump($_POST);
// return;


 function string_between_two_string($str, $starting_word, $ending_word) 
{ 
    $subtring_start = strpos($str, $starting_word);
    $subtring_start += strlen($starting_word);
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    return substr($str, $subtring_start, $size);   
} 
  
  
//echo $poid."-2233--".$add;  

function get_cust_id($name,$con1){
    
    global $con;
    
    $sql = mysqli_query($con1,"select * from customer where cust_name='".$name."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['cust_id'];
}


 $custid = get_cust_id($cust,$con1);

include("config.php");

//echo "select * from demo_atm where so_id='".$so_id."'";

$demo_atm_sql = mysqli_query($con1,"select * from demo_atm where so_id='".$so_id."'");

$demo_atm_sql_result = mysqli_fetch_assoc($demo_atm_sql);

$atm_id = $demo_atm_sql_result['atm_id'];
$cust_id = $demo_atm_sql_result['cust_id'];
$bank_name = mysqli_real_escape_string($con1,$demo_atm_sql_result['bank_name']);
$area = mysqli_real_escape_string($con1,$demo_atm_sql_result['area']);
$pincode = mysqli_real_escape_string($con1,$demo_atm_sql_result['pincode']);
$city = mysqli_real_escape_string($con1,$demo_atm_sql_result['city']);

$address = mysqli_real_escape_string($con1,$demo_atm_sql_result['address']);
$state = $demo_atm_sql_result['state'];
$sub= mysqli_real_escape_string($con1,$_POST['sub']);
$doc= mysqli_real_escape_string($con1,$_POST['doc']);

if($city=='') { $city='NULL';}
if($pincode=='') { $pincode='NULL';}
if($area=='') { $area='NULL';} 
if($prob=='') { $prob='NULL';}



mysqli_query($con1,"BEGIN");

$errors=0;
$qryatm = mysqli_query($con1,"select * from atm where atm_id='".$atm_id."'");

if(mysqli_num_rows($qryatm)>0){
    
$atmrow=mysqli_fetch_assoc($qryatm);

$track_id=$atmrow['track_id'];

//echo "update atm set cust_id='".$custid."', bank_name='".$bank_name."',area='".$area."',pincode='".$pincode."',city='".$city."',branch_id='".$branch_id."',start_date='".$start_date."',address='".$address."',po='".$po."',podate='".$po_date."',state1='".$state."',so_id='".$so_id."', ref_id='asset_added', site_type='site_del' where track_id='".$track_id."'";

//die;
    
$update_atm = "update atm set cust_id='".$custid."', bank_name='".$bank_name."',area='".$area."',pincode='".$pincode."',city='".$city."',branch_id='".$branch_id."',start_date='".$start_date."',address='".$address."',po='".$po."',podate='".$po_date."',state1='".$state."',so_id='".$so_id."', ref_id='asset_added', site_type='site_del' where track_id='".$track_id."'";
 
    $update=mysqli_query($con1,$update_atm);
    
if(!$update){
  $errors++;
  $table.="update atm set cust_id='".$custid."', bank_name='".$bank_name."',area='".$area."',pincode='".$pincode."',city='".$city."',branch_id='".$branch_id."',start_date='".$start_date."',address='".$address."',po='".$po."',podate='".$po_date."',state1='".$state."',so_id='".$so_id."', ref_id='asset_added', site_type='site_del' where track_id='".$track_id."'"."<br>";
 
  }
} else {
//echo "insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po, podate,state1,so_id, site_type, active) values('".$atm_id."','".$custid."','".$bank_name."','".$area."','".$pincode."','".$city."','".$branch_id."','".$start_date."','".$address."','".$po."','".$po_date."','".$state."','".$so_id."', 'site_del', 'Y')";

//die;
   $insert_atm=mysqli_query($con1,"insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po, podate,state1,so_id, site_type, active) values('".$atm_id."','".$custid."','".$bank_name."','".$area."','".$pincode."','".$city."','".$branch_id."','".$start_date."','".$address."','".$po."','".$po_date."','".$state."','".$so_id."', 'site_del', 'Y')");



    $track_id = mysqli_insert_id($con1);


if(!$insert_atm){
  $errors++;
  $table.="insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po, podate,state1,so_id, site_type, active) values('".$atm_id."','".$custid."','".$bank_name."','".$area."','".$pincode."','".$city."','".$branch_id."','".$start_date."','".$address."','".$po."','".$po_date."','".$state."','".$so_id."', 'site_del', 'Y')";
  }    

}
//==========Alert==========
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);
$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
   
  
   $adate=date('Y-m-d');

//echo "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`, `pincode`, `problem`, `caller_name`, `caller_phone`, `caller_email`, `entry_date`, `alert_date`, `call_status`, `alert_type`, `po`,`state1`, `createdby`,`subject`,`custdoctno`,`assetstatus`, ccmail) Values('".$custid."','".$track_id."','".$bank_name."','".$area."','".$address."','".$city."','".$branch_id."','".$pincode."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$cdate."','".$adate."','1','new','".$po."','".$state."','".$qry2ro[0]."_".date("ymd").$num3."','New Installation','".$doc."','site','".$ccmail."' )";
//die;

$query=mysqli_query($con1,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`, `pincode`, `problem`, `caller_name`, `caller_phone`, `caller_email`, `entry_date`, `alert_date`, `call_status`, `alert_type`, `po`,`state1`, `createdby`,`subject`,`custdoctno`,`assetstatus`, ccmail) Values('".$custid."','".$track_id."','".$bank_name."','".$area."','".$address."','".$city."','".$branch_id."','".$pincode."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$cdate."','".$adate."','1','new','".$po."','".$state."','".$qry2ro[0]."_".date("ymd").$num3."','New Installation','".$doc."','site','".$ccmail."' )");

$last_alert_id = mysqli_insert_id($con1);


if(!$query){
  $errors++;
  $table.="Creating Call Alert is Error";
  }    

//==================New Asset insert======

$sales_order_qry=mysqli_query($con1,"select * from new_sales_order_asset where so_trackid='".$so_id."' ");
$i=0;
while($asset=mysqli_fetch_assoc($sales_order_qry)) {

$product = $asset['po_product'];
$specs = $asset['po_model'];
$qty = $asset['po_qty'];
$valid = $asset['po_warr'];

//echo "INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, type, rate, status, callid,so_id,atm_trackid, start_date, po_date, alert_id) VALUES ('".$custid."', '".$po."', '".$product."','".$specs."', '".$valid."', '".$qty."', '".$track_id."',  'NEW', '0', '1', '0','".$so_id."','".$track_id."','".$start_date."','".$po_date."','".$last_alert_id."')";
//die;

$assetinst=mysqli_query($con1,"INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, type, rate, status, callid,so_id,atm_trackid, start_date, po_date, alert_id) VALUES ('".$custid."', '".$po."', '".$product."','".$specs."', '".$valid."', '".$qty."', '".$track_id."',  'NEW', '0', '1', '0','".$so_id."','".$track_id."','".$start_date."','".$po_date."','".$last_alert_id."')");
$i++ ;

}

if(!$assetinst){
  $errors++;
  $table.="INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, type, rate, status, callid,so_id,atm_trackid, start_date, po_date, alert_id) VALUES ('".$custid."', '".$po."', '".$product."','".$specs."', '".$valid."', '".$qty."', '".$track_id."',  'NEW', '0', '1', '0','".$so_id."','".$track_id."','".$start_date."','".$po_date."','".$last_alert_id."')";
  }  

if($assetinst){
    
   

        $address1=$address.','.$city.','.$state;
        $formattedAddr = str_replace(' ','+',$address1);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI'); 
        $output = json_decode($geocodeFromAddr);
        
        $latitude=$output->results[0]->geometry->location->lat; 
        $longitude=$output->results[0]->geometry->location->lng; 
        
      $updatelat= mysqli_query($con1,"update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$track_id."'");
//=============== Delegation===========
	    
 //$radius = 20; // in miles
      $radius = 50*0.621371192; // in km

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);
  //=========Eng Current Location==========  
 /*   $qry="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM engg_current_location WHERE (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) ORDER BY distance"; */

  //=====Area_engg==================
  $qry="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM area_engg WHERE (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) and status=1 ORDER BY distance";
  
  
   $res=mysqli_query($con1,$qry);
    $num=mysqli_num_rows($res);
    if($num>0){
        $row=mysqli_fetch_row($res);
        
        $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 24 hours"));
         $delegate_flag=1;
         $tab=mysqli_query($con1,"update alert set status='Delegated',call_status='1',eta='".$etdt."' where alert_id='".$last_alert_id."'");
    
        if($tab){
	
		$tab2=mysqli_query($con1,"Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$row[0]."','".$atm_id."','".$last_alert_id."','".$ctime."','".$_SESSION['user']."')");
   
     mysqli_query($con1,"Insert into Delegation_tracking(alertid,del_type,del_date) values('".$last_alert_id."','1','".$ctime."')");
        }     
               
/*$qry1=mysqli_query($con1,"Select gcm_regid from notification_tble where pid='".$row[0]."' AND status='0'");
    
      $max1=mysqli_fetch_row($qry1);

	$str2=$max1[0];

$message2="You have New Alerts";
include_once 'andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message); */
   
}


//=========================Email======================

/*function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}

$cc=implode(",",extract_email_address($ccmail)); */




$mailto=$cemail.", boopathy@avoups.com";
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>Complaint ID</th><th>Site/Sol ID</th><th>End User </th><th>State</th><th>City</th><th>Address</th><th>Call Type</th><th>Status</th></tr>";

$tbl.="<tr><td>".$qry2ro[0]."_".date("ymd").$num3."</td><td>".$atm_id."</td><td>".$bank."</td><td>".$state."</td><td>".$city."</td><td>".$address."</td><td>New Installation Call </td><td><b>Pending</b></td></tr>";



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

//echo "mail sent OKK";
//die;
if($errors==0)
{
$up_so=mysqli_query($con1,"update so_order set status=2, alert_id ='".$last_alert_id."' where id='".$so_order_id."'");

mysqli_query($con1,"COMMIT");
?>
<script type="text/javascript">

alert("Alert created successfully and complaint number is <?php echo $qry2ro[0]."_".date("ymd").$num3; ?>");

 window.location='new_invoices.php';

</script>
<?php } else 
mysqli_query($con1,"ROLLBACK");

die('Failed :<br>'.$table."<br>".mysqli_error($con1));

?>
