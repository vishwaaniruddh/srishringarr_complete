<?php
include("access.php");
 include("config.php");
?>

<html>
<head>
<title>Upload AMC Invoice</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<style>

</style>
</head>
<body>
<form name="frm1" action="process_amc_inv.php" method="post" enctype="multipart/form-data" >
<div align="center" style="padding:15px">


<h3>Upload AMC Invoice </h3>
<table id="tab">

<? $sql="SELECT * FROM amc_po_new where po_id= '".$_GET['id']."' ";
$sqlqry=mysqli_query($con1,$sql);
$result=mysqli_fetch_assoc($sqlqry);
$po_id=$result['po_id'];
$start1=$result['start_date'];
$start= date("d/m/Y", strtotime($start1));

$expiry1=$result['exp_date'];
$expiry= date("d/m/Y", strtotime($expiry1));

?>

<input type="hidden" name="po_id" id="po_id" value="<?php echo $_GET['id']; ?>" >
<tr>
  <td> Invoice NO:  </td>
  
  
  <td><input type="text" name="invno" id="invno"/>  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>Invoice Date: </td>
  
  <td><input type="text" name="date" id="date"  readonly="readonly" onclick="displayDatePicker('date');"  /> </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td>Invoice Value: </td>
  
  <td> <input type="text" name="invval" id="invval" onkeypress="return isNumber(event)" maxlength="10" />  </td>
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td>No. of Sites: </td>
  
<td> <input type="text" name="sites" id="sites" readonly="readonly" value= <? echo $result['no_sites']; ?> />  </td>
</tr>
<tr><th style="text-align: center;" colspan="2">Last Bill Details</th></tr>
<?
$sqlbill="SELECT * FROM amc_bills where po_id= '".$po_id."' ";
//echo $sqlbill;
$billqry=mysqli_query($con1,$sqlbill);
if(mysqli_num_rows($billqry) >0) {
while($bill=mysqli_fetch_row($billqry)){
    $sitecnt[] = $bill[5];
?>
<tr><td>Period: <?php echo $bill[11];?> Sites:<?php echo $bill[5];?> </td>

<td><table>
    <tr><td>From: <?php echo $bill[7];?> To : <?php echo $bill[8];?></td></tr>
    <tr><td>Invoice No: <?php echo $bill[2];?> </td></tr>
    <tr><td>Invoice Value: <?php echo $bill[4];?></td></tr>
    </table></td>
    </tr>
<?
} } else { ?>
<tr><td style="text-align: center;" colspan="2">No Bills Available</td></tr>
<?
}
//$scnt = array($sitecnt);
$site_cnt = array_sum($sitecnt);
//echo "Count: ".$site_cnt;
$bal= $result['no_sites'] - $site_cnt; ?>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>Now Billing Sites: </td>
  
<td> <input type="text" name="bill_sites" id="bill_sites" onkeypress="return isNumber(event)" maxlength="5" value= <? echo $bal; ?> />  </td>
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td> Select Bill Period: </td>
 <td> <select name="period" id="period" required>
     <option value="">Select</option>
<?php if($result['billperiod']==3){ ?>
    <option value="Quarter1">1st Quarter</option> 
    <option value="Quarter2">2nd Quarter</option> 
    <option value="Quarter3">3rd Quarter</option> 
    <option value="Quarter4">4th Quarter</option> <?php } ?>
   <?php if($result['billperiod']==6){ ?> 
    <option value="half1">1st Half Period</option>
    <option value="half2">2nd Half Period</option> <?php } else { ?>
    <option value="full">Full Period</option>
    
    <?php } ?>
     
 </select> </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td> Billing Period From date: </td>
 <td> <input type="text" name="start" id="start" readonly="readonly" onclick="displayDatePicker('start');" value= <? echo $start; ?> />   </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td> Billing to Date:   </td>
 <td> <input type="text" name="expiry" id="expiry" readonly="readonly" onclick="displayDatePicker('expiry');" value= <? echo $expiry; ?> />   </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td> Upload Invoice:</td>
  
  <td> <input type="file" name="invfile" id="invfile" required />  </td>
</tr>


<tr><td>&nbsp;</td><td>&nbsp;</td></tr>


<tr>
  <td colspan="2" align="center">
  <input type="submit" name="subs" value="submit" /> </td>
</tr>


</table>
</div>
</form>
</body>

<br>
<body>
<center>
<button name="close" id= "close" style="center" onclick="closeWin()">Go Back/ Close Window </button>

<script>
function closeWin() {
  window.close();
}
</script>
</center>
</body>