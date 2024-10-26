<?php 
include('config.php');

session_start();

$id=$_POST['patient_id'];
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
$ninsu=$_POST['ninsu'];
$nroom=$_POST['nroom'];$comp=$_POST['comp'];$path=$_POST['path'];$cli=$_POST['cli'];$pro=$_POST['pro'];

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


$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

//till here
$sq=mysql_query("select max(ad_id) from `admission`");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;
$newsrno=$max12[0]."-".$newpatid;

$sql="insert into admission (patient_id,admit_date,admit_time,dis_date,dis_time,room,past_hist,chief_comp,clinic_detail,final_diag,radio_investi,path_investi,pro_investi,occupation,adm_by,address,insurance,ad_real_id,ad_id) values('$id',STR_TO_DATE('".$addate."','%d/%m/%Y'),'$time',STR_TO_DATE('".$disdate."','%d/%m/%Y'),'$time1','".ucfirst($room)."','$final','$comptxt','$clitxt','$finaltxt','$radiotxt','$pathtxt','$protxt','$occu','$admit','$addr','$insu','$newsrno','$newpatid')";

$result=mysql_query($sql);

 ///mysql_query("update appoint set status='yes' where app_id='".$aid."'");
if($result)
{
	header("location: viewipd.php");

}
else
echo "error Inserting data";

?>