<?php
include("access.php");
include('config.php');
//echo $_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user'];  ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">
function astselect(id)
{
alert("hi");
	/*var x=document.getElementById('ascn').value;
	//alert(x);
	//alert(id);
	//alert(document.getElementById(id).value);
	if(document.getElementById(id).checked==true)
	document.getElementById('ascn').value=1;
	elseif(document.getElementById(id).checked==false)
	document.getElementById('ascn').value=0;
	
	//alert(document.getElementById('ascn').value);*/
}
</script>
</head>
<body>
<?php
$cust=$_GET['cust'];
$ref=$_GET['ref'];
$po=$_GET['po'];

 $qry="SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`servicetype`,`po` FROM `Amc` WHERE `atmid`='".$ref."'";
$res=mysqli_query($con1,$qry);
$row = mysqli_fetch_row($res);
//echo $row[4];
		

$qry1=mysqli_query($con1,"select * from customer where cust_id='$cust'");
$row1=mysqli_fetch_row($qry1);
?>

<table border="1" cellpadding="4" cellspacing="0"><tr>
<th>Customer Name</th><th>Purchase Order No.</th>
<th >Bank Name</th>
<th>State</th>
<th>City</th>
<th>Area</th>
<th >Address</th>
<th>Pin code</th>
<th>Primitive Maintenance</th>
</tr>
<tr>
<td><?php echo $cust; ?></td><td><?php echo $row[8]; ?></td>
<td><input type="hidden" name="bank" id="bank" value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></td>
<td ><input type="hidden" name="state" id="state" value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></td>
<td><input type="hidden" name="city" id="city" value="<?php echo $row[3]; ?>"><?php echo $row[3]; ?></td>
<td><input type="hidden" name="area" id="area" value="<?php echo $row[6]; ?>"><?php echo $row[6]; ?></td>
<td><input type="hidden" name="address" id="address" value="<?php echo $row[4]; ?>"><?php echo $row[4]; ?></td>
<td><input type="hidden" name="pin" id="pin" value="<?php echo $row[5]; ?>"><?php echo $row[5]; ?></td>
<td><input type="hidden" name="pm" id="pm" value="<?php echo $row[7]; ?>">Every <?php echo $row[7]; ?> month</td>
</tr>
</table>
<br />
<br />

<table border="1" align="center">
<tr>
<th>Srno.</th>
<th>Assets with specifications</th>
<th>Quantity</th>
</tr>
<?php
$cnt=0;
//echo "Select * from site_assets where atmid='$ref'";
//echo "Select * from site_assets where atmid in(select amcid from amc where amcid='$ref' )and type ='AMC'";
$qryasst=mysqli_query($con1,"Select * from site_assets where atmid in(select amcid from Amc where atmid='$ref' ) and type ='AMC'");
while($asstres=mysqli_fetch_row($qryasst))
{
	//echo "Select name from assets_specification where ass_spc_id='".$asstres[4]."'";
	$qryasstid=mysqli_query($con1,"Select name from assets_specification where ass_spc_id='".$asstres[4]."' ");
	$qryassidres=mysqli_fetch_row($qryasstid);
	//echo "Select * from installed_sitesme where assets like '".$asstres[3]."%' and atm_id='$ref' and cust_id='".$row[0]."'";
	$qryin=mysqli_query($con1,"Select * from installed_sitesme where assets like '".$asstres[3]."%' and atm_id='$ref' ");
	if(mysqli_num_rows($qryin)>0)
	{
	}
	else
	{
?>
<tr>
<td><?php echo $cnt+1; ?></td>

<td>
<input type="checkbox" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');" 
value="<?php echo $asstres[3]." (".$qryassidres[0].")"."-".$asstres[6]."*".$asstres[5]; ?>" />

<input type="hidden" name="assid[]" value="<?php echo $qryassidres[0]; ?>" /><?php echo $asstres[3]." (".$qryassidres[0].")"; ?></td>

	<td><?php echo $asstres[6]; ?></td>
    </tr>
 <?php
 $cnt=$cnt+1;   
}
}
?>
</table>
</body>
</html>