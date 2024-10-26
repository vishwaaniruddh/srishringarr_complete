<?php
include("access.php");
include("config.php");

$alert_id=$_GET['alert_id']; //echo  $alert_id ."<br>";
$am=$_GET['am']; //echo  $am ."<br>";
$service=$_GET['service']; //echo  $service ."<br>";
$adate=$_GET['adate']; //echo  $adate ."<br>";


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

<script>

//============================	
	
	function validate(form){
			 
		if(document.getElementById("service").value==''){
			//alert("hi");
				alert("Select primitive Maintenance");
				document.getElementById('service').focus();
				return false;
				}
		
	 if(confirm('Are you sure you want to Enter this Update.')) 
		   {
			return true;
		   }
		   else 
		    {
			return false;
			} 
	 
		 
 }
</script>

</head>
<body>
<center>
<br /> 
<br />
<br />
<form action="con2amc.php" method="post" name="form"  onSubmit="return validate();" >
<table width="100%">
<tr>
<td>Service:</td>  
<td colspan="2">
<select name="service" id="service">
    <option value="">-Select-</option>
    <option value="3">Every 3 month</option>
    <option value="6">Every 6 month</option>
</select></td>

<td>AMC Start Date:</td>  
<td colspan="2"><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate<?php echo $count; ?>');" value="<?php echo date('d/m/Y'); ?>" readonly /></td>

</tr>

<tr></tr>

<tr><th>Sr No</th><th>Asset</th><th>specification</th><th>Qty</th><th>AMC period</th><th>Rate</th></tr>
<?php 
	$qry2=mysqli_query($con1,"select * from assets where status=0");
	$i=0;
	while($assets=mysqli_fetch_array($qry2)){
?>
<tr>
<!-- ========= Sr No. ========= --->
<td><?php echo $i+1;?><input type="checkbox" name="check[]" value="<?php echo $assets[1];?>"/></td>
<!-- Name of Assets--->
<td height="35" ><?php echo $assets['assets_name'];?></td>	
<!--====== specification =========--->
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
<!-- =======QUANTITY==========--->
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

<!--====== WARRANTY =========--->
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
<!--====== RATE =========--->
<td>
<input type="text" name="rate[<?php echo $i;?>]" id="rate[<?php echo $i;?>]" />
</td>
</tr>


<?php
		
	$i++;
	}
?>
<tr> <td colspan="6" align="center"><input type="submit" name="submit" value="Submit" /> </td> </tr>
<input type="hidden" name="alert_id" id="alert_id" value="<?php echo $alert_id ; ?>" />
</table>

</form>
</center>
</body>
</html>
