<?php

include "db_conn.php";
include_once 'GCM.php';

$alert = $_POST['alertid'];
$eng_id = $_POST['engid'];
$atm_id = $_POST['atm_id']; // Add this
$cdate = $_POST['time']; //date('Y-m-d H:i:s');
$bb = $_POST['bb']; // Yes or No;
$collected = $_POST['collected']; //  Yes or No
if($collected=='') { $collected='0';}

//======product details ===== Array if multiple
// $product = $_POST['product'];
// $capacity = $_POST['capacity']; // try to remove special charecters
// $qty = $_POST['qty'];
$lat = '';
$lng = '';
$address = '';
if (isset($_POST['localarea'])) {
    $address .= $_POST['localarea'] . ",";
}

if (isset($_POST['area'])) {
    $address .= $_POST['area'] . ",";
}

if (isset($_POST['city'])) {
    $address .= $_POST['city'] . ",";
}

if (isset($_POST['state'])) {
    $address .= $_POST['state'] . ",";
}

if (isset($_POST['country'])) {
    $address .= $_POST['country'];
}

if($address==''){ $address='NULL';}

if (isset($_POST['lat'])) {
    $lat = $_POST['lat'];
} else {
    $lat = '0';
}

if (isset($_POST['long'])) {
    $lng = $_POST['long'];
} else {
    $lng = '0';
}

$str = "";

$qryreslt = mysqli_query($conapp,"Select mac_id,pid from notification_tble where logid='" . $eng_id . "' AND status='0'");
$macidrow = mysqli_fetch_row($qryreslt);
$mac = $macidrow[0];

mysqli_query($conapp,"Insert into Location(`mac_address`,`latitude`,`longitude`,`dt`,`address`,`engg_id`) Values('" . $mac . "','" . $lat . "','" . $lng . "','" . $cdate . "','" . $address . "','" . $eng_id . "')");

//============Insert multiple rows if multple products==========

if(count($_POST['product']))
{

for ($i=0; $i < count($_POST['product']) ; $i++) { 
    $sql = mysqli_query($conapp,"insert into `buyback_engg`(`alert_id`,`atm_id`,`eng_logid`,`bb_available`,`product` ,`capacity`,`qty`,`clollected`,`date`) values('" . $alert . "','" . $atm_id . "','" . $eng_id . "','" . $bb . "','" . $_POST['product'][$i] . "' ,'" . urldecode($_POST['capacity'][$i]). "','" . $_POST['qty'][$i] . "','" . $collected. "','" . $cdate . "')");

    if ($sql) {
        $str = 1;
    } else {
    //   echo  mysqli_error();
        $str = 0;
    }
}
}
else
{
    if($collected=='') { $collected='No';}
    if($bb=='') { $bb='No';}
    
     $sql = mysqli_query($conapp,"insert into `buyback_engg`(`alert_id`,`atm_id`,`eng_logid`,`bb_available`,`product` ,`capacity`,`qty`,`clollected`,`date`) values('" . $alert . "','" . $atm_id . "','" . $eng_id . "','" . $bb . "','NULL' ,'NULL','0','" . $collected. "','" . $cdate . "')");

    if ($sql) {
        $str = 1;
    } else {
    //   echo  mysqli_error();
        $str = 0;
    }
}
    



// var_dump($_POST['qty'])
echo json_encode($str);
?>