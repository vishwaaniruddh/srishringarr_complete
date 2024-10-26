<?php
include('config.php');
############# must create your db base connection
 
 $strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

	
//$id=$_REQUEST['id'];
//$fname=$_REQUEST['fname'];
if($_REQUEST['diag']!=""){
$query ="select a.srno,a.name,a.city,a.area,a.date,a.reference,b.diagnosis from patient a,opd b where ";	}

else if($_REQUEST['ref']!=""){
	$query ="select a.srno,a.name,a.city,a.area,a.date,a.reference,c.name from patient a,doctor c where ";	}
	
else
$query ="select a.srno,a.name,a.city,a.area,a.date,a.reference from patient a where ";
if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$query.="a.srno like('".$id."%') ";
}
if(isset($_REQUEST['fname']))
{
	
$fname=$_REQUEST['fname'];
$query.="and a.name like('".$fname."%')";
}
if(isset($_REQUEST['city'])){
	
$city=$_REQUEST['city'];
$query.="and a.city like('".$city."%') ";

}
if(isset($_REQUEST['area'])){
	
$area=$_REQUEST['area'];
$query.="and a.area like('".$area."%') ";

}

if(isset($_REQUEST['diag']) && $_REQUEST['diag']!=""){
	
$diag=$_REQUEST['diag'];
$query.="and b.diagnosis like('".$diag."%') and a.no=b.patient_id";

}

if(isset($_REQUEST['ref']) && $_REQUEST['ref']!=""){
	
$ref=$_REQUEST['ref'];
$query.="and c.name like('".$ref."%') and a.reference=c.doc_id";

}

if(isset($_REQUEST['pdate']) && $_REQUEST['pdate']!="")
{
	
$pdate=$_REQUEST['pdate'];
//echo "hi";
$query.="and a.date like STR_TO_DATE('".$pdate."%','%d/%m/%Y') ";
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

<table class="results">
 
       <thead align="left">
          <tr>
          <th>ID</th>
          <th>Full Name </th>
          <th>Start Date </th>
          <th>End Date </th>
          <th>City </th>
          <th>Area </th>
          <!--<th  >Reference Doctor </th>
          <th  >Diagnosis</th>-->
          <th  >Appointment</th>
          <th  >View Full Details</th>
         </tr>
</thead>
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {

while($row= mysql_fetch_row($result))
{
	 
?>
<tbody>
<tr>
    <td ><?php echo $row[0]; ?></td>
	<td ><?php echo $row[1]; ?></td>
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
    <td ><?php echo $row[2]; ?></td>
    <td > <?php echo $row[3]; ?></td>
    
<?php

$result1 = mysql_query("select * from doctor where doc_id='$row[5]'");
$row1=mysql_fetch_row($result1);

if($_REQUEST['diag']==""){
$result2 = mysql_query("select diagnosis from opd where patient_id='$row[0]'");
$row2=mysql_fetch_row($result2);}
?>  
   
    <!--<td > <?php if( $row1[1]==""){echo  $row[5]; } else { echo $row1[1]; } ?></td>
   <td style="word-break:break-all; white-space:normal"> <?php if($_REQUEST['diag']=="") echo $row2[0]; else echo $row[6]; ?></td>-->
    
<td align="left" ><!--<input name="ode1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[0]; ?>'" /> -->
<a href="app.php?id=<?php echo $row[0]; ?>&dt=<?php echo $row[4]; ?>">OPD App</a><!--<br />
<a href="app_surgery.php?id=<?php echo $row[0]; ?>">Surgery App</a>-->
</td>
<!--
<td width="78" align="center"><input name="code4[]" id="code4[]" type="checkbox" value="<?php //echo $row[0]; ?>" onclick="window.location.href='admission.php?id=<?php //echo $row[2]; ?>'" /> </td>-->
<td > <a href="patient_detail.php?id=<?php echo $row[0]; ?>"> Details </a></td>

</tr>  </tbody><?php
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
<?php
############
}
else{
echo "<div class='error'>No Records Found!</div>";
}
 
 
 ################ home end

 ?>
