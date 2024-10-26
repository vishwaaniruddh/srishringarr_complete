<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select a.opd_real_id,a.diagnosis,a.clinical,a.opddate,a.advise,a.medicines,a.howtotake,a.dosage,b.name,b.srno from opd a,patient b where a.patient_id=b.srno and ";


if(isset($_REQUEST['fname']))
{
$fname=$_REQUEST['fname'];
//$qu =mysql_query("select * from patient where name like('".$fname."%')");
//$ro=mysql_fetch_row($qu);
$query.="b.name like('".$fname."%') ";
}

/*if(isset($_REQUEST['fin']))
{
	
$fin=$_REQUEST['fin'];
$query.="and a.clinical like('".$fin."%')";
}*/
if(isset($_REQUEST['diag'])){
	
$diag=$_REQUEST['diag'];
$query.="and a.diagnosis like('".$diag."%') ";

}

if(isset($_REQUEST['odate']) && $_REQUEST['odate']!="")
{
	
$odate=$_REQUEST['odate'];

$query.="and a.opddate like STR_TO_DATE('".$odate."%','%d/%m/%Y') ";
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

$query.="order by a.opd_id desc LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> 
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<table class="results">
 
       <thead>
          <tr>
         <!-- <td width="55" style="color:#ac0404; font-size:12px; font-weight:bold;">ID</td>-->
          <th >Name</th>
          <th >Date </th>
         <!-- <td style="color:#ac0404; font-size:12px; font-weight:bold;">Findings</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Advised</td>-->
          <!--<td style="color:#ac0404; font-size:12px; font-weight:bold;">Diagnosis</td>-->
          <!--<td style="color:#ac0404; font-size:12px; font-weight:bold;">Medicines</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Procedure</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Dosage</td>-->
          <th >Edit</th>
          <th >Delete</th>
         <!-- <td style="color:#ac0404; font-size:12px; font-weight:bold;">Bill</td>-->
          <th >Details</th>
          <th >History</th>
          </tr>
</thead>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	$result1 = mysql_query("select * from patient where srno='$row[9]'");

$row1=mysql_fetch_row($result1);

	 
?>
<tbody>
	<tr>
   <!-- <td> <?php //echo $row[0]; ?></td>-->
    <td valign="top"> <?php echo $row1[6]; ?></td>
    <td valign="top"> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <!--<td> <?php //echo $row[2]; ?></td>
    <td> <?php //echo $row[4]; ?></td>-->
   
    <!-- <td> <?php //echo $row[5]; ?></td>
    <td> <?php //echo $row[6]; ?></td>
    <td> <?php //echo $row[7]; ?></td>-->
    <td valign="top"> <a href='edit_opd.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
    <td valign="top"> <a href="javascript:confirm_opddelete('<?php echo $row[0]; ?>');"> Delete </a></td>
    <!--<td valign="top"> <a href='opdcollection.php?id=<?php echo $row[0]; ?>'> Bill </a></td>-->
    <td valign="top"> <a href='opddetails.php?id=<?php echo $row[0]; ?>'> Details </a></td>
    <td width="55" align="center" valign="top"><a href="Timeline/opd_his.php?id=<?php echo $row1[3]; ?>&link=opd">History</a> </td>
</tr><?php
			$intRows++;
	?> 

	<?php
			
		}
		echo"";
	?>
    </tbody>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<font size="3">Total Records : <?php echo $Num_Rows;?>  </font>
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