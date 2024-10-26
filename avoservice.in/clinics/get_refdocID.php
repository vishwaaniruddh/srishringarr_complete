<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
if(isset($_REQUEST['id']) && isset($_REQUEST['fname'])){
	
$id=$_REQUEST['id'];
$fname=$_REQUEST['fname'];
$query ="select * from doctor_ref where ref_id like('".$id."%') and name like('".$fname."%')";
}else if(isset($_REQUEST['fname'])){
	
$fname=$_REQUEST['fname'];
$query ="select * from doctor_ref where name like('".$fname."%')";
}else if(isset($_REQUEST['id'])){
	
$id=$_REQUEST['id'];
$query ="select * from doctor_ref where ref_id like('".$id."%') ";


}else{
	$query ="select * from doctor_ref";
}

$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page =50;   // Records Per Page
 
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

$query.=" order  by ref_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> <table width="1102"  border="1" id="results" cellpadding="4" cellspacing="0" style="text-transform:uppercase;font-size:13px;">
 
       
                   <tr><th width='50' style='color:#ac0404; font-size:14px; font-weight:bold;'>Doc_id</th>
          <th width='200' style='color:#ac0404; font-size:14px; font-weight:bold;'>Name</th>
          <th width='120' style='color:#ac0404; font-size:14px; font-weight:bold;'>City</th>
          <th width='70' style='color:#ac0404; font-size:14px; font-weight:bold;'>Contact</th>
          <th width='130' style='color:#ac0404; font-size:14px;font-weight:bold;'>category</th>
		  <th width='130' style='color:#ac0404; font-size:14px;font-weight:bold;'>Specialist</th>
          <th width='70' style='color:#ac0404; font-size:14px;font-weight:bold;'>Edit</th>
          <th width='70' style='color:#ac0404; font-size:14px;font-weight:bold;'>Delete</th>
</tr>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	 
?>
<tr>
    <td><?php echo  $row[0]; ?></td>
	<td width='110'><?php echo  $row[1]; ?></td>
    <td width='105'><?php echo  $row[3]; ?></td>
    <td><?php echo  $row[6]; ?></td>
    <td><?php echo  $row[8]; ?></td>
	 <td><?php echo  $row[9]; ?></td>
    <td> <a href='edit_refdoc.php?id=<?php echo  $row[0]; ?>'> Edit </a></td>
    <td> <a href='javascript:Ddelete(<?php echo  $row[0]; ?>)'> Delete </a></td>
    </tr>

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