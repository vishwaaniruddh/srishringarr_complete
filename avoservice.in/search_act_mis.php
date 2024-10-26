<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
$branch=$_SESSION['branch'];
include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	

?>
<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="custtable" name="custtable" >
<tr>
<th width="2%">SN</th> 
<th width="10%">Eng Name</th>
<th width="8%">Branch</th>

<th width="10%">Name of Activity</th>
<th width="10%">Customer Name</th>
<th width="10%">Location</th>
<th width="5%">Date</th>
<th width="7%">From Time</th>
<th width="7%">To Time</th>
<th width="20%">Remarks</th>


</tr>
<?php
$branch=$_POST['branch_avo'];

$sql="select * from eng_mis where 1";

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='') {

$sql.=" and branch_id='".$branch."'";
}
//$sql.="Select * from `eng_mis` where branch_id = '$branch'  ";


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
$sql.=" and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

}

if(isset($_POST['engg']) && $_POST['engg']!='')
{
$eid=$_POST['engg'];
$sql.=" and eng_id ='".$eid."'";
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
$sql.=" order by `id` DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))
{

	include("config.php");
	
		?>
<tr>
<!--===SN===-->
<td  valign="top" width="200">&nbsp;<?php echo $sn; ?></td>
<!--===Eng Name===-->
<td  valign="top">&nbsp;<?php 
$eng=mysqli_query($con1,"select `engg_name` from `area_engg` where `engg_id`='".$row[2]."'");
$eng1=mysqli_fetch_row($eng);
echo $eng1[0] ; ?></td>

<td  valign="top">&nbsp;<?php 
$branch=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[10]."'");
$br1=mysqli_fetch_row($branch);
echo $br1[0] ; ?></td>

<!--===Name of Activity===-->
<td  valign="top">&nbsp;<?php 
$name_act=mysqli_query($con1,"select name from activity where id='".$row[4]."'");
$name_act1=mysqli_fetch_row($name_act);
echo $name_act1[0];
?></td>
<!--===Customer Name===-->
<td  valign="top">&nbsp;<?php echo $row[5]; ?></td>

<!--===Location===-->   
<td  valign="top">&nbsp;<?php echo $row[6]; ?></td>
<!--===Date===-->
<td  valign="top">&nbsp;<?php echo date('d-m-Y ',strtotime($row[1])); ?></td>
<!--===From Time===-->
<td  valign="top">&nbsp;<?php echo  date('h:i:s.a',strtotime($row[7]));?></td>
<!--===To Time===-->
<td valign="top">&nbsp;<?php  echo date('h:i:s.a',strtotime($row[8])); ?></td>
<td  valign="top">&nbsp;<?php echo $row[9]; ?></td>


</tr>
<?php

	$sn++;}
?>
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