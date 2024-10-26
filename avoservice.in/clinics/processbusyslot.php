<?php
session_start();
include('config.php');
if(isset($_POST['submit']))
{
$counter=0;
$cnt=$_POST['cnt'];
$time=array();
 $center=$_POST['center'];
 $apptype=$_POST['apptype'];
 $date=$_POST['appdate'];
$blockid=$_POST['block_id'];
for($i=0;$i<$cnt;$i++)
{
if(isset($_POST['busyslot'][$i]))
{
 $time[$counter]= $_POST['busyslot'][$i];
$counter=$counter+1;
}
}
$check=array();
$err=array();
$qr=mysql_query("select max(id) from busyslot");
$qrro=mysql_fetch_row($qr);
if($qrro[0]=='' || $qrro[0]==null)
$id=0;
else
$id=$qrro[0]+1;
//echo $id;
//echo $counter;
for($i=0;$i<$counter;$i++)
{
//echo "INSERT INTO `satyavan_new_clinic`.`busyslot` (`id`, `date`, `branch`, `type`, `slotid`, `time`, `status`) VALUES ('".$id."', '".$date."', '".$center."', '".$apptype."', '".$blockid."', '".$time[$i]."', '0')<br>";
$qry=mysql_query("INSERT INTO `satyavan_new_clinic`.`busyslot` (`id`, `date`, `branch`, `type`, `slotid`, `time`, `status`) VALUES ('".$id."', STR_TO_DATE('".$date."','%d/%m/%Y'), '".$center."', '".$apptype."', '".$blockid."', '".$time[$i]."', '0')");
if($qry)
{
$id=$id+1;
}
else
$err[]="failed to make ".$time[$i]." slot busy. reason ".mysql_error();
}
if(count($err)>0)
{
for($i=0;$i<count($err);$i++)
echo $err[$i]."<br>";
}
else
header('location:busyslot.php');
}
?>