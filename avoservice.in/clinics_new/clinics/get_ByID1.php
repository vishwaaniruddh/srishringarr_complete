<?php
include 'config.php';
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

$query.=" order  by srno ASC LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}

?> <table width="1038"  border="1" id="results" style="font-size:14px;border:1px #ac0404 solid;">
 
       
         <tr> <td width="112" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="149" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name </td>
          <td width="168" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="93" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
          <td width="171" style="color:#ac0404; font-size:14px; font-weight:bold;">Reference By </td>
          <td width="93" style="color:#ac0404; font-size:14px; font-weight:bold;" >Appointment</td>
          <td width="69" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
          <td width="101" style="color:#ac0404; font-size:14px; font-weight:bold;">View Full Details</td></tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysqli_num_rows($result)) {
while($row= mysqli_fetch_row($result))
{
	 
?>
<tr>
    <td  width='112'><?php echo $row[2]; ?></td>
	<td  width='149'> <?php echo $row[6]; ?></td>
    <td  width='168'><?php echo  $row[23]; ?></td>
    <td  width='93'> <?php echo $row[18]; ?></td>
    
   <?php

$result1 = mysqli_query($con,"select * from doctor where doc_id='$row[29]'");
//$result1 = mysqli_query("select doc_id,name from new_doc ");
$row1=mysqli_fetch_row($result1);


 ?>  
 <td  width='171'> <?php if(isset($row1[1])){ if($row1[1]==""){ echo  $row[29]; }else { echo $row1[1]; }}?></td>
   <!-- <td  width='171'> <?php //if( $row1[1]==""){echo  $row[29]; } else { echo $row1[1]; } ?></td> -->
    
<td width='93' align="center"><input name="code1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[2]; ?>'" /> </td>

<td width="69" align="center"><input name="code4[]" id="code4[]" type="checkbox" value="<?php echo $row[2]; ?>" onclick="window.location.href='admission.php?id=<?php echo $row[2]; ?>'" /> </td>

<td width="101"> <a href="patient_detail.php?id=<?php echo $row[2]; ?>"> Details </a></td>

</tr>
<?php
			$intRows++;
	
			
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