<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select a.srno,a.date,a.type,a.report,a.finding,a.amount,b.name,b.srno,a.d_id from diagnose a,patient b where a.srno=b.srno and ";

if(isset($_REQUEST['id']))
{
$id=$_REQUEST['id'];
$query.="a.type like('".$id."%') ";
}

if(isset($_REQUEST['fname']))
{
$fname=$_REQUEST['fname'];
$query.="and b.name like('".$fname."%')";
}

if(isset($_REQUEST['fin'])){
$fin=$_REQUEST['fin'];
$query.="and a.finding like('".$fin."%') ";
}

if(isset($_REQUEST['ddate']) && $_REQUEST['ddate']!="")
{
$ddate=$_REQUEST['ddate'];
$query.="and a.date=STR_TO_DATE('".$ddate."','%d/%m/%Y')";
}

$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
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

$query.=" order  by a.d_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> 
<table class="results">
<tr>
  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Sr No</td>
  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Patient Name</td>
  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Date</td>
  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Type</td>
  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Report</td>
  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Finding</td>
  <td style="color:#ac0404; font-size:12px; font-weight:bold;">amount</td>
  <td style="color:#ac0404; font-size:12px;font-weight:bold;">Edit</td>
  <td style="color:#ac0404; font-size:12px;font-weight:bold;">Delete</td>
</tr>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
$i=1;
while($row= mysql_fetch_row($result))
{
$result1 = mysql_query("select * from patient where srno='$row[0]'");
//$result1 = mysql_query("select doc_id,name from new_doc ");
$row1=mysql_fetch_row($result1);
?>

<tr>
   <td width="42"> <?php echo $i++; ?></td>
    <td width="152"> <?php echo $row1[6]; ?></td>
	 <td width="88"><?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>
	  <td width="70"> <?php echo $row[2]; ?></td>
	   <td width="161"> <?php echo $row[3]; ?></td>
	    <td width="245"> <?php echo $row[4]; ?></td>
		 <td width="87"> <?php echo $row[5]; ?></td>
	      <td> <a href='edit_diag.php?id=<?php echo $row[8]; ?>'> Edit </a></td>
           <td> <a href="javascript:confirm_delete1(<?php echo $row[8]; ?>);"> Delete </a></td>
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

/*for($i=1; $i<=$Num_Pages; $i++){
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