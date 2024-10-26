<?php
include "../access.php";
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
<style>
.specification{color:#FF3; font-size:20px; font-weight:bold;}
</style>
</head>
<body>
<center>
<?php include "menubar.php";
include "../config.php";
$amcid = $_GET['atmid'];
$custo = $_GET['cust'];
//echo $custo;
?>
<h2>View AMC Site</h2>

<form action="process_po.php" method="post" enctype="multipart/form-data"  name="form" onSubmit="return validat(this)">
<table width="800">
<tr>
<td width="200"><b>Customer Name</b></td>

<?php
$client = "select cust_id,cust_name from customer where 1";
if ($_SESSION['designation'] == 5) {
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust = mysqli_query($con1, "select client from clienthandle where logid= (select srno from login where username='" . $_SESSION['user'] . "')");
    $cc = array();
    while ($custr = mysqli_fetch_array($cust)) {
        $cc[] = $custr[0];
    }

    $ccl = implode(",", $cc);
    $ccl = str_replace(",", "','", $ccl);
    $ccl = "'" . $ccl . "'";
    $client .= " and cust_name in($ccl)";

}
$client .= " order by cust_name ASC";
//echo $client;
?>
  <td width="200" ><input type="text" name="cust" id="cust" value="<?php echo $custo; ?>" readonly="readonly" /></td>

  <td width="200" height="35" ><b>Site Type</b></td>
<td width="200" colspan="2">
<!--<input type="radio" name="type" id="type" value="sales" onclick="document.getElementById('amc').style.display='none';
 document.getElementById('sales').style.display='block';changerad();" class="type" checked="checked"/> Site-->

<input type="text" name="site" id="site" value="AMC"  readonly="readonly" />
 </td>
  </tr>





<tr>
<td height="35" width="200"><b>Primitive Maintenance:</b></td>
<td  width="200"><select name="servicetype" id="servicetype"><option value=''>Select</option>
<option value="3" >Every 3 Month</option>
<option value="6" >Every 6 Month</option>

</select></td>

<td width="200" height="35"><b>Purchase Order :</b></td>
<?php
$qrypo = mysqli_query($con1, "select * from `Amc` where amcid='" . $amcid . "' ");
$qrypo1 = mysqli_fetch_row($qrypo);

?>
<td width="200" colspan="2"><input type="text" name="po" id="po" value="<?php echo $qrypo1[2]; ?>" readonly="readonly" /></td>
</tr>



<tr>
<td width="200" height="35"><b>ATM ID :</b></td>
<td width="200" colspan="1" ><input type="text" name="atm" id="atm" value="<?php echo $qrypo1[3]; ?>" readonly="readonly" /></td>
<td width="200" height="35"><b>Bank Name :</b></td>
<td width="200" colspan="2"><input type="text" name="bank" id="bank" value="<?php echo $qrypo1[4]; ?>" readonly="readonly" /></td>
</tr>



<tr>
<td width="200" height="35"><b>Area :</b></td>
<td width="200" ><input type="text" name="area" id="area"  value="<?php echo $qrypo1[5]; ?>" readonly="readonly" /></td>
<td width="200" height="35"><b>Pincode:</b></td>
<td width="200" colspan="2"><input type="text" name="pin" id="pin" value="<?php echo $qrypo1[6]; ?>" readonly="readonly"  /></td>
</tr>



<tr>
<td width="200" height="35"><b>City :</b> </td>
<td width="200" >
<input type="text" name="city" id="city" value="<?php echo $qrypo1[7]; ?>" readonly="readonly"  />
<td width="200" height="35"><b>State :</b> </td>
<td width="200" colspan="2">
<input type="text" name="state" id="state" value="<?php echo $qrypo1[8]; ?>" readonly="readonly"/>
</td>

</tr>



<tr>
<td width="200" height="35"><b>Address : </b></td>
<td width="200" >
<textarea name="address" id="address" rows="4" cols="28" readonly="readonly" /></textarea>
</td>
<td width="200" height="35"><b>Ref ID:</b></td>
<td width="200" colspan="2"><input type="text" name="ref" id="ref" value="<?php echo $stro[10]; ?>" readonly="readonly" /></td>
</tr>



<tr>
<td width="200" height="35"><b> Date:</b></td>
<td width="200" colspan="4"><input type="text" name="dt" id="dt" onclick="displayDatePicker('dt')" value="<?php echo date('d/m/Y'); ?>"/></td>
</tr>

<tr>
<td height="35"><b>UPS</b></td>
<td width="627" colspan="4">
<table>
<tr>
<td width="100" class="specification">Specification:</td>
<td width="100">
<select name="ups" id="ups">
<option value="0">select</option>
<?php
$qry1 = mysqli_query($con1, "Select * from assets_specification where assets_id='1'");
while ($row = mysqli_fetch_row($qry1)) {
    ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>

</select>
</td><td width="100" class="specification">

Number:</td><td width="100">

<select name="upsno" id="upsno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</td><td width="100" class="specification">
Warranty:</td><td width="100">


<select name="upswr" id="upswr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td></tr></table>
</td>
</tr>


<tr>
<td height="35" ><b>Battery</b></td>
<td width="627" colspan="4">
<table><tr>
<td width="100" class="specification">Specification:</td>
<td width="100">
<select name="btry" id="btry">
<option value="0">select</option>
<?php
$qry1 = mysqli_query($con1, "Select * from assets_specification where assets_id='2'");
while ($row = mysqli_fetch_row($qry1)) {
    ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select></td><td width="100" class="specification">

Number:</td><td width="100">

<select name="btryno" id="btryno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</td><td width="100" class="specification">
Warranty:</td><td width="100">

<select name="btrywr" id="btrywr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td></tr></table>
</td>
</tr>

<tr>
<td height="39"><b>Isolation Transformer</b></td>
<td width="627" colspan="4">
<table><tr>
<td width="100" class="specification">Specification:</td>
<td width="100">
<select name="isot" id="isot">
<option value="0">select</option>
<?php
$qry1 = mysqli_query($con1, "Select * from assets_specification where assets_id='8'");
while ($row = mysqli_fetch_row($qry1)) {
    ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
</td><td width="100" class="specification">
Number:</td>
<td width="100">
<select name="isotno" id="isotno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</td><td width="100" class="specification">
Warranty: </td><td width="100">

<select name="isotwr" id="isotwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td></tr></table>
</td>
</tr>

<tr>
<td height="35"><b>Stabilizer<b></td>
<td width="627" colspan="4">
<table><tr>
<td width="100" class="specification">Specification:</td>
<td width="100">
<select name="stab" id="stab">
<option value="0">select</option>
<?php
$qry1 = mysqli_query($con1, "Select * from assets_specification where assets_id='7'");
while ($row = mysqli_fetch_row($qry1)) {
    ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>
</select>
</td><td width="100" class="specification">
Number: </td><td width="100">

<select name="stabno" id="stabno">
<option value="0">select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</td><td width="100" class="specification">
Warranty: </td>
<td width="100">

<select name="stabwr" id="stabwr">
<option value="0">select</option>
<option value="12,month">1year</option>
<option value="24,month">2year</option>
<option value="36,month">3year</option>
<option value="48,month">4year</option>
<option value="60,month">5year</option>
</select>
</td></tr></table>
</td>
</tr>

<tr>
<input type="hidden" name="atmid" value="<?php echo $amcid; ?>"  />
<td colspan="5" height="50" align="center"><input type="submit" value="submit" class="readbutton" /></td>

</tr>
</table>
</form>
</center>
</body>
</html>