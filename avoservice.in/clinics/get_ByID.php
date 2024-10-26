<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

$query ="select a.wait_real_id,a.no,a.app_date,a.time,a.type,a.hospital,b.srno,b.name,a.block_id,a.slot from opdwait a,patient b where a.no=b.srno and ";

if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$query.="b.srno like('".$id."%') ";
}
if(isset($_REQUEST['fname']))
{
	
$fname=$_REQUEST['fname'];
$query.="and b.name like('".$fname."%')";
}
if(isset($_REQUEST['adate']) && $_REQUEST['adate']!="")
{
	
$adate=$_REQUEST['adate'];
//echo "hi";
$query.="and a.app_date like STR_TO_DATE('".$adate."%','%d/%m/%Y')";
}
if(isset($_REQUEST['hos'])){
	
$hos=$_REQUEST['hos'];
$query.="and a.hospital like('".$hos."%') ";

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

$query.=" order by b.no ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> 

<table class="results">
 <thead>
 <tr>
 <th>ID</th>
 <th> Patient Name</th>
 <th>App_Date </th>
 <th>Timing </th>
 <th>Type </th>
 <th>Hospital </th>
 <th>Confirmed</th>
 <th>History</th>
 <th>Delete</th>
 </tr>
 </thead>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	 
$result2=mysql_query("select * from patient where srno='$row[1]'");
$row2=mysql_fetch_row($result2);

$result6=mysql_query("select * from slot where block_id='$row[8]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[9]-1)* 10;
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	
?>

<tbody>
	<tr>
    
    <td><?php echo $row2[3]; ?> </td>
	<td width="191"><?php echo $row2[6]; ?></td>
	<td width="80"><?php if(isset($row[2]) and $row[2]!="0000-00-00") echo date("d/m/Y",strtotime($row[2])); ?></td>
    <td width="52"><?php echo $apptime; ?></td>
    <td width="64"><?php echo $row[4]; ?></td>
	<td width="235"><?php echo $row[5]; ?></td>
	<td width="74" align="center"><a href="confirm_pat.php?id=<?php echo $row[0]; ?>" target="_self" />CONFIRM</A> </td>
    <td width="55" align="center"><a href="Timeline/opd_his.php?id=<?php echo $row[1]; ?>&link=detail1" >History</a> </td>
    <td height="27"> <a href="javascript:confirm_deleterecord('<?php echo $row[0]; ?>');"> Delete </a></td>
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