<?php
include("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPSmasteadmin</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
//////////////////////////////site type function

function validate(form){
 with(form)
 {

if(cust.value=="0")
{
	alert("Please Select Customer Name.");
	cust.focus();
	return false;
}

	 if(po2.value=="0")
{
	alert("Please Enter Purchase Order.");
	po2.focus();
	return false;
}
if(userfile2.value.length < 1)
{
    alert("You Forgot to select an *.xls File to Import");
     return false;
}
 }
 return true;
 }
 

</script>

</head>

<body>
<center>
<?php // include("menubar.php");
include("config.php"); ?>

<h2>Upload AMC data</h2>
<div id="header">

<!--<form action="process_amcupload.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">-->
<form action="process_amcupload2.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">
<table>
<?
$amcpo=mysqli_query($con1,"select * from amc_po_new where po_id ='".$_GET['id']."' ");
$po_data=mysqli_fetch_row($amcpo);

//echo "select * from amc_po_new where po_id ='".$_GET['id']."' ";

?>
<input type="hidden" name="po_id" id="po_id" value="<? echo $po_data[0]; ?>">
<tr>
<td width="207" height="35"> Customer Name: </td>
<?
 $custqry=mysqli_query($con1,"select cust_id, cust_name from customer where cust_id='".$po_data[3]."'");
$cust=mysqli_fetch_row($custqry);

?>
<td width="525"><input type="text" name="cust" id="cust" readonly="readonly" value="<? echo $cust[0]; ?>"> <? echo $cust[1]; ?></td>

</tr>

<tr>
<td height="35">Preventive Maintenance:</td>
<td colspan="2"><input type="text" name="servicetype" id="servicetype" value="<? echo $po_data[11]; ?>">
</td>
</tr>


<tr>
<td width="216" height="35"><b>Purchase Order :</b></td>
<td width="521"><input type="text" name="po2" id="po2" readonly="readonly" value="<? echo $po_data[1]; ?>" /></td>
</tr>
<tr>
<td width="216" height="35"><b>Select *.xls File to Import :</b></td>
<td width="521"><input type="file" name="images" value="" id="images" /></td>
</tr>

<tr>
<td colspan="2"><b>Data Format(Site Id)<font color='red'>*</font>,Bank Name,Area,Pincode,City<font color='red'>*</font>,State,Branch<font color='red'>*</font>,Address,Ref_id,Amc Start date<font color='red'>*</font>,Ups,Number of Ups, Ups warranty,Battery(separated with commas if multiple),Number of Battery (separated with commas),Battery warranty(separated with commas if multiple), Isolation Transformer,Number of Isolation transformer,Isolation Transformer Warranty, Stablizer,number of stablizer, Stablizer warranty,Amc Expiry Date(dd/mm/yyyy)<font color='red'>*</font>,AVR,number of AVR, AVR warranty,Reason,Distance from Branch<font color='red'>*</font>)</b></td>
</tr>

<tr>
<td height="35"  colspan="2"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>

</form>

</div>

</center>
</body>
</html>