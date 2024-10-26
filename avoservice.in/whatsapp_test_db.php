<?php
include("access.php");
include("config.php");
include("Whatsapp_delegation/delegation_fun.php");

$req=1037020;

$alertqry=mysqli_query($con1,"select * from alert where alert_id='".$req."' ");
$alertr=mysqli_fetch_row($alertqry);

$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$alertr[1]."' ");
$custname=mysqli_fetch_row($custqry);

if ($alertr[21]=='site') { $asstatus="Warranty";} 
elseif ($alertr[21]=='amc') { }
else $asstatus="PCB";

if ($alertr[21]=='amc') {

$amcqry=mysqli_query($con1,"select atmid from Amc where amcid='".$alertr[2]."' ");

//echo "select atmid from Amc where amcid='".$alertr[2]."' "."</br>";
$amc=mysqli_fetch_row($amcqry);
$atm_no=$amc[0];

$custqry=mysqli_query($con1,"select track_id from atm where atm_id ='".$atm_no."' ");

//echo "select track_id from atm where atm_id ='".$atm_no."' "."</br>";

if(mysqli_num_rows($custqry) > 0){
    $asset=mysqli_fetch_row($custqry);

$batwarqry=mysqli_query($con1,"select * from site_assets where atmid='".$asset[0]."' and assets_name='Battery' order by site_ass_id DESC"); 

//echo "select * from site_assets where atmid='".$asset[0]."' and assets_name='Battery' order by site_ass_id DESC";

$bat=mysqli_fetch_row($batwarqry);
$bstatus=$bat[11];
$bexp=$bat[18];

//echo $bexp;

if($bstatus==1) { $asstatus="UPS in AMC. Battery Under Warranty and Expires on: ".$bexp; }
else {$asstatus="UPS in AMC. Battery out of Warranty. Expired on: ".$bexp;}
} else {$asstatus="UPS in AMC. No any Battery supply";}

}

$batwarqry=mysqli_query($con1,"select * from site_assets where atmid='".$atm_id."' ");

if ($alertr[17]=='new') { $calltp="New Installation";} 
elseif ($alertr[17]=='service' || $alertr[17]=='new temp') { $calltp="Service Call";} 
elseif ($alertr[17]=='pm' || $alertr[17]=='temp_pm') { $calltp="PM Call";} 
elseif ($alertr[17]=='dere' || $alertr[17]=='temp_dere') { $calltp="De-Re Installation";}
        $MassageNew = "*Switching AVO Electro Power Ltd*";
        $Massage1 = "New Call Logged" ;
        $Massage2="*Customer Name:* ".$custname[0] ;
        $Massage3="*ATM Id:* ".$atm_no;
        $Massage4="*Ticket No:* ".$alertr[25] ;
        $Massage5="*End User:* ".$alertr[3] ;
        $Massage6="*Address:* ".$alertr[5];
        $Massage7="*Type Of Call:* ".$calltp;
        $Massage8="*Problem Reported:* ".$alertr[9];
        $Massage9="*Asset Status:* ".$asstatus;
        

        $mobile="9551086665";
$Message = $MassageNew."\n".$Massage1."\n".$Massage2."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8 ."\n".$Massage9;

//print $Message;

 SendWhatmsg($mobile,$Message);

?>