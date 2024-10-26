<?php
include 'config.php';
?> 
<center><h3>Consolidated Bill Format</h3></center>
Bill No : 

Date of Submission

<h4>Bill Details (Summary)</h4>
<table width="1190"  border="1" id="results" cellpadding="4" cellspacing="0">
<tr> 
          <td width="44" style="color:#ac0404; font-size:14px; font-weight:bold;">Sr No</td>
          <td width="136" style="color:#ac0404; font-size:14px; font-weight:bold;">Name of patient</td>
          <td width="89" style="color:#ac0404; font-size:14px; font-weight:bold;">Ref. No </td>
          <td width="144" style="color:#ac0404; font-size:14px; font-weight:bold;">Diag./Procedure for which referred</td>
          <td width="162" style="color:#ac0404; font-size:14px;font-weight:bold;">Procedure Performed/ treatment given</td>
          <td width="108" style="color:#ac0404; font-size:14px;font-weight:bold;">CGHS/other Code (with page) No/Nos/N.A.</td>
          <td width="108" style="color:#ac0404; font-size:14px; font-weight:bold;">Other if not in CGHS rate list</td>
          <td width="86" style="color:#ac0404; font-size:14px; font-weight:bold;">Amount claimed with date</td>
          <td width="98" style="color:#ac0404; font-size:14px; font-weight:bold;">Amount entitled with date</td>
          <td width="113" style="color:#ac0404; font-size:14px; font-weight:bold;">Remarks</td>
</tr>
         

<?php

while($row= mysqli_fetch_row($result))
{
	
?>
<tr>
    <td  width='44'><?php echo $row1[2]; ?></td>
	<td  width='136'> <?php echo $row1[6]; ?></td>
    <td  width='89'><?php echo  $row1[23]; ?></td>
    <td  width='144'><?php echo  $row1[18]; ?></td>
    <td width="162"> <?php echo $row[13]; ?></td>
    <td width="108"> <?php echo $row2[1]; ?></td>
    <td width="108"> <?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?></td>
    <td width="86"> <?php echo $row[5]; ?></td>

<td width="98"> <a href="patient_detail.php?id=<?php echo $row[11]; ?>"> Details </a></td>
</tr>
<?php } ?>
</table>