<?php
include 'config.php';
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
$rwno=2;
if($_REQUEST['mode']=="Listing"){
if(isset($_REQUEST['id']) && isset($_REQUEST['fname'])){
	
$id=$_REQUEST['id'];
$fname=$_REQUEST['fname'];
$query ="select * from patient where no like('".$id."%') and name like('".$fname."%')";
}else if(isset($_REQUEST['fname'])){
	
$fname=$_REQUEST['fname'];
$query ="select * from patient where name like('".$fname."%')";
}else if(isset($_REQUEST['id'])){
	
$id=$_REQUEST['id'];
$query ="select * from patient where no like('".$id."%') ";


}else{
	$dt=date('Y-m-d');
	$query ="select * from appoint where date='$dt' and waiting_list='' and status=''";
	$rwno=11;
}
//echo $query;
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}
 
$Num_Rows = mysqli_num_rows ($result);
 
########### pagins

$Per_Page = 15;   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$query.=" order by srno ASC LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}

?> <table width="1190"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       
         <tr> <td width="74" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
           <td width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient_Name</td>
          <td width="113" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
          <td width="100" style="color:#ac0404; font-size:14px;font-weight:bold;">Appointment For</td>
          <td width="100" style="color:#ac0404; font-size:14px;font-weight:bold;">Doctor</td>
          <td width="98" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Date</td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Time</td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Type</td>
          <td width="99" style="color:#ac0404; font-size:14px; font-weight:bold;" >Appointment</td>
         
          <td width="46" style="color:#ac0404; font-size:14px; font-weight:bold;">OPD</td>
          
          <!--<td width="83" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
          <td width="62" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery</td>-->
          <td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">History</td>
          <td width="92" style="color:#ac0404; font-size:14px; font-weight:bold;">View Full Details</td></tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysqli_num_rows($result)) {
while($row= mysqli_fetch_row($result))
{
$rw=$row[$rwno];
	$result1 = mysqli_query($con,"select * from patient where no='$rw'");
$row1=mysqli_fetch_row($result1);
	$result2=mysqli_query($con,"select doc_id,name from doctor where doc_id='$row[14]'");
$row2=mysqli_fetch_row($result2);
?>
<tr>
    <td  width='74'><?php  if(isset($row1[2])){echo $row1[2];} ?></td>
	<td  width='92'> <?php if(isset($row1[6])) {echo $row1[6];} ?></td>
    <td  width='103'><?php if(isset($row1[23])) {echo  $row1[23];} ?></td>
    <td  width='103'><?php if(isset($row1[18])) {echo $row1[18];} ?></td>
    <td width="150"> <?php echo $row[13]; ?></td>
    <td width="100"> <?php echo $row2[1]; ?></td>
    <td width="100"> <?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?></td>
    <td width="79"> <?php echo $row[5]; ?></td>
    <td width="79"> <?php echo $row[9]; ?></td>
<td width='68' align="center"><input name="ode1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[11]; ?>'" /> </td>
<!--<td width='48' align="center"><input name="ode1[]" id="code1[]" type="checkbox" value="<?php //echo $row[0]; ?>" onclick="window.location.href='pre_inves.php?id=<?php //echo $row[2]; ?>'" /> </td>-->
<td width="47" align="center"><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='opd.php?id=<?php echo $row[11]; ?>&aid=<?php echo $row[12];?>'" /> </td>
 <?php /*$rs=mysqli_query($con,"select * from surgery_wait where p_id='$row[2]' and waiting='No'");
				$s=mysqli_num_rows($rs);
				
					
				*/?>
<!--<td width="78" align="center"><?php /*if($s==0){ } else { ?><input name="code4[]" id="code4[]" type="checkbox" value="<?php //echo $row[0]; ?>" onclick="window.location.href='admission.php?id=<?php echo $row[2]; ?>'" /> <?php  } ?></td>

<td width="65" align="center"><input name="code5[]" id="code5[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='opt_surgery.php?id=<?php echo $row[2]; */?>'" /> </td>-->
<td width="71" align="center"><a href="Timeline/horizontal.php?id=<?php echo $row[11]; ?>" target="_blank" >History</a> </td>
<td width="91"> <a href="patient_detail.php?id=<?php echo $row[11]; ?>"> Details </a></td>
</tr><?php
			$intRows++;
	?> 

	<?php
			
		}
		echo"</table>";
	?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}
if($Page!=$Num_Pages)
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
}
?>
</font></div>
<?php
############
}
else{
echo "<div class='error'>No Records Found!</div>";
}
 
 
 ################ home end

 ?>