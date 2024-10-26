<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

$query ="select * from city where ";

if(isset($_REQUEST['city']))
{
	
$city=$_REQUEST['city'];

$query.="name like('".$city."%') ";
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

$query.=" order by name ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> <table width="385"  border="1" id="results" cellpadding="4" cellspacing="0" style="text-transform:uppercase;font-size:12px;">
 
       
                   <tr>  
                <th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>
                <th width="41" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>
                <th width="58" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>
</tr>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	 
?>
<tr>
   <td width="254"> <?php echo $row[0]; ?></td>
    <td> <a href='edit_city.php?id=<?php echo $row[1]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletecity(<?php echo $row[1]; ?>);"> Delete </a></td>
    </tr>

<?php
			$intRows++;
	?> 

	<?php
		}
		echo"</table>";	
		
	?>

<div class="pagination" style="width:200px;"><font size="3" color="#000">
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