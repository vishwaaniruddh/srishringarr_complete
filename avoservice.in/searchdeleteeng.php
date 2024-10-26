<?php
include("access.php");
$strPage = $_REQUEST['Page'];
?>
<form name="frm1" method="post" action="changeandroid.php">
<table width="700" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">
<tr><th width="150">Name</th>
<th width="100">City</th>
<th width="82">Branch</th>
<th width="80">Employee Code</th>
<th width="92">Designation</th>
<th width="92">Date of Join</th>
<th width="92">Contact</th>
<th width="120">Last Created Date</th>
<th width="92">Action</th>

</tr>

<?php

$count=0;
include("config.php");
$br=$_SESSION['branch'];
$eng_log=$_SESSION['user'];


$str.="select * from area_engg where deleted=1 and status=0 and engg_name !='' and city !='0' and area !='0'";

if(isset($_POST['name']) && $_POST['name']!='')
{
$str.=" and engg_name like '%".$_POST['name']."%'";

}

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$str.=" and area ='".$_POST['branch']."'";

}
if(isset($_POST['empcode']) && $_POST['empcode']!='')
{
$str.=" and emp_code like '%".$_POST['empcode']."%'";
}
if(isset($_POST['number']) && $_POST['number']!='')
{
	$str.=" and phone_no1 like '%".$_POST['number']."%'";
}

//echo $str ;

$table=mysqli_query($con1,$str);

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

$str.=" order by created_at DESC  LIMIT $Page_Start , $Per_Page";
//echo $str;

$qry=mysqli_query($con1,$str);
while($row=mysqli_fetch_row($qry))
{
$count=$count+1;

$qry2=mysqli_query($con1,"select city from cities where city_id='".$row[3]."'");
$row2=mysqli_fetch_row($qry2);
$qry3=mysqli_query($con1,"select name from avo_branch where id='".$row[2]."'");
$row3=mysqli_fetch_row($qry3);

?>

<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
    
<td><?php echo $row[1]; ?></td>
<td><?php echo $row2[0]; ?></td>
<!-- Branch-->
<td><?php echo $row3[0]; ?></td>
<td><?php echo $row[6]; ?></td>   <!-- Employee code-->
<td><?php echo $row[11]; ?></td>   <!-- Designation-->
<td><?php echo $row[13]; ?></td>   <!-- DOJ-->
<td><?php echo $row[5]; ?></td>   <!-- contact-->
<td><?php echo $row[12]; ?></td>

<?php if(($_SESSION['designation'])=='1'){ ?>

<td width="56" height="31">  <a href="javascript:confirm_activate(<?php echo $row[0]; ?>);" class="update"> Activate </a></td>
<?php } } ?>
</tr>

</table>
<!--<input type="submit" value="Exchange Phone" name="cmdexc">-->
</form>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?></font></div>