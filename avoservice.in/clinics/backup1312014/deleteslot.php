<?php
include("config.php");
if(isset($_POST['cmddel']))
{
$j=0;
$cnt=$_POST['counter'];
$id=array();
for($i=0;$i<$cnt;$i++)
{
//echo $_POST['blockid'][$i];
if(isset($_POST['blockid'][$i]) && $_POST['blockid'][$i]!='' )
{

$id[]=$_POST['blockid'][$i];

$j=$j+1;
}

}

if($j==0)
{
header('location:view_slot.php');
}
else
{
 $id2=implode(",",$id);
 //echo "delete from slot where block_id in ($id2)";
$qry=mysql_query("delete from slot where block_id in ($id2)");
if($qry)
header('location:view_slot.php?stat=Slot Deleted Successfully');
else
echo "Some Error Occurred".mysql_error();
}
}
?>