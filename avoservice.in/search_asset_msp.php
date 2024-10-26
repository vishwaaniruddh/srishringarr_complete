<?php
include("access.php");
$count=0;
include("config.php");


$strPage = $_REQUEST['Page'];
$sql="Select * from assets_specification where 1";

if(isset($_POST['asset']) && $_POST['asset']!='')
{
$sql.=" and assets_id ='".$_POST['asset']."'";

}

if(isset($_POST['name']) && $_POST['name']!='')
{
$sql.=" and name like '%".$_POST['name']."%'";

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
$sql.=" order by assets_id ASC, name ASC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
if(mysqli_num_rows($table)>0)
{
?>
<table width="770" border="0" cellpadding="1" cellspacing="0" class="res" id="custtable">
<tr><th width="100">Product Name</th>
<th width="150">Product Specification</th>
<th width="88">Min. Selling Price</th>

<? if ($_SESSION['user']=='masteradmin' || $_SESSION['user']=='accounts'){ ?>
<th width="100">Edit Price</th>
<th width="100">Action</th>
<? } ?>
</tr>


<?php 
while($row=mysqli_fetch_row($table))
{

$asid=$row[0];
$qry2=mysqli_query($con1,"select assets_name from assets where assets_id='".$row[1]."'");
$assetname=mysqli_fetch_row($qry2);

//$count=$count+1;

?>

<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $assetname[0]; ?></td>
<td><?php echo $row[2]; ?></td>
<td align="center"><?php echo $row[4]; ?></td>

<? if($_SESSION['user']=='masteradmin' || $_SESSION['user']=='accounts') { ?>

<div id="subdiv<?php echo $asid; ?>" >
<td width="75">
<input type="number" min="0" max="9999999" name="price<?php echo $asid; ?>" id="price<?php echo $asid; ?>" onkeyup="if(parseInt(this.value)>9999999){ this.value =0; return false; }"  />
</td> 

<td>		
<input type="button" name="submission" value="submit" onclick="setchange(<?php echo $asid; ?>)" />
</td>	
</div>

</tr>
<?php } }

?>
<tr><td colspan="9" align="center">
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
?></font></div></td></tr></table>
<?php
}
?>