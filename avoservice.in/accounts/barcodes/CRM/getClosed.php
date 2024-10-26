<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
</head>

<body>
<table width="975" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th width="25">Sr No.</th>
	 <th width="28">Customer ID</th>
    <th width="56">Name</th>
    <th width="62">Contact</th>
    <th width="124">Address</th>
    <th width="62">Pincode</th>
    <th width="61">Assign To</th>
    <th width="94">Request</th>
    <th width="75">Complete Date</th>
    <th width="143">Feedback</th>
    <th width="63">Client</th>
    <th width="65">Request Date</th>
    <th width="59">Amount</th>
    <th width="57">Paid Amount</th>
    <th width="63">Balance Amount</th>
    <?php
$sum=0;
$sum1=0;$sum2=0;
$i=1;
$cid=$_GET['cid'];
include('config.php');
$sql=mysql_query("select * from  phppos_request where status='close' and cust_type='$cid'");
while($row = mysql_fetch_row($sql)){ 

if($cid=="sales"){
$sql1=mysql_query("select * from  phppos_service where id='$row[1]'");
}else{
$sql1=mysql_query("select * from  phppos_service1 where id='$row[1]'");	
}
$row1 = mysql_fetch_row($sql1);

$result2 = mysql_query("SELECT * FROM  phppos_engineer where id='$row[4]' order by name");
$row2 = mysql_fetch_row($result2);
?>
  </tr>
  <tr>
    <th width="25"><?php echo $i++; ?></th>
	  <td><?php echo $row1[0]; ?></td>
    <td><?php echo $row1[2]; ?></td>
    <td><?php echo $row1[3]; ?></td>
    <td><?php echo $row1[5]; ?></td>
    <td><?php if($cid=='sales'){ echo $row1[17];} else echo $row1[8]; ?></td>
    <td><?php echo $row2[1]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php if(isset($row[6]) and $row[6]!='0000-00-00') echo date('d/m/Y',strtotime($row[6])); ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo $row[10]; ?></td>
    <td><?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td><?php echo $row[8]; $sum+=$row[8]; ?></td>
    <td><?php echo $row[9]; $sum1+=$row[9]; ?></td>
    <td><?php $am=$row[8]-$row[9]; $sum2+=$am; echo $am; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="8" align="right">Total Amount</td>
    <td><?php echo $sum; ?></td>
    <td><?php echo $sum1; ?></td>
    <td><?php echo $sum2; ?></td>
  </tr>
</table>
</body>
</html>