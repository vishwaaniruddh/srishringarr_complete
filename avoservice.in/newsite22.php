<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function validate(form)
{
	with(form)
{
	//alert("hi");
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
	if(po.value=="")
	{
	alert("Please Enter Purchase Order.");
	po.focus();
	return false;
	}
	if(atm.value=="")
	{
	alert("Please Enter ATMID.");
	atm.focus();
	return false;
	}
	if(bank.value=="")
	{
	alert("Please Enter Bank Name.");
	bank.focus();
	return false;
	}
	if(area.value=="")
	{
	alert("Please Enter Area.");
	area.focus();
	return false;
	}
	if(pin.value=="")
	{
	alert("Please Enter Pincode.");
	pin.focus();
	return false;
	}
	if(city.value=="")
	{
	alert("Please Enter City.");
	city.focus();
	return false;
	}
	if(state.value=="")
	{
	alert("Please Select State.");
	state.focus();
	return false;
	}
	if(address.value=="")
	{
	alert("Please Enter Address.");
	address.focus();
	return false;
	}
	if(ref.value=="")
	{
	alert("Please Enter Reference ID.");
	ref.focus();
	return false;
	}
	if(ups.value >0)
	{ 
	if(upsno.value=='0' || upswr.value=='0')
	{
	alert("Please Select UPS Quantitiy And Warranty.");
	//upsno.focus();
	return false;
	}
	}
	if(btry.value >0)
	{ 
	if(btryno.value=='0' && btrywr.value=='0')
	{
	alert("Please Select Battery Quantitiy And Warranty.");
	//btryno.focus();
	return false;
	}
	}
	if(isot.value >0)
	{ 
	if(isotno.value=='0' || isotwr.value=='0')
	{
	alert("Please Select Isolation Transformer Quantitiy And Warranty.");
	//isotno.focus();
	return false;
	}
	}
	if(stab.value >0)
	{ 
	if(stabno.value=='0' || stabwr.value=='0')
	{
	alert("Please Select Stabilizer Quantitiy And Warranty.");
	//stabno.focus();
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

<form action="process_newsiteme.php" method="post" enctype="multipart/form-data"  name="form" onSubmit="return validate(this)">
<table>
<tr>
<td><b>Select Customer Name<b></td>

<?php
$client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
    //echo $client;
    ?>
    <td width="627">
    <select name="cust" id="cust" onchange="searchById('Listing','1','');"> <?php if($_SESSION['designation']!=5){ ?><option value="0">Select Client</option><?php }
$cl=mysqli_query($con1,$client);
while($clro=mysqli_fetch_row($cl))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></td>

<!--<tr>
<td><b>Select Customer Name<b></td>
<td width="627">
<select name="cust" id="cust">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"Select * from customer");


while($row=mysqli_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php
}
?>
</select>
<!--<br/><a href="newcust.php"><b>New Customer</b></a></td>
</tr>-->

<tr>
<td width="189" height="35"><b>Select Site Type</b></td>
<td width="627">
<input type="radio" name="type" id="type" value="sales" onclick="document.getElementById('amc').style.display='none';
 document.getElementById('sales').style.display='block';changerad();" class="type" checked="checked"/>Sales Site
   
<!--<input type="radio" name="type" id="type" value="AMC"  onclick="document.getElementById('amc').style.display='block';
 document.getElementById('sales').style.display='none';changerad();" class="type"/>AMC Site</td>-->
</tr>

<tr>
<td height="35"><b>Primitive Maintenance:</b></td>
<td colspan="2"><select name="servicetype" id="servicetype"><option value=''>Select</option>
<option value="3" >Every 3 Month</option>
<option value="6" >Every 6 Month</option>

</select></td>
</tr>

<tr>
<td width="189" height="35"><b>Purchase Order :</b></td>
<td width="627"><input type="text" name="po" id="po" /></td>
</tr>

<tr>
<td width="189" height="35"><b>ATM ID :</b></td>
<td width="627"><input type="text" name="atm" id="atm" /></td>
</tr>

<tr>
<td width="189" height="35"><b>Bank Name :</b></td>
<td width="627"><input type="text" name="bank" id="bank" /></td>
</tr>

<tr>
<td width="189" height="35"><b>Area :</b></td>
<td width="627"><input type="text" name="area" id="area" /></td>
</tr>

<tr>
<td width="189" height="35"><b>Pincode:</b></td>
<td width="627"><input type="text" name="pin" id="pin" /></td>
</tr>

<tr>
<td width="189" height="35">City : </td>
<td width="627">
<input type="text" name="city" id="city"  />
</td>
</tr>

<tr>
<td width="189" height="35">State : </td>
<td width="627">
<!--<input type="text" name="state" id="state" onblur="filladd(this);" />-->
<select name="state" id="state" onchange="filladd(this);">
<option value="">--Select--</option>
<?php
$state=mysqli_query($con1,"select * from state order by state ASC");
while($stro=mysqli_fetch_array($state))
{
?>
<option value="<?php echo $stro[1]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td width="189" height="35">Address : </td>
<td width="627">
<textarea name="address" id="address" rows="4" cols="28" /></textarea>
</td>
</tr>

<tr>
<td width="189" height="35"><b>Ref ID:</b></td>
<td width="627"><input type="text" name="ref" id="ref" /></td>
</tr>

<tr>
<td width="189" height="35"><b> Date:</b></td>
<td width="627"><input type="text" name="dt" id="dt" onclick="displayDatePicker('dt')" value="<?php echo date('d/m/Y'); ?>"/></td>
</tr>

<tr>
<td height="35" >
<b>UPS</b>
</td>
<td width="627">
<select name="ups" id="ups">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='1'");
while($row=mysqli_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>

</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Number:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="upsno" id="upsno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Warranty:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<select name="upswr" id="upswr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>

</tr>
<tr>
<td height="35"><b>Battery<b></td>
<td width="255">
<select name="btry" id="btry">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='2'");
while($row=mysqli_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Number:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="btryno" id="btryno">
<option value="0">select</option>
<?php
for($i=1;$i<=16;$i++)
{
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Warranty:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="btrywr" id="btrywr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>

</tr>

<tr>
<td height="39"><b>Isolation Transformer<b></td>
<td width="255">
<select name="isot" id="isot">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='8'");
while($row=mysqli_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Number:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="isotno" id="isotno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Warranty:
&nbsp;&nbsp;&nbsp;&nbsp;
<select name="isotwr" id="isotwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>

</tr>

<tr>
<td height="35"><b>Stabilizer<b></td>
<td width="255">
<select name="stab" id="stab">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='7'");
while($row=mysqli_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Number:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="stabno" id="stabno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Warranty:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="stabwr" id="stabwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>

</tr>
<tr>
<td height="35" >
<b>AVR</b>
</td>
<td width="627">
<select name="avr" id="avr">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='10'");
while($row=mysqli_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>

</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Number:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="avrno" id="avrno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Warranty:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<select name="avrwr" id="avrwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>

</tr>
<tr>

<td colspan="2" height="50"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</center>
</body>
</html>