<?php
session_start();
include("config.php");
?>
<table border=1 id="custtable">
	<tr>
	  <th>Sr No</th>
	  <th>Date of PM</th>
	  <th>Bank Name</th>	
	  <th>ATM ID</th>
	  <th>Adrress</th>
	  <th>State</th>
	  <?php
	  $ast=mysqli_query($con1,"select assets_name from assets where status=0");
	  while($astro=mysqli_fetch_array($ast))
	  {
	  ?>
	  <th><?php echo $astro[0]; ?> make</th>
	  <th><?php echo $astro[0]; ?> Capacity</th>
	  <th><?php echo $astro[0]; ?> Quantity</th>
	  <th>Remarks</th>
	  <?php
	  }
	  ?>
	  <th>PM Status</th>
	</tr>
<?php
$i=0;
$str="select * from pmalert where call_status='Done'";

$qry=mysqli_query($con1,$str);
while($row=mysqli_fetch_array($qry))
{
$i=$i+1;
$atmid='';
$sql='';
//echo $row[21]."<br>";
if($row[21]=='amc')
$sql="select atmid from Amc where amcid='".$row[2]."'";
elseif($row[21]=='site')
$sql="select atm_id from atm where track_id='".$row[2]."'";
//echo $sql;
$atm=mysqli_query($con1,$sql);
$atmro=mysqli_fetch_row($atm);
$atmid=$atmro[0];
?>
<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo date('d/m/Y H:i:s',strtotime($row[18])); ?></td>
	<td><?php echo $row[3]; ?></td>
	<td><?php echo $atmid; ?></td>
	<td><?php echo $row[5]; ?></td>
	<td><?php echo $row[7]; ?></td>
	<?php
	$asst=mysqli_query($con1,"select * from assets where status=0 order by assets_id ASC");
	while($asstro=mysqli_fetch_array($asst))
	{
	//echo $i." select * from pmastrep where alertid='".$row[0]."' and asset='".$asstro[1]."'<br>";
	$pmast=mysqli_query($con1,"select * from pmastrep where alertid='".$row[0]."' and asset='".$asstro[1]."'");
	if(mysqli_num_rows($pmast)>0)
	{
	$pmastro=mysqli_fetch_row($pmast);
	?>
	<td><?php echo $pmastro[5]; ?></td>
	<td><?php echo $pmastro[4]; ?></td>
	<td><?php echo $pmastro[6]; ?></td>
	<td><?php echo $pmastro[7]; ?></td>
	<?php
	}
	else
	{
	?>
	<td>NA</td>
	<td>NA</td>
	<td>NA</td>
	<td>NA</td>
	<?php
	}
	}
	?>
</tr>
<?php
}
?></table>