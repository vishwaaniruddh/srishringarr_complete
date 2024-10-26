<?php
 
include('config.php');

       $cname=$_GET['cname'];
	   $service=$_GET['service'];
	   
 if($service=="sales")
 {

     $sql1=mysql_query("select item_id,ctype,purchase_date from phppos_service where id='$cname'");
     //$sql2=mysql_query("select purchase_date from phppos_service where id='$cname'");
 }
 
 else
 {
    $sql1=mysql_query("select item_id,amc_cust from phppos_service1 where id='$cname'");
	// $sql2=mysql_query("select start_date,end_date,amount from phppos_amc where person_id='$cname'");
	 $curdate=date('Y-m-d');
	 
 }
	
	while( $row1 = mysql_fetch_row($sql1)){
	

$out="
<td>item </td><td><input type='hidden' name='type' value='$row1[1]' />
<select name='item' id='item' >
<option value='0'>select item</option>";

    
                
$out=$out."<option value=".$row1[0].">".$row1[0]."</option>";

               }
$out=$out."</select></td><br><br>";
echo $out;

/*$r = mysql_fetch_row($sql2);	

$out1="<table><tr><td>Start Date : </td><td>";

if($curdate<$r[1])
$out1=$out1."<input type='text' name='sdate' value='$r[0]' readonly='readonly'><br><br>";

$out1=$out1."</td></tr></table>";

$out1=$out1."
Amount : <input type='text' name='amount' value='$r[2]'><br><br>";

 echo $out1; */
 
?>

####


<br/>
<?php 
//$reqcut=mysql_query("SELECT * FROM `phppos_request` WHERE `person_id`='$cname' and amount='0.00' and cust_type='$service' order by request_date DESC");

?><!--
<table border="1" cellpadding="4" cellspacing="0" width="" align="center">
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

</tr>-->
<?php /*
$a=1;
 while($resrow=mysql_fetch_row($reqcut)){

$enres=mysql_query("SELECT * FROM  `phppos_engineer` where id='$resrow[4]' ");
$enrow=mysql_fetch_row($enres);*/
?> <!--
<tr>
<td width="41" height="33"><?php // echo $a++; ?></td>
<td width="98"><?php //echo $resrow[2]; ?></td>
<td width="173"><?php // if(isset($resrow[3]) and $resrow[3]!='0000-00-00') echo date('d/m/Y',strtotime($resrow[3])); ?></td>
<td width="146"><?php // echo $enrow[1]; ?></td>
<td width="58"><?php  // echo $resrow[5]; ?></td>
<td width="118"><?php // if(isset($resrow[6]) and $resrow[6]!='0000-00-00') echo date('d/m/Y',strtotime($resrow[6])); ?></td>
<td width="179"><?php // echo $resrow[7]; ?></td>
<td width="121"><?php // echo $resrow[10]; ?></td>
</tr>
<?php  ?>
</table> -->