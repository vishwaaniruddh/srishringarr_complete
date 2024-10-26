<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

$query ="select * from address where ";

if(isset($_REQUEST['name']))
{
	
$name=$_REQUEST['name'];

$query.="name like('".$name."%') ";
}
if(isset($_REQUEST['add']))
{
	
$add=$_REQUEST['add'];
$query.="and office like('".$add."%')";
}
if(isset($_REQUEST['mobile'])){
	
$mobile=$_REQUEST['mobile'];
$query.="and mobile like('".$mobile."%') ";

}
if(isset($_REQUEST['pincode'])){
	
$pincode=$_REQUEST['pincode'];
$query.="and pincode like('".$pincode."%') ";

}


$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page =10;   // Records Per Page
 
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

$query.=" order  by name ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> <table class="results">
 <thead>
   <tr>
   <th>Name</th>
   <th>Address</th>
    <th>Contact</th>
     <th>Pincode </th>
      <th>Information For </th>
       <th>Edit</th>
         <th>Delete</th>
</tr>
</thead>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	 

$result1 = mysql_query("select * from patient where no='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2 = mysql_query("select * from doctor where doc_id='$row[2]'");
$row2=mysql_fetch_row($result2);
?>
<tbody>
	<tr>
    <td ><?php echo $row[2]; ?></td>
	<td ><?php echo $row[3]; ?></td>
    <td ><?php echo $row[9]; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td><?php echo $row[14]; ?></td>
    <td> <a href='edit_teldir.php?id=<?php echo $row[16]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_delete2(<?php echo $row[16]; ?>)"> Delete </a></td>
    </tr>
</tbody>
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
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
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