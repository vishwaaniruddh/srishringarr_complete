<?php
include 'config.php';
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
if(isset($_REQUEST['id']) && isset($_REQUEST['fname'])){
	
$id=$_REQUEST['id'];
$fname=$_REQUEST['fname'];
$query ="select * from doctor where doc_id like('".$id."%') and name like('".$fname."%')";
}else if(isset($_REQUEST['fname'])){
	
$fname=$_REQUEST['fname'];
$query ="select * from doctor where name like('".$fname."%')";
}else if(isset($_REQUEST['id'])){
	
$id=$_REQUEST['id'];
$query ="select * from doctor where doc_id like('".$id."%') ";


}else{
	$query ="select * from diagnose";
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

$query.=" orderby d_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}

?> <table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0">
<tr>
  <th width="42" style="color:#ac0404; font-size:14px; font-weight:bold;">Sr No</th>
          <th width="134" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient Name</th>
           <th width="99" style="color:#ac0404; font-size:14px; font-weight:bold;">Date</th>
		    <th width="92" style="color:#ac0404; font-size:14px; font-weight:bold;">Type</th>
			 <th width="182" style="color:#ac0404; font-size:14px; font-weight:bold;">Report</th>
			  <th width="256" style="color:#ac0404; font-size:14px; font-weight:bold;">Finding</th>
			  <th width="77" style="color:#ac0404; font-size:14px; font-weight:bold;">amount</th>
          <th width="63" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>
          <th width="75" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>
                   
        </tr>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(is_array($result))
{
if(mysqli_num_rows($result)) 
{
while($row= mysqli_fetch_row($result))
{
	 
$result1 = mysqli_query($con,"select * from patient where no='$row[0]'");
//$result1 = mysqli_query("select doc_id,name from new_doc ");
$row1=mysqli_fetch_row($result1);
?>

	<tr>
    <td width="42"> <?php echo $i++; ?></td>
    <td width="134"> <?php echo $row1[6]; ?></td>
	 <td width="99"><?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
	  <td width="92"> <?php echo $row[3]; ?></td>
	   <td width="182"> <?php echo $row[4]; ?></td>
	    <td width="256"> <?php echo $row[5]; ?></td>
		 <td width="77"> <?php echo $row[6]; ?></td>
	<td> <a href='edit_diag.php?id=<?php echo $row[7]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_delete1(<?php echo $row[7]; ?>);"> Delete </a></td>
        </tr>

<?php
			$intRows++;
	?> 

	<?php
			
		}
		echo"</table>";
		}	?>

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