<?php
include 'config.php';
$cust = $_POST['cust'];
//echo "cust=".$cust."<br>";
$type = $_POST['type'];
$service = $_POST['sertype'];
$pordr = $_POST['po'];
$atm = $_POST['atmid_send'];
//echo "atmid=".$atm."<br>";
$bank = $_POST['bank'];
$area = $_POST['area'];
$pincode = $_POST['pin'];
$city = $_POST['city'];
$state = $_POST['state'];
$branch = $_POST['branch_avo'];
$addr = htmlspecialchars($_POST['add']);
$cat = $_POST['cat'];
$ref = $_POST['ref'];
//echo "ref=".$ref;
//$dateget=$_POST['dt'];
$dateget = date('Y-m-d');
$nos = '1';
//$nos=$_POST['nos'];

//$bomno=$_POST['bomno'];
//$bomdate=$_POST['bomdate'];
//$indentno=$_POST['indentno'];
//$indentdate=$_POST['indentdate'];
//$ed=$_POST['ed'];
//$vat=$_POST['vat'];
//$dono=$_POST['dono'];
//$freight=$_POST['freight'];

//$dtstr=STR_TO_DATE('".$dateget."','%Y/%m/%d');
//echo $dtstr;
//$dtrep=str_replace("/","-",$dateget);

$upsrate = $_POST['upsrate'];
$batteryrate = $_POST['batteryrate'];
$isotrate = $_POST['isotrate'];
$stabrate = $_POST['stabrate'];
$avrrate = $_POST['avrrate'];

$ups = $_POST['ups']; //spec
$upsno = $_POST['upsno']; //qty
$upswr = $_POST['upswr']; //wrranty

$btry = $_POST['btry']; //spec
$btryno = $_POST['btryno']; //qty
$btrywr = $_POST['btrywr']; //wrranty

$isot = $_POST['isot']; //spec
$isotno = $_POST['isotno']; //qty
$isotwr = $_POST['isotwr']; //wrranty

$stab = $_POST['stab']; //spec
$stabno = $_POST['stabno']; //qty
$stabwr = $_POST['stabwr']; //wrranty

$avr = $_POST['avr']; //spec
$avrno = $_POST['avrno']; //qty
$avrwr = $_POST['avrwr']; //wrranty

//=============================inserting code start here==========================================

$add = mysqli_query($con1, "select * from `purchase_order` where `po_no`='" . $pordr . "'");
if (mysqli_num_rows($add) > 0) {} else {
    // echo "<br>insert into`purchase_order` VALUES ('".$pordr."','".$nos."','".$cust."','".$ref."','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y')) ";
    $result12 = mysqli_query($con1, "insert into`purchase_order` VALUES ('" . $pordr . "','" . $nos . "','" . $cust . "','" . $ref . "','" . $service . "',STR_TO_DATE('" . $dateget . "','%d/%m/%Y')) ");

    if ($upsno > 0) {
        //echo "<br>insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('".$pordr."','UPS','".$ups."','".$upsno."','".$upswr."','".$upsrate."')";
        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('" . $pordr . "','UPS','" . $ups . "','" . $upsno . "','" . $upswr . "','" . $upsrate . "')");
    }

    if ($btryno > 0) {
        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','NEW','".$atm."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`)values('" . $pordr . "','Battery','" . $btry . "','" . $btryno . "','" . $btrywr . "','" . $batteryrate . "')");
    }

    if ($isotno > 0) {

        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atm."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('" . $pordr . "','Isolation Transformer','" . $isot . "','" . $isotno . "','" . $isotwr . "','" . $isotrate . "')");
    }
    if ($stabno > 0) {

        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('" . $pordr . "','Stabilizer','" . $stab . "','" . $stabno . "','" . $stabwr . "','" . $stabrate . "')");
    }
    if ($avrno > 0) {

        //echo "<br>insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('".$pordr."','AVR','".$avr."','".$avrno."','".$avrwr."','".$avrrate."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('" . $pordr . "','AVR','" . $avr . "','" . $avrno . "','" . $avrwr . "','" . $avrrate . "')");
    }
}

//=================>>>>>>>>>>>===================type is sale=================<<<<<<<<<<<<<<<<<========================
if (strcasecmp($type, 'site') == 0) {
//echo "<br>in site"    ;

//echo "<br>INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1,cat)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$state','$cat')";

    $result = mysqli_query($con1, "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,branch_id,address,ref_id,po,cust_id,servicetype,podate,state1,cat,pending_status)  VALUES('" . $atm . "','" . $bank . "','" . $area . "','" . $pincode . "','" . $city . "','" . $branch . "','" . $addr . "','" . $ref . "','" . $pordr . "','" . $cust . "','" . $service . "','" . $dateget . "','" . $state . "','" . $cat . "',1)");
    //====last inserted auto id from atm get here =====
    $id = mysqli_insert_id();

    $ponum = mysqli_query($con1, "select `po` from `atm` where `po`='" . $pordr . "'");
    $ponum1 = mysqli_num_rows($ponum);

//===========For UPS============
    if ($upsno > 0) {
        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','UPS','".$ups."','".$upswr."','".$upsno."','".$id."','NEW','".$upsrate."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','UPS','" . $ups . "','" . $upswr . "','" . $upsno . "','" . $id . "','NEW','" . $upsrate . "')");
    }
//===========For Battery============
    if ($btryno > 0) {

        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','NEW','".$atm."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Battery','" . $btry . "','" . $btrywr . "','" . $btryno . "','" . $id . "','NEW','" . $batteryrate . "')");
    }
//===========For Isolation Transformer============
    if ($isotno > 0) {

        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atm."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Isolation Transformer','" . $isot . "','" . $isotwr . "','" . $isotno . "','" . $id . "','NEW','" . $isotrate . "')");
    }
//===========For Isolation Stabilizer============
    if ($stabno > 0) {

        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Stabilizer','" . $stab . "','" . $stabwr . "','" . $stabno . "','" . $id . "','NEW','" . $stabrate . "')");
    }
//===========For Isolation AVR============
    if ($avrno > 0) {
        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','AVR','" . $avr . "','" . $avrwr . "','" . $avrno . "','" . $id . "' ,'NEW','" . $avrrate . "')");
    }

    if ($result1) {
        header("Location:non_deployment.php?success=Non Deployment successfully....");

    }
}

//================>>>>>>>>>>>>>>=======<AMC Site=========<<<=================================================//////

elseif (strcasecmp($type, 'amc') == 0) {
    //echo "<br>in amc"    ;

    //echo "<br>INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city, branch,address, Ref_id, servicetype, state1) VALUES ('$pordr', '$cust', '$atm', '$bank', '$area', '$pincode', '$city', '$branch', '$addr', '$ref', '".$service."','$state')";

    $result = mysqli_query($con1, "INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city, branch,address, Ref_id, servicetype, state1) VALUES ('" . $pordr . "', '" . $cust . "', '" . $atm . "', '" . $bank . "', '" . $area . "', '" . $pincode . "', '" . $city . "', '" . $branch . "', '" . $addr . "', '" . $ref . "', '" . $service . "','" . $state . "')");

    $id = mysqli_insert_id();
    $dt = str_replace("/", "-", $dateget);
// echo $dt;
    $start = date('Y-m-d', strtotime($dt));
    //echo $start;
    //echo "<br>INSERT INTO `satyavan_accounts`.`amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$pordr."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')";

    $qry = mysqli_query($con1, "INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '" . $cust . "', '" . $pordr . "', '" . $start . "','" . date('Y-m-d', strtotime("+12 months $start")) . "','" . $id . "')");

    if (!$result) {
        echo "" . mysqli_error();
    }

    $today = strtotime($dt);
//========================Service For 3 Months==============================
    if ($service == '3') {
        for ($i = 1; $i <= 4; $i++) {
            //echo $i."<br>";
            $j = $service * $i;
            //echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
            $q = mysqli_query($con1, "Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('" . $pordr . "','" . date("Y-m-d", strtotime("+" . $j . " months", $today)) . "','AMC','" . $id . "')");
            if (!$q) {
                echo "failed" . mysqli_error();
            }

        }
    }
//========================service For 6 Month ====================================
    elseif ($service == '6') {

        for ($i = 1; $i <= 2; $i++) {
            //echo $i."<br>";
            $j = $service * $i;
            //echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
            $q = mysqli_query($con1, "Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('" . $pordr . "','" . date("Y-m-d", strtotime("+" . $j . " months", $today)) . "','AMC','" . $id . "')");
            if (!$q) {
                echo "failed" . mysqli_error();
            }

        }
    }
//======================>>>>>>>>>>>>> Insert Data inot amcassets <<<<<<<<<<<<<<<<<<<<<=================================
    if ($upsno > 0) {

//echo "<br>insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','UPS','" . $ups . "','" . $upsno . "','" . $id . "')");
    }

    if ($btryno > 0) {

//echo "<br>insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Battery','".$btry."','".$btryno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Battery','" . $btry . "','" . $btryno . "','" . $id . "')");
    }

    if ($isotno > 0) {

//echo "<br>insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Isolation Transformer','" . $isot . "','" . $isotno . "','" . $id . "')");
    }

    if ($stabno > 0) {

//echo "<br>insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Stabilizer','".$stab."','".$stabno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Stabilizer','" . $stab . "','" . $stabno . "','" . $id . "')");
    }

    if ($avrno > 0) {
        //echo "<br>insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','AVR','" . $avr . "','" . $avrno . "','" . $id . "')");
    }
    if ($insert) {
        header("Location:non_deployment.php?success=You have submited successfully....");
    }
}
