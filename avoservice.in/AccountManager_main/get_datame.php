<?php
include("../access.php");
include('../config.php');
//echo $_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user'];  ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

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
$callid=$_GET['callid'];
$my1=mysql_query("select type,po from pending_installations where id='".$callid."'");
$myrow = mysql_fetch_row($my1);
if($myrow[0]=="sales")
$qry="SELECT `cust_id`,`bank_name`,`state1`,`city`,`address`,`pincode`,`area`,`servicetype`,`po` FROM `atm` WHERE `atm_id`='$ref'";
else
$qry="SELECT `cid`,`bankname`,`state`,`city`,`address`,`pincode`,`area`,`po` FROM `Amc` WHERE `atmid`='$ref'";

//echo $qry;
$res=mysql_query($qry);
$row = mysql_fetch_row($res);
//echo $row[4];
		
//echo "select * from customer where cust_id='$cust'";
$qry1=mysql_query("select * from customer where cust_id='$cust'");
$row1=mysql_fetch_row($qry1);
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
<td><?php echo $cust; ?></td><td><?php echo $myrow[1]; ?></td>
<td><input type="hidden" name="bank" id="bank" value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></td>
<td ><input type="hidden" name="state" id="state" value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></td>
<td><input type="hidden" name="city" id="city" value="<?php echo $row[3]; ?>"><?php echo $row[3]; ?></td>
<td><input type="hidden" name="area" id="area" value="<?php echo $row[6]; ?>"><?php echo $row[6]; ?></td>
<td><input type="hidden" name="address" id="address" value="<?php echo $row[4]; ?>"><?php echo $row[4]; ?></td>
<td><input type="hidden" name="pin" id="pin" value="<?php echo $row[5]; ?>"><?php echo $row[5]; ?></td>
<td><input type="hidden" name="pm" id="pm" value="<?php echo ''; ?>">Every <?php echo ''; ?> month</td>
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

//echo "Select * from site_assets where atmid= (select track_id from atm where atm_id='$ref' and cust_id='".$row[0]."')";
if($myrow[0]=="sales")
$qryasst=mysql_query("Select assets_name,assets_spec,valid,quantity from site_assets where callid='".$callid."'");
else
$qryasst=mysql_query("Select assets_name,assetspecid,valid,quantity from amcassets where callid='".$callid."'");
//echo "Select * from amcassets where siteid= (select amcid from Amc where atmid='$ref' and cid='".$row[0]."')";
while($asstres=mysql_fetch_row($qryasst))
{
	$qryasstid=mysql_query("Select name from assets_specification where ass_spc_id='".$asstres[1]."' ");
	$qryassidres=mysql_fetch_row($qryasstid);
	//echo "Select * from installed_sitesme where assets like '".$asstres[0]."%' and atm_id='$ref' and cust_id='".$row[0]."'";
	
?>
<tr>
<td><?php echo $cnt+1; ?></td>

<td>
<!--<input type="checkbox" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');" value="<?php echo $asstres[3]." (".$qryassidres[0].")"; ?>" />-->
<!--<input type="checkbox" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');" value="<?php echo $asstres[3]." (".$qryassidres[0].")"."-".$asstres[6]; ?>" />-->
<input type="checkbox" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');" value="<?php echo $asstres[0]." (".$qryassidres[0].")"."-".$asstres[3]."*".$asstres[2]; ?>" checked/>
<input type="hidden" name="assid[]" value="<?php echo $qryassidres[0]; ?>" /><?php echo $asstres[0]." (".$qryassidres[0].")"; ?></td>
	<td><?php echo $asstres[3]; ?></td>
    </tr>
 <?php
 $cnt=$cnt+1;   
}
?>
</table>
</body>
</html>