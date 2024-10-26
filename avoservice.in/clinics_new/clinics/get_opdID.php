<?php
include 'config.php';
############# must create your db base connection
//$strPage=0;
//if(is_array($strPage)){
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
  if(isset($_REQUEST['id']) && isset($_REQUEST['fname'])){

######## process of opd report  #############	
	$id=$_REQUEST['id'];
	$fname=$_REQUEST['fname'];
	$query ="select * from patient where no like('".$id."%') and name like('".$fname."%')";
}else if(isset($_REQUEST['fname'])){

	
$fname=$_REQUEST['fname'];
$getdata ="select * from patient where name like('".$fname."%')";
$pdata=mysqli_fetch_assoc(mysqli_query($con,$getdata));
$patient_id=$pdata['no'];
$query ="select * from opd where patient_id = '".$patient_id."'";
}else if(isset($_REQUEST['id'])){
	
$id=$_REQUEST['id'];
$query ="select * from opd where opd_id like('".$id."%') ";

}else{
	
	$query ="select * from opd";
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

$query.=" order  by opd_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);

if(!$result){
	mysqli_error($con);
}
}
?> <table width="1215"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       
          <tr>
          <td width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
          <td width="80" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</td>
          <td width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Date </td>
          <td width="86" style="color:#ac0404; font-size:14px; font-weight:bold;">Complaints</td>
          <td width="71" style="color:#ac0404; font-size:14px; font-weight:bold;">Findings</td>
          <td width="76" style="color:#ac0404; font-size:14px; font-weight:bold;">Advised</td>
          <td width="87" style="color:#ac0404; font-size:14px; font-weight:bold;">Diagnosis</td>
          <td width="110" style="color:#ac0404; font-size:14px; font-weight:bold;">Medicines</td>
          <td width="85" style="color:#ac0404; font-size:14px; font-weight:bold;">Procedure</td>
          <td width="57" style="color:#ac0404; font-size:14px; font-weight:bold;">Dosage</td>
          <td width="39" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</td>
          <td width="43" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</td></tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
// if(is_array($result)){
if(mysqli_num_rows($result)) {
while($row= mysqli_fetch_array($result))
{
	//echo "return";
	$result1 = mysqli_query($con,"select * from patient where no='$row[1]'");

$row1=mysqli_fetch_row($result1);

	 
?>

	<tr>
    <td> <?php echo $row[0]; ?></td>
    <td> <?php if(isset($row1[6])) {echo $row1[6];} ?></td>
    <td> <?php if(isset($row[76]) and $row[76]!='0000-00-00') echo date('d/m/Y',strtotime($row[76])); ?></td>
    <td> <?php echo $row[29]; ?></td>
    <td> <?php echo $row[77]; ?></td>
    <td> <?php echo $row[36]; ?></td>
    <td> <?php echo $row[30]; ?></td>
    <td> <?php echo $row[78]; ?></td>
    <td> <?php echo $row[79]; ?></td>
    <td> <?php echo $row[80]; ?></td>
    <td> <a href='edit_opd.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td>  <a href="javascript:confirm_opddelete(<?php echo $row[0]; ?>);"> Delete </a></td>
      
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
// } 
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