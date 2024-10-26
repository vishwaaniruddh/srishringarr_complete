<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Barcode_Slno</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function validate(form)
{
with(form)
{
var x=document.getElementById('slno').value;
 	if(x=='0')
  	{
   	alert("Please Enter Correctly");
   	slno.focus();
  	return false;
  	}
}
}

</script>
</head>

<body>
<center><?php include("menubar.php"); ?>
<h2>Add Barcode Serial No</h2>
<div id="header">
<form action="process_barcode_slno.php" method="post" name="form" onsubmit="return validate(this)";>
<table border="1">
<?php
include('config.php');
 
 $so_id=$_GET['id'];
 $model=$_GET['model'];
 $pend_cnt=$_GET['cnt'];
// echo var_dump($_GET);

$sql="select * from demo_atm where so_id='".$so_id."'";
$atmqry=mysqli_query($con1,$sql);
$atm=mysqli_fetch_row($atmqry);

$so_qry = mysqli_query($con1, "select inv_no from so_order where po_id='".$so_id."' ");
    $soro = mysqli_fetch_row($so_qry);
    $inv_no = $soro[0];

$cl = mysqli_query($con1, "select cust_id,cust_name from customer where cust_id='".$atm[2]."' ");
    $clro = mysqli_fetch_row($cl);
    $cust_name = $clro[1];
                
$brqry = mysqli_query($con1, "select id,name from avo_branch where id='".$atm[10]."' ");
    $brro = mysqli_fetch_row($brqry);
    $br_name = $brro[1];
    
$assqry = mysqli_query($con1, "select name from assets_specification where ass_spc_id='".$model."' ");
    $assro = mysqli_fetch_row($assqry);
    $ast_name = $assro[0];

?>
<tr>
    <th width="77">Client</th><td><?php echo $cust_name; ?></td> </tr>

<tr> <th >Site/Sol/ATM ID</th> <td><?php echo $atm[1]; ?></td></tr>
<tr><th>Invoice No.</th> <td><?php echo $inv_no; ?></td> </tr>
<tr><th>End User</th> <td><?php echo $atm[6]; ?></td></tr>
<tr><th valign="top">UPS Model </th><td width="200" valign="top"><?php echo $ast_name; ?></td></tr>


<tr>

<td></td>
<td></td>
</tr>

<?php

for($i=1;$i<=$pend_cnt;$i++)
{
?>
<tr>
    <td> <? echo $i ?></td>
    <td>
        <input type="text" autocomplete="none" name="slno[]" id="slno[]">
    </td>
</tr>
<?php
}
?>
<tr>
<th height="35" colspan="4" align="center">
<input type="hidden" id="so_id" name="so_id" value="<?php echo $so_id; ?>">
<input type="hidden" id="model" name="model" value="<?php echo $model; ?>">
<input type="hidden" id="count" name="count" value="<?php echo $pend_cnt; ?>">
<input type="submit" value="submit" class="readbutton" name="delegate" /></th>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>