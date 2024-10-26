<?php
include('config.php');
$cid=$_GET['cid'];
$dt=date('Y-m-d');
$tp=$_GET['tp'];
//echo $tp;
if($tp=="sales"){
$sql=mysql_query("SELECT * FROM  `phppos_service` WHERE cust_id ='$cid' ");
$row=mysql_fetch_row($sql);

if($row[16]=="commercial"){

$a=mysql_query("select * from phppos_servicestatus where service_id=(SELECT MAX( service_id ) FROM  `phppos_servicestatus` where id='$cid')");
$rowa=mysql_fetch_row($a);
$expt=$rowa[2];
}else{
$expt=$row[14];
}
//echo $dt."/".$expt."<br/>";
if($dt>$expt){
	
	//echo "yes";
	
$sql1=mysql_query("SELECT * FROM  `phppos_amc`  WHERE id ='$cid' and atype='sales'");
$row1=mysql_fetch_row($sql1);
$num=mysql_num_rows($sql1);
if($num==0){ ?>
	<table width="77%" border="0"><tr>
<td width="32%">
Charges Amount:</td>
<td width="68%"> <input type="text" value="" name="amount" /></td></tr></table>
	
<?php	}else{

if($dt>$row1[5]){
	
	?><table width="77%" border="0"><tr>
<td width="32%">
Charges Amount:</td>
<td width="68%"> <input type="text" value="" name="amount" /></td></tr></table>
<?php }
else{ ?>
	<table width="100%"><tr>
<td>
<b>Item Name : </b><?php echo $row1[2]; ?><input type="hidden" value="0" name="amount"  /></td><td><b>End Date : </b><font color="#FFF"><?php if(isset($row1[5]) and $row1[5]!='0000-00-00') echo date('d/m/Y',strtotime($row1[5])); ?></font> </td></tr></table>
<?php }

}
}else{

?>
<table width="100%"><tr>
<td>
<b>Item Name : </b><?php echo $row[6]; ?><input type="hidden" value="0" name="amount"  /></td><td><b>End Date : </b><font color="#FFF"><?php if(isset($expt) and $expt!='0000-00-00') echo date('d/m/Y',strtotime($expt)); ?></font> </td></tr></table>

<?php }
}else if($tp=="service"){

////echo "h";
$sql=mysql_query("SELECT * FROM  `phppos_amc` WHERE person_id ='$cid' and (atype='services' or atype='service') and cust_status='New' ");
$row=mysql_fetch_row($sql);
////echo $row[7];
if($row[7]=="commercial"){
////echo "select * from phppos_servicestatus1 where service_id=(SELECT MAX( service_id ) FROM  `phppos_servicestatus1` where id='$cid')";
$a=mysql_query("select * from phppos_servicestatus1 where service_id=(SELECT MAX( service_id ) FROM  `phppos_servicestatus1` where id='$cid')");
$rowa=mysql_fetch_row($a);
$expt=$rowa[2];
}else{
$expt=$row[5];
}
///echo $dt."/".$expt."<br/>";
if($dt>$expt){
	
	//echo "yes";
	
$sql1=mysql_query("SELECT * FROM  `phppos_amc`  WHERE id ='$cid' and atype='sales'");
$row1=mysql_fetch_row($sql1);
$num=mysql_num_rows($sql1);
if($num==0){ ?>
	<table width="77%" border="0"><tr>
<td width="33%">
Charges Amount:</td>
<td width="67%"> <input type="text" value="" name="amount" /></td></tr></table>
	
<?php	}else{

if($dt>$row1[5]){
	
	?><table width="77%" border="0"><tr>
<td width="33%">
Charges Amount:</td>
<td width="67%"> <input type="text" value="" name="amount" /></td></tr></table>
<?php }
else{ ?>
	<table width="100%"><tr>
<td>
<b>Item Name : </b><?php echo $row1[2]; ?><input type="hidden" value="0" name="amount"  /></td><td><b>End Date : </b><font color="#FFF"><?php if(isset($row1[5]) and $row1[5]!='0000-00-00') echo date('d/m/Y',strtotime($row1[5])); ?></font> </td></tr></table>
<?php }

}
}else{

?>
<table width="100%"><tr>
<td>
<b>Item Name : </b><?php echo $row[6]; ?><input type="hidden" value="0" name="amount"  /></td><td><b>End Date : </b><font color="#FFF"><?php if(isset($expt) and $expt!='0000-00-00') echo date('d/m/Y',strtotime($expt)); ?></font> </td></tr></table>
<?php
}
}
//////////////////////////////////////end of sales
?>
