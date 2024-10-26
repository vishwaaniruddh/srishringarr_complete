<?php
include("../config.php");
$patid=$_GET['patid'];
$apptype=$_GET['apptype'];
$center=$_GET['branch'];
$appdate=$_GET['appdate'];
$slot=$_GET['avail'];
$pat=mysql_query("select name from patient where srno='".$patid."'");
$patro=mysql_fetch_row($pat);
$tp=mysql_query("select * from appoint where no='".$patid."'");
if(mysql_num_rows($tp)>0)
$new="O";
else
$new="N";
$qry=mysql_query("select * from slot where hospital='".$apptype."' and app_date='".$appdate."' and center='".$center."'");
$qryro=mysql_fetch_row($qry);
$block_id=$qryro[0];
$sq=mysql_query("select max(app_id) from `appoint`");
$max=mysql_fetch_row($sq);
//echo $max[0];
$ini=substr($center,0,1);
$newpatid=$max[0]+1;
$newsrno=$ini."-".$newpatid;
$app=$sql="insert into `appoint`(name,no,type,hospital,app_date,new_old,remarks,block_id,slot,app_real_id,app_id,center,confirmstat) values('$patro[0]','$patid','$type','$apptype',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$new','','$block_id','$slot','$newsrno','$newpatid','".$center."','w')";
$res=mysql_query($app);
if($res)
$str=1;
else
$str=0;

echo json_encode($str);
?>