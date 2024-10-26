<?php
include('config.php');
############# must create your db base connection
 
 $strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

	$date=date("Y-m-d",strtotime($date,'-1 day'));
//$id=$_REQUEST['id'];
//$fname=$_REQUEST['fname'];

$query ="select a.srno,a.name,a.city,a.area,a.date,a.reference from patient a,patient_package b where 1 ";	

if(isset($_REQUEST['pdate']) && $_REQUEST['pdate']!="" && isset($_REQUEST['todate']) && $_REQUEST['todate']!="" )
{
	
$pdate=$_REQUEST['pdate'];
$todate=$_REQUEST['todate']; 
//echo "hi";
$query.="and b.expdt between STR_TO_DATE('".$pdate."%','%d/%m/%Y') and  STR_TO_DATE('".$todate."%','%d/%m/%Y') ";

}
else
{

$dt=date("Y-m-d",strtotime($date,'-1 month'));
$query.="and b.expdt between '".$date."' and '".$dt."' ";
}
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
/*if(isset($_REQUEST['city']) &&($_REQUEST['city']!='') ){
	
$city=$_REQUEST['city'];
$query.="and a.city like('%".$city."%') ";

}*/
if(isset($_REQUEST['area']) && ($_REQUEST['area']!='')){
	
$area=$_REQUEST['area'];
$query.="and a.area like('%".$area."%') ";

}
if(isset($_REQUEST['mob']) && $_REQUEST['mob']!=""){
	
$mob=$_REQUEST['mob'];
$query.="and (a.mobile like('%".$mob."%') or a.mobile2 like ('%".$mob."%') or a.telno like ('%".$mob."%') ) ";

}
$query.="and b.patientid=a.srno and status='0' ";

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
$dcbqry=$query." and b.expdt<'".date('Y-m-d')."' order by b.expdt DESC";
$query.=" and b.expdt<'".date('Y-m-d')."' order by b.expdt DESC LIMIT $Page_Start , $Per_Page";
//echo $query;
$result = mysql_query($query) or die(mysql_error());

?>
<style>


</style>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<input type="hidden" id="dcbqry" value="<?php echo $dcbqry; ?>"/>
<table class="results">
 
       <thead align="left">
          <tr>
          <th>ID</th>
          <th>Full Name </th>
          <th>Start Date </th>
          <th>End Date </th>
          <th>City </th>
          <th>Area </th>
          <th>Balance</th>
         <th>Renew </th>
           <!--<th  >Diagnosis</th>-->
        
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
    
<td width="78" align="center"><?php
	//echo "select sum(amt) from opd_collection where patientid='".$row[0]."'";
	$pac=mysql_query("select sum(amt) from patient_package where patientid='".$row[0]."' and status='0'");
$pacro=mysql_fetch_row($pac);
$qr=mysql_query("select sum(amt) from opd_collection where patientid='".$row[0]."'");
$ro=mysql_fetch_row($qr);
echo ($pacro[0]-$ro[0]);
?> </td>
<td><a href="newrenew.php?id=<?php echo $row[0]; ?>">Renew</a></td>

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