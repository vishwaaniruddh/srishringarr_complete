<?php
include("access.php");
$count=0;
include("config.php");
$strPage = $_REQUEST['Page'];

$design= $_POST['acc'];


$sql="Select * from branch_head where 1";

if(isset($_POST['acc']) && $_POST['acc']=='0')
{
$sql.=" and status=0 and loginid in(select srno from login where status='0')";

} else {
$sql.=" and status=1 and loginid in(select srno from login where designation ='".$_POST['acc']."')";

}
if(isset($_POST['name']) && $_POST['name']!='')
{
$sql.=" and head_name like '%".$_POST['name']."%'";

}
if(isset($_POST['email']) && $_POST['email']!='')
{
$sql.=" and email_id like '%".$_POST['email']."%'";
}
if(isset($_POST['number']) && $_POST['number']!='')
{
	$sql.=" and (phone_no1 like '%".$_POST['number']."%' or phone_no2 like '%".$_POST['number']."%')";
}

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
$sql.=" order by loginid DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
if(mysqli_num_rows($table)>0)
{
?>
<table width="770" border="0" cellpadding="1" cellspacing="0" class="res" id="custtable">
<tr><th width="128">Name</th>
<th width="98">UserId</th>
<th width="88">Password</th>
<th width="80">Branch</th>
<th width="120">Type of Login</th>
<th width="85">Contact</th>

<? if ($design !=0) { ?>
<th width="100">Add Branch</th>
<th width="70">Edit</th>
<th width="70">Delete</th></tr>
<? } else{ ?>
<th width="70">Activate</th></tr>


<?php }


while($row=mysqli_fetch_row($table))
{
$state=array();
//echo "select * from branch_details where branchid='".$row[1]."'";

$qry2=mysqli_query($con1,"select * from branch_details where branchid='".$row[1]."'");
$row3=mysqli_fetch_row($qry2);

//echo "select * from login where srno='".$row[6]."' and designation='".$_POST['acc']."'";
if ($design !=0)
$qry4=mysqli_query($con1,"select * from login where srno='".$row[6]."' and designation='".$_POST['acc']."'");
else 
$qry4=mysqli_query($con1,"select * from login where srno='".$row[6]."' and status=0");


if(mysqli_num_rows($qry4)>0)
{
$row4=mysqli_fetch_row($qry4);

if ($row4[4]==2) $type="Help Desk";
if ($row4[4]==3) $type="Branch Id";
if ($row4[4]==5) $type="Account Manager";
if ($row4[4]==6) $type="Client ID";
if ($row4[4]==7) $type="Accounts ID";

$qry=mysqli_query($con1,"select name,id from avo_branch where id = '".$row4[3]."'");
$row2=mysqli_fetch_row($qry)


//$count=$count+1;

?>

<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row[2]; ?></td>
<td><?php echo $row4[1]; ?></td>
<td><?php echo $row4[2]; ?></td>
<td ><?php echo $row2[0]; ?></td>
<td ><?php echo $type; ?></td>
<td ><?php echo $row[4]; ?></td>

<? if ($design !=0) { ?>

<td width="46" class="update" height="3
1"> <a href='addbranch.php?id=<?php echo $row[0]; ?>&hid=<?php echo $row[6];  ?>'> Add Branch </a></td>
<td width="46" class="update" height="31"> <a href='edit_cityhead.php?id=<?php echo $row[0]; ?>&lid=<?php echo $row4[0]; ?>'> Edit </a></td>
<td width="56" height="31" class="update">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);"> Delete </a></td>
<? } else { ?>

<td width="56" height="31" class="update">  <a href="javascript:confirm_activate(<?php echo $row[0]; ?>);"> Activate </a></td>
<? } ?>
</tr>
<?php } 
}
?>
<tr><td colspan="9" align="center">
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