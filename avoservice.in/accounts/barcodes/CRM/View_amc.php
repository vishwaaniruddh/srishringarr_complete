<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script>
///customer date
function cust()

{ //alert("GGG");

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("res").innerHTML=xmlhttp.responseText;
    }
  }
  var s=document.getElementById('cname').value;
//alert(s);
xmlhttp.open("POST","getClosed.php?cid="+s,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("fname=Henry&lname=Ford");
}
</script>
<body onload="cust();">
<center>



<?php
 //$cname=$_GET['cname'];
 $cust=$_GET['cust'];
 $cid=$_GET['cid'];
 //session_start();
 $user=$_session['user'];
 ?>

 
 
<!----sales customer ----> 
<?php if($cid=="sales"){ ?>
<table width="793" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="30">Sr No </th>
	   <th width="116">Customer ID</th>
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
    <th width="48">Options</th>
  </tr>
<?php
 
include('config.php');
//echo "select * from phppos_amc where id='$cust' and atype='sales'";
$query =mysql_query("select * from phppos_amc where id='$cust' and atype='sales'");
$num=mysql_num_rows($query);
$st="";
$n=0;
$i=1;
//echo $num;
if($num==0){
?>
 <tr>
    <td colspan="12"><?php echo "No Record Found,Please Select Another Customer "; ?></td></tr>
<?php
}else{
///////////////////////////////////////////////////////////////service	
while($row=mysql_fetch_row($query)){
//echo $row[1];
$result1 = mysql_query("SELECT * FROM  phppos_service where id='$row[1]' ");
$row1=mysql_fetch_row($result1);
?>
  <tr>
    <td><?php echo $i++; ?></td>
	<td><?php echo $row[1]; ?></td>
    <td><?php echo $row1[2]; ?></td>
    <td><?php echo $row1[6]; ?></td>
	  <td><?php echo $row1[3]; ?></td>
    <td><?php echo $row1[5]; ?></td>
	  <td><?php echo $row1[17]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?></td>
    <?php
	/////////////////////////////////////////////////////////////////////////commercial
	///echo $row[13];
	?> <?php if($row[13]=='commercial'){  ?>
     <td width="48"><a href="edit_amc.php?id=<?php echo $row[1]."$cid=".$cid; ?>">Edit</a>
     <?php if($user="sunrise")?>
<a href="delete_amc.php?id=<?php echo $row[0]."&atype=".$cid."&ctype=".$row1[7]?>"> Delete</a>
     </td>
     <?php
	//echo "select * from phppos_amcservicestatus where id='$row[6]' order by service_date asc";
$query2 =mysql_query("select * from phppos_amcservicestatus where id='$row[0]' order by service_date asc");
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
     
     
    <td>
	<?php if(isset($row[6]) and $row[6]!='0000-00-00') echo date('d/m/Y',strtotime($row[6])); ?>
    <?php if($row[7]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[6];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status1&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[6]; ?>&name=<?php echo $row1[2]; ?>';">
    <input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=1&id=<?php echo $row[1]; ?>';"/><?php } ?>
    </td>
    
    <td>
	<?php if(isset($row[8]) and $row[8]!='0000-00-00') echo date('d/m/Y',strtotime($row[8])); ?>
    <?php if($row[9]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[8];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status2&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[8]; ?>';">
    <input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=2&id=<?php echo $row[1]; ?>';"/><?php } ?>
    </td>
    
    <td>
	<?php if(isset($row[10]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?>
    <?php if($row[11]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[10];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status3&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[10]; ?>&name=<?php echo $row1[2]; ?>';">
    <input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=3&id=<?php echo $row[1]; ?>';"/><?php } ?>
    </td>
    
    <td>
	<?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status4&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[5]; ?>&name=<?php echo $row1[2]; ?>';">
    <input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=4&id=<?php echo $row[1]; ?>';"/>
    </td>
    <td width="48"><a href="edit_amc.php?id=<?php echo $row[1]."&cid=".$cid; ?>">Edit</a>
    <?php if($user="sunrise")?>
<a href="delete_amc.php?id=<?php echo $row[0]."&atype=".$cid."&ctype=".$row1[7]?>"> Delete</a>
  </tr>
 <?php } ?>
</table>
<?php } ///////////////end of while loop
}

 }?>
 
 
 <!----service customer ----> 
<?php if($cid=="service")
{ ?>
<table width="793" border="1" cellspacing="0" cellpadding="0">
  
<?php
include('config.php');

$st="";
$n=0;
$i=1;


	
//$result1 = mysql_query("select * from phppos_amc where person_id='$cust' and atype='service' and cust_status='New'");
///while($row1=mysql_fetch_row($result1)){
?>
 
    <?php  ?>
  </tr>
<?php
//echo "select * from phppos_amc where person_id='$cust' and atype='services' and (cust_status='New' or cust_status='')";
$query =mysql_query("select * from phppos_amc where id='$cust' and atype='services' and (cust_status='New' or cust_status='')");
$num=mysql_num_rows($query);


//echo $num;
if($num!=0){?>
<tr>
    <th width="116">Customer ID</th>
    <th width="73">Customer Name</th>
    <th width="61">Item Name</th>
   <th width="104">Contact</th>
    <th width="124">Address</th>
    <th width="124">Pincode</th>
    <th width="56">Amount</th>
    <th width="55">Start Date</th>
    <th width="50">Options</th> 
    <th width="66">Service Date1</th>
    <th width="66">Service Date2</th>
    <th width="66">Service Date3</th>
    <th width="51">End Date</th>
<?php
while($row=mysql_fetch_row($query)){
	
	$result1 = mysql_query("SELECT * FROM  phppos_service1 where id='$row[1]' ");
$row1=mysql_fetch_row($result1);
?>
  <tr>
    <td><?php echo $row[1]; ?></td>
    <td><?php echo $row1[2]; ?></td>
    <td><?php echo $row1[6]; ?></td>
	  <td><?php echo $row1[3]; ?></td>
    <td><?php echo $row1[5]; ?></td>
	  <td><?php echo $row1[8]; ?></td>
    <td><?php echo $row[3]; ?></td>
	
    <td><?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?></td>
    <td width="56"><a href="edit_amc.php?id=<?php echo $row[1]; ?>">Edit</a>
    <?php if($user="sunrise")?>
<a href="delete_amc.php?id=<?php echo $row[0]."&atype=".$cid."&ctype=".$row1[7]?>"> Delete</a>
    </td>
    
<?php if($row1[7]=='commercial'){ 
$query1 =mysql_query("select * from phppos_servicestatus1 where id='$row[0]' order by service_date asc");
$num1=mysql_num_rows($query1);
$j=1;
while($ro=mysql_fetch_row($query1)){
//	for($i=1<$i<=mysql_num_rows($query);$i++){
?>
    <tr>
    <td><font color="#FFFFFF"> Service Date<?php echo $j++; ?> : </font></td>
    <td>
	<?php if(isset($ro[2]) and $ro[2]!='0000-00-00') echo date('d/m/Y',strtotime($ro[2])); ?>
     <?php if($ro[3]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $ro[2];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service4.php?st=status&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $ro[2]; ?>&name=<?php echo $row1[2]; ?>';" />
    <input type="button" value="change" onclick="javascript:location.href = 'changedate2.php?sd=1&id=<?php echo $row[1]; ?>&sdate1=<?php echo $ro[2]; ?>';"/><?php } ?>
    </td>
    </tr>

    
    <?php } } else { ?>
    
    
    <td>
	<?php if(isset($row[6]) and $row[6]!='0000-00-00') echo date('d/m/Y',strtotime($row[6])); ?>
    <?php if($row[7]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[6];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status1&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[6]; ?>&name=<?php echo $row1[2]; ?>';"><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=1&id=<?php echo $row[1]; ?>';"/>
    <?php } ?>
    </td>
    
    <td>
	<?php if(isset($row[8]) and $row[8]!='0000-00-00') echo date('d/m/Y',strtotime($row[8])); ?>
    <?php if($row[9]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[8];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status2&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[8]; ?>';"><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=2&id=<?php echo $row[1]; ?>';"/>
    <?php } ?>
    </td>
    
    <td>
	<?php if(isset($row[10]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?>
    <?php if($row[11]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[10];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status3&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[10]; ?>&name=<?php echo $row1[2]; ?>';"><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=3&id=<?php echo $row[1]; ?>';"/>
    <?php } ?>
    </td>
   
    <td><?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=4&id=<?php echo $row[1]; ?>';"/></td><?php } ?>
   
     
  </tr>
  <?php }?>
</table>
<?php }else {
	///echo "select * from phppos_amc where person_id='$cust' and atype='services' and cust_status='Old'";
	$query =mysql_query("select * from phppos_amc where id='$cust' and cust_status='Old'");
$num=mysql_num_rows($query);
	?>

<tr>
    <th width="116">Customer ID</th>
    <th width="73">Customer Name</th>
    <th width="61">Item Name</th>
    <th width="130">Address</th>
    <th width="56">Amount</th>
    <th width="55">Start Date</th>
    <th width="50">Option</th> 
    <th width="66">Service Date1</th>
    <th width="66">Service Date2</th>
    <th width="66">Service Date3</th>
    <th width="51">End Date</th></tr>
<?php
while($row=mysql_fetch_row($query)){
	
$result1 = mysql_query("SELECT * FROM  phppos_service1 where id='$row[1]' ");
$row1=mysql_fetch_row($result1);
?>
  <tr>
    <td><?php echo $row[1]; ?></td>
    <td><?php echo $row1[2]; ?></td>
    <td><?php echo $row1[6]; ?></td>
    <td><?php echo $row1[5]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?></td>
    <td width="56"><a href="edit_amc.php?id=<?php echo $row[1]; ?>">Edit</a>
    <?php if($user="sunrise")?>
<a href="delete_amc.php?id=<?php echo $row[0]."&atype=".$cid."&ctype=".$row1[7]?>"> Delete</a>
    </td></tr>
    
<?php if($row1[7]=='commercial'){ 
$query1 =mysql_query("select * from phppos_amcservicestatus where id='$row[1]' order by service_date asc");
$num1=mysql_num_rows($query1);
$j=1;
while($ro=mysql_fetch_row($query1)){
//	for($i=1<$i<=mysql_num_rows($query);$i++){
?>
    <tr>
    <td><font color="#FFFFFF"> Service Date<?php echo $j++; ?> : </font></td>
    <td>
	<?php if(isset($ro[2]) and $ro[2]!='0000-00-00') echo date('d/m/Y',strtotime($ro[2])); ?>
     <?php if($ro[3]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $ro[2];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service4.php?st=status&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $ro[2]; ?>&name=<?php echo $row1[2]; ?>';" />
    <input type="button" value="change" onclick="javascript:location.href = 'changedate2.php?sd=1&id=<?php echo $row[1]; ?>&sdate1=<?php echo $ro[2]; ?>';"/><?php } ?>
    </td>
    </tr>

    
    <?php } } else { ?>
    
    
    <td>
	<?php if(isset($row[6]) and $row[6]!='0000-00-00') echo date('d/m/Y',strtotime($row[6])); ?>
    <?php if($row[7]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[6];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status1&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[6]; ?>&name=<?php echo $row1[2]; ?>';"><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=1&id=<?php echo $row[1]; ?>';"/>
    <?php } ?>
    </td>
    
    <td>
	<?php if(isset($row[8]) and $row[8]!='0000-00-00') echo date('d/m/Y',strtotime($row[8])); ?>
    <?php if($row[9]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[8];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status2&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[8]; ?>';"><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=2&id=<?php echo $row[1]; ?>';"/>
    <?php } ?>
    </td>
    
    <td>
	<?php if(isset($row[10]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?>
    <?php if($row[11]=='Yes'){echo "Done " ?><a href="service_detail1.php?id=<?php echo $row[1]; ?>&sdate1=<?php echo $row[10];?>"> Details</a> <?php } else{ ?>
    <input type="checkbox" name="sd1" id="sd1" onclick="javascript:location.href = 'service3.php?st=status3&id=<?php echo $row[0]; ?>&cid=<?php echo $row[1]; ?>&pdate=<?php echo $row[4]; ?>&sdate=<?php echo $row[10]; ?>&name=<?php echo $row1[2]; ?>';"><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=3&id=<?php echo $row[1]; ?>';"/>
    <?php } ?>
    </td>
   
    <td><?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?><input type="button" value="change"  onclick="javascript:location.href = 'changedate1.php?sd=4&id=<?php echo $row[1]; ?>';"/></td><?php } ?>
   
     
  </tr>
  <?php }?>
</table>

<?php } } ?>

</center>

</body>
</html>