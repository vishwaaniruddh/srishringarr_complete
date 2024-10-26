<?php
include 'config.php';
require('fpdf.php');


$a=$_POST['Call_Ticket'];
$b=$_POST['CallAlertDate'];
$c=$_POST['Battery_Vendor'];
$d=$_POST['Customer_Name'];
$e=$_POST['Address'];
$f=$_POST['Branch'];
$g=$_POST['ContactPersonName'];
$h=$_POST['ContactpersonNumber'];
$i=$_POST['AVOContactPerson'];
$j=$_POST['AVOContactNumber'];
$k=$_POST['NatureofProblem'];
$l=$_POST['BatteryType'];

$inst1 = str_replace('/', '-', $_POST['inst_date']);
$inst=date('Y-m-d', strtotime($inst1));
$exp_date= $_POST['exp_date'];
if($exp_date==''){ $exp_date='0000-00-00';}
//echo $inst;
//echo $a ;

$m=$_POST['BatteryRating_AH'];
$n=$_POST['BatteryQuantity'];
$o=$_POST['No_ofBattery'];
$p=$_POST['PhysicalCondition'];
$q=$_POST['ConnectedtoUPS'];
$r=$_POST['KVARating'];
$s=$_POST['SrNo_ofUPS'];
$t=$_POST['FloatVoltage'];
$u=$_POST['ChargingCurrentSetting'];
$v=$_POST['CutOffVoltage'];
$w=$_POST['AmbientOperating'];
$x=$_POST['Load_Present'];
$y=$_POST['Back_up_Required'];
$z=$_POST['No_ofbatteriesfound'];
$Remarks=$_POST['Remarks'];
$atm=$_POST['atm_id'];


$Batterysno=$_POST['BatterySerialNo'];
$Charging=$_POST['Charging_Voltage'];
$Discharg=$_POST['Discharge'];
$Discharge30=$_POST['DischargeVoltage'];

//print_r($Batterysno);

if($Batterysno==''){ 
echo "You must provide the Battery serial No";
die;
}

$BatteryS_No= $Batterysno;
$ChargingVoltage= $Charging;
$Disch=  $Discharg;
$Discharge_Voltage= $Discharge30;


//$BatteryS_No=  explode(',', $Batterysno);
//$ChargingVoltage=  explode(',', $Charging);
//$Disch=  explode(',', $Discharg);
//$Discharge_Voltage=  explode(',', $Discharge30);

//print_r($BatteryS_No);

$sql="insert into BRF_form(Call_Ticket,CallAlertDate,Battery_Vendor,Customer_Name,Address,Branch,ContactPersonName,ContactpersonNumber,AVOContactPerson,AVOContactNumber,NatureofProblem,BatteryType,BatteryRating_AH,BatteryQuantity,No_ofBattery,PhysicalCondition,ConnectedtoUPS,KVARating,SrNo_ofUPS,FloatVoltage,ChargingCurrentSetting,CutOffVoltage,AmbientOperating,Load_Present,Back_up_Required,No_ofbatteriesfoundSuspected,Remarks,ATM_ID,inst_date,exp_date)values('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$s','$t','$u','$v','$w','$x','$y','$z','$Remarks','$atm','$inst', '$exp_date')";


$result=mysqli_query($con1,$sql);
$last=mysqli_insert_id($con1);

if(!$result){ echo $sql; die; } else {

for($i=0;$i<count($BatteryS_No);$i++)
                        { 
                        if($BatteryS_No[$i]!="" && $ChargingVoltage[$i]!="" && $Disch[$i]!="" && $Discharge_Voltage[$i]!="")
                      
                            
 $qry1=mysqli_query($con1,"INSERT INTO `BRF_details`(Brf_id,BatterySerialNo,Charging_Voltage,Discharge,DischargeVoltage) VALUES('".$last."','".$BatteryS_No[$i]."','".$ChargingVoltage[$i]."','".$Disch[$i]."','".$Discharge_Voltage[$i]."')");
 } 
    
}

if(!$qry1) {echo "<br>.INSERT INTO `BRF_details`(Brf_id,BatterySerialNo,Charging_Voltage,Discharge,DischargeVoltage) VALUES('".$last."','".$BatteryS_No[$i]."','".$ChargingVoltage[$i]."','".$Disch[$i]."','".$Discharge_Voltage[$i]."')";
    die;
} 
?>

<script type="text/javascript">

alert("You have Succefully created BRF");
window.location.href="view_alert.php";
</script>
