<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
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
	$query ="select * from patient";
}

$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
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

$query.=" order  by srno ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> <table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       
         <tr> <td width="74" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="91" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name </td>
          <td width="113" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
          <td width="114" style="color:#ac0404; font-size:14px; font-weight:bold;">Reference By </td>
          <td width="68" style="color:#ac0404; font-size:14px; font-weight:bold;" >Appoint-ment</td>
          <td width="46" style="color:#ac0404; font-size:14px; font-weight:bold;">OPD</td>
          <td width="83" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
          <td width="62" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery</td>
          <td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">History</td>
          <td width="92" style="color:#ac0404; font-size:14px; font-weight:bold;">View Full Details</td></tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	 
?>
<tr>
    <td  width='74'><?php echo $row[2]; ?></td>
	<td  width='92'> <?php echo $row[6]; ?></td>
    <td  width='103'><?php echo  $row[23]; ?></td>
    <td  width='61'> <?php echo $row[18]; ?></td>
    
   <?php

$result1 = mysql_query("select * from doctor where doc_id='$row[29]'");
//$result1 = mysql_query("select doc_id,name from new_doc ");
$row1=mysql_fetch_row($result1);


 ?>  
    <td  width='115'> <?php if( $row1[1]==""){echo  $row[29]; } else { echo $row1[1]; } ?></td>
    
<td width='68' align="center"><input name="ode1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[2]; ?>'" /> </td>
<td width="47" align="center"><input name="code2[]" id="code2[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='opd.php?id=<?php echo $row[2]; ?>'" /> </td>
<td width="78" align="center"><input name="code4[]" id="code4[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='admission.php?id=<?php echo $row[2]; ?>'" /> </td>
<td width="65" align="center"><input name="code5[]" id="code5[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='surgery.php?id=<?php echo $row[2]; ?>'" /> </td>
<td width="71" align="center"><input name="code3[]" id="code3[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='Timeline/horizontal.php?id=<?php echo $row[2]; ?>'" /> </td>
<td width="91"> <a href="patient_detail.php?id=<?php echo $row[2]; ?>"> Details </a></td>
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