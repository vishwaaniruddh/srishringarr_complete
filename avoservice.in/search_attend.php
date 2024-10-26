<?php
include('config.php');

$strPage = $_REQUEST['Page'];
 $branch = $_POST['br'];
//$branch_new = $_REQUEST['branch'];

$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";


?>
<table border="1"  style="margin-top:5px; width:60%;"  >
<tr>
<th width="2%" style="text-align:center;">SN</th> 
<th width="18%" style="text-align:center;">Eng Name</th> 
<th width="5%" style="text-align:center;">Present</th>
<th width="5%"style="text-align:center;">Leave</th>
<th width="5%" style="text-align:center;">Absent</th>
<th width="8%" style="text-align:center;">Date</th>
<th width="20%" style="text-align:center;">Branch</th>
<th width="5%" style="text-align:center;">Edit</th>



</tr>
<?php
if($branch=='all'){
 $sql.="Select * from `avo_attendence` where 1 ";
}else{
	$sql.="Select * from `avo_attendence` where `branch_id` in(".$branch.")  ";
	}

	/*if(isset($_POST['calltype'])){	
		$calltype=$_REQUEST['calltype'];
		if($calltype=='Done')
		{
		$sql.=" and call_status = 'Done'";
		}
	}*/

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
$sql.=" and `attend_date` Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')";
}

if(isset($_POST['branches']) && $_POST['branches']!='')
{
$branchserch=$_POST['branches'];
$sql.=" and `branch_id` in(".$branchserch.")";
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and eng like '".$cid."'";
}
$sql.=" group by attend_date,eng,branch_id";
//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
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

//echo $sql;
$qr22=$sql;
$sql.=" order by `attend_date` DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))
{		
?>
<tr>
<!--===SN===-->
<td  valign="top" align="center">&nbsp;<?php echo $sn; ?></td>
<!--===Eng Name===-->
<td  valign="top" >&nbsp;<?php echo $row[1] ; ?></td>

<!--===Present===-->
<td  valign="top" style="color:blue;" align="center">&nbsp;<?php  echo $row[2]; $totpr+=$row[2]=='P'; ?></td>

<!--===Leave===-->
<td  valign="top" style="color:blue;" align="center">&nbsp;<?php  echo $row[3]; $totle+=$row[3]=='L'; ?></td>

<!--===Absent===-->   
<td  valign="top" style="color:blue;" align="center">&nbsp;<?php  echo $row[4]; $totab+=$row[4]=='A'; ?></td>
<!--===Date===-->
<td  valign="top" align="center">&nbsp;<?php echo date('d-m-Y ',strtotime($row[5])); ?></td>

<!--===Branch===-->
<td  valign="top" align="center">&nbsp;<?php  
							if($row[6]=='all') {
							echo "Masteradmin";
							}else{
							  
								//echo "select state from state where state_id='$br_row[$i]'";
								$state=mysqli_query($con1,"select name from `avo_branch` where `id`='".$row[6]."'");
								while($state1=mysqli_fetch_row($state)){
								echo   $state1[0];
							  
							 }
							} ?>
                       </td>
<!--Edit--->

 <?php if($branch=='all') { ?>
	<td  valign="top" align="center"> <a href="edit_attend.php?enid=<?php echo $row[0]; ?>"> Edit </a> </td>
 <?php }?>

</tr>
<?php

	$sn++;}
?>

<tr>
<td colspan="2">Total </td>

<td style="color:red;" align="center"><?php echo $totpr; ?></td>
<td style="color:red;" align="center"><?php echo $totle; ?></td>
<td style="color:red;" align="center"><?php echo $totab; ?></td>

<td></td>
<td></td>
<td></td>
</tr>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
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
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<!--<input type="submit" name="cmdsub" value="Export" >-->
</form>
 
<div id="bg" class="popup_bg"> </div> 