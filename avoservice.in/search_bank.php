<?php
include("access.php");
$strPage = $_REQUEST['Page'];
?>
<form name="frm1" method="post" action="changeandroid.php">
<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">
<tr><th width="200">Bank Name</th>
<th width="80">Customer Name</th>
<th width="47">Edit</th>
<!--<th width="56">Delete</th>-->

</tr>

<?php

$count=0;
include("config.php");
$br=$_SESSION['branch'];
if($_SESSION['branch']!='all')
{
}
$qry="";
$str="";

if($_SESSION['branch']=='all' || $_SESSION['branch']=='0')
{
$str.="select * from `avo_bank` where 1";
}
else
$str.="select * from `avo_bank`";

//echo $str;
if(isset($_POST['name']) && $_POST['name']!='')
{
$str.=" and bank_id = '".$_POST['name']."'";

}
if(isset($_POST['customer']) && $_POST['customer']!='')
{
$str.=" and cust_id = '".$_POST['customer']."'";
}

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

$str.=" order by bank_id ASC  LIMIT $Page_Start , $Per_Page";
//echo $str;
$qry=mysqli_query($con1,$str);
while($row=mysqli_fetch_row($qry))
{
$count=$count+1;
	
?>
<tr>
<td><?php echo $row[1]; ?></td>
<td><?php 
$cust=mysqli_query($con1,"select `cust_name` from `customer` where cust_id='".$row[2]."'");
$cust1=mysqli_fetch_row($cust);
echo $cust1[0]; ?></td>


<td width="47" height="31"> <a href='edit_avobank.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<!--<td width="47" height="31"> <a href='edit_areaeng.php?id=<?php //echo $row[0]; ?>'> Delete </a></td>-->
</tr>
<?php } ?>
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
?></font></div>