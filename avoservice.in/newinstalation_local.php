<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
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
 
<form action="process_instalation_local.php" method="post" enctype="multipart/form-data"  name="form" onSubmit=" validate(this)">
<table>
<tr>
<td><b>Customer Name : </b></td>
    <td width="627" colspan="5"><input type="text"  name="cust" id="cust"/></td></tr>
<tr>
<td width="189" height="35"><b>Select Site Type</b></td>
<td width="627" colspan="5">
<input type="radio" name="type" id="type" value="sales" onclick="document.getElementById('amc').style.display='none';
 document.getElementById('sales').style.display='block';changerad();" class="type" checked="checked"/>Sales Site
   </td>

</tr>

<tr>
<td height="35"><b>Primitive Maintenance:</b></td>
<td colspan="5"><select name="servicetype" id="servicetype"><option value=''>Select</option>
<option value="3" >Every 3 Month</option>
<option value="6" >Every 6 Month</option>

</select></td>
</tr>

<tr>
<td width="189" height="35"><b>Purchase Order :</b></td>
<td width="200"><input type="text" name="po" id="po" /></td>
<td>Bom No: </td><td colspan="3"><input type="text" name="bomno" id="bomno" /></td>
</tr>

<tr>
<td width="189" height="35"><b>Customer Identification Number :</b></td>
<td width="200"><input type="text" name="atm" id="atm" /></td>
<td>Bom Date: </td><td colspan="3"><input type="text" name="bomdate" id="bomdate" onclick="displayDatePicker('bomdate');"/></td>
</tr>
<!--
<tr>
<td width="189" height="35"><b>Bank Name :</b></td>
<td width="200"><input type="text" name="bank" id="bank" /></td>

</tr>
-->

<tr>
<td width="189" height="35"><b>Area :</b></td>
<td width="200"><input type="text" name="area" id="area" /></td>
<td>Indent No: </td><td colspan="3"><input type="text" name="indentno" id="indentno" /></td>
</tr>

<tr>
<td width="189" height="35"><b>Pincode:</b></td>
<td width="200" colspan="1"><input type="text" name="pin" id="pin" /></td>
<td>Indent Date: </td><td colspan="3"><input type="text" name="indentdate" id="indentdate" onclick="displayDatePicker('indentdate');"/></td>
</tr>

<tr>
<td width="189" height="35">City : </td>
<td width="200" colspan="5">
<input type="text" name="city" id="city"  />
</td>
</tr>

<tr>
<td width="189" height="35">State : </td>
<td width="200">
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
<td>ED: </td><td colspan="3"><input type="text" name="ed" id="ed" /></td>
</tr>

<tr>
<td width="189" height="35">Address : </td>
<td width="200">
<textarea name="address" id="address" rows="4" cols="28" /></textarea>
</td>

<td>VAT: </td><td colspan="3"><input type="text" name="vat" id="vat" /></td>
</tr>

<tr>
<td width="189" height="35"><b>Ref ID:</b></td>
<td><input type="text" name="ref" id="ref" /></td>

<td>Document no : </td><td colspan="3"><input type="text" name="dono" id="dono" /></td>
</tr>

<tr>
<td width="189" height="35"><b> Date:</b></td>
<td width="200"><input type="text" name="dt" id="dt" onclick="displayDatePicker('dt')" value="<?php echo date('d/m/Y'); ?>"/></td>

<td>Freight Charges: </td><td colspan="3"><input type="text" name="freight" id="freight" /></td>
</tr>
<tr><td colspan="6">
<table width="100%"><tr><th>Sr No</th><th>Asset</th><th>specification</th><th>Qty</th><th>Warrenty</th><th>Rate</th></tr>
<?php 
	$qry2=mysqli_query($con1,"select * from assets where status=0");
	$i=0;
	while($assets=mysqli_fetch_array($qry2))
	{
		//echo "<br/>".$assets['assets_name'];
?>
<tr>
<td><?php echo $i+1;?><input type="checkbox" name="check[]" value="<?php echo $assets[0];?>"/></td>
<td height="35" ><?php echo $assets['assets_name'];?></td>	
<td>
	<select name="assets[<?php echo $i;?>]" >
		<option value="0">select</option>
<?php
		$qry3=mysqli_query($con1,"select * from assets_specification where assets_id='".$assets['assets_id']."'");	
		while($assets_spec=mysqli_fetch_array($qry3))
		{
			//echo $assets_spec['name'];
?>
<option value="<?php echo $assets_spec[0]; ?>"><?php echo $assets_spec[2]; ?></option>
<?php
		}
?>
</select>
</td>
<?php
	if(strcasecmp($assets['assets_name'],"Battery")==0){
?>
<td>
<select name="qty[<?php echo $i;?>]" id="qty[<?php echo $i;?>]">
<option value="0">select</option>
<?php 
		for($j=1;$j<51;$j++){
?>
<option value="<?php echo $j;?>"><?php echo $j;?></option>
<?php 	}	?>
</select>
</td>
<?php
	}
	else{
?>
<td>
<select name="qty[<?php echo $i;?>]" id="qty[<?php echo $i;?>]">
<option value="0">select</option>
<?php 
		for($j=1;$j<11;$j++){
?>
<option value="<?php echo $j;?>"><?php echo $j;?></option>
<?php 	}	?>
</select>
</td>
<?php } ?>
<td>
<select name="warranty[<?php echo $i;?>]" id="warranty[<?php echo $i;?>]">
<option value="0">select</option>
<?php 
		for($j=1;$j<6;$j++){
?>
<option value="<?php echo ($j*12);?>,month"><?php echo $j;?> year</option>
<?php 	}	?>
</select>
</td>
<td>
<input type="text" name="rate[<?php echo $i;?>]" id="rate[<?php echo $i;?>]" />
</td>
</tr>
<?php
		
	$i++;
	}
?></table></td></tr>
<tr>
<td>Contact Number :</td><td><input type="text" name="cphone" id="cphone"/></td>
<td>Email:</td><td colspan="3"><input type="email" name="cemail" id="cemail"/></td>
</tr>
<tr><td>Requirements:</td><td colspan="4"><input type="text" name="req" id="req"/></td><td>&nbsp;</td></tr>

<tr>

<td colspan="6" height="50"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</center>
</body>
</html>