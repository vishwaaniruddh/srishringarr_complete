<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logistics Expenses</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<link href="menu.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>

<script type="text/javascript">
    
function validate() {

var form=document.getElementById('engform');
with(form)
{
//alert("hello");
if(cour_amount.value=='')
{
//alert("hi");
alert("Claim Amount Blank. Check !!");
cour_amount.focus();
return;
}

if(desc.value=='')
{
//alert("hi");
alert("Provide details briefly in description !!");
desc.focus();
return;
}

form.submit();
}
}


</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<?

?>

<h2>Branch Logistics Expenses</h2>
<div id="header">

<form action="process_logistics.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>

<? 

$id=$_GET['id'];

$qry=mysqli_query($con1,"select * from so_order where id='".$id."' ");
$row=mysqli_fetch_assoc($qry);
$soid=$row['po_id'];

$soqry=mysqli_query($con1,"select * from new_sales_order where so_trackid='".$soid."' ");
$sorow=mysqli_fetch_assoc($soqry);
$bran=$sorow['branch_id'];
$custid= $sorow['po_custid'];
$brqry=mysqli_query($con1,"select id, name from avo_branch where id='".$bran."' ");
$stro=mysqli_fetch_row($brqry);

$custqry=mysqli_query($con1,"select cust_id, cust_name from customer where cust_id='".$custid."' ");
$cust=mysqli_fetch_row($custqry);

$atmqry=mysqli_query($con1,"select * from demo_atm where so_id='".$soid."' ");
$atm=mysqli_fetch_row($atmqry);

$cdate=date('Y-m-d');

?>

<tr>
<td width="130" height="35">Claim Date: </td>    
<td><input type="text" name="cldate" id="cldate" class="date" readonly="readonly" value ="<? echo $cdate; ?>" ></td>
</tr>
<tr><th colspan="4" style="text-align:center">Customer Details</th></tr>

<tr>
<td width="120" height="35">Branch : </td>
<td width="220"> <input type="hidden" name="branch" id="branch" value= "<?php echo $stro[0]; ?>"><?php echo $stro[1]; ?> </td>

<td width="120" height="35">Customer Name: </td>
<td width="220"> <input type="hidden" name="cust_id" id="cust_id" value= "<?php echo $cust[0]; ?>"><?php echo $cust[1]; ?> </td>
</tr>

<tr>
<td width="120" height="35">End User Name: </td>
<td width="220"> <?php echo $atm[6]; ?> </td>

<td width="120" height="35">Address: </td>
<td width="220"> <?php echo $atm[11]; ?> </td>
</tr>

<tr>
<td width="120" height="35">Area: </td>
<td width="220"> <?php echo $atm[7]; ?> </td>

<td width="120" height="35">City & Pincode: </td>
<td width="220"> <?php echo $atm[9]." - ".$atm[8]; ?> </td>
</tr>
<tr><th colspan="4" style="text-align:center">Invoice Details</th></tr>
<tr>
<td width="120" height="35">Invoice Number: </td>
<td width="220"> <?php echo $row['inv_no']; ?> </td>

<td width="120" height="35">Invoice Date: </td>
<td width="220"> <?php echo $row['inv_date'];?> </td>
</tr>

<tr><th colspan="4" style="text-align:center">Logistics Details</th></tr>

<tr>
<td width="120" height="35">Delivery Mode: </td>
<td width="220"> <?php echo $row['del_mode']; ?> </td>

<td width="120" height="35">Courier Name: </td>
<td width="220"> <?php echo $row['courier'];?> </td>
</tr>
<tr>
<td width="120" height="35">LR / Docket No.: </td>
<td width="220"> <?php echo $row['docketno']; ?> </td>

<td width="120" height="35">Dispatch Date: </td>
<td width="220"> <?php echo $row['dis_date'];?> </td>
</tr>

<tr><th colspan="4" style="text-align:center">Expenses Claim</th></tr>

<tr>
<td width="120" height="35">Courier Amount: </td>
<td><input type="text" name="cour_amount" id="cour_amount"  ></td>

<td width="120" height="35">Handling / Other Charges, if any: </td>
<td><input type="text" name="hamali" id="hamali"  ></td>
</tr>

<tr>
<td width="120" height="35">Description in Detail: </td>
<td width="300"><textarea name="desc" id="desc" rows="3" cols="28" ></textarea></td>

<td width="130" height="35">Additional Remarks: </td>    
<td><input type="text" name="remarks" id="remarks" ></td>

</tr>

<tr>
<input type="hidden" name="so_orderid" id="so_orderid" value= "<?php echo $id; ?>">   
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>

</tr>

</table>
</form>
</div>
</center>
</body>
</html>