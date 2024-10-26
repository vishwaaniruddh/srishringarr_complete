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
	$query ="select * from surgery";		//changed surgery1 to surgery 
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

$query.=" orderby s_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}

?> <table width="1190"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       
         <tr> <td width="55" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient Name</td>
          <td width="55" style="color:#ac0404; font-size:14px; font-weight:bold;">Anaesthetist</td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Type </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery Date </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgeon 1 </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgeon 2 </td>
          <td width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Total Fees</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</td>
          <td width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</td></tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(isset($results)){
if(mysqli_num_rows($result)) {				//CHECK HERE
while($row= mysqli_fetch_row($result))
{
$result1=mysqli_query($con,"select name from patient where no='$row[0]'");
$row1=mysqli_fetch_row($result1);?>
	<tr>
    
    <td width="55">  <?php if(isset($row1[1])) {echo  $row1[1];} ?></td>
	<td width="110"> <?php echo $row[7]; ?></td>
    <td width="105"> <?php if($row[8]=="LA") { echo "Local Anaesthetist"; }
                 else if($row[8]=="GA") { echo "General Anaesthetist"; } 
            else if($row[8]=="SA") { echo "Spinal Anaesthetist"; }?>
    <td width="105"> <?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td width="105"> <?php echo $row[3]; ?></td>
    <td width="105"> <?php echo $row[4]; ?></td>
    <td width="105"> <?php echo $row[32]; ?></td>
    <td> <a href='edit_surgery.php?id=<?php echo $row[37]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletead(<?php echo $row[37]; ?>);"> Delete </a></td>
        
</tr><?php
			$intRows++;
	?> 

	<?php
			
		}
		echo"</table>";
	?>
 <!-- PAGINATION  -->
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
} }
else{
echo "<div class='error'>No Records Found!</div>";
}
 
 
 ################ home end

 ?>