<?php
session_start();
include 'config.php';

//$ref=$_GET['ref'];
$qry = "";
$atm = $_GET['atm'];
$type = $_GET['type'];

//echo $atm;
//if($ref=="df"){
//echo "SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `atm` WHERE `ref_id`='$var[0]'";
if ($type == 'amc') {
    //echo "SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `Amc` WHERE `amcid`='$atm'";
    $qry = mysqli_query($conc,"SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `Amc` WHERE `amcid`='$atm'");
//echo "SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `Amc` WHERE `ref_id`='$atm'";;
} elseif ($type == 'site') {
    $qry = mysqli_query($conc,"SELECT `cust_id`,`bank_name`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `atm` WHERE `track_id`='$atm'");
//echo "SELECT `cust_id`,`bank_name`,`state`,`city`,`address`,`pincode`,`area`,`servicetype` FROM `atm` WHERE `ref_id`='$atm'";//
}

if (!$qry) {
    echo mysqli_error();
}

$row = mysqli_fetch_row($qry);
//echo $row[4];

$str = $row[0] . "#" . $row[1] . "#" . $row[2] . "#" . $row[3] . "#" . $row[4] . "#" . $row[5] . "#" . $row[6];

echo $str;
