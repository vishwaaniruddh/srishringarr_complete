<?php
include("config.php");
$opdid=$_GET['opd'];
//echo "select medicines,potency,opd_real_id from opd where opd_real_id='".$opdid."'";
$opd=mysql_query("select medicines,potency,days1,app_id,howtotake,dosage,prescmnt from opd where opd_real_id='".$opdid."'");
$opdro=mysql_fetch_row($opd);
$med=explode(",",$opdro[0]);
$pot=explode(",",$opdro[1]);
$days=explode(",",$opdro[2]);
$how=explode(",",$opdro[4]);
$dos=explode(",",$opdro[5]);
$cmnt=explode(",",$opdro[6]);
if(count($med)>0 && $med[0]!=''&& $med[0]!='0')
{
?>
<table border="0" width="50%"><tr><td width="13%"><b>Sr. no.</b></td>
<td width="70%" align="center"><b>Medicine</b></td><td width="13%" align="center"><b>Potency</b></td><td width="20%" align="center"><b>Duration/week</b></td>
<td width="20%" align="center"><b>Repetition</b></td><td width="20%" align="center"><b>Comment</b></td>
</tr><?php  

for($i=0;$i<count($med);$i++)
{
if($med[$i]!='0')
{
?>
<tr><td><?php echo $i+1; ?></td><td><?php echo $med[$i]; ?></td><td><?php echo $pot[$i]; ?></td><td><?php echo $days[$i]; ?> weeks</td>
<td><?php echo $dos[$i]; ?></td><td><?php echo $cmnt[$i]; ?></td>
</tr>
<?php
}
}
 ?></table>

<input type="button" class="" onclick="givemed('<?php echo $opdid; ?>','<?php echo $opdro[3]; ?>');" value="Done" id="medbut" />

<?php
}
?>