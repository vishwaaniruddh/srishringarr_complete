<?php
session_start();
include('getcenter.php');
include('config.php');
############# must create your db base connection
 
 $strPage = '1'; //$_REQUEST['Page'];
// echo $_REQUEST['mode'];


	
//$id=$_REQUEST['id'];
//$fname=$_REQUEST['fname'];
$query ="select * from enquirystatus where perid in (select trackid from enquiryperson) and status=0";

//echo $query;
$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 //echo $Num_Rows;
########### pagins

$Per_Page = $Num_Rows;   // Records Per Page
 
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

$query.=" order by entrydt DESC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?>
<style>


</style>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<table class="results">
 
       <thead align="left">
          <tr>
          <th>ID</th>
          <th>Full Name </th>
          <th>Phone </th>
          <th>Next FollowUP Date </th>
          <!--<th>End Date </th>-->
          <th>City </th>
          <th>Area </th>
          <th>Reference</th>
          <!--<th  >Reference Doctor </th>
          <th  >Diagnosis</th>-->
          <th>Feedback</th>
          <th>Appointment</th>          
          <th>View Full Details</th>
          <th>Update</th>
         </tr>
</thead>
<?php
$intRows = 0;
$i=1;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {

while($row= mysql_fetch_row($result))
{
	//echo "Select * from enquiryperson where trackid='".$row[6]."'";
$qr=mysql_query("Select * from enquiryperson where trackid='".$row[6]."'");	 
$qrro=mysql_fetch_array($qr);
//echo $qrro[4];	
?>
<tbody>
<tr>
    <td ><?php echo $row[6]; ?></td>
	<td ><?php echo $qrro[1]; ?></td>
    <td><?php 
	if($qrro[11]!='')
	echo $qrro[11]."<br>";
	if($qrro[12]!='')
	echo $qrro[12]."<br>";
	
	if($qrro[13]!='')
	echo $qrro[13]."<br>";
	
	if($qrro[10]!='')
	echo $qrro[10]."<br>";
	
	 ?></td>
    <td ><?php echo date("Y-m-d",strtotime($row[4])); ?></td>
 <td ><?php echo $qrro[6]; ?></td>
    <td > <?php echo $qrro[9]; ?></td>
<td><?php echo $qrro['reference']; ?></td>
 
    <td width="78" align="center"><?php
	echo $row[1];
?> </td>
<td align="left" ><!--<input name="ode1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[0]; ?>'" /> -->
<a href="enq2pat.php?enqid=<?php echo $row[6]; ?>">Give Appointment</a><!--<br />
<a href="app_surgery.php?id=<?php echo $row[0]; ?>">Surgery App</a>-->
</td>


<td > <!--<a href="patient_detail.php?id=<?php //echo $row[0]; ?>"> Details </a>/ -->
 <a href="Edit_enquiry.php?id=<?php echo $row[6];  ?> &center=<?php echo $qrro[9]; ?> " style="text-decoration:none; color:#099">Edit</a></td>

<td>
	<div id="showrem<?php echo $i; ?>1" style="display:block">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" value="Update" />
	</div>
	<div id="showrem<?php echo $i; ?>" style="display:none">	
		<textarea id="rem<?php echo $i; ?>"></textarea>
		<input type="button" onClick="add_update('<?php echo $i; ?>','<?php echo $row[6]; ?>')" value="Update">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" value="Cancel" />
	</div>
</td>

</tr>  </tbody><?php
			$i++;
			$intRows++;
	?> 

	<?php
			
		}
		
	?>
</table>
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