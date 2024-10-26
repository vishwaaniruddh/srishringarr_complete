<?php
session_start();


include_once '../andi/GCM.php';
include("../config.php");
//echo $_SESSION['designation'];

$so_id = $_POST['so_id'];

$cust=$_POST['cust'];
$bank=mysql_real_escape_string($_POST['bank']);
$state=$_POST['state_st'];
$branch_id=$_POST['branch_avo'];
$city=mysql_real_escape_string($_POST['city']);
$area=mysql_real_escape_string($_POST['area']);
$add=mysql_real_escape_string($_POST['address']);
$pin=$_POST['pin'];
$adate=$_POST['adate'];

$prob=mysql_real_escape_string($_POST['prob']);
$cname=mysql_real_escape_string($_POST['cname']);
$cphone=mysql_real_escape_string($_POST['cphone']);
$cemail=mysql_real_escape_string($_POST['cemail']);
$ccmail = mysql_real_escape_string($_POST['ccemail']);
$cdate = date('Y-m-d H:i:s');
$start_date= date('Y-m-d');
$po=$_POST['po'];
$asset=$_POST['assetsme'];

 $atmid = $_POST['ref_id'];
 
 $po_qty = $_POST['po_qty'];
$so_order_id = $_POST['so_order_id'];


$poqry = mysql_query("select * from purchase_order where po_no='".$po."'");
$porow = mysql_fetch_assoc($poqry);
$poid = $porow['id'];    
$po_date= $porow['po_date']; 



// var_dump($_POST);
// return;

 function string_between_two_string($str, $starting_word, $ending_word) 
{ 
    $subtring_start = strpos($str, $starting_word);
    $subtring_start += strlen($starting_word);
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    return substr($str, $subtring_start, $size);   
} 
  
  
  

function get_cust_id($name){
    
    global $con;
    
    $sql = mysql_query("select * from customer where cust_name='".$name."'");
    
    $sql_result = mysql_fetch_assoc($sql);
    
    return $sql_result['cust_id'];
}


 $custid = get_cust_id($cust);


//include('../class_files/insert.php');
//$in_obj=new insert();
include("../config.php");




$demo_atm_sql = mysql_query("select * from demo_atm where so_id='".$so_id."'");

$demo_atm_sql_result = mysql_fetch_assoc($demo_atm_sql);

$atm_id = $demo_atm_sql_result['atm_id'];
$cust_id = $demo_atm_sql_result['cust_id'];
$bank_name = mysql_real_escape_string($demo_atm_sql_result['bank_name']);
$area = mysql_real_escape_string($demo_atm_sql_result['area']);
$pincode = mysql_real_escape_string($demo_atm_sql_result['pincode']);
$city = mysql_real_escape_string($demo_atm_sql_result['city']);

$address = mysql_real_escape_string($demo_atm_sql_result['address']);
$state = $demo_atm_sql_result['state'];
$atmdate = $demo_atm_sql_result['so_date'];


$check_atm_sql = mysql_query("select * from atm where atm_id='".$atm_id."'");

$check_atm_sql_result = mysql_fetch_assoc($check_atm_sql);


if($check_atm_sql_result){
    
    $track_id=$check_atm_sql_result['track_id'];
    
        $update_atm = "update atm set cust_id='".$custid."', bank_name='".$bank_name."',area='".$area."',pincode='".$pincode."',city='".$city."',branch_id='".$branch_id."',start_date='".$start_date."',address='".$address."',po='".$po."',servicetype='".$servicetype."',podate='".$po_date."',expdt='".$expdt."',state1='".$state."',service_date1='".$service_date1."',service_date2='".$service_date2."',service_date3='".$service_date3."',so_id='".$so_id."', ref_id='asset_added', site_type='site_del' where track_id='".$track_id."'";
 
    mysql_query($update_atm);

   // $site_asset_call_id = $check_atm_sql_result['track_id'];


}
else{

    mysql_query("insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po,servicetype,podate,expdt,state1,service_date1,service_date2,service_date3,so_id, site_type) values('".$atm_id."','".$custid."','".$bank_name."','".$area."','".$pincode."','".$city."','".$branch_id."','".$start_date."','".$address."','".$po."','".$servicetype."','".$po_date."','".$expdt."','".$state."','".$service_date1."','".$service_date2."','".$service_date3."','".$so_id."', 'site_del')");

    $track_id = mysql_insert_id();

}


//==========Alert==========
$qry2=mysql_query("select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysql_fetch_row($qry2);
$qrr=mysql_query("select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysql_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
   
   $sub= mysql_real_escape_string($_POST['sub']);
   $doc= mysql_real_escape_string($_POST['doc']);
    
    $query=mysql_query("Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`, `pincode`, `problem`, `caller_name`, `caller_phone`, `caller_email`, `entry_date`, `alert_date`, `call_status`, `alert_type`, `po`,`state1`, `buyback`,`createdby`,`subject`,`custdoctno`,`assetstatus`, ccmail) Values('".$custid."','".$track_id."','".$bank_name."','".$area."','".$address."','".$city."','".$branch_id."','".$pincode."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$cdate."',STR_TO_DATE('".$adate."','%d/%m/%Y'),'1','new','".$po."','".$state."','".$buy."','".$qry2ro[0]."_".date("ymd").$num3."','".$sub."','".$doc."','site','".$ccmail."' )");


$last_alert_id = mysql_insert_id();

mysql_query("update so_order set status=2, call_status=2, alert_id ='".$last_alert_id."' where id='".$so_order_id."'");

//==================New Asset insert======

$sales_order_qry=mysql_query("select * from new_sales_order_asset where so_trackid='".$so_id."' ");
$i=0;
while($asset=mysql_fetch_assoc($sales_order_qry)) {

$product = $asset['po_product'];
$specs = $asset['po_model'];
$qty = $asset['po_qty'];
$valid = $asset['po_warr'];

mysql_query("INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, serialno, type, rate, status, callid,so_id,atm_trackid, start_date, po_date, alert_id) VALUES ('".$custid."', '".$po."', '".$product."','".$specs."', '".$valid."', '".$qty."', '".$track_id."', '".$serialno."', 'NEW', '', '1', '0','".$so_id."','".$track_id."','".$start_date."','".$po_date."','".$last_alert_id."')");
$i++ ;
}


for($i=0;$i<count($asset);$i++)
{
	$strhy=explode("-",$asset[$i]);
	$asstre = $strhy[0];
	$qtyre = $strhy[1];

	$qtyex=explode("*",$qtyre);
	$qtyfinal=$qtyex[0];
	$valid=$qtyex[1];

    $qryst=mysql_query("INSERT INTO `alert_assets` (`id`, `alert_id`, `po`, `assets`, `qty`, `valid`,`pm`) VALUES (NULL, '".$last_alert_id."', '".$po."', '".$asstre."', '".$qtyfinal."', '".$valid."','".$_POST['pm']."')");
}


        $address1=$address.','.$city.','.$state;
        $formattedAddr = str_replace(' ','+',$address1);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI'); 
        $output = json_decode($geocodeFromAddr);
        
        $latitude=$output->results[0]->geometry->location->lat; 
        $longitude=$output->results[0]->geometry->location->lng; 
        
      $updatelat= mysql_query("update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$track_id."'");

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
  
  
   $res=mysql_query($qry);
    $num=mysql_num_rows($res);
    if($num>0){
        $row=mysql_fetch_row($res);
        
        $ctime=date("Y-m-d H:i:s");
         $etdt=date("Y-m-d H:i:s", strtotime($ctime." + 24 hours"));
         $delegate_flag=1;
         $tab=mysql_query("update alert set status='Delegated',call_status='1',eta='".$etdt."' where alert_id='".$last_alert_id."'");

        if($tab){
	
		$tab2=mysql_query("Insert into alert_delegation(engineer,atm,alert_id,date,delby) values('".$row[0]."','".$atm_id."','".$last_alert_id."','".$ctime."','".$_SESSION['user']."')");
   
     mysql_query("Insert into Delegation_tracking(alertid,del_type,del_date) values('".$last_alert_id."','1','".$ctime."')");
        }     
               

$qry1=mysql_query("Select gcm_regid from notification_tble where pid='".$row[0]."' AND status='0'");
    
      $max1=mysql_fetch_row($qry1);

	$str2=$max1[0];

$message2="You have New Alerts";
include_once '../andi/GCM.php';
 $gcm = new GCM();
    //$registatoin_ids = $str2;
    $message = array("alert" => $message2);

    $result = $gcm->send_notification($str2, $message);
   
}
//=========================Email======================

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
if($query)
{

?>
<script type="text/javascript">
alert("Alert created successfully and complaint number is <?php echo $qry2ro[0]."_".date("ymd").$num3; ?>");


 window.location='../new_invoices.php';

</script>
<?php } else ?>

<script type="text/javascript">
alert("Some error. Check in the call log for Ticket Number");

 window.location='../new_invoices.php';

</script>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>