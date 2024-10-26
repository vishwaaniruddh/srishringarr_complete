<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>



<?php
 //$cname=$_GET['cname'];
 //$cust=$_GET['cust'];
 $cid=$_GET['cid'];
 // $cont=$_GET['cont'];
 ?>

 
 
<!----sales customer ----> 
<?php if($cid=="sales"){ ?>
<table width="793" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="30">Sr No</th>
	 <th width="73">Customer ID</th>
    <th width="116">Customer Name</th>
    <th width="89">Item Name</th>
    <th width="104">Contact</th>
    <th width="124">Address</th>
    <th width="124">Pincode</th>
    <th width="69">Amount</th>
    <th width="80">Start Date</th>
    <th width="80">Service Date1</th>
    <th width="80">Service Date2</th>
    <th width="80">Service Date3</th>
    <th width="77">End Date</th>
    <th width="48">Edit</th>
  </tr>
<?php
include('config.php');
$query ="select a.amount,a.start_date,a.end_date,a.service_date1,a.service_date2,a.service_date3,a.id,b.name,b.contact,b.address,b.item_id,a.person_id,b.pincode,a.status1,a.status2,a.status3,a.end_status,a.cust_type from phppos_amc a,phppos_service b where a.person_id=b.id and a.atype='sales' ";

if(isset($_REQUEST['cont']))
{
	
$con=$_REQUEST['cont'];

$query .="and b.contact like('".$con."%') ";
}
if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$query .="and a.person_id like('".$id."%') ";
}
if(isset($_REQUEST['pin']))
{
	
$pin=$_REQUEST['pin'];
$query .="and b.pincode like('".$pin."%')";
}
$ress=mysql_query($query);

$st="";
$n=0;
$i=1;
	
//echo $query;
//	$result1 = mysql_query("SELECT * FROM  phppos_service where id='$cust' ");
	//$row1=mysql_fetch_row($result1);
while($row=mysql_fetch_row($ress)){	


  ?>
  <tr>
    <td><?php echo $i++; ?></td>
	 <td><?php echo $row[11]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo $row[10]; ?></td>
	<td><?php echo $row[8]; ?></td>
	
    <td><?php echo $row[9]; ?></td>
	    <td><?php echo $row[12]; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td><?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>
	 <td width="48"><a href="edit_amc.php?id=<?php echo $row[6]; ?>">Edit</a></td>
	<?php
	/////////////////////////////////////////////////////////////////////////commercial
	//echo $row[17];
	?> <?php if($row[17]=='commercial'){ 
	//echo "select * from phppos_amcservicestatus where id='$row[6]' order by service_date asc";
$query2 =mysql_query("select * from phppos_amcservicestatus where id='$row[6]' order by service_date asc");
$num2=mysql_num_rows($query2);
$j=1;
while($ro2=mysql_fetch_row($query2)){
	?>
	
    <tr>
    
    <td><font color="#FFFFFF"> Service Date<?php echo $j++; ?> : </font></td>
    <td>
	
	<?php if($ro2[3]=='Yes' || $ro2[3]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $ro2[0]; ?>&tbl=phppos_amcservicestatus&st=status'">

<?php if(isset($ro2[2]) and $ro2[2]!='0000-00-00') echo date('d/m/Y',strtotime($ro2[2])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate2.php?sd=5&id=<?php echo $ro2[12]; ?>';"/>
<?php } ?>

	 </td><?php } }else{?>
	
    <td><?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?>
	<?php if($row[13]=='Yes' || $row[3]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update1.php?id=status1&cid=<?php echo $row[6]; ?>'">
<?php } ?>
	<input type="button" value="change"  onclick="javascript:location.href = 'changedate2.php?sd=1&id=<?php echo $row[6]; ?>';"/> 
	</td>
    <td>
	<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?>
	<?php if($row[14]=='Yes' || $row[4]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update1.php?id=status2&cid=<?php echo $row[11]; ?>'">
<?php } ?>
<input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=2&id=<?php echo $row[6]; ?>';"/>
	</td>
    <td>
	<?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?>
	<?php if($row[15]=='Yes' || $row[5]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update1.php?id=status3&cid=<?php echo $row[6]; ?>'">
<?php } ?>

	<input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=3&id=<?php echo $row[6]; ?>';"/>
	</td>
    <td>
	<?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?>
	<?php if($row[16]=='Yes' || $row[2]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update1.php?id=end_status&cid=<?php echo $row[6]; ?>'">
<?php } ?>
	<input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=4&id=<?php echo $row[11]; ?>';"/>
	</td>
    <td width="48"><a href="edit_amc.php?id=<?php echo $row[6]; ?>">Edit</a></td>
  </tr>
 <?php } }?>
</table>
<?php } ?>
 
 
 <!----service customer ----> 
<?php if($cid=="service"){ ?>
<table width="793" border="1" cellspacing="0" cellpadding="0">
  
<?php
include('config.php');

$st="";
$n=0;
$i=1;


/*	
$result1 = mysql_query("SELECT * FROM  phppos_service1 where id='$cust' ");
$row1=mysql_fetch_row($result1);*/

$query ="select a.amount,a.start_date,a.end_date,a.service_date1,a.service_date2,a.service_date3,a.id,b.name,b.contact,b.address,b.item_id,b.amc_cust,a.person_id,b.id,a.status1,a.status2,a.status3,a.end_status from phppos_amc a,phppos_service1 b where a.person_id=b.id and a.cust_status='New' and a.atype='services' ";


if(isset($_REQUEST['cont']))
{
	
$con=$_REQUEST['cont'];

$query .="and b.contact like('".$con."%') ";
}
if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$query .="and a.person_id like('".$id."%') ";
}
if(isset($_REQUEST['pin']))
{
	
$pin=$_REQUEST['pin'];
$query .="and b.pincode like('".$pin."%')";
}
//echo $query;
$ress=mysql_query($query);
$num2=mysql_num_rows($ress);
//echo $num2;

if($num2!=0){
?>

<tr>
<th width="73">Customer ID</th>
    
    <th width="73">Customer Name</th>
    <th width="61">Item Name</th>
 
    <th width="104">Contact</th>
    <th width="124">Address</th>
    <th width="124">Pincode</th>
    <th width="56">Amount</th>
    <th width="55">Start Date</th>
    <th width="50">Edit</th> 
    <th width="66">Service Date1</th>
    <th width="66">Service Date2</th>
    <th width="66">Service Date3</th>
    <th width="51">End Date</th> 
 
  </tr>
<?php while($row=mysql_fetch_row($ress)){
 ?>
  <tr>
    <td><?php echo $row[13]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo $row[10]; ?></td>
	 <td><?php echo $row[8]; ?></td>
    <td><?php echo $row[9]; ?></td>
	 <td><?php echo $row[12]; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td><?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>
   
	    <td width="56"><a href="edit_amc.php?id=<?php echo $row[6]; ?>">Edit</a></td>
    <?php if($row[11]=='commercial'){ 
	
$query1 =mysql_query("select * from phppos_servicestatus1 where id='$row[12]' order by service_date asc");
$num1=mysql_num_rows($query1);
$j=1;
while($ro=mysql_fetch_row($query1)){
	?>
	 <td width="56"></td>
	 <td width="56"></td>
	  <td width="56"></td>
	   <td width="56"></td>
    <tr>
    
    <td><font color="#FFFFFF"> Service Date<?php echo $j++; ?> : </font></td>
    <td>
	
	<?php if($ro[3]=='Yes' || $ro[3]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  

<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $ro[0]; ?>&tbl=phppos_amc'">
<?php } ?>

	<?php if(isset($ro[2]) and $ro[2]!='0000-00-00') echo date('d/m/Y',strtotime($ro[2])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate2.php?sd=5&id=<?php echo $row[12]; ?>';"/> </td></tr>

    
    <?php } } else { ?>
    
    
    <td>
	<?php if($row[14]=='Yes' || $row[3]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=status1'">

	<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=1&id=<?php echo $row[12]; ?>';"/> 
	<?php } ?>
	</td>
	
    <td>
	<?php if($row[15]=='Yes' ){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=status2'">

	<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=2&id=<?php echo $row[12]; ?>';"/>
		<?php } ?>
	</td>
	
    <td>
	<?php if($row[16]=='Yes' ){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=status3'">

	<?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=3&id=<?php echo $row[12]; ?>';"/>
		<?php } ?>
	</td>
	
    <td>
	<?php if($row[17]=='Yes'){echo "Done " ?> <?php } else{ ?>  
	<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=end_status'">
	
	<?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=4&id=<?php echo $row[12]; ?>';"/></td>
	<?php } ?>
		<?php } ?>
   
     
  </tr>
  
  
  
  <?php } }else{
  /////////////////////////////////////starting of old service customer/////////////////////////////
 $query1 ="select a.amount,a.start_date,a.end_date,a.service_date1,a.service_date2,a.service_date3,a.id,b.name,b.contact,b.address,b.item_id,a.cust_type,a.person_id,b.id,a.status1,a.status2,a.status3,a.end_status from phppos_amc a,phppos_service1 b where a.person_id=b.id and a.cust_status='Old' ";
///echo "old";

if($_REQUEST['cont']!="")
{
	
$con=$_REQUEST['cont'];

$query1 .="and b.contact like('".$con."%') ";
}
if($_REQUEST['id']!="")
{
	
$id=$_REQUEST['id'];

$query1 .="and a.person_id like('".$id."%') ";
}
if($_REQUEST['pin']!="")
{
	
$pin=$_REQUEST['pin'];
$query1 .="and b.pincode like('".$pin."%')";
}
///echo $query1;
$ress1=mysql_query($query1);
 
 
 
 
 while($row=mysql_fetch_row($ress1)){
 ?>
  <tr>
    <td><?php echo $row[13]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo $row[10]; ?></td>
	 <td><?php echo $row[8]; ?></td>
    <td><?php echo $row[9]; ?></td>
	 <td><?php echo $row[12]; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td><?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>
   
	    <td width="56"><a href="edit_amc.php?id=<?php echo $row[6]; ?>">Edit</a></td>
    <?php if($row[11]=='commercial'){ 
	//echo "select * from phppos_amcservicestatus where id='$row[6]' order by service_date asc";
$query2 =mysql_query("select * from phppos_amcservicestatus where id='$row[6]' order by service_date asc");
$num2=mysql_num_rows($query2);
$j=1;
while($ro2=mysql_fetch_row($query2)){
	?>
	
    <tr>
    
    <td><font color="#FFFFFF"> Service Date<?php echo $j++; ?> : </font></td>
    <td>
	
	<?php if($ro2[3]=='Yes' || $ro2[3]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $ro2[0]; ?>&tbl=phppos_amcservicestatus&st=status'">

<?php if(isset($ro2[2]) and $ro2[2]!='0000-00-00') echo date('d/m/Y',strtotime($ro2[2])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate2.php?sd=5&id=<?php echo $ro2[12]; ?>';"/>
<?php } ?>

	 </td></tr>
	
    <?php } } else { ?>
    
    
    <td>
	<?php if($row[14]=='Yes' || $row[3]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=status1'">

	<?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=1&id=<?php echo $row[12]; ?>';"/> 
	<?php } ?>
	</td>
	
    <td>
	<?php if($row[15]=='Yes' || $row[4]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=status2'">

	<?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=2&id=<?php echo $row[12]; ?>';"/>
		<?php } ?>
	</td>
	
    <td>
	<?php if($row[16]=='Yes' || $row[5]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=status3'">

	<?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=3&id=<?php echo $row[12]; ?>';"/>
		<?php } ?>
	</td>
	
    <td>
	<?php if($row[17]=='Yes' || $row[2]=="0000-00-00"){echo "Done " ?> <?php } else{ ?>  
	<input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'update2.php?id=<?php echo $row[6]; ?>&tbl=phppos_amc&st=end_status'">
	
	<?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=4&id=<?php echo $row[12]; ?>';"/></td>
	<?php } ?>
		<?php } ?>
   
     
  </tr>
  <?php } } }?>
  <!----end of new-->
</table>

</center>

</body>
</html>