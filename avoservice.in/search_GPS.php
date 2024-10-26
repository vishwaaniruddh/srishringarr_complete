<?php
session_start();
include ("config.php");
$strPage = $POST['Page'];

$engg=$_POST['engg'];

echo $engg;

if($_POST['dt']!="")
{
$dt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt'])));
}

if($_POST['todt']!="")
{
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
}
echo $todt;

//echo  "hi : ".$varbr;
?>

<?php
// ==========Get the login id for engineers of the branch==========
//$sqlqry="select loginid,engg_name,engg_desgn,area from area_engg where area='".$varbr."' and status=1 and deleted=0";

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')


 $sqlqry="SELECT loginid,engg_name,engg_desgn, area, emp_code, engg_id FROM `area_engg` where area='".$_POST['branch_avo']."' and deleted=0 and status=1";
 
 else if(isset($_POST['engg']) && $_POST['engg']!='')
 $sqlqry="SELECT loginid,engg_name,engg_desgn, area, emp_code, engg_id FROM `area_engg` where engg_id='".$engg."' and deleted=0 and status=1";
 
 else
 
 $sqlqry="SELECT loginid,engg_name,engg_desgn, area, emp_code, engg_id FROM `area_engg` where deleted=0 and status=1 LIMIT 50";

//echo $sqlqry;

$table=mysqli_query($con1,$sqlqry);
$count=0;
$Num_Rows = mysqli_num_rows($table);
 





 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
<!--<table width="50%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >-->
<table border="1" style="margin-right:18%;margin-left:18%" width="80%" align="right" cellpadding="2" cellspacing="0" id="custtable">
<tr>

<th width="10%">Eng. Name</th>
<th width="8%">Designation</th>
<th width="9%">Branch</th>
<th width="10%">Last Update Time</th>
<th width="30%">Last Position</th>
<th width="5%">Latitude </th>
<th width="5%">Longitude</th>
<th width="5%"> View Details</th>
</tr>

<?php
while($engqry=mysqli_fetch_array($table))
{


$queryloc=mysqli_query($con1,"select latitude,longitude,dt,address from Location where engg_id='".$engqry[5]."' order by id DESC limit 1");

//echo "select latitude,longitude,dt,address from Location where engg_id='".$engqry[5]."' order by id DESC limit 1";

$locfetchqry=mysqli_fetch_row($queryloc);

$brqry=mysqli_query($con1,"select name from avo_branch where id='".$engqry[3]."'");
$bfetchqry=mysqli_fetch_array($brqry);


?>
<tr>
<td ><?php echo $engqry[1]; ?></td>
<td ><?php echo $engqry[2]; ?></td>
<td ><?php echo $bfetchqry[0]; ?></td>
<td><?php echo $locfetchqry[2]; ?></td>
<td><?php echo $locfetchqry[3]; ?></td>
<td><?php echo $locfetchqry[0]; ?></td>
<td><?php echo $locfetchqry[1]; ?></td>


<td><a href="javascript:void(0);" onclick="window.open('GPS_details.php?id=<?php echo $engqry[5];?>&fm=<?php echo $dt;?>&to=<?php echo $todt;?>&en=<?php echo $engqry[1];?>','Engineer Details','width=800px,height=600,left=200,top=40')" class="update">
 Details</a></td>
</tr>

<?php
 } 
?>
</table>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export into Excel</button>



