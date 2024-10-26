<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           divToPrint.style.fontSize = "10px";
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
</script>
</head>
<body>
<?php
$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);

$id=$_GET['id'];
$uid=$_GET['uid'];



$sql1=mysql_query("select * from phppos_challan where sale_id='$id'");
$row1=mysql_fetch_row($sql1);

$sql2=mysql_query("select * from phppos_people where person_id='$row1[1]'");
$row2=mysql_fetch_row($sql2);



$sql4=mysql_query("select * from phppos_people where person_id='$uid'");
$row4=mysql_fetch_row($sql4);
?>
<div id="bill">
<center>
<h3>SUNRISE</h3>
<p>15,rafiq compound,near payal hotel,W.Exp.Highway,Dahisar East, Phone : 02228962949</p>
<table width="481" border="0" cellpadding="2" cellspacing="0">
<tr>
<td width="102"><b> Customer : </b></td>
<td width="129"><?php echo $row2[0]." ".$row2[1]; ?></td>
<td width="65" align="right"><b> Date : </b></td>
<td width="169" align="right"><?php if(isset($row1[3]) and $row1[3]!='0000-00-00') echo date('d/m/Y H:i:s',strtotime($row1[3])); ?></td>
</tr>

<tr>
<td valign="top"><b> Address : </b></td>
<td><?php echo $row2[4]." ".$row2[5]; ?></td>
</tr>

<tr>
<td><b> Challan No : </b></td>
<td><?php echo $id; ?></td>
</tr>

<tr>
<td><b> Employee : </b></td>
<td><?php echo $row4[0]." ".$row4[1]; ?></td>
</tr>
</table>

<h5>Please recieve the following goods in good order & condition.</h5>
<table width="318" border="1" cellpadding="2" cellspacing="0">
<th width="91">Item No</th>
<th width="109">Item Name</th>
<th width="98">Qty</th>

<?php
$sql=mysql_query("select * from phppos_challan_items where sale_id='$id'");
while($row=mysql_fetch_row($sql)){
$sql3=mysql_query("select * from phppos_items where item_id='$row[1]'");
$row3=mysql_fetch_row($sql3)?>
<tr>
<td><?php echo $row3[3]; ?></td>
<td><?php echo $row3[0]; ?></td>
<td><?php echo $row[2]; ?></td>
</tr>
<?php } ?>
</table>

<h6>Goods once sold will not be taken back. </h6> 
<span> Receiver's Signature </span><br /><br />
</center>
</div>
<center><a href="#" style="font-size:18px;font-weight:bold;" onclick='PrintDiv();'>Print</a></center>
</body>
</html>