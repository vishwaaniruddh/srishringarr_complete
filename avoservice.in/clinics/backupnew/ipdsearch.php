<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

$query ="select a.ad_real_id,a.patient_id,a.admit_date,a.dis_date,a.room,b.srno,b.name from admission a,patient b where a.patient_id=b.srno";

if(isset($_REQUEST['name']))
{
	
$name=$_REQUEST['name'];

$query.=" and b.name like('".$name."%') ";
}

if(isset($_REQUEST['adate']) && $_REQUEST['adate']!="")
{
	
$adate=$_REQUEST['adate'];
//echo "hi";
$query.="and a.admit_date like STR_TO_DATE('".$adate."%','%d/%m/%Y')";
}

if(isset($_REQUEST['room']))
{
	
$room=$_REQUEST['room'];
$query.="and a.room like('".$room."%')";
}

//echo $query;
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

$query.=" order  by a.ad_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> <table class="results">
 
       
         <tr>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Name</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Admission Date </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Discharge Date </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Room no. </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Doctor Visit</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Surgery</td>
          <td style="color:#ac0404; font-size:12px;font-weight:bold;">Edit</td>
          <td style="color:#ac0404; font-size:12px;font-weight:bold;">Delete</td>
</tr>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{

$result1 = mysql_query("select * from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);	 
?>
<tr>
    <td> <?php echo $row1[6]; ?></td>
    <td> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td> <?php echo $row[4]; ?></td>
    <td align="center"><input name="code5[]" id="code5[]" type="checkbox" value="<?php echo $row[1]; ?>" onClick="window.location.href='visit_doc.php?id=<?php echo $row[1]; ?>&ad=<?php echo $row[0]; ?>'" /> </td>
    <td align="center"><input name="code5[]" id="code5[]" type="checkbox" value="<?php echo $row[1]; ?>" onClick="window.location.href='surgery.php?id=<?php echo $row[1]; ?>'" /> </td>
    <td> <a href='edit_ad.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td> <a href="javascript:confirm_deletead(<?php echo $row[0]; ?>);"> Delete </a></td>
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