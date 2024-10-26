<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select a.no,a.new_old,a.hospital,a.app_date,a.slot,a.type,a.block_id,b.name,b.srno from appoint a,patient b where a.no=b.srno and ";

if(isset($_REQUEST['hos']))
{
	
$hos=$_REQUEST['hos'];

$query.="a.hospital like('".$hos."%') ";
}

if(isset($_REQUEST['adate']) && $_REQUEST['adate']!="")
{
$adate=$_REQUEST['adate'];
//$qu =mysql_query("select * from patient where name like('".$fname."%')");
//$ro=mysql_fetch_row($qu);
$query.="and a.app_date like STR_TO_DATE('".$adate."%','%d/%m/%Y')";
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

$query.="order by a.no desc LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> 
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<style>

</style>
<table width="950" class="results">
 
 <thead      
          <tr>
          <th width="56" >Sr. No</th>
          <th width="57" >Time</th>
          <th width="60" >App_Date</th>
          <th width="71" >Name / Age</th>
          <th width="87" >Contact/ Email</th>
          <th width="84" >Ref.Doctor</th>
          <th width="77" >Speciality</th>
          <th width="94" >Dr.Contact No.</th>
          <th width="110" >Appointment Type</th>
          <th width="88" >Diagnosis</th>
          <th width="59" >F/u Plan</th>
          <th width="60" >Category</th>
          </tr>
</thead>
<?php
$intRows = 0;
$i=1;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
$result1 = mysql_query("select * from patient where srno='$row[0]'");
$row1=mysql_fetch_row($result1);

$result2=mysql_query("select doc_id,name,special,mobile from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);

$result3=mysql_query("select diagnosis from opd where patient_id='$row1[2]'");
$row3=mysql_fetch_row($result3);

$result6=mysql_query("select * from slot where block_id='$row[6]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[4]-1)* 10;
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	

$result4 = mysql_query("select lower(email) from patient where srno='$row[0]'");
$row4=mysql_fetch_row($result4); 
?>
<tbody>
	<tr>
    <td> <?php echo $i++ ; ?></td>
    <td> <?php echo $apptime; ?></td>
    <td> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td>
    <td> <?php echo $row1[6]." / ".$row1[26]; ?></td>
    <td style="text-transform:lowercase;"> <?php echo $row1[23]."/ ".$row4[0]; ?></td>
 	<td> <?php echo $row2[1]; ?></td>
    <td> <?php echo $row2[2]; ?></td>
    <td> <?php echo $row2[3]; ?></td>
    <td> <?php echo $row[2]; ?></td>
    <td style="word-break:break-all; white-space:normal"> <?php echo $row3[0]; ?></td>
    <td></td>
    <td></td>
   
</tr>
</tbody>
<?php
			$intRows++;
	?> 

	<?php
			
		 }
		
	?>
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