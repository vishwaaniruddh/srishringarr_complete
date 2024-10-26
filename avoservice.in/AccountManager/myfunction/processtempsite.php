<?php
include "access.php";
include "config.php";
//echo "INSERT INTO `satyavan_accounts`.`tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`) VALUES (NULL, '".$_POST['cust']."', '".$_POST['po']."', '".$_POST['atmid']."', '".$_POST['bank']."', '".$_POST['area']."', '".$_POST['pincode']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['address']."', '".$_POST['atmid']."')<br>";
$qry = mysqli_query($con1, "INSERT INTO `satyavan_accounts`.`tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`) VALUES (NULL, '" . $_POST['cust'] . "', '" . $_POST['po'] . "', 'temp_" . $_POST['atmid'] . "', '" . $_POST['bank'] . "', '" . $_POST['area'] . "', '" . $_POST['pincode'] . "', '" . $_POST['city'] . "', '" . $_POST['state'] . "', '" . $_POST['address'] . "', '" . $_POST['atmid'] . "')");
$tempid = mysqli_insert_id();
if (!$qry) {
    echo "failed" . mysqli_error();
}

//echo "update tempsites set trackerid='temp_".$tempid."' where id='".$tempid."'<br>";
$qryup = mysqli_query($con1, "update tempsites set trackerid='temp_" . $tempid . "' where id='" . $tempid . "'");

//echo "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`) Values('".$_POST['cust']."','".$_POST['atmid']."','".$_POST['bank']."','".$_POST['area']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."','".$_POST['pincode']."','".$_POST['prob']."','".$_POST['cname']."','".$_POST['cphone']."','".$_POST['cemail']."',STR_TO_DATE('".$_POST['adate']."','%d/%m/%Y'),'Pending','new','".$_POST['cdate']."','".$_POST['po']."')<br>";
$alert = mysqli_query($con1, "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`) Values('" . $_POST['cust'] . "','temp_" . $_POST['atmid'] . "','" . $_POST['bank'] . "','" . $_POST['area'] . "','" . $_POST['address'] . "','" . $_POST['city'] . "','" . $_POST['state'] . "','" . $_POST['pincode'] . "','" . $_POST['prob'] . "','" . $_POST['cname'] . "','" . $_POST['cphone'] . "','" . $_POST['cemail'] . "',STR_TO_DATE('" . $_POST['adate'] . "','%d/%m/%Y'),'Pending','new','" . $_POST['cdate'] . "','" . $_POST['po'] . "')");
$id = mysqli_insert_id();

$qry2 = mysqli_query($con1, "select srno from login where username='" . $_SESSION['user'] . "'");
$qry2ro = mysqli_fetch_row($qry2);
//echo "<br>Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$tempid."' where alert_id='".$tempid."'";
$up = mysqli_query($con1, "Update alert set `createdby`='" . $qry2ro[0] . "_" . date("Ymd") . $tempid . "' where alert_id='" . $id . "'");
?>
<script type="text/javascript">
alert("Alert created successfully. Complain ID is : <?php echo $qry2ro[0] . "_" . date("Ymd") . $id; ?> ");
window.location='newtempsite.php';
</script>