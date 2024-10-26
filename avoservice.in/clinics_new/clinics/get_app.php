<?php
include 'config.php';
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
if(isset($_REQUEST['id']) && isset($_REQUEST['fname'])){
	
$id=$_REQUEST['id'];
$fname=$_REQUEST['fname'];
$query ="select * from appoint where NO in(select no from patient where no like('".$id."%') and name like('".$fname."%'))";
}else if(isset($_REQUEST['fname'])){
	
$fname=$_REQUEST['fname'];
$query ="select * from appoint where NO in(select no from patient where name like('".$fname."%'))";
}else if(isset($_REQUEST['id'])){
	
$id=$_REQUEST['id'];
$query ="select * from appoint where NO like('".$id."%') ";


}else{
	$dt=date('Y-m-d');
	$query ="select * from appoint where date='$dt' and waiting_list=''";
}

$result = mysqli_query($con,$query) or die(mysqli_error());
 
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

$query.=" order  by srno ASC LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}

?> <table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       <tr>
          <td width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient_Name</td>
          <td width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">IP NO.</td>		  
          <td width="100" style="color:#ac0404; font-size:14px;font-weight:bold;">Appointment For</td>
          <td width="100" style="color:#ac0404; font-size:14px;font-weight:bold;">Doctor</td>
          <td width="98" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Date</td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Time</td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Type</td>
		  <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">Create Bill</td>
		  <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">View Bill</td>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</td>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</td>
          </tr>
		  <?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysqli_num_rows($result)) {
while($row= mysqli_fetch_row($result))
{
$result1 = mysqli_query($con,"select * from patient where no='$row[11]'");
$row1=mysqli_fetch_row($result1);
$result2=mysqli_query($con,"select doc_id,name from doctor where doc_id='$row[14]'");
$row2=mysqli_fetch_row($result2);
?>

	<tr>
	
    <td> <?php if(isset($row1[6])) {echo $row1[6];} ?></td><td> <?php if(isset($row1[39])) {echo $row1[39];} ?></td>
 	<td width="150"> <?php echo $row[13]; ?></td>
    <td width="100"> <?php if(isset($row2[1])){ if($row2[1]==""){ echo  $row[1]; }else { echo $row2[1]; }}?></td>
    <td width="100"> <?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?></td>
    <td width="79"> <?php echo $row[5]; ?></td>
    <td width="79"> <?php echo $row[9]; ?></td>
     
    <td width="50"> <a href='opdesi.php?id=<?php echo $row[12]; ?>'> Create </a></td>
    <td width="50"> <a href='print_opdbill.php?id=<?php echo $row[12]; ?>'> View </a></td>	
    <td width="50"> <a href='edit_app.php?id=<?php echo $row[12]; ?>'> Edit </a></td>
    <td>  <a href="javascript:confirm_delete3(<?php echo $row[12]; ?>);"> Delete </a></td>
<?php
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