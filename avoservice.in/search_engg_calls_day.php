<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection


$branch=$_POST['branch_avo'];

if(isset($_POST['date']) && $_POST['date']!='')
{
$date=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['date'])));

}
else{
$date=date('Y-m-d');
}

$strPage = $_REQUEST['Page'];


?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="10%">Engineer Name</th>
<th width="10%">Mobile No.</th>
<th width="10%">Designation</th>
<th width="10%">Branch</th>
<th width="8%">City</th>
<th width="5%">City Cat</th>
<th width="5%">Attendance</th>
<th width="5%">No. of Tickets</th>
<th width="5%">No. of Visits</th>
<th width="5%">PM Calls</th>

 </tr>
<?php

$ii=1;

$qry="SELECT engg_id,engg_name, loginid, area, city, engg_desgn, emp_code, phone_no1 FROM `area_engg` where status=1 and deleted=0 ";

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
{
    $qry .=" and area='".$branch."'";
}

//echo $qry;

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
<td  valign="center"><?php echo $engg[7]; ?></td>
<td  valign="center"><?php echo $engg[5]; ?></td>
<td  valign="center"><?php echo $brname[0]; ?></td>
<td  valign="center"><?php echo $city[0]; ?></td>
<td  valign="center"><?php echo $city[1]; ?></td>
<?
//echo "select id from employee where empcode='".$engg[6]."' and status=0";

$empqry=mysqli_query($con1,"select id from employee where empcode like '%".$engg[6]."%'and status=0 ");
$emprow=mysqli_fetch_row($empqry);

$attqry=mysqli_query($con1,"select attendance from Attendance where emp_id='".$emprow[0]."' and date='".$date."'");

$att=mysqli_fetch_row($attqry);

$alert= "select count(distinct alert_id)  as `count`,  count(alert_id) as `visit` from alert_progress where engg_id= '".$engg[2]."' and date(responsetime) ='".$date."' group by engg_id  " ;    


$alert_id= mysqli_query($con1,$alert);
$row = mysqli_fetch_assoc($alert_id);
$callcnt = $row['count'];
$visitcnt = $row['visit'];
  ?>
  <td  valign="center"><?php echo $att[0]; ?></td>
<td  valign="center"><?php echo $callcnt; ?></td>
<td  valign="center"><?php echo $visitcnt; ?></td>
<?

$respqry="select count(alert_id) as `pmcount` from alert where alert_id in (select alert_id from alert_delegation where engineer='".$engg[0]."' and status=0) and alert_type in('pm','temp_pm') and date(close_date)='".$date."' group by engg_id" ; 
//echo $respqry;
$pmqry= mysqli_query($con1,$respqry);
$pmc = mysqli_fetch_assoc($pmqry);

$pmcount=$pmc['pmcount'];

?>
<td  valign="center"><?php echo $pmcount; ?></td>


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

