<?php
session_start();
include ("config.php");
$strPage = $POST['Page'];
$varbr=$_POST['branch_avo'];


if($_POST['dt']!="")
{
$dt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt'])));
}

if($_POST['todt']!="")
{
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
}
echo "new page";
echo  "hi : ".$varbr;
?>

<?php
// Get the login id for engineers of the branch
$sqlqry="select loginid,engg_name from area_engg where area='".$varbr."' and status=1 and deleted=0";
//echo $sql;
$table=mysqli_query($con1,$sqlqry);
$count=0;
$Num_Rows = mysqli_num_rows($table);
?>
<?php

$loginds="";
while($engqry=mysqli_fetch_array($table))
{

$macids="";
$gtmac=mysqli_query($con1,"select mac_id from notification_tble where logid='".$engqry[0]."'");
while($gtmacrws=mysqli_fetch_array($gtmac))
{
if($macids=="")
{
$macids="'".$gtmacrws[0]."'";

}
else
{
$macids=$macids.",'".$gtmacrws[0]."'";
}

}

//echo "select max(id) from Location where mac_address in (select mac_id from notification_tble where logid='".$engqry[0]."')";

$locqr="select id from Location where 1";
if($dt!="")
{
$locqr.=" and (dt>='".$dt."' and dt<='".$todt."')";
}
echo $locqr."<br>";

//echo "select id from Location where mac_address in ($macids) and id in($locqr)  order by id desc";
$locqry=mysqli_query($con1,"select id from Location where mac_address in ($macids) and id in($locqr)  order by id desc");
$locfetch=mysqli_fetch_array($locqry);


//echo "select max(id) from Location where mac_address in (select mac_id from notification_tble where logid='".$engqry[0]."')";

//$queryloc=mysqli_query($con1,"select latitude,longitude,dt from Location where id='".$locfetch[0]."'");

//echo "select latitude,longitude from Location where id='".$locfetch[0]."'";
//$locfetchqry=mysqli_fetch_array($queryloc);
$norws=mysqli_num_rows($locqry);

if($norws>0)
{

if($loginds=="")
{

$loginds=$engqry[0];

}
else
{
$loginds=$loginds.",".$engqry[0];
}

//echo "logids".$loginds."<br>";
}

 } 

if($loginds!="")
{
$sqlqry=$sqlqry." and loginid in($loginds)";

//echo $sqlqry;
$newt=mysqli_query($con1,$sqlqry);
$Num_Rows = mysqli_num_rows($newt);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">Eng. Name</th> 
<th width="5%">Last Update Time</th>
<th width="5%">Last Position</th>
<th width="5%">Latitude </th>
<th width="5%">Longitude</th>
<th width="5%"> View Details</th>
</tr>

<?php


while($engqry=mysqli_fetch_array($newt))
{
//$notiqry=mysqli_query($con1,"select mac_id from notification_tble where logid='".$engqry[0]."' ");
//$botifetch=mysqli_fetch_array($notiqry);

//echo "select max(id) from Location where mac_address in (select mac_id from notification_tble where logid='".$engqry[0]."')";
$macids="";
$gtmac=mysqli_query($con1,"select mac_id from notification_tble where logid='".$engqry[0]."'");
while($gtmacrws=mysqli_fetch_array($gtmac))
{
if($macids=="")
{
$macids="'".$gtmacrws[0]."'";

}
else
{
$macids=$macids.",'".$gtmacrws[0]."'";
}




}



$locqry=mysqli_query($con1,"select id from Location where mac_address in ($macids) order by id desc");
$locfetch=mysqli_fetch_array($locqry);


//echo "select max(id) from Location where mac_address in (select mac_id from notification_tble where logid='".$engqry[0]."')";

$queryloc=mysqli_query($con1,"select latitude,longitude,dt from Location where id='".$locfetch[0]."'");

//echo "select latitude,longitude from Location where id='".$locfetch[0]."'";
$locfetchqry=mysqli_fetch_array($queryloc);

?>
<tr>
<td ><?php echo $engqry[1]; ?></td>
<td><?php echo $locfetchqry[2]; ?></td>
<td><?php echo "DD" ?></td>
<td><?php echo $locfetchqry[0]; ?></td>
<td><?php echo $locfetchqry[1]; ?></td>
<td><a href="javascript:void(0);" onclick="window.open('GPS_details.php?id=<?php echo $engqry[0];?>','Engineer Details','width=700px,height=750,left=200,top=40')" class="update">
 Details</a></td>
</tr>

<?php
 } 
?>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php /*
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
*/
?>
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 



<?php
}else

{
echo "NO records Found";
?>



<?php
}?>


