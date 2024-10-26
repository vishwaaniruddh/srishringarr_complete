<?php
include 'config.php';
$cust = $_POST['cust'];
//echo "cust=".$cust."<br>";
$type = $_POST['type'];
$service = $_POST['servicetype'];
$pordr = $_POST['po'];
$atm = $_POST['atm'];
$bank = $_POST['bank'];
$area = $_POST['area'];
$pincode = $_POST['pin'];
$city = $_POST['city'];
$state = $_POST['state'];
$site_branch = $_POST['site_branch'];
//echo $site_branch;
$addr = htmlspecialchars($_POST['address']);
$ref = $_POST['ref'];
$dateget = $_POST['dt'];
$nos = $_POST['nos'];
//$bomno=$_POST['bomno'];
//$bomdate=$_POST['bomdate'];
//$indentno=$_POST['indentno'];
//$indentdate=$_POST['indentdate'];
//$ed=$_POST['ed'];
//$vat=$_POST['vat'];
//$dono=$_POST['dono'];
//$freight=$_POST['freight'];
$upsrate = $_POST['upsrate'];
$batteryrate = $_POST['batteryrate'];
$isotrate = $_POST['isotrate'];
$stabrate = $_POST['stabrate'];
$avrrate = $_POST['avrrate'];
//$cat=$_POST['cat'];

//$dtstr=STR_TO_DATE('".$dateget."','%Y/%m/%d');
//echo $dtstr;
//$dtrep=str_replace("/","-",$dateget);
$ups = $_POST['ups'];
$upsno = $_POST['upsno'];
$upswr = $_POST['upswr'];
$btry = $_POST['btry'];
$btryno = $_POST['btryno'];
$btrywr = $_POST['btrywr'];
$isot = $_POST['isot'];
$isotno = $_POST['isotno'];
$isotwr = $_POST['isotwr'];
$stab = $_POST['stab'];
$stabno = $_POST['stabno'];
$stabwr = $_POST['stabwr'];
$avr = $_POST['avr'];
$avrno = $_POST['avrno'];
$avrwr = $_POST['avrwr'];

//=============================inserting code start here==========================================

$add = mysqli_query($con1, "select * from `purchase_order` where `po_no`='" . $pordr . "'");
if (mysqli_num_rows($add) > 0) {} else {
    $result12 = mysqli_query($con1, "insert into`purchase_order` VALUES ('" . $pordr . "','" . $nos . "','" . $cust . "','" . $ref . "','" . $service . "',STR_TO_DATE('" . $dateget . "','%d/%m/%Y')) ");

    if ($upsno > 0) {
        //echo "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('".$pordr."','UPS','".$ups."','".$upsno."','".$upswr."','".$upsrate."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`)
		   values('" . $pordr . "','UPS','" . $ups . "','" . $upsno . "','" . $upswr . "','" . $upsrate . "')");
    }
    if ($btryno > 0) {

        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','NEW','".$atm."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`)
		   values('" . $pordr . "','Battery','" . $btry . "','" . $btryno . "','" . $btrywr . "','" . $batteryrate . "')");
    }

    if ($isotno > 0) {

        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atm."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`)
		   values('" . $pordr . "','Isolation Transformer','" . $isot . "','" . $isotno . "','" . $isotwr . "','" . $isotrate . "')");
    }
    if ($stabno > 0) {

        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`)
		   values('" . $pordr . "','Stabilizer','" . $stab . "','" . $stabno . "','" . $stabwr . "','" . $stabrate . "')");
    }
    if ($avrno > 0) {

        echo "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`)
		   values('" . $pordr . "','AVR','" . $avr . "','" . $avrno . "','" . $avrwr . "','" . $avrrate . "')";

        $addasset = mysqli_query($con1, "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`)
		   values('" . $pordr . "','AVR','" . $avr . "','" . $avrno . "','" . $avrwr . "','" . $avrrate . "')");
    }
}

//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$addr')";
if ($type == 'sales') {

//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1,cat)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$state','$cat')";

    $result = mysqli_query($con1, "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,branch_id,address,ref_id,po,cust_id,servicetype,podate,state1,cat,pending_status)
VALUES('$atm','$bank','$area','$pincode','" . $city . "','" . $site_branch . "','" . $addr . "','" . $ref . "','" . $pordr . "','" . $cust . "','" . $service . "', STR_TO_DATE('" . $dateget . "','%d/%m/%Y'),'" . $state . "','" . $cat . "',1)");
    $id = mysqli_insert_id();

    $ponum = mysqli_query($con1, "select `po` from `atm` where `po`='" . $pordr . "'");
    $ponum1 = mysqli_num_rows($ponum);

    if ($result) {
        //echo "INSERT INTO `instdetails`(`atm_id`, `bomno`, `bomdate`, `indentno`, `indentdate`, `vat`, `ed`, `dono`, `freight`) VALUES ('".$id."','".$bomno."',STR_TO_DATE('".$bomdate."','%d/%m/%Y'),'".$indentno."',STR_TO_DATE('".$indentdate."','%d/%m/%Y'),'".$vat."','".$ed."','".$dono."','".$freight."')";
        $qry = mysqli_query($con1, "INSERT INTO `instdetails`(`atm_id`, `bomno`, `bomdate`, `indentno`, `indentdate`, `vat`, `ed`, `dono`, `freight`) VALUES ('" . $id . "','" . $bomno . "',STR_TO_DATE('" . $bomdate . "','%d/%m/%Y'),'" . $indentno . "',STR_TO_DATE('" . $indentdate . "','%d/%m/%Y'),'" . $vat . "','" . $ed . "','" . $dono . "','" . $freight . "')");
    }
    if ($upsno > 0) {
        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','UPS','".$ups."','".$upswr."','".$upsno."','".$id."','NEW','".$upsrate."')";
        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','UPS','" . $ups . "','" . $upswr . "','" . $upsno . "','" . $id . "','NEW','" . $upsrate . "')");
    }
    if ($btryno > 0) {

        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','NEW','".$atm."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Battery','" . $btry . "','" . $btrywr . "','" . $btryno . "','" . $id . "','NEW','" . $batteryrate . "')");
    }

    if ($isotno > 0) {

        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atm."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Isolation Transformer','" . $isot . "','" . $isotwr . "','" . $isotno . "','" . $id . "','NEW','" . $isotrate . "')");
    }
    if ($stabno > 0) {

        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";

        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Stabilizer','" . $stab . "','" . $stabwr . "','" . $stabno . "','" . $id . "','NEW','" . $stabrate . "')");
    }
    if ($avrno > 0) {
        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";
        $result1 = mysqli_query($con1, "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','AVR','" . $avr . "','" . $avrwr . "','" . $avrno . "','" . $id . "' ,'NEW','" . $avrrate . "')");
    }

    if ($result) {
        echo "1 **##" . $ponum1;
    } else {
        echo "0";
    }

} elseif ($type == "AMC") {
    //echo "INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city,state,address,Ref_id,servicetype,state1)VALUES('$pordr','$cust','$atm','$bank','$area','$pincode','$city','$state','$addr','$ref','".$service."','$state')";

    $result = mysqli_query($con1, "INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city,branch,address,Ref_id,servicetype,state1)VALUES('" . $pordr . "', '" . $cust . "', '" . $atm . "', '" . $bank . "', '" . $area . "', '" . $pincode . "', '" . $city . "', '" . $site_branch . "','" . $addr . "','" . $ref . "','" . $service . "','" . $state . "')");
    $id = mysqli_insert_id();
    $ponum = mysqli_query($con1, "select `po` from `Amc` where `po`='" . $pordr . "'");
    $ponum1 = mysqli_num_rows($ponum);
    $dt = str_replace("/", "-", $dateget);
// echo $dt;
    $start = date('Y-m-d', strtotime($dt));
    //echo $start;
    //echo "INSERT INTO `satyavan_accounts`.`amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$pordr."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')";
    $qry = mysqli_query($con1, "INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '" . $cust . "', '" . $pordr . "', '" . $start . "','" . date('Y-m-d', strtotime("+12 months $start")) . "','" . $id . "')");
    if (!$result) {
        echo "" . mysqli_error();
    }

    $today = strtotime($dt);

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
    } elseif ($service == '6') {

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

    if ($upsno > 0) {

//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','UPS','" . $ups . "','" . $upsno . "','" . $id . "')");
    }

    if ($btryno > 0) {

//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Battery','".$btry."','".$btryno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Battery','" . $btry . "','" . $btryno . "','" . $id . "')");
    }

    if ($isotno > 0) {

//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Isolation Transformer','" . $isot . "','" . $isotno . "','" . $id . "')");
    }

    if ($stabno > 0) {

//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Stabilizer','".$stab."','".$stabno."','".$id."')";
        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Stabilizer','" . $stab . "','" . $stabno . "','" . $id . "')");
    }

    if ($avrno > 0) {

        //echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";

        $insert = mysqli_query($con1, "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','AVR','" . $avr . "','" . $avrno . "','" . $id . "')");
    }
    if ($insert) {
        echo "1 **##" . $ponum1;
    } else {
        echo "0";
    }
}
