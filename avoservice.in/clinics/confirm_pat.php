<?php
include('config.php');
$id=$_GET['id'];

$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

//till here
$sq=mysql_query("select max(app_id) from `appoint`");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;
$newsrno=$max12[0]."-".$newpatid;

$result=mysql_query("select * from opdwait where wait_real_id='$id'");
$row=mysql_fetch_row($result);

$sql="insert into appoint(name,time,app_date,new_old,doctor,type,hospital,remarks,no,app_real_id,app_id,center) values('$row[1]','$row[2]','$row[3]','$row[4]','$row[6]','$row[7]','$row[8]','$row[9]','$row[10]','$newsrno','$newpatid','$row[15]')";
$result1=mysql_query($sql);

$sql1="delete from opdwait where wait_real_id='$id'";
$result2=mysql_query($sql1);

if($result1){
if($result2){
header('location:view_patient.php');
}}
else{
echo "error inserting data";
}

?>