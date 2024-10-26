<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
$dt=date('Y-m-d');
//echo "select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.status='' and a.reason='' ";
$query="select * from opd_collection where appid in (select app_real_id from appoint where 1 ";
//$query ="select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile,a.status from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.reason='' ";


if(isset($_REQUEST['searchdate']) && $_REQUEST['searchdate']!="")
{
	
$searchdate=$_REQUEST['searchdate'];
//echo "hi";
$query.="and app_date like STR_TO_DATE('".$searchdate."%','%d/%m/%Y') ";
}
else
$query.="and app_date='".$dt."'";


$query.=" ) and status=0 ";

$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page =8;   // Records Per Page
 
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

$query.="  LIMIT $Page_Start , $Per_Page";
//echo $query;

$result = mysql_query($query) or die(mysql_error());

?> 
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<div  style="overflow:scroll;width:910px;">
<table class="results">
 
       <thead>
         <tr>
		<!-- <td width="5" style="color:#ac0404; font-size:12px; font-weight:bold;">Mail</td>-->
		 
          <th>App_Date</th>
          <th>Time</th>
          <th>Patient_Name</th>
          <th>Contact</th>
          <th>New/Old</th>
          <th>Ref.Doctor</th>
          <th>Hospital</th>
          <th>Type</th>
          <th>Amount</th>
          <!--<td width="40" style="color:#ac0404; font-size:12px; font-weight:bold;">Edit</td>
          <td width="51" style="color:#ac0404; font-size:12px; font-weight:bold;">Delete</td>-->
</tr>
</thead>
<?php
$intRows = 0;
$cnt=0;
$amt=0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
while($row= mysql_fetch_row($result))
{
$amt=$amt+$row[2];
//echo "select * from appoint where app_real_id='".$row[1]."'";
$qry2=mysql_query("select * from appoint where app_real_id='".$row[1]."'");
$qrro=mysql_fetch_row($qry2);
$result1 = mysql_query("select * from patient where srno='$qrro[11]'");
$row1=mysql_fetch_row($result1);
$result2=mysql_query("select doc_id,name from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);


$result6=mysql_query("select * from slot where block_id='$row[3]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[4]-1)* 10;
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 
?>

<tbody>
   <tr>
   <!--<td width="5" height="31"> <input type="checkbox" name="mail<?php echo $cnt; ?>" id="mail<?php echo $cnt ?>" value="<?php echo $row[0]; ?>" /></td>-->
   
    <td width="71" height="31"> <?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
    <td width="105" height="31"> <?php echo $apptime; ?></td>
    <td height="31"> <?php echo $row1[6]; ?></td>
    <td height="31"> <?php if($row1[23]=="") { echo $row1[22]; } else { echo $row1[23]; }?></td>
 	<td width="69" height="31"> <?php  if($qrro[10]=="N"){ echo "New";}else if($qrro[10]=="O"){ echo "Old"; }  ?></td>
    <td width="126" height="31"> <?php if (is_numeric($row1[9])) echo $row2[1]; else echo $row1[9]; ?></td>
    <td width="124" height="31"> <?php echo $qrro[18]; ?></td>
    <td width="48" height="31"> <?php if($qrro[9]!='0'){ echo $qrro[9]; } ?></td>
     <td width="51" height="31"> <?php echo $row[2]; ?></td>
    <?php
	if(isset($qrro[2]) and $qrro[2]!='0000-00-00') $ad= date('d/m/Y',strtotime($qrro[2]));
	
	?>
   
   <!-- <td width="40" height="31"> <!--<a href='edit_app.php?id=<?php echo $qrro[0]; ?>' onclick="Makerequest1('<?php echo $qrro[2];  ?>')">-->
	<!--<a href='#' onClick="Editapp('<?php echo date('d/m/Y',strtotime($row[2]));  ?>','<?php echo $row[0] ?>','<?php echo $row[7]; ?>')"> Edit </a></td>
    <td width="51" height="31"> <a href="javascript:confirm_delete3('<?php echo $row[0]; ?>');"> Delete </a></td>-->
    </tr>

<?php
			$intRows++;
			$cnt=$cnt+1;
	?> 

	<?php
	}		
		
	?>
    <tr><td>Total Collection</td><td colspan="8" align="right"><b>Rs. <?php echo $amt.".00"; ?></b></td></tr>
    
    </tbody>
    </table>
    
</div>

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
}
?>

