<?php
include("access.php");
$strPage = $_REQUEST['Page'];
?>

<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">
<tr><th width="86">Name</th>
<th width="103">City</th>
<th width="82">Area</th>
<th width="80">Email</th>
<th width="92">Contact</th>
<?php if(($_SESSION['designation'])=='1'){ ?><th width="80">Resume</th>
<th width="92">Approval</th>
<th width="47">Edit</th>
<th width="56">Delete</th>
<th width="56">Deactivate Android App</th>
<?php } ?></tr>

<?php

$count=0;
include("config.php");
$br=$_SESSION['branch'];
if($_SESSION['branch']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
$qry="";
$str="";
//include_once('class_files/select.php');
//$sel_obj=new select();
//$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_engg","","",array(""),"y","engg_name","a");
//echo $br2." ".$_SESSION['branch'];
if($_SESSION['branch']=='all')
{
$str.="select * from area_engg where deleted=0";
}
else
$str.="select * from area_engg where deleted=0 and area in (".$_SESSION['branch'].")";

//echo $str;
if(isset($_POST['name']) && $_POST['name']!='')
{
$str.=" and engg_name like '%".$_POST['name']."%'";

}
if(isset($_POST['email']) && $_POST['email']!='')
{
$str.=" and email_id like '%".$_POST['email']."%'";
}
if(isset($_POST['number']) && $_POST['number']!='')
{
	$str.=" and (phone_no1 like '%".$_POST['number']."%' or phone_no2 like '%".$_POST['number']."%')";
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

$str.=" order by engg_name ASC  LIMIT $Page_Start , $Per_Page";
//echo $str;
$qry=mysqli_query($con1,$str);

while($row=mysqli_fetch_row($qry))
{
$count=$count+1;
//echo "select city from cities where city_id='".$row[3]."'";
//echo "select state from state where state_id='".$row[2]."'";
$qry2=mysqli_query($con1,"select city from cities where city_id='".$row[3]."'");
$row2=mysqli_fetch_row($qry2);
$qry3=mysqli_query($con1,"select state from state where state_id='".$row[2]."'");
$row3=mysqli_fetch_row($qry3);
$qryme=mysqli_query($con1,"Select status from notification_tble where pid='".$row[0]."'");
$qryres=mysqli_fetch_row($qryme);
//$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_engg","","",array(""),"y","engg_name","a");	
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row[1]; ?></td>
<td><?php echo $row2[0]; ?></td>
<td><?php echo $row3[0]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[5]; ?></td>
<?php if(($_SESSION['designation'])=='1'){ ?><td><?php if($row[7]!=''){  ?><a href="download.php?filename=<?php echo $row[7]; ?>"><?php echo $row[1]." Resume"; ?></a><?php  } ?></td>
<td><?php // echo $row[9];   ?>
<div id="app<?php echo $row[0]; ?>"><?php if($row[9]==0){ ?><input class="buttn" type='button' onClick="Approve('<?php echo $row[0]; ?>');" style="background:#; height:25px" value='Approve'><?php } elseif($row[9]==1){ ?><input class="buttn" type='button' style="background:#CCCCCC; height:25px" onClick="Approve('<?php echo $row[0]; ?>');" value='Disapprove'><?php }  ?></div></td>
<td width="47" height="31"> <a href='edit_areaeng.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<td width="56" height="31">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);" class="update"> Delete </a></td>
<td width="56" height="31">
<?php if($qryres[0]==0)
{ 
?> 
 <a href="javascript:deactivate(<?php echo $row[0]; ?>);" class="update"> Deactivate</a>
 <?php
  } 
  elseif($qryres[0]==1)
  {?> 
  <a href="javascript:reactivate(<?php echo $row[0]; ?>);" class="update"> Reactivate</a></td>
<?php  } ?>
<?php  } ?>
</tr>
<?php } ?>
</table>
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