<?php 
session_start();
include("config.php");


$enqid=$_GET['enqid'];

$query=mysql_query("select * from enquiryperson where trackid ='".$enqid."'");
$row=mysql_fetch_row($query);

//create patient id
$ini=substr($row[9],0,1);


$sq=mysql_query("select max(no) from `patient` where area='".$row[9]."'");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;

$newsrno=$ini."-".$newpatid;

$result=mysql_query("INSERT INTO `patient`(`no`,`srno`,`name`,`birth`,`sex`,`telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`mobile2`,`type`,`area`,`remarks`) values('".$newpatid."','".$newsrno."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[10]."','".$row[12]."','".$row[6]."','".$row[8]."','".$row[5]."','".$row[16]."','".$row[14]."','".$row[13]."','nr','".$row[9]."','".$row[4]."')");

if($result)
     {
		 $dt=date('Y-m-d');
		 ?>
		 <script type="text/javascript">
		 window.location='app.php?id=<?php echo $newsrno; ?>&dt=<?php echo $dt; ?>';
		 </script>
		 <?php
	// header('location:app.php?id='.$newsrno.'&dt='.$dt.'');
	 }
	 else
	 echo "Some Error Occurred".mysql_error();


?>

















