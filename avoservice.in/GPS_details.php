<?php 
session_start();
include("access.php");
include('config.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->

</head>



<body>


<center>
<!--<table width="80%" border='2'>-->
<table border="1" style="margin-right:5%;margin-left:5%" width="100%" align="right" cellpadding="2" cellspacing="0" id="gpstable" >

<th width="5%">S.No</th>
<th width="10%">Name</th>
<th width="8%">Latitude</th>
<th width="8%">Longitude</th>
<th width="12%">Date</th>
<th width="40%">Address</th>

<?php
$en=$_GET['en'];
if(isset($_GET['fm']) && $_GET['fm']!=''){
$fm=$_GET['fm'];
$to=$_GET['to'];


//$locqry=mysqli_query($con1,"select * from Location where mac_address in (select mac_id from notification_tble where logid='".$_GET['id']."' ) and date(dt) between '".$fm."' and '".$to."'");    

 $locqry=mysqli_query($con1,"select * from Location where engg_id='".$_GET['id']."' and date(dt) between '".$fm."' and '".$to."' " );   
    
}
else{
$dt=date('Y-m-d');

//echo "select * from Location where mac_address in (select mac_id from notification_tble where logid='".$_GET['id']."' ) and date(dt)='".$dt."'";

$locqry=mysqli_query($con1,"select * from Location where engg_id='".$_GET['id']."' and date(dt)='".$dt."'");
}

$srn='1';
while($locfetch=mysqli_fetch_array($locqry))
{
?>

<tr>
<td><?php echo $srn;?></td>
<td><?php echo $en;?></td>
<td><?php echo $locfetch[2];?></td>
<td><?php echo $locfetch[3];?></td>
<td><?php echo date('d-m-Y H:i:s',strtotime($locfetch[4]));?></td>
<td><?php echo $locfetch[5];?></td>
</tr>

<?php
$srn++;
}
?>

</table>
</center>
</body>

</html>
