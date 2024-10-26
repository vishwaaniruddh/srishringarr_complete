<?php
include 'config.php';
 
$strPage = $_REQUEST['Page'];

$frdt="";
$todt="";

$doc=$_REQUEST['doc'];
$docids="";
$docqr="select doc_id,name from doctor where 1";

if($doc!="")
{
	
	$docqr.=" and doc_id='".$doc."'";
	
}

$execdocqr=mysqli_query($con,$docqr);
while($frray=mysqli_fetch_array($execdocqr))
{
	if($docids=="")
	{
		
		$docids=$docids."'".$frray[0]."'";
	}
	else
	{
		
		$docids=$docids.",'".$frray[0]."'";
	}
	
}

echo $docids;

$query ="SELECT * FROM `appoint` where Doctor in($docqr)";
//echo $query;

if($_REQUEST['frdt']!="")
{
	
$frdt=str_replace("/","-",$_REQUEST['frdt']);
$query .=" and date>='".$frdt."'";	
}

if($_REQUEST['todt']!="")
{
	
$todt=str_replace("/","-",$_REQUEST['todt']);	
$query .=" and date>='".$todt."'";
}


$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}
 
$Num_Rows = mysqli_num_rows ($result);
 
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

?> <table width="1190"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       
         <tr> <td width="74" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
           <td width="90" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient_Name</td>
          <td width="113" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </td>
          <td width="50" style="color:#ac0404; font-size:14px; font-weight:bold;">City </td>
          <td width="100" style="color:#ac0404; font-size:14px;font-weight:bold;">Appointment For</td>
          <td width="100" style="color:#ac0404; font-size:14px;font-weight:bold;">Doctor</td>
          <td width="98" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Date</td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Time</td>
          <td width="70" style="color:#ac0404; font-size:14px; font-weight:bold;">Type</td>
          <td width="99" style="color:#ac0404; font-size:14px; font-weight:bold;" >Appointment</td>
         
          <td width="46" style="color:#ac0404; font-size:14px; font-weight:bold;">OPD</td>
          
          <!--<td width="83" style="color:#ac0404; font-size:14px; font-weight:bold;">Admission</td>
          <td width="62" style="color:#ac0404; font-size:14px; font-weight:bold;">Surgery</td>-->
          <td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">History</td>
          <td width="92" style="color:#ac0404; font-size:14px; font-weight:bold;">View Full Details</td></tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysqli_num_rows($result)) {
while($row= mysqli_fetch_row($result))
{
	$result1 = mysqli_query($con,"select * from patient where no='$row[11]'");
$row1=mysqli_fetch_row($result1);

$result2=mysqli_query($con,"select doc_id,name from doctor where doc_id='$row[14]'");
$row2=mysqli_fetch_row($result2) 
?>
<tr>
    <td  width='74'><?php echo $row1[2]; ?></td>
	<td  width='92'> <?php echo $row1[6]; ?></td>
    <td  width='103'><?php echo  $row1[23]; ?></td>
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