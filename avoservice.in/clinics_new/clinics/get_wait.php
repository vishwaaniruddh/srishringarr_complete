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
	$query ="select * from surgery_wait where waiting='No'";
}

$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}
 
$Num_Rows = mysqli_num_rows($result);
 
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

$query.=" order  by sur_date ASC LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);


if(!$result){
	mysqli_error($con);
}

?> <table width="1190"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       
         <tr> <td width="14" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name </td>
          <td width="113" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
		    <td width="84" style="color:#ac0404; font-size:14px; font-weight:bold;">Date</td>
			  <td width="84" style="color:#ac0404; font-size:14px; font-weight:bold;">Waiting Date</td>
          <td width="84" style="color:#ac0404; font-size:14px; font-weight:bold;">Number of days</td>
        
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Give Appointment</td>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</td>
          <td width="52" style="color:#ac0404; font-size:14px; font-weight:bold;">Details</td></tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(isset($result)){ 
if(mysqli_num_rows($result)) {		
while($row= mysqli_fetch_array($result))
{
	 
?>
<tr>
    <td  width='34'><?php echo $row[0]; ?></td>
   <?php

$result1 = mysqli_query($con,"select * from patient where no='$row[1]'");
//$result1 = mysqli_query($con,"select doc_id,name from new_doc ");
$row1=mysqli_fetch_row($result1);


 ?>  
    <td  width='135'> <?php if(isset($row1[6])) {echo $row1[6];} ?></td>
    <td  width='75'> <?php if(isset($row1[23])) {echo $row1[23];} ?></td>
    <td  width='75'> <?php if(isset($row1[18])) {echo $row1[18];} ?></td>
	
	 <td  width='115'><?php if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4])); ?></td>
	  <td  width='115'><?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
     <td  width='115'> <?php  echo $row[3]; ?></td>
     
    
<td width="100" ><a href="edit_optsurgery.php?id=<?php echo $row[0]; ?>">Give Appointment</a></td>
  <td> <a href='javascript:Ddelete(<?php echo  $row[0]; ?>)'> Delete </a></td>
<td width="51"> <a href="patient_detail.php?id=<?php echo $row[0]; ?>"> Details </a></td>
</tr><?php
			$intRows++;
	?> 

	<?php
			
		}
		echo"</table>";
	?>

<div class="pagination" sty le="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
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