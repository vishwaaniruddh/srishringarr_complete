<?php
include("access.php");
$count=0;
include("config.php");

$strPage = $_REQUEST['Page'];
$sql="Select * from `login` where status=1 and `designation`='3'";

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$sql.=" and branch ='".$_POST['branch']."'";

}
if(isset($_POST['name']) && $_POST['name']!='')
{
$sql.=" and `username` like '%".$_POST['name']."%'";

}
if(isset($_POST['email']) && $_POST['email']!='')
{
$sql.=" and email_id like '%".$_POST['email']."%'";
}
if(isset($_POST['number']) && $_POST['number']!='')
{
	$sql.=" and (phone_no1 like '%".$_POST['number']."%' or phone_no2 like '%".$_POST['number']."%')";
}
/*if(isset($_POST['state']) && $_POST['state']!='')
{
	$sql.=" and loginid in (select srno from login where branch like '%,".$_POST['state'].",%' or branch like '%,".$_POST['state']."%' or branch like '%".$_POST['state'].",%' or branch like '%".$_POST['state']."%')";
}*/
//echo $sql;
$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
?>
 <div align="center">Total Number Of Records :>> <?php echo $Num_Rows; ?>
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
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins

$Per_Page =$_POST['perpg'];;   // Records Per Page
 
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
$sql.=" order by `branch` DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
if(mysqli_num_rows($table)>0)
{
?>
<table width="613" border="0" cellpadding="1" cellspacing="0" class="res" id="custtable">
<tr>
<th width="10">SN.</th>
<th width="100">UserId</th>
</tr>
<?php
$srn=1;
while($row=mysqli_fetch_row($table))
{
?>

<tr>
<td><?php echo $srn ; ?></td>
<td><?php echo $row[1]; ?></td>
<tr>
<?php 
$srn++; 
}
?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


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
?></font></div></td></tr></table>
<?php
}
?>