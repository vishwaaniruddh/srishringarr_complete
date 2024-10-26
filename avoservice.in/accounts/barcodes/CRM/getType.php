<table width="927" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th width="28">Sr No.</th>
	 <th width="28">Customer ID</th>
    <th width="71">Name</th>
    <th width="73">Contact</th>
    <th width="119">Address</th>
    <th width="119">Pincode</th>
    <th width="83">Assign To</th>
    <th width="81">Request</th>
    <th width="122">Feedback</th>
    <th width="66">Request Date</th>
    <th width="60">Amount</th>
    <th width="60">Paid Amount</th>
    <th width="68">Balance Amount</th>
    <th width="70">Update</th>
    <th width="70">Feedback</th>
<?php
$sum=0;
$sum1=0;$sum2=0;
$i=1;
$cid=$_GET['cid'];
include('config.php');
//echo "select * from  phppos_request where status='' and cust_type='$cid'";
$sql=mysql_query("select * from  phppos_request where status='' and cust_type='$cid'");
while($row = mysql_fetch_row($sql)){ 

if($cid=="sales"){ 
$sql1="select * from  phppos_service where id='$row[1]'";
}else if($cid=="service"){ 
//echo $row[1];
$sql1="select * from  phppos_service1 where cr_id='$row[1]'";	
}
else{  
$sql1="select * from  phppos_service1 where cr_id='$row[1]'";	
}
//echo $sql1;
$sq=mysql_query($sql1);
$row1 = mysql_fetch_row($sq);

$result2 = mysql_query("SELECT * FROM  phppos_engineer where id='$row[4]' order by name");
$row2 = mysql_fetch_row($result2);
?>
  </tr>
  <tr>
    <th width="28"><?php echo $i++; ?></th>
	<td><?php echo $row1[0]; ?></td>
    <td><?php echo $row1[2]; ?></td>
    <td><?php echo $row1[3]; ?></td>
    <td><?php echo $row1[5]; ?></td>
    <td><?php if($cid=='sales'){ echo $row1[17];} else echo $row1[8]; ?></td>
    <td><?php echo $row2[1]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td><?php echo $row[8]; $sum+=$row[8]; ?></td>
    <td><?php echo $row[9]; $sum1+=$row[9]; ?></td>
    <td><?php $am=$row[8]-$row[9]; $sum2+=$am; echo $am; ?></td>
    <td width="70"><a href="update_request.php?id=<?php echo $row[0]; ?>&type=<?php echo $cid; ?>">Update</a></td>
    <td width="70"><a href="view_feedback.php?id=<?php echo $row[0]; ?>&type=<?php echo $cid; ?>&name=<?php echo $row1[2]; ?>">Feedback</a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="9" align="right">Total Amount</td>
    <td><?php echo $sum; ?></td>
    <td><?php echo $sum1; ?></td>
    <td><?php echo $sum2; ?></td>
    <td></td>
  </tr>
</table>