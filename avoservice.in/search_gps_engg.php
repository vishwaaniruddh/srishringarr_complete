<?php
include("access.php");
session_start();
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];


?>
<body>
<form name="form1" method="post">

<table border="1" style="margin-right:18%;margin-left:18%" width="100%" align="right" cellpadding="2" cellspacing="0" id="custtable">

<!--<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" style="margin-top:5px;margin-left:20px;" id="custtable">  -->

<tr>

<th width="5%">S.No</th>
<th width="10%">Name</th>
<th width="10%">Designation</th>
<th width="8%">Latitude</th>
<th width="8%">Longitude</th>
<th width="12%">Date</th>
<th width="40%">Address</th>

</tr>


<?php

$count=0;
include("config.php");
$fix=25;

$engg=$_POST['Employee_name'];
$date =$_POST['from'];



$strPage=$_POST['Page'];


if(isset($_POST['from']) && $_POST['from']!=''){
 $locqry=mysqli_query($con1,"select * from Location where engg_id='".$engg."' and date(dt) ='".$date."' " );   

// echo "select * from Location where engg_id='".$engg."' and date(dt) ='".$date."' ";   
}
else{
$dt=date('Y-m-d');

$locqry=mysqli_query($con1,"select * from Location where engg_id='".$engg."' and date(dt)='".$dt."'");
}


$srn='1';

if(mysqli_num_rows($locqry)>0){
while($locfetch=mysqli_fetch_array($locqry))
{

$qry3=mysqli_query($con1,"select engg_name,  engg_desgn from area_engg where engg_id='".$locfetch[6]."'");
//echo "select engg_name,  engg_design from area_engg where engg_id='".$locfetch[6]."'";
$row3=mysqli_fetch_row($qry3);



?>

<tr>
<td><?php echo $srn;?></td>
<td><?php echo $row3[0];?></td>
<td><?php echo $row3[1];?></td>
<td><?php echo $locfetch[2];?></td>
<td><?php echo $locfetch[3];?></td>
<td><?php echo date('d-m-Y H:i:s',strtotime($locfetch[4]));?></td>
<td><?php echo $locfetch[5];?></td>
</tr>

<?php
$srn++;
}
} else 

$locqry=mysqli_query($con1,"select * from Location where engg_id='".$engg."' order by id DESC limit 1");
while($locfetch=mysqli_fetch_array($locqry))
{

$qry3=mysqli_query($con1,"select engg_name,  engg_desgn from area_engg where engg_id='".$locfetch[6]."'");
//echo "select engg_name,  engg_design from area_engg where engg_id='".$locfetch[6]."'";
$row3=mysqli_fetch_row($qry3);

?>
<h4 class="h4color" align="center" style="color:red">No Records found in this Date. Last Record found is:</h4>

<tr>
<td><?php echo $srn;?></td>
<td><?php echo $row3[0];?></td>
<td><?php echo $row3[1];?></td>
<td><?php echo $locfetch[2];?></td>
<td><?php echo $locfetch[3];?></td>
<td><?php echo date('d-m-Y H:i:s',strtotime($locfetch[4]));?></td>
<td><?php echo $locfetch[5];?></td>
</tr>

<?php
$srn++;
}

?>

</table>
</form>
</body>
