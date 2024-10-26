<?php
session_start();

//========Opex Marking in site_type in ATM table

include_once '../andi/GCM.php';
include "../config.php";
//echo $_SESSION['designation'];

$so_id = $_POST['so_id'];

$cust = $_POST['cust'];
$bank = mysqli_real_escape_string($con1,$_POST['bank']);
$state = $_POST['state_st'];
$branch_id = $_POST['branch_avo'];
$city = mysqli_real_escape_string($con1,$_POST['city']);
$area = mysqli_real_escape_string($con1,$_POST['area']);
$add = mysqli_real_escape_string($con1,$_POST['address']);
$pin = $_POST['pin'];
$adate = $_POST['adate'];

$prob = mysqli_real_escape_string($con1,$_POST['prob']);
$cname = mysqli_real_escape_string($con1,$_POST['cname']);
$cphone = mysqli_real_escape_string($con1,$_POST['cphone']);
$cemail = mysqli_real_escape_string($con1,$_POST['cemail']);
$cdate = date('Y-m-d H:i:s');
$start_date = date('Y-m-d');
$po = $_POST['po'];
$asset = $_POST['assetsme'];

$atmid = $_POST['ref_id'];

$po_qty = $_POST['po_qty'];
$so_order_id = $_POST['so_order_id'];

$poqry = mysqli_query($con1, "select * from purchase_order where po_no='" . $po . "'");
$porow = mysqli_fetch_assoc($poqry);
$poid = $porow['id'];
$po_date = $porow['po_date'];

// var_dump($_POST);
// return;

function string_between_two_string($str, $starting_word, $ending_word)
{
    $subtring_start = strpos($str, $starting_word);
    $subtring_start += strlen($starting_word);
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
    return substr($str, $subtring_start, $size);
}

function get_cust_id($name)
{

    global $con1;

    $sql = mysqli_query($con1, "select * from customer where cust_name='" . $name . "'");

    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['cust_id'];
}

$custid = get_cust_id($cust);

include '../class_files/insert.php';
$in_obj = new insert();
include "../config.php";

$demo_atm_sql = mysqli_query($con1, "select * from demo_atm where so_id='" . $so_id . "'");

$demo_atm_sql_result = mysqli_fetch_assoc($demo_atm_sql);

$atm_id = $demo_atm_sql_result['atm_id'];
$cust_id = $demo_atm_sql_result['cust_id'];
$bank_name = mysqli_real_escape_string($con1,$demo_atm_sql_result['bank_name']);
$area = mysqli_real_escape_string($con1,$demo_atm_sql_result['area']);
$pincode = mysqli_real_escape_string($con1,$demo_atm_sql_result['pincode']);
$city = mysqli_real_escape_string($con1,$demo_atm_sql_result['city']);

$address = mysqli_real_escape_string($con1,$demo_atm_sql_result['address']);
$state = $demo_atm_sql_result['state'];
$atmdate = $demo_atm_sql_result['so_date'];

$check_atm_sql = mysqli_query($con1, "select * from atm where atm_id='" . $atm_id . "'");

$check_atm_sql_result = mysqli_fetch_assoc($check_atm_sql);

if ($check_atm_sql_result) {
    $trackid = $check_atm_sql_result['track_id'];
    $site_asset_call_id = $check_atm_sql_result['track_id'];

    $update_atm = "update atm set cust_id='" . $custid . "', bank_name='" . $bank_name . "',area='" . $area . "',pincode='" . $pincode . "',city='" . $city . "',branch_id='" . $branch_id . "',start_date='" . $start_date . "',address='" . $address . "',po='" . $po . "',servicetype='0',podate='" . $po_date . "',state1='" . $state . "',so_id='" . $so_id . "', ref_id='asset_added', site_type='opex' where track_id='" . $trackid . "'";

    mysqli_query($con1, $update_atm);

} else {

    mysqli_query($con1, "insert into atm (atm_id,cust_id,bank_name,area,pincode,city,branch_id,start_date,address,po,servicetype,podate,state1,so_id, site_type) values('" . $atm_id . "','" . $custid . "','" . $bank_name . "','" . $area . "','" . $pincode . "','" . $city . "','" . $branch_id . "','" . $start_date . "','" . $address . "','" . $po . "','0','" . $po_date . "','" . $state . "','" . $so_id . "', 'opex')");

    $site_asset_call_id = mysqli_insert_id($con1);

}

$qry2 = mysqli_query($con1, "select srno from login where username='" . $_SESSION['user'] . "'");
$qry2ro = mysqli_fetch_row($qry2);
$qrr = mysqli_query($con1, "select * from alert where entry_date LIKE ('" . date('Y-m-d') . "%')");
$num = mysqli_num_rows($qrr);
$num2 = $num + 1;
if ($num2 > 0 && $num2 <= 9) {
    $num3 = "0" . $num2;
} else {
    $num3 = $num2;
}

$sub = mysqli_real_escape_string($con1,$_POST['sub']);
$doc = mysqli_real_escape_string($con1,$_POST['doc']);

$query = mysqli_query($con1, "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`, `pincode`, `problem`, `caller_name`, `caller_phone`, `caller_email`, `entry_date`, `alert_date`, `call_status`, `alert_type`, `po`,`state1`,`createdby`,`subject`,`custdoctno`,`assetstatus`) Values('" . $custid . "','" . $site_asset_call_id . "','" . $bank_name . "','" . $area . "','" . $address . "','" . $city . "','" . $branch_id . "','" . $pincode . "','" . $prob . "','" . $cname . "','" . $cphone . "','" . $cemail . "','" . $cdate . "',STR_TO_DATE('" . $adate . "','%d/%m/%Y'),'1','new','" . $po . "','" . $state . "','" . $qry2ro[0] . "_" . date("ymd") . $num3 . "','" . $sub . "','" . $doc . "','site')");

$last_alert_id = mysqli_insert_id($con1);

//==================New Asset insert======

$sales_order_qry = mysqli_query($con1, "select * from new_sales_order_asset where so_trackid='" . $so_id . "' ");
$i = 0;
while ($asset = mysqli_fetch_assoc($sales_order_qry)) {

    $product = $asset['po_product'];
    $specs = $asset['po_model'];
    $qty = $asset['po_qty'];
    $valid = $asset['po_warr'];

    mysqli_query($con1, "INSERT INTO site_assets (cust_id, po, assets_name,assets_spec, valid, quantity, atmid, serialno, type, rate, status, callid,so_id,atm_trackid, start_date, po_date, alert_id) VALUES ('" . $custid . "', '" . $po . "', '" . $product . "','" . $specs . "', '" . $valid . "', '" . $qty . "', '" . $site_asset_call_id . "', '" . $serialno . "', 'NEW', '0', '1', '0','" . $so_id . "','" . $site_asset_call_id . "','" . $start_date . "','" . $po_date . "','" . $last_alert_id . "')");

    $i++;
}

mysqli_query($con1, "update so_order set status=2, alert_id ='" . $last_alert_id . "' where id='" . $so_order_id . "'");

/*
for($i=0;$i<count($asset);$i++)
{
$strhy=explode("-",$asset[$i]);
$asstre = $strhy[0];
$qtyre = $strhy[1];

$qtyex=explode("*",$qtyre);
$qtyfinal=$qtyex[0];
$valid=$qtyex[1];

$qryst=mysqli_query($con1,"INSERT INTO `alert_assets` (`id`, `alert_id`, `po`, `assets`, `qty`, `valid`,`pm`) VALUES (NULL, '".$id."', '".$po."', '".$asstre."', '".$qtyfinal."', '".$valid."','".$_POST['pm']."')");

} */

//=========================Email======================

if ($query) {

    if (isset($_POST['em'])) {
        function extract_email_address($string)
        {
            foreach (preg_split('/\s/', $string) as $token) {
                $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
                if ($email !== false) {
                    $emails[] = $email;
                }
            }
            return $emails;
        }
        $cc = implode(",", extract_email_address($_POST['ccemail']));
        $mailto = $cemail;
        $tbl = "<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>Complaint ID</th><th>Site /Sol ID</th><th>End UserK</th><th>State</th><th>City</th><th>Address</th><th>Call Type</th><th>Status</th></tr>";

        $tbl .= "<tr><td>" . $qry2ro[0] . "_" . date("ymd") . $num3 . "</td><td>" . $_POST['ref_id'] . "</td><td>" . $_POST['bank'] . "</td><td>" . $_POST['state_st'] . "</td><td>" . $_POST['city'] . "</td><td>" . $_POST['address'] . "</td><td>New Installation Call </td><td><b>Pending</b></td></tr>";

//print_r($cc);
        $subject = $qry2ro[0] . "_" . date("ymd") . $num3 . " <Switching AVO Electro Power Limited>";
//echo "<br>";
        $tbl .= "</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";
//echo $tbl."<br>";
        //echo $mailto." ".$cc;
        $headers = "From: Switching AVO Electro Power Limited\r\n";
        //$headers .= "Reply-To: ".dfdf . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "Cc: " . $cc . "\r\n";
        //echo $tbl;
        $message = $tbl;
        if (isset($_POST['em'])) {
            mail($mailto, $subject, $message, $headers);
        }

    }

    $message2 = "";
    //echo "Select state_id from state where state='".$state"'";
    $qry1 = mysqli_query($con1, "Select state_id from state where state='" . $state . "'");
    if (mysqli_num_rows($qry1) > 0) {
        $resltrow = mysqli_fetch_row($qry1);
        $message2 = "You have  New Alerts";
        $qry2 = mysqli_query($con1, "Select * from login where designation='3'");
        $srno = array();
        while ($max1 = mysqli_fetch_row($qry2)) {
            //echo $max1[3]."<br>";
            $br = explode(",", $max1[3]);
            for ($i = 0; $i < count($br); $i++) {
                //echo "<br>br=".($br[$i])."<br>";
                if ($br[$i] == $resltrow[0]) {
                    $srno[] = $max1[0];
                    break;
                }
            }

        }
        $logid = implode(",", $srno);
        //echo "Select gcm_regid from notification_tble where logid in($logid)";
        $qryreslt = mysqli_query($con1, "Select gcm_regid from notification_tble where logid in($logid)");
        if (mysqli_num_rows($qryreslt) > 0) {
            $str2 = array();
            while ($maxnew = mysqli_fetch_row($qryreslt)) {
                $str2[] = $maxnew[0];

            }
            //$maxnew=mysqli_fetch_row($qryreslt);
            //$str2=$maxnew[0];
            //print_r($str2);

            $gcm = new GCM();
            //$registatoin_ids = $str2;
            // echo $str2." ".$message2;
            $message = array("alert" => $message2);

            $result = $gcm->send_notification($str2, $message);
        }
    }

//echo $atm;
    ?>
<script type="text/javascript">
alert("Alert created successfully and complaint number is <?php echo $qry2ro[0] . "_" . date("ymd") . $num3; ?>");


 window.location='../new_invoices.php';

</script>
<?php

} else {
    echo "Error Creating Alert" . mysqli_error($con1);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>