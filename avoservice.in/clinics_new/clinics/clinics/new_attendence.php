<?php
include ('config.php');

$adate=$_POST['atdate'];
$name=$_POST['name'];
$d=count($name);
$present=$_POST['present'];
$hour=$_POST['hr'];
$min=$_POST['min'];
$ot=$_POST['ot'];

for($i=0;$i<$d;$i++)
{
//	echo $adate;
	//$liste = explode("+",$present[$i]); 
  // $liste1 =  $liste[0];
 // $liste2 =  $liste[1];
// echo $present[$i];
 // echo $hour[$i]."<br/>";
 // echo $min[$i]."<br/>";
 
 $time[$i]=$hour[$i].":".$min[$i];

$sql="insert into attendence (attdate,staff_id,present,time,ot) values (STR_TO_DATE('".$adate."','%d/%m/%Y'),'$name[$i]','$present[$i]','$time[$i]','$ot[$i]')";
$result=mysql_query($sql);
}

if ($result)
{
	header("location:home.php");
}
else 
echo "Error Inserting Data";

?>