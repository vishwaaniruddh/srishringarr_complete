<?php
include('config.php');

       $id=$_GET['barcode'];

$qry="SELECT * FROM  `phppos_rent` where cust_id='$id' and status='A' ";
$res=mysql_query($qry);                
$num=mysql_num_rows($res);
$dep=0;
$pa=0;
$rent=0;			
				 				 
?>
<table  border="1" cellpadding="4" cellspacing="0" width="850" align="left">
 <tr>
 <th width='35' height="34"><U>Sr.No.</U></th>
    <th width='35' height="34"><U>Bill No.</U></th>
    <th width='95'><u>Customer Name</u></th>
    <th width='34'><u>Pick-Up</u></th>
    <th width='58'><u>Delivery</u></th>
     <th width='61'><u>Throught</U></th>
     <th width='70'><u>Bill Date</U></th>
  <th width='40'><U>Rent</U></th>
  <th width='79'><U>Deposit</U></th>
    <th width='99'><U>Rent Return</U></th>
  <th width='97'><U>Delete Rent </U></th>
  </tr>
<?php
$i=1;

$dep1=0;

while($row = mysql_fetch_row($res)) 
 {
$sql1=mysql_query("SELECT * FROM `phppos_people` WHERE `person_id`='$row[1]'");
$row1=mysql_fetch_row($sql1);
 
 $sql2=mysql_query("SELECT * FROM `phppos_people` WHERE `person_id`='$row[8]'");
$row2=mysql_fetch_row($sql2);

$sql3=mysql_query("SELECT * FROM `order_detail` WHERE `bill_id`='$row[0]'");
while($row3=mysql_fetch_row($sql3)){
	$dep1+=$row3[3];
}

?>				   
				   
<tr>
<td width="35"><?php echo $i; ?></td>
<td width="35"><?php echo $row[0]; ?></td>
<td width="95" align="center"><?php echo $row1[0]." " .$row1[1]; ?></td>
<td width="34"><?php echo $row[6]; ?></td>
<td width="58"><?php echo $row[7]; ?></td>
<td width="61"><?php echo $row2[0]; ?></td>
<td width="70"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
<td width="40"><?php echo $row[3]; $rent+=$row[3]; ?></td>
<td width="79"><?php echo $dep1; $dep+=$dep1; ?></td>
 <td  align="left" width="99"><a href="rent_detail.php?id=<?php echo $row[0]; ?>">Rent Return</a></td>
 
 <td  align="left" width="97"><a href="javascript: confirm_delete(<?php echo $row[0]; ?>);">Delete Rent </a></td>
     </tr>
				
			<?php $i++; } ?>
            <tr>
<td width="35">&nbsp;</td>
<td width="95" align="center">&nbsp;</td>
<td width="34">&nbsp;</td>
<td width="58">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="61">&nbsp;</td>
<td width="70">Total </td>
<td width="40"><?php echo $rent; ?></td>
<td width="79"><?php echo $dep; ?></td>
<td width="70"><?php ///echo $pa ?></td>


     </tr>
	 <tr>
<td colspan="7" align="right"><b>Total Rent Amount :</b></td>
<!--<td width="103"><?php ///echo $pd; ?></td>-->
<td width="136"><?php echo $rent ?></td>
 <?php ///echo $s."/".$a."/".$row2[0]."<br/>"; ?>
 <td  align="left" width="135"></td><td  align="left" width="135"></td>
     </tr>
	 
	  <tr>
	  <?php $sql4=mysql_query("SELECT SUM( rent_amount)  FROM `phppos_rent`  WHERE `cust_id`='$id'");
$row4=mysql_fetch_row($sql4);
?>
	  
<td colspan="7" align="right"><b><strong>Total Rent and Rent Return Amount</strong>:</b></td>
<!--<td width="103"><?php ///echo $pd; ?></td>-->
<td width="136"><?php echo $row4[0]; ?></td>
 <?php ///echo $s."/".$a."/".$row2[0]."<br/>"; ?>
 <td  align="left" width="135"></td><td  align="left" width="135"></td>
     </tr>
	 
	  <tr>
<td colspan="7" align="right"><b>Total Paid Amount :</b></td>
<!--<td width="103"><?php
 $sql5=mysql_query("SELECT SUM( amount ) FROM  `rent_amount` WHERE  `cust_id`='$id'");
$row5=mysql_fetch_row($sql5);
 ?></td>-->
<td width="136"><?php echo $row5[0]; ?></td>
 <?php ///echo $s."/".$a."/".$row2[0]."<br/>"; ?>
 <td  align="left" width="135"></td><td  align="left" width="135"></td>
     </tr>
	 
	  <tr>
<td colspan="7" align="right"><b>Total Balance Amount :</b></td>
<!--<td width="103"><?php ///echo $pd; ?></td>-->
<td width="136"><?php echo $row4[0]-$row5[0] ?></td>
 <?php ///echo $s."/".$a."/".$row2[0]."<br/>"; ?>
 <td  align="left" width="135"></td><td  align="left" width="135"></td>
     </tr>
	 
	 
            </table>
			  
               