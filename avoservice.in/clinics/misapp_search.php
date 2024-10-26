<?php
include('config.php');
############# must create your db base connection
 
 $strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){

	
//$id=$_REQUEST['id'];
//$fname=$_REQUEST['fname'];
$query ="select a.srno,a.name,b.rem,b.entrdt,b.app_id from patient a,misapp_rem b where b.srno=a.srno ";
/*
if(isset($_REQUEST['pdate']) && $_REQUEST['pdate']!="" && isset($_REQUEST['todate']) && $_REQUEST['todate']!="" )
{
	
$pdate=$_REQUEST['pdate'];
$todate=$_REQUEST['todate']; 
//echo "hi";
$query.="and b.expdt between STR_TO_DATE('".$pdate."%','%d/%m/%Y') and STR_TO_DATE('".$todate."%','%d/%m/%Y') ";
//echo $query;
}
else
{
$date=date("Y-m-d");
$dt=date("Y-m-d",strtotime($date,'+15 days'));
$query.="and b.expdt between '".date('Y-m-d')."' and '".$dt."' ";
}*/
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

}
if(isset($_REQUEST['area']) && ($_REQUEST['area']!='')){
	
$area=$_REQUEST['area'];
$query.="and a.area like('%".$area."%') ";

}
if(isset($_REQUEST['mob']) && $_REQUEST['mob']!=""){
	
$mob=$_REQUEST['mob'];
$query.="and (a.mobile like('%".$mob."%') or a.mobile2 like ('%".$mob."%') or a.telno like ('%".$mob."%') ) ";

}*/
//echo $query;
$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page = 20;   // Records Per Page
 
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

$query.=" order by b.app_id,b.entrdt DESC LIMIT $Page_Start , $Per_Page";
//echo $query;
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
          <th>Appointment Date</th>
         <th>Update</th>
         <th>Date</th>
        
          </tr>
</thead>
<?php
$intRows = 0;
$i=1;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {

while($row= mysql_fetch_array($result))
{
	 $app_qry=mysql_query("SELECT * FROM `appoint` WHERE `app_id` = '".$row['app_id']."'");
	 $app_row=mysql_fetch_array($app_qry);
?>
<tbody>
<tr>
    <td ><?php echo $row[0]; ?></td>
	<td ><?php echo $row[1]; ?></td>
	<td ><?php echo date('d/m/Y',strtotime($app_row['app_date'])); ?></td>
	<td ><?php echo $row[2]; ?></td>
	<td ><?php echo date('d/m/Y h:i:s A',strtotime($row[3])); ?></td>

</tr>  </tbody><?php
			$intRows++;
			$i++;			
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