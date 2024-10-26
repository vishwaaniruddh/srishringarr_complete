<?php
include('config.php');
$appdate=$_GET['appdate']; 
$hos=$_GET['hos'];
$id=$_GET['ad'];

//echo "center=".$center=$_GET['center'];
$center=$_GET['center'];
//echo $appdate." ".$hos." ".$id;
if($hos=="" || $hos=="0"){
$qry="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
$qry1="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
}else{
$qry="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and hospital='$hos' and center='".$center."'";
$qry1="SELECT * FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and hospital='$hos' and center='".$center."'";
}
//echo $qry."<br>".$qry1;
$res=mysql_query($qry);


$res1=mysql_query($qry1);
?>
<style>

</style>

<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<table><tr>
<?php
$cnt=0;
while ($row = mysql_fetch_row($res)){
	$cnt=$cnt+1;
	$stime24=strtotime($row[3]);
	$etime24=strtotime($row[4]);
	$stime12=date("h:i a",$stime24);
	$etime12=date("h:i a",$etime24);
	
?>

<td>
<table width="190" border="1" style="background-color:#FFC" cellpadding="0" cellspacing="0">
<tr>
<th colspan="2" align="left"><?php echo $row[1]; ?><input type="checkbox" id="ch" name="ch[]" class="ch" value="<?php echo $row[0]; ?>" style="width:20px;" /></th>
</tr>
<tr>
<td width="87" height="20" style="border:1px solid;">Start Time</td>
<td width="83" height="20" style="border:1px solid;">End Time</td>
</tr>
<tr>
<td width="87" height="22" style="border:1px solid;"><?php echo $stime12; ?></td>
<td width="83" style="border:1px solid;"><?php echo $etime12; ?></td>
</tr>
</table>
</td>

<?php
if($cnt%2==0)
echo "</tr><tr>";
 } ?>
</tr>
</table>

              

     
     
     
     
     
     
     
     