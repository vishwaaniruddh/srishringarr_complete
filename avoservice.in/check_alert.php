<?php
session_start();
include('config.php');

$log_id=$_GET['eid']; // login id
$date=$_GET['date'];
     
        ?>
<html>
    <head>
<script type='text/javascript' src='jquery-1.6.2.min.js'></script>
<script type='text/javascript' src='jquery-ui-1.8.14.custom.min.js'></script>
    
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<body>

<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="10%">Complain ID</th> 
<th width="5%">Vertical</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">User Customer Name</th>
<th width="5%">City</th>
<th width="5%">Address</th>
<th width="5%">AVO Branch</th>
<th width="5%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Call Type</th>
<th width="5%">Last FeedBack</th>
<th width="5%">Call Status</th>

</tr>
<?php

//echo "SELECT alert_id FROM `alert_progress` where engg_id='".$log_id."' and date(responsetime)='".$date."' and responsetime !='0000-00-00 00:00:00'";
$result = mysqli_query($con1,"SELECT alert_id FROM `alert_progress` where engg_id='".$log_id."' and date(responsetime)='".$date."' and responsetime !='0000-00-00 00:00:00'");

while ($calls = mysqli_fetch_array($result)){

$sql="Select * from alert where alert_id='".$calls[0]."' ";

//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
include("config.php");
$row= mysqli_fetch_row($table);

     
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	if ($row[21]=='site') {
	$atmid= mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'"); 
	    
	} else if ($row[21]=='amc') {
	$atmid= mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'"); 
	}
	$atmdet=mysqli_fetch_row($atmid);
	$atm_id=$atmdet[0];
	
	if($atm_id=='') { $atm_id= $row[2]; }
	
	$tab=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
	
	$br= mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'"); 
	
	$branch=mysqli_fetch_row($br);
	
	if ($row[15]=='delegated' && $row[16]=='delegated') 
	
	?>
<tr>
<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td> <!-- Vertical Name-->
<td  valign="top">&nbsp;<?php echo $atm_id ; ?></td>
<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[6];?></td>
<td  valign="top">&nbsp;<?php  echo $row[5]; ?></td>
<td  valign="top">&nbsp;<?php echo $branch[0]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[9] ?></td>
<td  valign="top">&nbsp;<?php echo $row[10] ?></td>


<td  valign="top">&nbsp;<?php echo $row[17] ?></td> <!-- Call type-->
<td  valign="top">&nbsp;<?php echo $row1[0] ?></td>

<td  valign="top">&nbsp;<?php 	if ($row[15]=='delegated' && $row[16]=='delegated') { echo "Closed By Branch" ;} 
        else echo $row[15] ?></td> <!-- Status-->

</tr>
<? }} ?>
</table>

<center><button onclick="goBack()">Close </button></center>

<script>
function goBack() {
 history.back();

}
</script>
</body>
</html>
 