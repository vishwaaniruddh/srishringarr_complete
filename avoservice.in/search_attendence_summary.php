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
<table border="1"  style="margin-top:5px; width:60%;" id="custtable" >
<tr>
<th width="2%" style="text-align:center;">SN</th> 
<th width="18%" style="text-align:center;">Eng Name</th> 
<th width="18%" style="text-align:center;">Branch</th> 
<th width="5%" style="text-align:center;">Total Days</th>
<th width="5%"style="text-align:center;">Days Present</th>
<th width="5%" style="text-align:center;">Days Leave</th>
<th width="8%" style="text-align:center;">Days Absent</th>
<th width="8%" style="text-align:center;">No info</th>
<th width="5%" style="text-align:center;">Sunday Present</th>



</tr>
<?php
if($branch=='all'){
 $sql="Select * from `area_engg` where status='1' ";
}else{
	$sql="Select * from `avo_attendence` where branch_id = '".$branch."'  ";
	}

	/*if(isset($_POST['calltype'])){	
		$calltype=$_REQUEST['calltype'];
		if($calltype=='Done')
		{
		$sql.=" and call_status = 'Done'";
		}
	}*/


if(isset($_POST['branches']) && $_POST['branches']!='')
{
$branchserch=$_POST['branches'];
$sql.=" and `area` ='".$branchserch."'";
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and `engg_name` like '".$cid."'";
}

//echo $sql;

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
$sql.=" order by `engg_name` DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$frm=str_replace("/","-",$_POST['fromdt']); //echo $frm;
$to=str_replace("/","-",$_POST['todt']); //echo $to;
 //echo date('d-m-Y ',strtotime($frm)); 
$d1 = new DateTime($frm);
$d2 = new DateTime($to);
$diff=$d1->diff($d2)->days; 
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
	if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];


while($row= mysqli_fetch_row($table))
{	

$sql_P=mysqli_query($con1,"SELECT distinct(attend_date) FROM `avo_attendence` where eng ='".$row[1]."' and branch_id='".$branchserch."' and present='P' and `sunday`='0' and `attend_date` Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')");
$sql_P1=mysqli_num_rows($sql_P);

//echo "SELECT count(sunday) FROM `avo_attendence` where eng ='".$row[1]."' and present='P' and `sunday`='1'";
$sql_S=mysqli_query($con1,"SELECT distinct(attend_date) FROM `avo_attendence` where eng ='".$row[1]."' and branch_id='".$branchserch."' and present='P' and `sunday`='1' and `attend_date` Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')");
$sqlS1=mysqli_num_rows($sql_S);	

$sql_A=mysqli_query($con1,"SELECT count(absent) FROM `avo_attendence` where eng ='".$row[1]."' and branch_id='".$branchserch."' and absent='A' and `attend_date` Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')");	
$sql_A1=mysqli_fetch_row($sql_A);

$sql_L=mysqli_query($con1,"SELECT count(onleave) FROM `avo_attendence` where eng ='".$row[1]."' and branch_id='".$branchserch."' and onleave='L' and `attend_date` Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')");	
$sql_L1=mysqli_fetch_row($sql_L);

?>
<tr>
<!--===SN===-->
<td  valign="top" align="center"><?php echo $sn; ?></td>
<!--===Eng Name===-->
<td  valign="top"><?php echo $row[1] ; ?></td>
<!--===Eng Branch===-->
<td  valign="top" ><?php 
$branc_avo=mysqli_query($con1,"select * from `avo_branch` where `id`='".$row[2]."'");
$branc_avo1=mysqli_fetch_row($branc_avo);
echo $branc_avo1[1];
 ?></td>
<!--===Total Days===-->
<td  valign="top" style="color:blue;" align="center"><?php  echo $diff+1; ?></td>

<!--===present days===-->
<td  valign="top" style="color:blue;" align="center"><?php  echo $sql_P1; ?></td>

<!--===Days leave===-->   
<td  valign="top" style="color:blue;" align="center"><?php  echo $sql_L1[0]; ?></td>
<!--===Days Absent===-->
<td  valign="top" align="center"><?php echo $sql_A1[0]; ?></td>

<!--===No inffo===-->
<td  valign="top" align="center"><?php echo ($diff+1)-$sql_P1-$sql_L1[0]-$sql_A1[0]-$sqlS1;  ?></td>
							 
                       
<!--sunday present--->
<td  valign="top" align="center">  <?php echo $sqlS1; ?> </td>


</tr>
<?php

	$sn++;}}
?>

<!--<tr>
<td colspan="2">Total </td>

<td style="color:red;" align="center"><?php echo $totpr; ?></td>
<td style="color:red;" align="center"><?php echo $totle; ?></td>
<td style="color:red;" align="center"><?php echo $totab; ?></td>

<td></td>
<td></td>
<td></td>
</tr>-->
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