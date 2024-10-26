<?php
session_start();
include('getcenter.php');
include('config.php');
############# must create your db base connection
 
 $strPage = $_REQUEST['Page'];
// echo $_REQUEST['mode'];
if($_REQUEST['mode']=="Listing"){

	
//$id=$_REQUEST['id'];
//$fname=$_REQUEST['fname'];
if(isset($_REQUEST['diag']) && $_REQUEST['diag']!=""){
$query ="select a.srno,a.name,a.city,a.area,a.date,a.reference,b.diagnosis,a.mobile from patient a,opd b where 1 ";	}

else if($_REQUEST['ref']!=""){
	$query ="select a.srno,a.name,a.city,a.area,a.date,a.reference,c.name,a.mobile from patient a,doctor c where 1 ";	}
	
else
$query ="select a.srno,a.name,a.city,a.area,a.date,a.reference,a.sex,a.mobile from patient a where 1 ";
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
if(isset($_REQUEST['city']) &&($_REQUEST['city']!='') ){
	
$city=$_REQUEST['city'];
$query.="and a.city like('%".$city."%') ";

}
//echo $query;
//echo $_SESSION['ip'];

 $center=getcenter($_SESSION['ip']);
//if(isset($_REQUEST['area']) && ($_REQUEST['area']!='')){
if($center!='Both' && $center!='')
{
	
	$query.="and a.area like('%".$center."%') ";
}
	else
	{
	
	if(isset($_REQUEST['area']) && ($_REQUEST['area']!='')){
$area=$_REQUEST['area'];
$query.="and a.area like('".$area."%') ";
}
}
//}

if(isset($_REQUEST['diag']) && $_REQUEST['diag']!=""){
	
$diag=$_REQUEST['diag'];
$query.="and b.diagnosis like('%".$diag."%') and a.no=b.patient_id ";

}
if(isset($_REQUEST['mob']) && $_REQUEST['mob']!=""){
	
$mob=$_REQUEST['mob'];
$query.="and (a.mobile like('%".$mob."%') or a.mobile2 like ('%".$mob."%') or a.telno like ('%".$mob."%') ) ";

}
if(isset($_REQUEST['ref']) && $_REQUEST['ref']!=""){
	
$ref=$_REQUEST['ref'];
$query.="and c.name like('%".$ref."%') and a.reference=c.doc_id ";

}
if(isset($_REQUEST['pattype']) && $_REQUEST['pattype']!=""){
	
$pattype=$_REQUEST['pattype'];
$query.="and a.TYPE='".$pattype."'";

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
<h1>Number of Records: <?php echo $Num_Rows; ?></h1>
<table class="results">
 
       <thead align="left">
          <tr>
          <th>ID</th>
          <th>Full Name </th>
          <th>Phone </th>
          <th>Start Date </th>
          <th>End Date </th>
          <th>City </th>
          <th>Area </th>
          <!--<th  >Reference Doctor </th>
          <th  >Diagnosis</th>-->
          <th  >Balance</th>
          <th  >Appointment</th>
          <th>Update</th>               
          <th  >View Full Details</th>
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
    <td width="78" align="center"><?php
	//echo "select sum(amt) from opd_collection where patientid='".$row[0]."'";
	$pac=mysql_query("select sum(amt) from patient_package where patientid='".$row[0]."' and status='0'");
$pacro=mysql_fetch_row($pac);
$qr=mysql_query("select sum(amt) from opd_collection where patientid='".$row[0]."'");
$ro=mysql_fetch_row($qr);
$bal=$pacro[0]-$ro[0];
echo ($pacro[0]-$ro[0]);
?> </td>
<td align="left" ><!--<input name="ode1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[0]; ?>'" /> -->
<a href="app.php?id=<?php echo $row[0]; ?>&dt=<?php echo $row[4]; ?>">OPD app</a><!--<br />
<a href="app_surgery.php?id=<?php echo $row[0]; ?>">Surgery App</a>-->
</td>
<td>
	<div id="showrem<?php echo $i; ?>1" style="display:block">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" value="Update" />
	</div>
	<div id="showrem<?php echo $i; ?>" style="display:none">	
		<textarea id="rem<?php echo $i; ?>" cols="20"></textarea>
		<input type="button" onClick="add_update('<?php echo $i; ?>','<?php echo $row[0]; ?>')" value="Update">
		<input type="button" onclick="showrem('showrem<?php echo $i; ?>','<?php echo $i; ?>')" value="Cancel" />
	</div>
</td>
   
   <?php 
  //echo "select max(id) from patient_package where patientid='$row[0]' and status=0 ";
  $packrow=mysql_query("select max(id) from patient_package where patientid='$row[0]' and status=0 ");
  $packroid=mysql_fetch_row($packrow);
  //echo $packroid[0];
   ?>
  

<td > <a href="patient_detail.php?id=<?php echo $row[0]; ?>&packidme=<?php echo $packroid[0]; ?>"> Details

<?php if($pacro[0]-$ro[0]>0){ ?>
 / 
 
 
 
 
<a href="#" onClick="window.open('opdpayment.php?amt=<?php echo $bal; ?>&pid=<?php echo $row[0]; ?>&packidme=<?php echo $packroid[0]; ?>','opdpay','width=600,height=300,left=200,top=100')" style="text-decoration:none; color:#099">Make Payment</a>
<?php } ?>

</td>

</tr>  </tbody><?php
			$i++;
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