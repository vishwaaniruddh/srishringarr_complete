<?php
session_start();
include('config.php');
############# must create your db base connection
 
 $strPage = $_REQUEST['Page'];
// echo $_REQUEST['mode'];
if($_REQUEST['mode']=="Listing"){
$query ="select  a.srno,a.name,a.city,a.area,a.date,a.reference,a.sex,a.mobile from patient a where 1 ";
if(isset($_REQUEST['id']) && ($_REQUEST['id']!=''))
{
	
$id=$_REQUEST['id'];

$query.="and a.srno like('%".$id."%') ";
}
if(isset($_REQUEST['fname']) && ($_REQUEST['fname']!=''))
{
	
$fname=$_REQUEST['fname'];
$query.="and a.name like('%".$fname."%')";
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

$query.=" order by no DESC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?>
<style>


</style>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<h1>Number of Records: <?php echo $Num_Rows; ?></h1>
<table class="results">
 
       <thead align="left">
	  <tr>
		  <th>ID</th>
		  <th>Full Name </th>
		  <th>Phone </th>
		  <th>Start Date </th>
		  <th>End Date </th>
		  <th>Pending Refrence</th>
		  <th>Paid Reference</th>
         </tr>
</thead>
<?php
$intRows = 0;
$i=1;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {

while($row= mysql_fetch_row($result))
{
	 
?>
<tbody>
<tr>
    <td ><?php echo $row[0]; ?></td>
	<td ><?php echo $row[1]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td ><?php 
	//echo "select * from patient_package where patientid='$row[0]' and status=0 order by id DESC limit 1";
	$dt=mysql_query("select * from patient_package where patientid='$row[0]' and status=0 order by id DESC limit 1");
	if(mysql_num_rows($dt)>0)
	{
	$dtro=mysql_fetch_row($dt);
	echo date('d/m/Y',strtotime($dtro[3]))."</td><td>";
	if(date('Y',strtotime($dtro[4]))>='1990')
	echo date('d/m/Y',strtotime($dtro[4]))."";
	}
	else
	{
	if(isset($row[4]) and $row[4]!='0000-00-00') echo date('d/m/Y',strtotime($row[4]))."</td><td>".date('d/m/Y',strtotime($row[4]))."";
     }
	 ?></td>
<td>
<?php
	$pat_qry=mysql_query("select count(*) from patient where REFERENCE='".$row[0]."' and REFERENCE1 is null");
	$pat_cnt=mysql_fetch_row($pat_qry);
if($pat_cnt[0]>0)
{
?>
<a href="get_pat_ref_details.php?id=<?php echo $row[0]; ?>&type=u" target="_blank"><?php echo "Total: ".$pat_cnt[0];?></a> 
<?php
}
else
echo "0";
?>
</td>
<td>
<?php
	$pat_qry1=mysql_query("select count(*) from patient where REFERENCE='".$row[0]."' and REFERENCE1='Y'");
	$pat_cnt1=mysql_fetch_row($pat_qry1);
if($pat_cnt1[0]>0)
{
?>
<a href="get_pat_ref_details.php?id=<?php echo $row[0]; ?>&type=p" target="_blank"><?php echo "Total: ".$pat_cnt1[0];?></a> 
<?php
}
else
echo "0";
?>
</td>
<?php
if($pat_cnt[0]>0)
{
?>
<td>
	<div id="showrem<?php echo $i; ?>1" style="display:block">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" class="submit formbutton" value="Extend" />
	</div>
	<div id="showrem<?php echo $i; ?>" style="display:none">	
		<select id="num<?php echo $i; ?>">
			<option value="">Number</option>
			<?php
				for($k=1;$k<13;$k++)
				{
			?>
			<option value="<?php echo $k; ?>"><?php echo $k; ?></option>
			<?php
				}
			?>
		</select>
		<select id="add_type<?php echo $i; ?>">
			<option value="">Add Type</option>
			<option value="month">Month</option>
			<option value="year">Year</option>
		</select>
		<input type="button" onClick="add_date('<?php echo $i; ?>','<?php echo $row[0]; ?>')" class="submit formbutton" value="Update">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" class="submit formbutton" value="Cancel" />
	</div>
</td>
<?php
}
?>
</tr>  </tbody><?php
			$i++;
			$intRows++;	
		}
		
	?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
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