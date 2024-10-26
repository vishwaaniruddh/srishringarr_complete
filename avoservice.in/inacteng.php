<?php
session_start();
if(!isset($_SESSION['user']))
echo "<script type='text/javascript'>window.close();</script>";
else
{
$i=0;
include("config.php");
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<form name="frm1" method="post" action=<?php $_SERVER['PHP_SELF'] ?>>
<table><tr><td>From Date(dd/mm/yyyy): <input type="text" name="from" id="from" value="<?php if(isset($_POST['from'])){ echo $_POST['from']; }else{ echo date("d/m/Y",strtotime("-1 week"));}?>"></td>
<td>To Date(dd/mm/yyyy): <input type="text" name="to" id="to" value="<?php if(isset($_POST['from'])){ echo $_POST['to']; }else{ echo date("d/m/Y"); } ?>"></td>
<td><input type="submit" name="cmdsub" value="submit"></td></tr></table>

</form>

<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<table border='1' id="custtable"><tr><td>Sr No</td><td>ID</td><td>Name</td><td>Contact Number</td><td>Branch</td>
<td>Total Calls</td><td>Response on calls</td></tr>
<?php

if(isset($_POST['from']) && $_POST['from']!='' && isset($_POST['to']) && $_POST['to']!='')
{
$dt1=str_replace("/","-",$_POST['from']);
$dt2=str_replace("/","-",$_POST['to']);
$dt1=date('Y-m-d 00:00:00',strtotime($dt1));
$dt2=date('Y-m-d 23:59:59',strtotime($dt2));
}
else{
$dt1=date('Y-m-d 00:00:00',strtotime('-1 week'));
$dt2=date('Y-m-d 23:59:59');
}
//echo "select e.`engg_id`, e.`engg_name`, s.`state`,c.`city`, e.`phone_no2`, e.`phone_no1`,e.`loginid` from area_engg e,state s,cities c where e.deleted=0 and e.status=1 and  s.state_id=e.state_id and c.city_id=e.city order by e.engg_name";
// echo "select e.`engg_id`, e.`engg_name`, s.`state`,c.`city`, e.`phone_no1`,e.`loginid`,s.`branch_id` from area_engg e,state s,cities c where e.deleted=0 and e.status=1 and  s.state_id=e.state_id and c.city_id=e.city order by e.engg_name";

$qry=mysqli_query($con1,"select `engg_id`, `engg_name`, `phone_no1`,`loginid`,`area` from area_engg where deleted=0 and status=1 order by area");

while($qryro=mysqli_fetch_array($qry))
{
$rescal=0;
$alert=array();
$totcall=0;
//$alertid=mysqli_query($con1,"select distinct(alert_id) from alert_delegation where engineer='".$qryro[0]."' and status=0");
//$alertnum=mysqli_num_rows($alertid);
//$feed=mysqli_query($con1,"select distinct(alert_id) from eng_feedback where engineer='".$qryro[0]."'");

//echo "select distinct(alert_id) from alert_delegation where engineer='".$qryro[0]."' and alert_id in(select alert_id from alert where entry_date between '".$dt1."' and '".$dt2."')";
$alertid2=mysqli_query($con1,"select distinct(alert_id) from alert_delegation where engineer='".$qryro[0]."' and alert_id in(select alert_id from alert where entry_date between '".$dt1."' and '".$dt2."')");
if(mysqli_num_rows($alertid2)>0){
while($alertro2=mysqli_fetch_array($alertid2))
{
$alert[]=$alertro2[0];
}
}
$eng2=implode(',',$alert);
$numalert=0;
if(count($alert)>0)
{
$res2=mysqli_query($con1,"select distinct(alert_id) from eng_feedback where engineer='".$qryro[3]."' and alert_id in($eng2)");
$resro=mysqli_num_rows($res2);
$numalert=$resro;
}
?>
<tr>
<td><?php echo $i=++$i; ?></td>
<td><?php echo $qryro[0]; ?></td>
<td><?php echo $qryro[1]; ?></td>
<td><?php echo $qryro[2]; ?></td>
<!--<td><?php echo $qryro[2]; ?></td>-->
<!--Branch--->
<td><?php 
$bravo=mysqli_query($con1,"select * from avo_branch where id='".$qryro[4]."'");
$bravo1=mysqli_fetch_row($bravo);
echo $bravo1[1]; ?></td>

<!--<td><?php echo $qryro[3]; ?></td>-->
<!--<td><?php //echo $alertnum; ?></td>
<td><?php //echo mysqli_num_rows($feed); ?></td>-->
<td><?php echo count($alert); ?></td>
<td><?php echo $numalert; ?></td>
</tr>
<?php
}

/*$alertid=mysqli_query($con1,"select distinct(engineer) from alert_delegation");
while($alr=mysqli_fetch_array($alertid))
$alert[]=$alr[0];

$eng=implode(',',$alert);
//echo "select * from area_engg where loginid not in(select engineer from eng_feedback) and id in ($eng) order by engg_name ASC";
$qry=mysqli_query($con1,"select * from area_engg where loginid not in(select engineer from eng_feedback) and engg_id in ($eng) order by engg_name ASC");
while($qryro=mysqli_fetch_array($qry))
{
$state=mysqli_query($con1,"select state from state where state_id='".$qryro[2]."'");
$statero=mysqli_fetch_row($state);
$city=mysqli_query($con1,"select city from cities where city_id='".$qryro[3]."'");
$cityro=mysqli_fetch_row($city);
?>
<tr><td><?php echo $i=++$i; ?></td><td><?php echo $qryro[1]; ?></td><td><?php echo $qryro[5]; ?></td>
<td><?php echo $statero[0]; ?></td>
<td><?php echo $cityro[0]; ?></td><!--<td><?php 
if($qryro[12]!='0000-00-00 00:00:00')
echo date("d/m/Y",strtotime($qryro[12])); ?></td>--></tr>
<?php
}*/
?>
</table>
<?php
}
?>