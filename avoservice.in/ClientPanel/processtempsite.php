<?php
include "access.php";
include "config.php";

$call_type= $_POST['type_call'];

if($call_type=='service') { $alert_type="new temp";}
if($call_type=='pm') { $alert_type="temp_pm";}
if($call_type=='dere') { $alert_type="temp_dere";}

if (isset($_POST['cmdsubmit']) && $_POST['branch_avo'] != '') {
    include_once '../andi/GCM.php';

    $qry = mysqli_query($conc,"INSERT INTO `tempsites` (`id`, `custid`, `po`, `atmid`, `bankname`, `area`, `pincode`, `city`, `state`, `address`, `ref_id`,`type`,`state1`) VALUES (NULL, '" . $_POST['cust'] . "', '" . $_POST['po'] . "', 'temp_" . $_POST['atmid'] . "', '" . $_POST['bank'] . "', '" . $_POST['area'] . "', '" . $_POST['pincode'] . "', '" . $_POST['city'] . "', '" . $_POST['state'] . "', '" . $_POST['address'] . "', '" . $_POST['atmid'] . "','" . $_POST['type'] . "', '" . $_POST['state'] . "')");

    $tempid = mysqli_insert_id($conc);
    if (!$qry) {
        echo "failed" . mysqli_error($conc);
    }
    $qry2 = mysqli_query($conc,"select srno from login where username='" . $_SESSION['user'] . "'");
    $qry2ro = mysqli_fetch_row($qry2);
    $qrr = mysqli_query($conc,"select * from alert where entry_date LIKE ('" . date('Y-m-d') . "%')");
    $num = mysqli_num_rows($qrr);
    $num2 = $num + 1;
    if ($num2 > 0 && $num2 <= 9) {
        $num3 = "0" . $num2;
    } else {
        $num3 = $num2;
    }

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

    $ccm = implode(",", extract_email_address($_POST['ccemail']));
$date=date('Y-m-d');
  
    $alert = mysqli_query($conc,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`,`state1`,`createdby`,`subject`,`custdoctno`,`appby`,`appref`,`ccmail`) Values('" . $_POST['cust'] . "','temp_" . $_POST['atmid'] . "','" . $_POST['bank'] . "','" . $_POST['area'] . "','" . preg_replace('/\s+/', ' ', $_POST['address']) . "','" . $_POST['city'] . "','" . $_POST['branch_avo'] . "','" . $_POST['pincode'] . "','" . preg_replace('/\s+/', ' ', $_POST['prob']) . "','" . $_POST['cname'] . "','" . $_POST['cphone'] . "','" . $_POST['cemail'] . "', '".$date."','Pending','".$alert_type."','" . date('Y-m-d H:i:s') . "','" . $_POST['po'] . "','" . $_POST['state'] . "','" . $qry2ro[0] . "_" . date("ymd") . $num3 . "','" . $_POST['sub'] . "','" . $_POST['doc'] . "','" . $_POST['appby'] . "','" . $_POST['how'] . "','" . $ccm . "')");
    $id = mysqli_insert_id($conc);

if (!$alert) { echo "failed" . mysqli_error($conc); 
    
} else {
        
        $qryup = mysqli_query($conc,"update tempsites set trackerid='".$id."' where id='" . $tempid . "'");
     
        if (strlen($_POST['atmid']) >= 4) {
            $delqry = mysqli_query($conc,"SELECT engineer,count(*) as cnt  FROM `alert_delegation` WHERE `alert_id` in(select `alert_id` from alert where atm_id='temp_" . $_POST['atmid'] . "') group by engineer order by cnt desc");
            $aidqry = mysqli_query($conc,"select max(alert_id) from alert where atm_id='temp_" . $_POST['atmid'] . "'");
            $aidrow = mysqli_fetch_row($aidqry);
            $req = $aidrow[0];
            $bidqry = mysqli_query($conc,"select branch_id from alert where alert_id='" . $req . "'");
            $bidrow = mysqli_fetch_row($bidqry);
            $branch_id = $bidrow[0];
            while ($delrow = mysqli_fetch_row($delqry)) {
                $enqry = mysqli_query($conc,"select * from area_engg where engg_id='" . $delrow[0] . "' and area='" . $branch_id . "' and status=1");
                if (mysqli_num_rows($enqry) > 0) { // delegate
                    $ctime = date("Y-m-d H:i:s");
                    $etdt = date("Y-m-d H:i:s", strtotime($ctime . " + 4 hours"));

                    $tab = mysqli_query($conc,"update alert set status='Delegated',call_status='1',eta='" . $etdt . "' where alert_id='" . $req . "'");

                    if ($tab) {
                        //$cdate = date('Y-m-d H:i:s');
                        $tab2 = mysqli_query($conc,"Insert into alert_delegation(engineer,atm,alert_id,date,delby)            values('" . $delrow[0] . "','" . $_POST['atmid'] . "','" . $req . "','" . $ctime . "','" . $_SESSION['user'] . "')");
                    }

                    $str2 = array();
//echo "Select gcm_regid from notification_tble where logid='".$str."' AND pid='".$eng."' AND status='0'";
                    $qry1 = mysqli_query($conc,"Select gcm_regid from notification_tble where pid='" . $delrow[0] . "' AND status='0'");

                    while ($max1 = mysqli_fetch_row($qry1)) {
                        $str2[] = $max1[0];

                    }

                    $message2 = "You have New Alerts";
                    include_once 'andi/GCM.php';
                    $gcm = new GCM();
                   
                    $message = array("alert" => $message2);

                    $result = $gcm->send_notification($str2, $message);

                } else {
                    continue;
                }

            }
            //header('location:service.php');
            // echo "Data added successfully<br><br><a href='service.php'>New Service</a>";

            //mail
            $tbl = "<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Call Logged from <font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></p><table border='1' width='700px'><tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";

            $tbl .= "<tr><td>" . $qry2ro[0] . "_" . date("ymd") . $num3 . "</td><td>" . $_POST['atmid'] . "</td><td>" . $_POST['bank'] . "</td><td>" . $_POST['state'] . "</td><td>" . $_POST['city'] . "</td><td>" . $_POST['address'] . "</td><td>" . $_POST['prob'] . "</td><td><b>Pending</b></td></tr>";

//print_r($cc);
            $subject = $qry2ro[0] . "_" . date("ymd") . $num3 . " <Switching AVO Electro Power Limited>";
//echo "<br>";
            $tbl .= "</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font></body></html>";

            $headers = "From: Switching AVO Electro Power Limited\r\n";
            //$headers .= "Reply-To: ".dfdf . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $headers .= "Cc: " . $ccm . "\r\n";
            //echo $tbl;
            $message = $tbl;
            if (isset($_POST['ccemail'])) {
                $mailto = $_POST['ccemail'];
                mail($mailto, $subject, $message, $headers);
            }
        }
    
    ?>
<script type="text/javascript">
alert("Alert created successfully. Complain ID is : <?php echo $qry2ro[0] . "_" . date("ymd") . $num3; ?> ");
window.location='newtempsite.php';
</script>
<?php

} } else {
    ?>
	<script type="text/javascript">
	alert("Your login expired please try again");
	window.location='newtempsite.php';
	</script>

	<?php
}
?>