<?php
include('config.php');
//$cname=$_GET['cname'];
//$cont=$_REQUEST['cont'];
///$pin=$_REQUEST['pin'];


$sql="SELECT * FROM `phppos_service` WHERE ";



if(isset($_REQUEST['cont']))
{
	
$con=$_REQUEST['cont'];

$sql.="contact like('".$con."%') ";
}
if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$sql.="and id like('".$id."%') ";
}
if(isset($_REQUEST['pin']))
{
	
$pin=$_REQUEST['pin'];
$sql.="and pincode like('".$pin."%')";
}
//echo $sql;
$ress=mysql_query($sql);

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
<th width='61'>Edit</th>
</tr>
<?php
$i=1;

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
while($row=mysql_fetch_row($ress)){
?>	   
<tr>
<td width="43"><?php echo $i++; ?></td>
<td width="109"><?php echo $row[0]; ?></td>
<td width="109"><?php echo $row[2]; ?></td>
<td width="61"><?php echo $row[6]; ?></td>
<td width="68"><?php echo $row[3]; ?></td>
<td width="104"><?php echo $row[5]; ?></td>
<td width="61"><?php echo $row[17]; ?></td>
<td width="86"><?php if(isset($row[7]) and $row[7]!='0000-00-00') echo date('d/m/Y',strtotime($row[7])); ?></td>
<td width="110"><?php if(isset($row[8]) and $row[8]!='0000-00-00') echo date('d/m/Y',strtotime($row[8])); ?>

 <?php if($row[9]=='Yes'){}else{ ?>  <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update.php?id=status1&cid=<?php echo $cname; ?>';"> <?php } ?>
<input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=1&id=<?php echo $cname; ?>';"/> 
 </td>
  
<td width="107"><?php if(isset($row[10]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?>
  <?php if($row[11]=='Yes'){}else{ ?> <input type="checkbox" name="sd2" id="sd2" onclick="javascript:location.href = 'update.php?id=status2&cid=<?php echo $cname; ?>';"><?php } ?>
  <input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=2&id=<?php echo  $cname; ?>';"/>
  </td>
  
<td width="101"><?php if(isset($row[12]) and $row[12]!='0000-00-00') echo date('d/m/Y',strtotime($row[12])); ?>
  <?php if($row[13]=='Yes'){}else{ ?> <input type="checkbox" name="sd3" id="sd3" onclick="javascript:location.href = 'update.php?id=status3&cid=<?php echo $cname; ?>';"><?php } ?>
  <input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=3&id=<?php echo $cname; ?>';"/></td>
  
<td width="125"><?php if(isset($row[14]) and $row[14]!='0000-00-00') echo date('d/m/Y',strtotime($row[14])); ?>
  <?php if($row[15]=='Yes'){}else{ ?><input type="checkbox" name="sd4" id="sd4" onclick="javascript:location.href = 'update.php?id=status4&cid=<?php echo $cname; ?>';"> <?php } ?>
  <input type="button" value="change"  onclick="javascript:location.href = 'changedate.php?sd=4&id=<?php echo $cname; ?>';"/></td>
  
<td width="109"><a href="edit_customer.php?id=<?php echo $row[0]; ?>">Edit</a></td>
</tr>
<?php } ?>
</table>
</center>			  
               