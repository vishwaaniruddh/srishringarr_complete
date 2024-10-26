<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
 header("location: index.html");
 
 include('config.php');
 include('template_clinic.html');
 $id=$_GET['id'];
 $sql=mysql_query("select * from opd where opd_real_id='$id'");
 $row=mysql_fetch_row($sql);
 $sql1=mysql_query("select name from patient where srno='$row[1]'");
 $row1=mysql_fetch_row($sql1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="M_page">
<fieldset class="textbox">
  <legend><h1><img src="ddmenu/opd.png" height="50" width="50" />OPD Details</h1></legend>

<h3>Patient : <?php echo $row1[0]; ?> <br />OPD Date : <?php if(isset($row[76]) and $row[76]!='0000-00-00') echo date('d/m/Y',strtotime($row[76])); ?></h3>

<table class="results">

<tr><th>Appointments : </th> <td><?php echo $row[8]; ?></td></tr>



<tr><th>Complaints :</th> <td><?php echo $row[30]; ?></td></tr>


<tr><th>Clincal Details :</th> <td><?php echo $row[73]; ?></td></tr>


<tr><th>Advise :</th> <td><?php echo $row[36]; ?></td></tr>


<tr><th>Diagnosis :</th> <td><?php echo $row[30]; ?></td></tr>

<tr><th>Medicines/Doasage/Procedure:</th>  <td><?php echo $row[78]." / ".$row[80]." / ".$row[79]; ?></td></tr>


<tr><th>Summary of Intervention :</th> <td><?php echo $row[34]; ?></td></tr>


<tr><th >Next Visit Information:</th>  <td><?php echo "<b>Date : </b>";

if(isset($row[38]) and $row[38]!='0000-00-00')  echo ''.date("d/m/Y",strtotime($row[38])).'<b> Time : </b>'.$row[39].' <b> Text : </b>'.$row[83].' <b> Hospital : </b>'.$row[60]; ?></td></tr>

</table>
</fieldset>
</div>

</body>
</html>




