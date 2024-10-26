<?php
include('config.php');
############# must create your db base connection
 
 $strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
$dt=date("Y-m-d");
	
//$id=$_REQUEST['id'];
//$fname=$_REQUEST['fname'];

$query ="select a.medicines,a.howtotake,a.potency,a.prescmnt,a.days1,a.dosage,a.opddate,a.hospital,b.name,b.srno,b.area,a.opd_real_id from opd a,patient b where a.medicines<>'' and b.srno=a.patient_id and a.app_id in (select app_real_id from appoint where presstat>='4' order by app_date DESC) ";	}


if(isset($_REQUEST['fname']) && $_REQUEST['fname']!='')
{
$name=$_REQUEST['fname'];
$query.=" and b.name LIKE ('%".$name."%')";

}
if(isset($_REQUEST['id']) && $_REQUEST['id']!='')
{
$id=$_REQUEST['id'];
$query.=" and b.srno LIKE ('%".$id."%')";

}
if(isset($_REQUEST['city']) && $_REQUEST['city']!='')
{
$city=$_REQUEST['city'];
$query.=" and b.city LIKE ('%".$city."%')";

}
if(isset($_REQUEST['area']) && $_REQUEST['area']!='')
{
$area=$_REQUEST['area'];
$query.=" and b.area LIKE ('%".$area."%')";

}
if(isset($_REQUEST['pdate']) && $_REQUEST['pdate']!='')
{
$dt=$_REQUEST['pdate'];
//$query.=" and b.srno LIKE ('$".$id."%')";
$query.=" and a.opddate Like STR_TO_DATE('".$dt."%','%d/%m/%Y')";
}
else
$query.=" and a.opddate Like ('".$dt."%')";
//echo $query;
$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page = 6;   // Records Per Page
 
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

$query.=" LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?>


 
       
         

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
?>

<?php
while($row= mysql_fetch_row($result))
{
	 
?>
<div id="<?php echo $row[11]; ?>">
<table class="results">
<tr>
<td width="98">Patient Name :</td>
<td width="141"><b><?php echo $row[8]; ?></b></td>
<td width="49">ID :</td>
<td width="84"><b><?php echo $row[9]; ?></b></td>
<td width="79"><?php echo "Date :".$row[6]; ?></td><td id="td<?php echo $row[11]; ?>"><a href="#" onClick="printDiv('<?php echo $row[11]; ?>');">Print</a></td>
</tr>
<tr>
    <td colspan="5">
    <?php
	$med=explode(",",$row[0]);
$pot=explode(",",$row[2]);
$days=explode(",",$row[4]);
$how=explode(",",$row[1]);
$dos=explode(",",$row[5]);
$cmnt=explode(",",$row[3]);
if(count($med)>0 && $med[0]!=''&& $med[0]!='0')
{
?>
<table border="0" width="100%"><tr><td width="13%"><b>Sr. no.</b></td>
<td width="70%" align="center"><b>Medicine</b></td><td width="13%" align="center"><b>Potency</b></td><td width="20%" align="center"><b>Duration/week</b></td>
<td width="20%" align="center"><b>Repetition</b></td><td width="20%" align="center"><b>Comment</b></td>
</tr><?php  

for($i=0;$i<count($med);$i++)
{
if($med[$i]!='0')
{
?>
<tr><td><?php echo $i+1; ?></td><td><?php echo $med[$i]; ?></td><td><?php echo $pot[$i]; ?></td><td><?php echo $days[$i]; ?> weeks</td>
<td><?php echo $dos[$i]; ?></td><td><?php echo $cmnt[$i]; ?></td>
</tr>
<?php
}
}
 ?></table>

<!--<input type="button" class="" onclick="givemed('<?php echo $opdid; ?>','<?php echo $opdro[3]; ?>');" value="Done" id="medbut" />-->

<?php
}
	?>
    </td>
</tr></table>
</div>

<?php
			$intRows++;
	?> 

	<?php
			
		}
		
	?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

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