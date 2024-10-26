<?php
include('config.php');

session_start();
//require("myfunction/function.php");
############# must create your db base connection

//echo $_SESSION['designation']; echo $_SESSION['branch']; echo $_SESSION['user'];


$strPage = $_REQUEST['Page'];
 $br=$_POST['br'];
//$status=$_POST['mapp'];

echo $status;
//==========================================	
if($_POST['br']=='all')
$sql="Select distinct(engg_id) from engg_site_mapping where (engg_id !='' or  engg_id !='0')";
else
 $sql="Select distinct(engg_id) from engg_site_mapping where branch_id in(".$br.") and (engg_id !='' or  engg_id !='0') ";	

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and branch_id='".$branch."'";
}

//echo $sql;
$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
########### pagins
?>
 <div align="center"><b>Total Records: <?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;
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
$qry22=$sql;
$sql.=" order by engg_id ASC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);

include("config.php");
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="100">Existing Engineer</th>
<th width="77">City Name</th>
<th width="77">Branch</th>

<th width="40">Engineer Status</th>
<th width="70">Action</th>


<?php
if(mysqli_num_rows($table)>0) {

while($row= mysqli_fetch_row($table))
{

$qry1=mysqli_query($con1,"select engg_name, status, area, city from area_engg where engg_id='$row[0]'");
$enrow=mysqli_fetch_row($qry1);
$oldeng=$enrow[0];

$ciqry=mysqli_query($con1,"select city from cities where city_id='$enrow[3]'");
$cityname=mysqli_fetch_row($ciqry);


$brqry1=mysqli_query($con1,"select name from avo_branch where id='$enrow[2]'");
$branch=mysqli_fetch_row($brqry1);

if($enrow[1]==1) { $stat="Active";}
else{ $stat="Left Job /Transferred";}
?>
<div class=article>
<div class=title><tr>

<td width="77"><?php echo $oldeng ?></td>
<td width="77"><?php echo $cityname[0] ?></td>
<td width="77"><?php echo $branch[0] ?></td>
<td width="40"><?php echo $stat ?></td>


<td width="77"> 
<? if($stat !="Active") {?>
<a href="#" onClick="window.open('edit_engg_mapp.php?id=<?php echo $row[0]; ?>&br=<?php echo $enrow[2]; ?>','edit_mapp','width=700px,height=750,left=200,top=40')"><font color="Red"> Change Engineer</font> </a>
<? } else { ?>
<a href="#" onClick="window.open('edit_engg_mapp.php?id=<?php echo $row[0]; ?>&br=<?php echo $enrow[2]; ?>','edit_mapp','width=700px,height=750,left=200,top=40')"><font color="yellow"> Shift Engineer</font> </a>
<? } ?>
</td>


</tr></div></div><?php
} }

?></table>
<div class="pagination" style="width:90%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?> 
<form name="frm" method="post" action="exportallamc.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>