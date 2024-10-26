<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection
$sql=mysqli_query($con1,"select * from sales_orders where id='".$_GET['id']."'");
$row=mysqli_fetch_row($sql);
$sql1=mysqli_query($con1,"select * from pending_installations where id='".$row[0]."'");
$row1=mysqli_fetch_row($sql1);
?>
<html>
<head>
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<style>

</style>
</head>
<body>
<form name="frm1" action="editprocessSO.php" method="post" enctype="multipart/form-data" >
<div align="center" style="padding:10px">
<input type="hidden" name="sid" value="<?php echo $_GET['id']; ?>" >
<h3>EDIT SALES ORDER</h3>
<table id="tab">
<tr>
  <td>
  Invoice NO:
  </td>
  
  <td>
  <input type="text" name="invno" id="invno" value="<?php echo $row[2]; ?>" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Invoice Date:
  </td>
  
  <td>
  <input type="text" name="date1" id="date1"  value="<?php if($row[3]!='0000-00-00' and $row[3]!='')echo date('d/m/Y',strtotime($row[3])); ?>" onclick="displayDatePicker('date1');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Invoice Value:
  </td>
  
  <td>
  <input type="text" name="invval" id="invval"  value="<?php echo $row[4]; ?>"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Courier Name:
  </td>
  <td>
  <input type="text" name="cname" id="cname" value="<?php echo $row[5]; ?>"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Docket No:
  </td>
  
  <td>
  <input type="text" name="dno" id="dno" value="<?php echo $row[6]; ?>"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Estimated Delivery Date:
  </td>
  
  <td>
  <input type="text" name="estdate" id="estdate"  value="<?php if($row[7]!='0000-00-00' and $row[7]!='')echo date('d/m/Y',strtotime($row[7])); ?>" onclick="displayDatePicker('estdate');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Dispatch Date:
  </td>
  
  <td>
  <input type="text" name="date2" id="date2"  value="<?php if($row[8]!='0000-00-00' and $row[8]!='')echo date('d/m/Y',strtotime($row[8])); ?>" onclick="displayDatePicker('date2');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Delivery Date:
  </td>
  
  <td>
  <input type="text" name="deldt" id="deldt" value="<?php if($row[9]!='0000-00-00' and $row[9]!='')echo date('d/m/Y',strtotime($row[9])); ?>" onclick="displayDatePicker('deldt');"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td>
  Upload Invoice:
  </td>
  
  <td>
  <input type="file" name="invfile" id="invfile" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note No.:
  </td>
  
  <td>
  <input type="text" name="crn" id="crn" value="<?php echo $row[12]; ?>"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note Date:
  </td>
  
  <td>
  <input type="text" name="crndate" id="crndate" value="<?php if($row[13]!='0000-00-00' and $row[13]!='')echo date('d/m/Y',strtotime($row[13])); ?>" onclick="displayDatePicker('crndate');"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note Amount:
  </td>
  
  <td>
  <input type="text" name="crnamt" id="crnamt" value="<?php echo $row[14]; ?>" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Upload Credit Note:
  </td>
  
  <td>
  <input type="file" name="crnfile" id="crnfile" />
  </td>
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td colspan="2" align="center">
  <input type="submit" name="subs" value="submit" />
  </td>
</tr>
</table>
<br>
<!--<a href="invoices.php" >BACK</a>-->
</div>
</form>
</body>