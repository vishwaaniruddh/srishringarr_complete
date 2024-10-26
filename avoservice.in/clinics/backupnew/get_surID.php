<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

$query ="select a.s_real_id,a.no,a.sur_date,a.doctor,a.doctor1,a.anaesth,a.anatype,a.net,b.srno,b.name from surgery1 a,patient b where a.no=b.srno ";

if(isset($_REQUEST['name']))
{
	
$name=$_REQUEST['name'];
$query.=" and b.name like('".$name."%') ";
}

if(isset($_REQUEST['type']))
{
$type=$_REQUEST['type'];
$query.=" and a.anatype like('".$type."%') ";
}

if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!="")
{
	
$sdate=$_REQUEST['sdate'];
$query.="and a.sur_date=STR_TO_DATE('".$sdate."','%d/%m/%Y')";
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

$query.=" order by a.s_id ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> <table class="results">
 
       
          <tr>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Patient Name</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Anaesthetist</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Type </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Surgery Date </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Surgeon 1 </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Surgeon 2 </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Total Fees</td>
          <td style="color:#ac0404; font-size:12px;font-weight:bold;">Edit</td>
          <td style="color:#ac0404; font-size:12px;font-weight:bold;">Delete</td>
         </tr>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
$result1=mysql_query("select name from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);

$sql="select doc_id,name from doctor where doc_id='$row[5]'";
$result2=mysql_query($sql);
$row2=mysql_fetch_row($result2);

$sql1="select doc_id,name from doctor where doc_id='$row[3]'";
$result3=mysql_query($sql1);
$row3=mysql_fetch_row($result3);

$sql2="select doc_id,name from doctor where doc_id='$row[4]'";
$result4=mysql_query($sql2);
$row4=mysql_fetch_row($result4); 
?>
<tr>
    <td><?php echo $row1[0]; ?></td>
	<td><?php echo $row2[1]; ?></td>
    <td>
	<?php if($row[6]=="LA") { echo "Local Anaesthetist"; } else if($row[6]=="GA") { echo "General Anaesthetist"; } else if($row[6]=="SA") { echo "Spinal Anaesthetist"; }?>
    </td>
    <td> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td><?php echo $row3[1]; ?></td>
    <td><?php echo $row4[1]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><a href='edit_surgery.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td><a href="javascript:Ddelete('<?php echo $row[0]; ?>');"> Delete </a></td>
    </tr>

<?php
			$intRows++;
	?> 

	<?php
	}
		echo"</table>";		
		
	?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
Total <?php echo $Num_Rows;?> Record : 
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