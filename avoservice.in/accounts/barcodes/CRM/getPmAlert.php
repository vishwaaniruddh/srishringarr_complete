<?php
include('config.php');

$currentdate=Date("Y-m-d");
$a='2013-08-15';
$ab=date('Y-m-d', strtotime($currentdate. ' + 15 days'));
$cid=$_GET['cid'];
////////////////get Alert Type

if($cid=="PM"){


?>
<h3 align="center">PM Call </h3>
<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th width='65' height="34">Sr.No.</th>
<th width='140' height="34">Customer ID</th>
<th width='140' height="34">Customer</th>
<th width='140' height="34">Address</th>
<th width='101'>Item</th>
<th width='71'>Contact</th>
<th width='110'>Purchase Date</th>
<th width='128'>Service Date</th>
</tr>
<?php

$st1="";
$st2="";
$st3="";
$st4="";
//echo "SELECT * FROM `phppos_service` WHERE `ctype`='domestic'and((`service_date1`<='$ab' and `status1`<>'yes')or(`service_date2`<='$ab' and `status2`<>'yes')or(`service_date3`<='$ab' and `status3`<>'yes')or(`service_date4`<='$ab' and `status4`<>'yes'))";
$r=mysql_query("SELECT * FROM `phppos_service` WHERE `ctype`='domestic'and((`service_date1`>='$a' and`service_date1`<='$ab' and `status1`<>'yes')or(`service_date2`>='$a' and`service_date2`<='$ab' and `status2`<>'yes')or(`service_date3`>='$a' and`service_date3`<='$ab' and `status3`<>'yes')or(`service_date4`>='$a' and`service_date4`<='$ab' and `status4`<>'yes'))order by cust_id");

$i=1;
while($row=mysql_fetch_row($r)){
	$p='';
if(isset($row[8]) and $row[8]!='0000-00-00') $st1=date('d/m/Y',strtotime($row[8])); 
 if(isset($row[10]) and $row[10]!='0000-00-00') $st2= date('d/m/Y',strtotime($row[10])); 
 if(isset($row[12]) and $row[12]!='0000-00-00') $st3=date('d/m/Y',strtotime($row[12]));
 if(isset($row[14]) and $row[14]!='0000-00-00') $st4=date('d/m/Y',strtotime($row[14])); 
 

if($row[8]>= $a &&  $row[8] <= $ab && $row[9]!='Yes'){

$p= $st1;
}else if($row[10] >= $a &&  $row[10] <= $ab && $row[11]!='Yes'){
$p=$st2;
}else if($row[12] >= $a &&  $row[12] <= $ab && $row[13]!='Yes'){
$p=$st3;
}else if($row[14] >= $a &&  $row[14]<= $ab && $row[15]!='Yes'){
$p= $st4;
}
if($p=="" || $p=="0"){}else{
//$i=1;
?>
<tr>
<td width="65"><?php echo $i++; ?></td>
<td width="140"><?php echo $row[18]; ?></td>
<td width="140"><?php echo $row[2]; ?></td>
<td width="140"><?php echo $row[5]; ?></td>
<td width="101" ><?php echo $row[6]; ?></td>
<td width="71"><?php echo $row[3]; ?></td>
<td width="110"><?php if(isset($row[7]) and $row[7]!='0000-00-00') echo date('d/m/Y',strtotime($row[7])); ?></td>
<td width="128"><?php
 if($row[8]>= $a &&  $row[8] <= $ab && $row[9]!='Yes'){

echo $st1;
?>

<input type='checkbox' onclick="javascript:location.href = 'service2.php?id=status1&cid=<?php echo $row[0] ?>&sdate1=<?php echo $row[8]?>&pdate=<?php echo $row[7] ?>'">
<?php }else if($row[10] >= $a &&  $row[10] <= $ab && $row[11]!='Yes'){
echo $st2;
?>
<input type='checkbox' onclick="javascript:location.href = 'service2.php?id=status2&cid=<?php echo $row[0] ?>&sdate1=<?php echo $row[10] ?>&pdate=<?php echo $row[7] ?>'">
<?php
}else if($row[12] >= $a &&  $row[12] <= $ab && $row[13]!='Yes'){
echo $st3."";
?>
<input type='checkbox' onclick="javascript:location.href = 'service2.php?id=status3&cid=<?php echo $row[0] ?>&sdate1=<?php echo $row[12] ?>&pdate=<?php echo $row[7] ?>'">
<?php
}else if($row[14] >= $a &&  $row[14]<= $ab && $row[15]!='Yes'){
echo $st4."";
?>
<input type='checkbox' onclick="javascript:location.href = 'service2.php?id=status4&cid=<?php echo $row[0] ?>&sdate1=<?php echo $row[14] ?>&pdate=<?php echo $row[7] ?>'">
<?php
} else{
?>
<p align="center" style="color:#FF0000;">Done</p>
<?php } ?>
</td>
</tr>

<?php }
///////////////////////////end of domestic
 }
 //$i=1;
 $st5="";
$r1=mysql_query("SELECT * FROM `phppos_service` WHERE ctype='commercial'");
while($row2=mysql_fetch_row($r1)){
$q=mysql_query("SELECT * FROM `phppos_servicestatus` where id='$row2[0]' and (`service_date`>='$ab' and service_date <= '$ab' and status<>'Yes')");
$row11=mysql_fetch_row($q); 
///echo "SELECT * FROM `phppos_servicestatus` where id='$row2[0]' and (service_date  between '$a' and '$ab')";
if(isset($row11[2]) and $row11[2]!='0000-00-00') $st5= date('d/m/Y',strtotime($row11[2]));
if($st5=="" || $st5=="0"){}else{
?>
<tr>
<td width="65"><?php echo $i++; ?></td>
<td width="140"><?php echo $row2[18]; ?></td>
<td width="140"><?php echo $row2[2]; ?></td>
<td width="140"><?php echo $row2[5]; ?></td>
<td width="101" ><?php echo $row2[6]; ?></td>
<td width="71"><?php echo $row2[3]; ?></td>
<td width="110"><?php if(isset($row2[7]) and $row2[7]!='0000-00-00') echo date('d/m/Y',strtotime($row2[7])); ?></td>
<td width="110"><?php if($row11[2] >= $a &&  $row11[2]<= $ab){
echo $st5;
} 
else
if($cid=="AMC")
{
	?>
<p align="center" style="color:#FF0000;">Done</p>
<?php
}
 ?></td>

</tr>

</td>
</tr>
<?php
 }} ?>
</table>

<?php } else{
/////////////////////////////////////AMC?>
<h3 align="center"> AMC </h3>
<table border="1" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th width='65' height="34">Sr.No.</th>
<th width='65' height="34">Customer ID</th>
<th width='140' height="34">Customer</th>
<th width='65' height="34">Address</th>
<th width='101'>Item</th>
<th width='71'>Contact</th>
<th width='128'>Service Date</th>
</tr>
<?php

$cnt=0;
$st11="";
$st22="";
$st33="";
$st44="";
$k=1;
//domestic customers
//echo "select * from phppos_amc where cust_type='domestic' and (atype='service' or atype='services') and ((service_date1 between '".$a."' and '".$ab."') and status1<>'Yes') or ((service_date2 between '".$a."' and '".$ab."') and status2<>'Yes') or ((service_date3 between '".$a."' and '".$ab."') and status3<>'Yes') or ((end_date between '".$a."' and '".$ab."') and end_status<>'Yes') ";
$qry=mysql_query("select * from phppos_amc where cust_type='domestic' and (atype='service' or atype='services') and ((service_date1 between '$a' and '$ab') and status1<>'Yes') or ((service_date2 between '$a' and '$ab' )and status2<>'Yes') or ((service_date3 between '$a' and '$ab') and status3<>'Yes') or ((end_date between '$a' and '$ab') and end_status<>'Yes') ");
while($rr=mysql_fetch_array($qry))
{
	$dd='';
 $ddt='';
	
	$cnt=++$cnt;
	$qry4=mysql_query("select * from phppos_service1 where id='".$rr[1]."'");
	$rr4=mysql_fetch_row($qry4);
?>
<tr><td><?php echo $cnt; ?></td>
<td><?php echo $rr4[9]; ?></td>
<td><?php echo $rr4[2];; ?></td>
<td><?php echo $rr4[5]; ?></td>
<td><?php echo $rr4[6]; ?></td>
<td><?php echo $rr4[3]; ?></td>
<td><?php 

if($rr[6]>=$a && $rr[6]<=$ab && $rr[6]!='0000-00-00' && $rr[6]!='')
{
	echo date("d/m/Y",strtotime($rr[6]));
	 $dd="status1";
 $ddt=$rr[6];
}
elseif($rr[8]>=$a && $rr[8]<=$ab && $rr[8]!='0000-00-00' && $rr[8]!='')
{
	echo date("d/m/Y",strtotime($rr[8]));
	 $dd="status2";
 $ddt=$rr[8];
}
elseif($rr[10]>=$a && $rr[10]<=$ab && $rr[10]!='0000-00-00'&& $rr[10]!='')
{
	echo date("d/m/Y",strtotime($rr[10]));
	 $dd="status3";
 $ddt=$rr[10];
}
elseif($rr[5]>=$a && $rr[5]<=$ab && $rr[5]!='0000-00-00' && $rr[5]!='')
{
	echo date("d/m/Y",strtotime($rr[5]));
	 $dd="status4";
 $ddt=$rr[5];
}
 ?><input type='checkbox' name='sd1' id='sd1' onclick="javascript:location.href = 'service3.php?st=<?php echo $dd; ?>&id=<?php echo  $rr[0]; ?>&cid=<?php echo  $rr4[0]; ?>&pdate=<?php echo $rr[4]; ?> &sdate=<?php echo $ddt; ?> &name=<?php echo $rr[2];?>';"/>
</td>
</tr>
<?php
}
//commercial customers
//echo "select * from phppos_amc where cust_type='commercial' and (atype='service' or atype='services') ";
$qry2=mysql_query("select * from phppos_amc where cust_type='commercial' and (atype='service' or atype='services') ");
while($rr2=mysql_fetch_array($qry2))
{
	$stat=0;
	$s=0;
//echo	"select * from phppos_servicestatus1 where id='".$rr2[1]."'";
$qry5=mysql_query("select * from phppos_service1 where id='".$rr2[1]."'");
$rr5=mysql_fetch_row($qry5);
	//$rr4=mysql_fetch_row($qry4);
$qry3=mysql_query("select * from phppos_servicestatus1 where id='".$rr2[1]."'");
 
//echo mysql_num_rows($qry3);
while($rr3=mysql_fetch_row($qry3))
{
$stat=$stat+1;
if($s!=1)
{
	$today = strtotime($rr3[2]);
 $stdt =date("Y-m-d", strtotime("-2 months", $today));

	$s=1;
}
if(($rr3[2]>=$a && $rr3[2]<=$ab) && $rr3[3]!='Yes')
	{
	$cnt=++$cnt;
?>
<tr><td><?php echo $cnt; ?></td>
<td><?php echo $rr5[9]; ?></td>
<td><?php echo $rr5[2];; ?></td>
<td><?php echo $rr5[5]; ?></td>
<td><?php echo $rr5[6]; ?></td>
<td><?php echo $rr5[3]; ?></td>
<td><?php 
 $dd="status".$stat;
 
 $ddt=$rr3[2];
echo date("d/m/Y",strtotime($rr3[2]));
 ?><input type='checkbox' name='sd1' id='sd1' onclick="javascript:location.href = 'service3.php?st=<?php echo $dd; ?>&id=<?php echo  $rr2[0]; ?>&cid=<?php echo  $rr5[0]; ?>&pdate=<?php echo $stdt; ?> &sdate=<?php echo $ddt; ?> &name=<?php echo $rr5[2];?>';"/>
</td>
</tr>
<?php
	}
}
}
}
?>
</table>

<?php 
?>