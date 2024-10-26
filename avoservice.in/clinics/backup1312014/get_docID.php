<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

$query ="select * from doctor where ";

/*if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$query.="doc_id like('".$id."%') ";
}*/
if(isset($_REQUEST['fname']))
{
	
$fname=$_REQUEST['fname'];
$query.="name like('%".$fname."%')";
}
if(isset($_REQUEST['city'])){
	
$city=$_REQUEST['city'];
$query.="and city like('%".$city."%') ";

}
if(isset($_REQUEST['con'])){
	
$con=$_REQUEST['con'];
$query.="and mobile like('%".$con."%') ";

}
if(isset($_REQUEST['cat'])){
	
$cat=$_REQUEST['cat'];
$query.="and category like('%".$cat."%') ";

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

$query.=" order  by doc_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?>
<style>
.results {table-layout:fixed;}
.results td {overflow: hidden; width:120px;text-overflow: ellipsis;font-size:12px;}
.results td input{font-size:12px;}
</style>
 <table class="results">
 
       <thead>
          <tr>
         
          <th >Name</th>
          <th >City</th>
          <th >Contact</th>
          <th >category</th>
		  <th >Specialist</th>
          <th >Edit</th>
          <th >Delete</th>
</tr>
</thead>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	 
?>
<tbody>
<tr>
    
	<td width='193'><?php echo  $row[1]; ?></td>
    <td width='118'><?php echo  $row[3]; ?></td>
    <td width='117'><?php echo  $row[6]; ?></td>
    <td width='148'><?php echo  $row[8]; ?></td>
	<td width='123'><?php echo  $row[9]; ?></td>
    <td width='29'><a href='edit_doc.php?id=<?php echo  $row[0]; ?>'> Edit </a></td>
    <td width='44'><a href='javascript:Ddelete(<?php echo  $row[0]; ?>)'> Delete </a></td>
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