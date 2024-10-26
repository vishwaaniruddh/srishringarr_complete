<?php
include("access.php");
include("config.php");

 $site_id=$_POST['site_id'];
 $site_type =$_POST['stype'];
 $sub= mysqli_real_escape_string($con1,$_POST['sub']);
 $cphone= mysqli_real_escape_string($con1,$_POST['cphone']);
 $cname= mysqli_real_escape_string($con1,$_POST['cname']);
 $cemail=$_POST['cemail'];


 

function extract_email_address($str){
    // This regular expression extracts all emails from a string:
    $regexp = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
    preg_match_all($regexp, $str, $m);

    return isset($m[0]) ? $m[0] : array();
}


/*function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
} */

$ccm=implode(",",extract_email_address($_POST['ccemail']));



//============Ticket No generate========
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);
	$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
//=================end============


if(isset($_POST['stype']) && $_POST['stype']=='warr'){
$siteqry="select * from atm where track_id='".$site_id."'";
$siteqr=mysqli_query($con1,$siteqry);
$srow=mysqli_fetch_row($siteqr);

$cust=$srow[2];
$atmid=$srow[0];
$bank=mysqli_real_escape_string($con1,$srow[3]);
$area=mysqli_real_escape_string($con1,$srow[4]);
$pincode =$srow[5];
$city =$srow[6];
$address =mysqli_real_escape_string($con1,$srow[9]);
$branch =$srow[7];
$po ='NULL';
$state =$srow[15];
$docket ="PM Call";
$asset ="site";
$prob ="PM need to be Done";
$adate=date('Y-m-d H:i:s');

$alert=mysqli_query($con1,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`createdby`,`subject`,`appby`,`appref`,`ccmail`, assetstatus,custdoctno) Values('".$cust."','".$atmid."','".$bank."','".$area."','".$address."' ,'".$city."','".$branch."','".$pincode."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$adate."','Pending','pm','".$adate."','".$po."','".$state."','".$qry2ro[0]."_".date("ymd").$num3."','".$sub."','','','".$ccm."', '".$asset."','".$docket."' )");


$id=mysqli_insert_id($con1);

} else if (isset($_POST['stype']) && $_POST['stype']=='amc'){

$siteqry="select * from Amc where amcid='".$site_id."'";
$siteqr=mysqli_query($con1,$siteqry);
$srow=mysqli_fetch_row($siteqr);

$cust=$srow[1];
$atmid=$srow[0];
$bank= mysqli_real_escape_string($con1,$srow[4]);
$area= mysqli_real_escape_string($con1,$srow[5]);
$pincode =$srow[6];
$city = mysqli_real_escape_string($con1,$srow[7]);
$address = mysqli_real_escape_string($con1,$srow[9]);
$branch =$srow[8];
$po ='NULL';
$state =$srow[10];

$asset ="amc";
$prob ="PM need to be Done";
$docket ="PM Call";
$adate=date('Y-m-d H:i:s');

$alert=mysqli_query($con1,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`createdby`,`subject`,`appby`,`appref`,`ccmail`, assetstatus, custdoctno) Values('".$cust."','".$atmid."','".$bank."','".$area."','".$address."' ,'".$city."','".$branch."','".$pincode."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$adate."','Pending','pm','".$adate."','".$po."','".$state."','".$qry2ro[0]."_".date("ymd").$num3."','".$sub."','','','".$ccm."', '".$asset."', '".$docket."')");

$id=mysqli_insert_id($con1);

}

if(!$alert)
echo "failed".mysqli_error($con1);

if($alert)
		{		
/*    
 
	//mail
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";

$tbl.="<tr><td>".$qry2ro[0]."_".date("ymd").$num3."</td><td>".$_POST['atmid']."</td><td>".$_POST['bank']."</td><td>".$_POST['state']."</td><td>".$_POST['city']."</td><td>".$_POST['address']."</td><td>".$_POST['prob']."</td><td><b>Pending</b></td></tr>";



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
			$headers .= "Cc: ".$ccm."\r\n";
			//echo $tbl;
			$message=$tbl;
			if(isset($_POST['ccemail']))
			{
			$mailto=$_POST['ccemail'];
			mail($mailto, $subject, $message, $headers);
			}	
		
*/	

?>
<script type="text/javascript">
alert("Alert created successfully. Complain ID is : <?php echo $qry2ro[0]."_".date("ymd").$num3; ?> ");
window.close();
</script>


<?  } ?>