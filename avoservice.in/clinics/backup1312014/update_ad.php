<?php 
include('config.php');

$id=$_POST['ad_id'];
$addate=$_POST['addate'];
$disdate=$_POST['disdate'];
$room=$_POST['room'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$dur=$_POST['dur'];
$time= $hr.":".$min." ".$dur;
$hr1=$_POST['hour1'];
$min1=$_POST['min1'];
$dur1=$_POST['dur1'];
$time1= $hr1.":".$min1." ".$dur1;

$final=$_POST['pastfinal'];
$comptxt=$_POST['comptxt'];
$clitxt=$_POST['clitxt'];
$finaltxt=$_POST['finaltxt'];
$radiotxt=$_POST['radiotxt'];
$pathtxt=$_POST['pathtxt'];
$protxt=$_POST['protxt'];
$occu=$_POST['occu'];
$admit=$_POST['admit'];
$addr=$_POST['addr'];
$insu=$_POST['insu'];
$nroom=$_POST['nroom'];
$ninsu=$_POST['ninsu'];$comp=$_POST['comp'];$path=$_POST['path'];$cli=$_POST['cli'];$pro=$_POST['pro'];

if($room=='Other' && $nroom!=''){$room=$nroom;
if($room!='Other'){
$r=mysql_query("insert into room(type) values ('$room')");
}
}

if($insu=='Other' && $ninsu!=''){$insu=$ninsu;
if($insu!='Other'){
$n=mysql_query("insert into insumast(name) values ('$insu')");
}
}

if($comp=='Other' && $comptxt!=''){ $co=mysql_query("insert into compla(name) values ('$comptxt')"); }

if($path=='Other' && $pathtxt!=''){ $po=mysql_query("insert into investi1(name) values ('$pathtxt')"); }

if($cli=='Other' && $clitxt!=''){ $cl=mysql_query("insert into finding(name) values ('$clitxt')"); }

if($pro=='Other' && $protxt!=''){ $pr=mysql_query("insert into diag(name) values ('$protxt')"); }

$sql="UPDATE  `satyavan_clinicmgt`.`admission` SET admit_date=STR_TO_DATE('".$addate."','%d/%m/%Y'),admit_time ='".$time."',dis_date=STR_TO_DATE('".$disdate."','%d/%m/%Y'),dis_time ='".$time1."',room ='".$room."',past_hist ='".$final."',chief_comp='".$comptxt."',clinic_detail='".$clitxt."',final_diag='".$finaltxt."',radio_investi='".$radiotxt."',path_investi='".$pathtxt."',pro_investi='".$protxt."',occupation='".$occu."',adm_by='".$admit."',address='".$addr."',insurance='".$insu."' where ad_real_id='".$id."'";

$result=mysql_query($sql);
if($result)
{

header("location: viewipd.php");

}
else
echo "error Inserting data";
?>