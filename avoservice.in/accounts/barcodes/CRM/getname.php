<?php
include('config.php');
session_start();
//echo $_SESSION['user']."hiii";
$user=$_SESSION['user'];
//echo $user;
$cname=$_GET['cname'];
//echo $cname;
$sql=mysql_query("SELECT * FROM `phppos_service` WHERE `cust_id`='$cname'");
?>
<center>
<table  border="1" cellpadding="4" cellspacing="0" width="1016" align="center">
<tr>
<th width='43' height="34">Sr.No.</th>
<th width='109' height="34">Customer ID</th>
<th width='109' height="34">Customer</th>
<th width='61'>Item</th>
<th width='68'>Contact</th>
<th width='104'>Address</th>
<th width='61'>Pincode</th>
<th width='86'>Purchase Date</th>
<th width='110'>Service Date1</th>
<th width='107'>Service Date2</th>
<th width='101'>Service Date3</th>	
<th width='125'>Service Date4</th>
<th width='61' align="center">Options</th>
</tr>
<?php
$i=1;
while($row = mysql_fetch_row($sql)) 
 {
     /*$sql1="select * from phppos_sales where customer_id='$row[11]'";
	 $res1=mysql_query($sql1);
	 $row1 = mysql_fetch_row($res1);
	 
	 $sql2=mysql_query("select * from phppos_sales_items where sale_id='$row1[4]'");
	while( $row2 = mysql_fetch_row($sql2)) {
	 
	 $sql3=mysql_query("select * from phppos_items where item_id='$row2[1]'");
	 $row3 = mysql_fetch_row($sql3);
	 
	 ////alert date
	
$a=date('d/m/Y', strtotime($row1[0]. ' + 3 months'));
$b=date('d/m/Y', strtotime($row1[0]. ' + 6 months'));
$c=date('d/m/Y', strtotime($row1[0]. ' + 9 months'));
$d=date('d/m/Y', strtotime($row1[0]. ' + 1 year'));*/
?>	   
<tr>
<td width="43"><?php echo $i++; ?></td>
<td width="109"><?php echo $row[18]; ?></td>
<td width="109"><?php echo $row[2]; ?></td>
<td width="61"><?php echo $row[6]; ?></td>
<td width="68"><?php echo $row[3]; ?></td>
<td width="104"><?php echo $row[5]; ?></td>
<td width="61"><?php echo $row[17]; ?></td>
<td width="86"><?php if(isset($row[7]) and $row[7]!='0000-00-00') echo date('d/m/Y',strtotime($row[7])); ?></td>
<?php if($row[16]=='domestic'){ ?>

<td width="110"><?php if(isset($row[8]) and $row[8]!='0000-00-00') echo date('d/m/Y',strtotime($row[8])); ?>
<?php if($row[9]=='Yes'){echo "Done " ?><a href="service_detail.php?id=<?php echo $row[0]; ?>&sdate1=<?php echo $row[8];?>"> Details</a> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service2.php?id=status1&cid=<?php echo $cname; ?>&sdate1=<?php echo $row[8]; ?>&pdate=<?php echo $row[7]; ?>';"> 
 <input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=1&id=<?php echo $cname; ?>';"/> <?php } ?>
 </td>
  
<td width="107"><?php if(isset($row[10]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?>
  <?php if($row[11]=='Yes'){echo "Done " ?><a href="service_detail.php?id=<?php echo $row[0]; ?>&sdate1=<?php echo $row[10]; ?>">Details</a> <?php }else{ ?> <input type="checkbox" name="sd2" id="sd2" onclick="javascript:location.href = 'service2.php?id=status2&cid=<?php echo $cname; ?>&sdate1=<?php echo $row[10]; ?>&pdate=<?php echo $row[7]; ?>';">
  <input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=2&id=<?php echo  $cname; ?>';"/><?php } ?>
  </td>
  
<td width="101"><?php if(isset($row[12]) and $row[12]!='0000-00-00') echo date('d/m/Y',strtotime($row[12])); ?>
  <?php if($row[13]=='Yes'){echo "Done " ?><a href="service_detail.php?id=<?php echo $row[0]; ?>&sdate1=<?php echo $row[12]; ?>">Details</a> <?php }else{ ?> <input type="checkbox" name="sd3" id="sd3" onclick="javascript:location.href = 'service2.php?id=status3&cid=<?php echo $cname; ?>&sdate1=<?php echo $row[12]; ?>&pdate=<?php echo $row[7]; ?>';">
  <input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=3&id=<?php echo $cname; ?>';"/><?php } ?></td>
  
<td width="125"><?php if(isset($row[14]) and $row[14]!='0000-00-00') echo date('d/m/Y',strtotime($row[14])); ?>
  <?php if($row[15]=='Yes'){echo "Done " ?><a href="service_detail.php?id=<?php echo $row[0]; ?>&sdate1=<?php echo $row[14]; ?>">Details</a> <?php }else{ ?><input type="checkbox" name="sd4" id="sd4" onclick="javascript:location.href = 'service2.php?id=status4&cid=<?php echo $cname; ?>&sdate1=<?php echo $row[14]; ?>&pdate=<?php echo $row[7]; ?>'">
  <input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=4&id=<?php echo $cname; ?>';"/> <?php } ?>
</td>
   <?php } else{?>
  <td width="110"> </td>
<td width="110"> </td>
<td width="110"> </td>
 <td width="110"> </td>
  <?php } ?>
<td width="109"><a href="edit_customer.php?id=<?php echo $cname; ?>">Edit</a>&nbsp&nbsp&nbsp<?php if($user=='sunrise') { ?><a href="delete_customer.php?id=<?php echo $row[0]; ?>">Delete</a><?php  } ?>
<input type="button" value="Print Warranty" onclick="window.open('print.php?id=<?php echo $row[0];?>','PRINT WARRANTY')"></td>
</tr>
 <?php if($row[16]=='commercial'){ 
	
$query1 =mysql_query("select * from phppos_servicestatus where id='$row[0]' order by service_date asc");
$num1=mysql_num_rows($query1);
$j=1;
while($ro=mysql_fetch_row($query1)){
	?>
    <tr>
    
    <td><font color="#FFFFFF"> Service Date<?php echo $j++; ?> : </font></td>
    <td>
	<?php if(isset($ro[2]) and $ro[2]!='0000-00-00') echo date('d/m/Y',strtotime($ro[2])); ?>
	<?php if($ro[3]=='Yes' || $ro[3]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update3.php?id=<?php echo $ro[0]; ?>&dt=<?php echo $row[3]; ?>'">


	<input type="button" value="change"  onclick="javascript:location.href = 'changedate2.php?sd=5&id=<?php echo $row[12]; ?>';"/> </td></tr>
	<?php } ?>
<?php
////closing of if case
 }}

/////////////closing of while loop
 }?>
</table>

<br/>
<?php 
$reqcut=mysql_query("SELECT * FROM `phppos_request` WHERE `person_id`='$cname' and amount='0.00' order by request_date DESC");

?>
<table border="1" cellpadding="4" cellspacing="0" width="1016" align="center">
  <tr>

<th colspan="8">Customer Request</th></tr>
<tr>
<th width="41"><b>Sr No.</b></th>
<th width="98"><b>Request For </b></th>
<th width="173"><b>Request Date</b></th>
<th width="146"><b>Assign to</b></th>
<th width="58"><b>Status</b></th>
<th width="118"><b>Complete_date </b></th>
<th width="179"><b>feed Back</b></th>
<th width="121"><b>Client</b></th>

</tr>
<?php
$a=1;
 while($resrow=mysql_fetch_row($reqcut)){

$enres=mysql_query("SELECT * FROM  `phppos_engineer` where id='$resrow[4]' ");
$enrow=mysql_fetch_row($enres);
?>
<tr>
<td width="41" height="33"><?php echo $a++; ?></td>
<td width="98"><?php echo $resrow[2]; ?></td>
<td width="173"><?php if(isset($resrow[3]) and $resrow[3]!='0000-00-00') echo date('d/m/Y',strtotime($resrow[3])); ?></td>
<td width="146"><?php echo $enrow[1]; ?></td>
<td width="58"><?php echo $resrow[5]; ?></td>
<td width="118"><?php if(isset($resrow[6]) and $resrow[6]!='0000-00-00') echo date('d/m/Y',strtotime($resrow[6])); ?></td>
<td width="179"><?php echo $resrow[7]; ?></td>
<td width="121"><?php echo $resrow[10]; ?></td>
</tr>
<?php } ?>
</table>
</center>			  
               