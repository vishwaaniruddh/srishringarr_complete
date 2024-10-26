<?php
include('config.php');

//$Num_Rows = mysql_num_rows ($result);
$result = mysql_query($_REQUEST['qry']) or die(mysql_error());

?> 
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript">

 $(document).ready(function() {

        $('#cou_btn').click(function(e) {
          e.preventDefault();

          w=window.open();
          var temp=$('#search').html();
          w.document.write(temp);
          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
	else w.print();
          w.close();
         return false;
        });
       });  


</script>
<style type="text/css">
   table { page-break-inside:auto }
   tr    { page-break-inside:avoid; page-break-after:auto }

</style>
</head>
<body>
<input type="button" id="cou_btn" value="Print" style="width:100px;"/>
<div id="search">
<table  border="1" style="border:thin" cellpadding="0" cellspacing="0" width="100%">
 
       <thead>
         <tr>
		<th>OPD</th>
          <th>App_Date</th>
          <th>Patient ID</th>
          <th>Time</th>
          <th>Patient_Name</th>
          <th>Balance</th>
          <th>Contact</th>
          <th>New/Old</th>
          <th>Center</th>
          <th>Appointment Type</th>
          <th>Type/status</th>    
</tr>
</thead>
<?php
$intRows = 0;
$cnt=0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
$cnt=0;
while($row= mysql_fetch_array($result))
{
	$chckqry=mysql_query("select * from appoint where presstat<>0 and app_date>'".$row['app_date']."' and no='".$row['no']."'");
	//echo "select * from appoint where presstat<>0 and app_date>'".$row['app_date']."' and no='".$row['no']."' ".mysql_num_rows($chckqry)."<br/>";
	if(mysql_num_rows($chckqry)<1)
	{
$cnt=$cnt+1;
$result1 = mysql_query("select * from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2=mysql_query("select doc_id,name from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);
$result5=mysql_query("select * from appoint");
$row5=mysql_fetch_row($result5);

$result6=mysql_query("select * from slot where block_id='$row[3]'");
$row6=mysql_fetch_row($result6);
$dur=mysql_query("select duration from apptype where type='".$row6[1]."'");
$durro=mysql_fetch_row($dur);
$stime=$row6[3];
$mins=($row[4]-1)* $durro[0];
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 
?>
<tbody>
<tr>
   <tr>
   <!--<td width="5" height="31"> <input type="checkbox" name="mail<?php echo $cnt; ?>" id="mail<?php echo $cnt ?>" value="<?php echo $row[0]; ?>" /></td>-->
    <td align="center"><?php //if ($row[2]==$dt)
if($row[11]!='yes' && $row[2]<=$dt && $row[6]!='w' && $row[12]=='2') { ?><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row5[0]; ?>" onClick="window.location.href='opd.php?id=<?php echo $row[1]; ?>&aid=<?php echo $row[0];?>&type=<?php echo $row[5];?>&dt=<?php echo $row[2]; ?>'" /> <?php } ?></td>
    <td width="71" height="31"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td><?php echo $row[8];  ?></td>
    <td width="105" height="31"> <?php echo $apptime; ?></td>
    <td height="31"> <?php echo $row1[6]; ?></td>
    <td><?php
    
	$pac=mysql_query("select sum(amt) from patient_package where patientid='".$row[8]."' and status='0'");
$pacro=mysql_fetch_row($pac);
$qr=mysql_query("select sum(amt) from opd_collection where patientid='".$row[8]."'");
$ro=mysql_fetch_row($qr);
echo ($pacro[0]-$ro[0]);
	?></td>
    
    <td height="31"> <?php if($row1[23]=="") { echo $row1[22]; } else { echo $row1[23]; }?></td>
 	<td width="69" height="31"> <?php if($row[5]=="N"){ echo "New";}else if($row[5]=="O"){ echo "Old"; }  ?></td>
    <td width="126" height="31"> <?php echo $row[13];
	
	 ?></td>
    <td width="124" height="31"> <?php echo $row[7]; ?></td>
   	<td width="48" height="31"> 
	<?php
	if($row[14]!=''){ echo $row[14]."/";} ?>
	<?php if($row[6]=='w'){ ?>Tentative<?php }else{ echo "Confirmed";} ?>
	</td>
    </tr>
    </tbody>

<?php
			$intRows++;
			$cnt=$cnt+1;
	}
	}	
		
	?>
</table></div>
<?php

}
else{
echo "<div class='error'>No Records Found!</div>";
}
?>
</div>
</body>