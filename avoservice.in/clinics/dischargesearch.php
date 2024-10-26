<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select a.dis_real_id,a.final_diagnosis,a.operation_notes,a.treatment_advised,b.name,b.srno,a.ad_id from discharge_summary a,patient b where a.p_id=b.srno and ";

if(isset($_REQUEST['fname']))
{
	
$fname=$_REQUEST['fname'];

$query.="b.name like('".$fname."%') ";
}

if(isset($_REQUEST['diag']))
{
$diag=$_REQUEST['diag'];
//$qu =mysql_query("select * from patient where name like('".$fname."%')");
//$ro=mysql_fetch_row($qu);
$query.="and a.final_diagnosis like('".$diag."%') ";
}

if(isset($_REQUEST['tre']))
{
	
$tre=$_REQUEST['tre'];
$query.="and a.treatment_advised like('".$tre."%')";
}

if(isset($_REQUEST['op']))
{
	
$op=$_REQUEST['op'];
$query.="and a.operation like('".$op."%')";
}

//echo $query;
$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page = 10;   // Records Per Page
 
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

$query.="order by a.dis_id desc LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> 

<table class="results">
 
       
          <tr>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Name</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Discharge Date</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Final Diagnosis </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Operation Notes</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Treatment </td>
          <td style="color:#ac0404; font-size:12px;font-weight:bold;">Edit</td>
          <td style="color:#ac0404; font-size:12px;font-weight:bold;">Delete</td>
          </tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
$result1 = mysql_query("select * from patient where srno='$row[5]'");
$row1=mysql_fetch_row($result1);

$result2 = mysql_query("select * from admission where ad_real_id='$row[6]'");
$row2=mysql_fetch_row($result2);
	 
?>

	<tr>
    <td valign="top"> <?php echo $row1[6]; ?></td>
    <td valign="top"> <?php if(isset($row2[3]) and $row2[3]!='0000-00-00') echo date('d/m/Y',strtotime($row2[3])); ?></td>
    <td valign="top"> <?php echo $row[1]; ?></td>
    <td valign="top"> <?php echo $row[2]; ?></td>
    <td valign="top"> <?php echo $row[3]; ?></td>
    <!--<td> <a href='edit_discharge.php?id=<?php echo $row[0]; ?>'> Edit </a></td>-->
	<td valign="top"> <a href='discharge_report.php?id=<?php echo $row[0]; ?>'> Case Summery </a></td>
    <td valign="top"> <a href="javascript:confirm_deletedis('<?php echo $row[0]; ?>');"> Delete </a></td>
    </tr>
	<?php
			$intRows++;
	?> 

	<?php
		}
		echo"</table>";	
	?>	
	

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<font size="3"><br />Total Records : <?php echo $Num_Rows;?>  </font>
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