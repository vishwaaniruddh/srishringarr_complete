<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');
include('template.html');
$sql="select * from patient";
$result=mysql_query($sql);
?>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>



<?php 
$result = mysql_query("select * from admission");
?>

      
        
        <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Discharge</p><br />
        
          <table width="869" border="1" style="border:1px #ac0404 solid; text-align:left;text-transform:uppercase;font-size:12px;">
          
          <th width="153" style="color:#ac0404; font-size:12px; font-weight:bold;">Name</th>
          <th width="144" style="color:#ac0404; font-size:12px; font-weight:bold;">Doctor</th>
          <th width="124" style="color:#ac0404; font-size:12px; font-weight:bold;">Admission Date </th>
		     <th width="124" style="color:#ac0404; font-size:12px; font-weight:bold;">Admission Time </th>
          <th width="131" style="color:#ac0404; font-size:12px; font-weight:bold;">Discharge Date </th>
          <th width="79" style="color:#ac0404; font-size:12px; font-weight:bold;">Discharge Time </th>
          <th width="87" style="color:#ac0404; font-size:12px; font-weight:bold;">Room no. </th>
          <th width="105" style="color:#ac0404; font-size:12px;font-weight:bold;">Discharge</th>
        
                   
            <?php while($row=mysql_fetch_row($result))
{  

$result1 = mysql_query("select * from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2 = mysql_query("select * from doctor where doc_id='$row[2]'");
$row2=mysql_fetch_row($result2);
?>

	<tr>
    
    <td width="153"> <?php echo $row1[6]; ?></td>
	<td width="144"> <?php echo $row2[1]; ?></td>
    <td width="124"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
	<td width="79"> <?php echo $row[3]; ?></td>
    <td width="131"> <?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td width="79"> <?php echo $row[5]; ?></td>
    <td width="87"> <?php echo $row[6]; ?></td>
    <td> <a href='discharge_summary.php?id=<?php echo $row[18]; ?>'> Discharge </a></td>
    
        
    </tr>
<?php } ?>
</table>


<?php 
include('footer.html');
}else
{ 
 header("location: index.html");
}

?>