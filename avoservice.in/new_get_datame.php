<?php
include("access.php");
include('config.php');



 function get_customer($parameter, $callid,$con1){
    
    global $con;
    
    $sql= mysqli_query($con1,"select $parameter from demo_atm where so_id = '".$callid."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}


function get_specs($id,$con1){
    
    global $con;
    

    $sql = mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['name'];
    
}





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
}
</script>
</head>
<body>
<?php


$cust=$_GET['cust'];
$ref=$_GET['ref'];
$po=$_GET['po'];
$callid=$_GET['callid'];


?>

<table border="1" cellpadding="4" cellspacing="0">
    <tr>
        <th>Customer Name</th>
        <th>Purchase Order No.</th>
        <th >Bank Name</th>
        <th>State</th>
        <th>City</th>
        <th>Area</th>
        <th >Address</th>
        <th>Pin code</th>
       
    </tr>

<tr>

<td>
    <?php echo $cust; ?>
</td>

<td>
    <?php echo $po;
    ?>
</td>

<td>
   <input type="hidden" name="bank" id="bank" value="<?php echo get_customer('cust_id',$cust,$con1); ?>"><?php echo get_customer('bank_name',$callid,$con1); ?>
</td>
<td>
    <input type="hidden" name="state" id="state" value="<?php echo get_customer('state',$cust,$con1); ?>"><?php echo get_customer('state',$callid,$con1); ?>
</td>
<td>
    <input type="hidden" name="city" id="city" value="<?php echo get_customer('city',$cust,$con1); ?>"><?php echo get_customer('city',$callid,$con1); ?>
</td>
<td>
    <input type="hidden" name="area" id="area" value="<?php echo get_customer('area',$cust,$con1); ?>"><?php echo get_customer('area',$callid,$con1); ?>
</td>
<td>
    <input type="hidden" name="address" id="address" value="<?php echo get_customer('address',$cust,$con1); ?>"><?php echo get_customer('address',$callid,$con1); ?>
</td>

<td>
    <input type="hidden" name="pin" id="pin" value="<?php echo get_customer('pincode',$cust,$con1); ?>"><?php echo get_customer('pincode',$callid,$con1); ?>
</td>


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


$so_id = $callid;



$qryasst=mysqli_query($con1,"Select * from new_sales_order_asset where so_trackid='".$so_id."'");

while($asstres=mysqli_fetch_assoc($qryasst))
{



?>
<tr>
<td><?php echo $cnt+1; ?></td>


<td>
    
<!--<input type="hidden" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');" value="<?php echo $asstres['po_product']." (".get_specs($asstres['po_model'],$con1).")"."-".$asstres['po_qty']."*".$asstres['po_warr']; ?>" /> -->

<input type="hidden" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');" value="<?php echo $asstres['po_product']."##".get_specs($asstres['po_model'],$con1)."##".$asstres['po_qty']."##".$asstres['po_warr']; ?>" />

<!--<input type="hidden" name="assid[]" value="<?php echo $qryassidres[0]; ?>" /> -->

<?php echo  $asstres['po_product']." (".get_specs($asstres['po_model'],$con1).")"; ?>

</td>
	<td><input type="hidden" name="po_qty[]" value="<?php echo $asstres['po_qty']; ?>"><?php echo $asstres['po_qty']; ?></td>
</tr>
 <?php
 $cnt=$cnt+1;   
}
?>
</table>
</body>
</html>