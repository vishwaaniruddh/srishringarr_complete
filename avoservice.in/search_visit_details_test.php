<?php
//include("access.php");
include("config.php");
session_start();
$strPage = $_REQUEST['Page'];
echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$engg_id=$_POST['engr'];
$date=$_POST['date'];
$branch=$_POST['branch'];

?>
<body>
<form name="form1" method="post">

<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" id="custtable" >
<tr>
<th width="5%">Complain ID</th> 
<th width="5%">Vertical</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">User Customer Name</th>
<th width="5%">City</th>
<th width="10%">Address</th>
<th width="5%">AVO Branch</th>
<th width="5%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Call Type</th>
<th width="20%">Last FeedBack</th>
<th width="5%">Reached Time</th>
<th width="3%">Call Status</th>

</tr>
<?php
$qry1 = mysqli_query($con1,"SELECT loginid FROM `area_engg` where engg_id='".$engg_id."'");
$logid=mysqli_fetch_row($qry1);

$result = mysqli_query($con1,"SELECT alert_id, responsetime FROM `alert_progress` where engg_id='".$logid[0]."' and date(responsetime)=STR_TO_DATE('$date','%d/%m/%Y') and responsetime !='0000-00-00 00:00:00' order by responsetime ASC");

while ($calls = mysqli_fetch_row($result)){

$sql="Select * from alert where alert_id='".$calls[0]."' ";

//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
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
	?>
<tr>
<td valign="top"><?php echo $row[25]; ?></td>
<td valign="top">&nbsp;<?php echo $custrow[0]; ?></td> <!-- Vertical Name-->
<td valign="top">&nbsp;<?php echo $atm_id ; ?></td>
<td valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td valign="top">&nbsp;<?php echo $row[6];?></td>
<td valign="top">&nbsp;<?php  echo $row[5]; ?></td>
<td valign="top">&nbsp;<?php echo $branch[0]; ?></td>
<td valign="top">&nbsp;<?php echo $row[9] ?></td>
<td valign="top">&nbsp;<?php echo $row[10] ?></td>


<td valign="top">&nbsp;<?php echo $row[17] ?></td> <!-- Call type-->
<td valign="top">&nbsp;<?php echo $row1[0] ?></td>
<td valign="top">&nbsp;<?php echo $calls[1] ?></td>

<td valign="top">&nbsp;<?php if ($row[15]=='Done') {echo "Closed By Engineer";} else if($row[16]=='Done') {echo "Closed By Branch" ;} ?></td> <!-- Status-->

</tr>
<? }} ?>
</table>
<tr>
    <td width="45" height="31"> <a href="test_distance3_test.php?id=<?php echo $engg_id?>&date=<?php echo $date; ?>" target="_blank"> View Map </a></td>
</tr>
</body>
</html>
 