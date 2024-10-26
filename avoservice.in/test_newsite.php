<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
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
if(servicetype.value=="")
{
	alert("Please Select Primitive maintenance.");
	servicetype.focus();
	return false;
}
//alert(type.value);
if(type.value=="sales")
{
	alert("hi");
if(po.value=="0" || po.value=="")
{
	alert("Please Enter Purchase Order.");
	po.focus();
	return false;
}
if(userfile.value.length < 1)
{
    alert("You Forgot to select an *.xls File to Import");
     return false;
}
}
else if(type.value=='AMC')
 {
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
 
  }


</script>

</head>

<body>
<center>
<?php include("menubar.php");
include("config.php"); ?>

<h2>Add New Site</h2>
<div id="header">

<form action="test_process_newsite.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">

<table>
<tr>
<td width="207" height="35">Select Customer Name: </td>
<td width="525">

<select name="cust" id="cust">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"select * from customer");
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>


<?php } ?>
</select> 
<br/><a href="newcust.php">New Customer</a></td>
</tr>

<tr>
<td width="210" height="35">Select Site Type </td>
<td width="525">
<input type="radio" name="type" id="type" value="sales" onclick="document.getElementById('amc').style.display='none';
 document.getElementById('sales').style.display='block';changerad();" class="type" checked="checked"/>Sales Site
   
<input type="radio" name="type" id="type" value="AMC"  onclick="document.getElementById('amc').style.display='block';
 document.getElementById('sales').style.display='none';changerad();" class="type"/>AMC Site</td>
</tr>
<tr>
<td height="35">Primitive Maintenance:</td>
<td colspan="2"><select name="servicetype" id="servicetype"><option value=''>Select</option>
<option value="3" <?php if(isset($_POST['servicetype'])=="3"){ echo "selected";  }  ?>>Every 3 Month</option>
<option value="6" <?php if(isset($_POST['servicetype'])=="6"){ echo "selected";  }  ?>>Every 6 Month</option>

</select></td>
</tr>

</table>
<!-----------------------------------------------------sales----------------------------------------->

<table border="0" id='sales' >

<tr>
<td width="216" height="35"><b>Purchase Order :</b></td>
<td width="521"><input type="text" name="po" id="po" /></td>
</tr>
<tr>
<td width="216" height="35"><b>Select *.xls File to Import :</b></td>
<td width="521"><input type="file" name="userfile" value="" id="userfile" /></td>
</tr>
<tr>

<td colspan="2"><b>Data Format(ATM Id<font color='red'>*</font>,Bank Name,Area,Pincode,City<font color='red'>*</font>,State<font color='red'>*</font>,Branch<font color='red'>*</font>,Address,Ref_id,PO date,Ups,Number of Ups, Ups warrenty,Battery(separated with commas if multiple),Number of Battery (separated with commas),Battery warranty(separated with commas if multiple), Isolation Transformer,Number of Isolation transformer,Isolation Transformer Warranty, Stablizer,number of stablizer, Stablizer warranty,AVR,number of AVR, AVR warranty),Distance from Branch<font color='red'>*</font></b></td>
</tr>



<tr>
<td height="35" colspan="2"><input type="submit" value="submit1" class="readbutton" /></td>
</tr>
</table>




<!-----------------------------------------AMC form---------------------------------->


<table  id="amc" style="display:none;">
<tr>
<td width="216" height="35"><b>Purchase Order :</b></td>
<td width="521"><input type="text" name="po2" value="" id="po2" /></td>
</tr>
<tr>
<td width="216" height="35"><b>Select *.csv File to Import :</b></td>
<td width="521"><input type="file" name="userfile2" value=""></td>
</tr>


<tr>

<td colspan="2"><b>Data Format(ATM Id<font color='red'>*</font>,Bank Name,Area,Pincode,City<font color='red'>*</font>,State,Branch<font color='red'>*</font>,Address,Ref_id,Amc Start date<font color='red'>*</font>,Ups,Number of Ups, Ups warranty,Battery(separated with commas if multiple),Number of Battery (separated with commas),Battery warranty(separated with commas if multiple), Isolation Transformer,Number of Isolation transformer,Isolation Transformer Warranty, Stablizer,number of stablizer, Stablizer warranty,Amc Expiry Date(dd/mm/yyyy)<font color='red'>*</font>,AVR,number of AVR, AVR warranty,Reason,Distance from Branch<font color='red'>*</font>)</b></td>
</tr>

<tr>
<td height="35"  colspan="2"><input type="submit" value="submit" class="readbutton" /></td>
</tr></table>

</form>

</div>

</center>
</body>
</html>