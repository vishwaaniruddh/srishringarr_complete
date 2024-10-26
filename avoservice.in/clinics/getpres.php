<?php
include("config.php");
$opdid=$_GET['opd'];
//echo "select medicines,potency,opd_real_id from opd where opd_real_id='".$opdid."'";
$opd=mysql_query("select medicines,potency,days1,app_id,howtotake,dosage,prescmnt,app_id,patient_id,drugs,dos,blister,instruction from opd where opd_real_id='".$opdid."'");
$opdro=mysql_fetch_row($opd);
$med=explode(",",$opdro[0]);
$pot=explode(",",$opdro[1]);
$days=explode(",",$opdro[2]);
$how=explode(",",$opdro[4]);
$dos=explode(",",$opdro[5]);
$cmnt=explode(",",$opdro[6]);
$drugs=explode(",",$opdro[9]);
$dosage=explode(",",$opdro[10]);
$blis=explode(",",$opdro[11]);
$inst=explode(",",$opdro[12]);
if(count($med)>0 && $med[0]!=''&& $med[0]!='0')
{
?>
<table border="0" width="50%" class="results"><!--<tr><td width="13%"><b>Sr. no.</b></td>
<th width="70%" align="center"><b>Medicine</b></th><th>Drugs</th><th width="13%" align="center"><b>Potency</b></th><th width="20%" align="center"><b>Duration/week</b></th>
<th width="20%" align="center"><b>Repetition</b></th><th width="20%" align="center"><b>Comment</b></th>-->
<tr><thead><th>Sr No</th><th>Medicine Name </th><th>Drugs</th><th>Potency</th><th>Repetition </th><th>dosage</th>
<th>Duration/week</th><th>Blister</th><th>Instruction</th><th>Others</th></thead></tr>
<?php  

for($i=0;$i<count($med);$i++)
{
if($med[$i]!='0')
{
?>
<tbody><tr><td><?php echo $i+1; ?></td><td><?php echo $med[$i]; ?></td>
<td><?php echo $drugs[$i]; ?></td>
<td><?php echo $pot[$i]; ?></td><td><?php echo $days[$i]; ?></td>
<td><?php echo $dosage[$i]; ?></td>
<td><?php echo $dos[$i]; ?></td>
<td><?php echo $blis[$i]; ?></td>
<td><?php echo $inst[$i]; ?></td>
<td><?php echo $cmnt[$i]; ?></td>
</tr></tbody>
<?php
}
}
 ?></table>
<input type="button" class="" onclick="givemed('<?php echo $opdid; ?>','<?php echo $opdro[3]; ?>');" value="Medicine Given" id="medbut" style="width:120px; height:40px;" />
   <?php
}
?>
    

 <a href="#" onClick="window.open('opdpayment.php?appid=<?php echo $opdro[7];  ?>&amt=<?php //echo $bal; ?>&pid=<?php echo $opdro[8]; ?>','opdpay','width=600,height=300,left=200,top=100')" style="text-decoration:none; color:#099">
 <input type="button" class="" value="Final Procedure" id="medbut" style="width:120px; height:40px;" /></a>

