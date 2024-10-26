<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection


$branch=$_POST['branch_avo'];
$type= $_POST['type'];


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$frmdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			//echo Sfrmdt. " ".$todt;
}
else{
$frmdt=date('Y-m-d');
$todt=date('Y-m-d');
}

$strPage = $_REQUEST['Page'];


?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="10%">Engineer Name</th>
<th width="10%">Employee Code</th>

<th width="10%">Designation</th>
<th width="10%">Branch</th>
<th width="8%">City</th>
<th width="5%">City Cat</th>
<th width="5%">No. of Tickets</th>
<th width="5%">No. of Visits</th>


<?
//================= Date heading====
$rowdate="select distinct date(date_format(responsetime,'%Y-%m-%d')) as uniquedates  from alert_progress where date(responsetime) between '".$frmdt."' and '".$todt."' ORDER BY date(responsetime) ASC";
$rdate=mysqli_query($con1,$rowdate);
while($row4=mysqli_fetch_assoc($rdate))
{?>
 <th width="5"> <?php echo date("d-m", strtotime($row4['uniquedates']));?> </th> 
 <?php }?>
 </tr>
<?php

$ii=1;

$qry="SELECT engg_id,engg_name, loginid, area, city, engg_desgn,emp_code FROM `area_engg` where status=1 and deleted=0 and area ='".$branch."'";

$qy=mysqli_query($con1,$qry);

while ($engg=mysqli_fetch_row($qy)) {
    
    //===Branch====
$branchqry=mysqli_query($con1,"select name from avo_branch where id='".$engg[3]."'");
$brname=mysqli_fetch_row($branchqry);

 $cityqry=mysqli_query($con1,"select city, category from cities where city_id='".$engg[4]."' ");
$city=mysqli_fetch_row($cityqry);
?>    

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="center"><?php echo $engg[1]; ?></td>
<td  valign="center"><?php echo $engg[6]; ?></td>
<td  valign="center"><?php echo $engg[5]; ?></td>
<td  valign="center"><?php echo $brname[0]; ?></td>
<td  valign="center"><?php echo $city[0]; ?></td>
<td  valign="center"><?php echo $city[1]; ?></td>
<?

$alert= "select count(distinct alert_id)  as `count`,  count(alert_id) as `visit` from alert_progress where engg_id= '".$engg[2]."' and date(responsetime) between '".$frmdt."' and '".$todt."' " ;    


$alert_id= mysqli_query($con1,$alert);
$row = mysqli_fetch_assoc($alert_id);
$callcnt = $row['count'];
$visitcnt = $row['visit'];
  ?>
<td  valign="center"><?php echo $callcnt; ?></td>
<td  valign="center"><?php echo $visitcnt; ?></td>

<?
//==================Datewise count========

$dateqry="select distinct date(date_format(responsetime,'%Y-%m-%d')) as uniquedates  from alert_progress where date(responsetime) between '".$frmdt."' and '".$todt."' ORDER BY date(responsetime) ASC";

$daterow =mysqli_query($con1,$dateqry);

while($drow=mysqli_fetch_array($daterow)){

$cnt=0;

$cntqry= "select count(alert_id) as `dayvisit` from alert_progress where engg_id= '".$engg[2]."' and date(responsetime)='".$drow[0]."'" ;    

//echo $cntqry;

$eqry=mysqli_query($con1,$cntqry);
$cntrow=mysqli_fetch_assoc($eqry);
$cnt=$cntrow['dayvisit'];

?>
<td align="center"><?php echo $cnt ;?></td>

<?php } ?>

</tr>
<?php $ii++;   


} ?>
</table>
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

?>

 
<div id="bg" class="popup_bg"> </div> 

